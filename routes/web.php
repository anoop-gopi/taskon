<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminAuthController;

// Admin Auth Routes
Route::get('/admin', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// Auth Routes
Route::post('/auth/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::post('/auth/signin', [AuthController::class, 'signin'])->name('auth.signin');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::get('/auth/validate-session', [AuthController::class, 'validateSession'])->name('auth.validate-session');

// OAuth Routes - Google
Route::get('/auth/google/redirect', [AuthController::class, 'redirectToGoogle'])->name('auth.google.redirect');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback'])->name('auth.google.callback');

// OAuth Routes - Facebook
Route::get('/auth/facebook/redirect', [AuthController::class, 'redirectToFacebook'])->name('auth.facebook.redirect');
Route::get('/auth/facebook/callback', [AuthController::class, 'handleFacebookCallback'])->name('auth.facebook.callback');

Route::get('/', function () {
    $testimonials = \App\Models\Testimonial::where('is_active', true)
        ->orderBy('created_at', 'desc')
        ->limit(6)
        ->get();
    return view('public.home', ['testimonials' => $testimonials]);
})->name('public.home');

Route::get('/earn-money', function () {
    return view('public.earn-money');
})->name('public.earn-money');

Route::get('/how-it-works', function () {
    return view('public.how-it-works');
})->name('public.how-it-works');

Route::get('/learn', function () {
    return view('public.learn');
})->name('public.learn');

// Protected Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        // Get user's category or default to free (1)
        $userCategory = $user->category_id;
        
        // Fetch tasks that match user's category or lower
        // Free users (category 1) see only category 1 tasks (limit 1)
        // Premium users see tasks for their category and below
        $tasks = \App\Models\Task::where('category_id', '<=', $userCategory)
            ->orderBy('created_at', 'desc')
            ->get();
        
        // If user is free (category_id = 1), limit to 1 task
        if ($userCategory == 1) {
            $tasks = $tasks->take(1);
        }
        
        return view('dashboard.home', [
            'tasks' => $tasks,
            'userCategory' => $user->category,
        ]);
    })->name('dashboard.home');

    Route::get('/dashboard/profile', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        return view('dashboard.profile', [
            'user' => $user,
        ]);
    })->name('dashboard.profile');

    Route::post('/dashboard/profile/update-wallet', function (\Illuminate\Http\Request $request) {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $validated = $request->validate([
            'crypto_wallet' => 'nullable|string|max:255',
        ]);
        
        $user->update([
            'crypto_wallet' => $validated['crypto_wallet'],
        ]);
        
        return redirect()->route('dashboard.profile')->with('success', 'Crypto wallet updated successfully!');
    })->name('dashboard.profile.update-wallet');

    Route::get('/dashboard/upgrade', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $categories = \App\Models\UserCategory::where('id', '>', 1)->orderBy('id')->get();
        $currentCategory = $user->category;
        
        return view('dashboard.upgrade', [
            'categories' => $categories,
            'currentCategory' => $currentCategory,
        ]);
    })->name('dashboard.upgrade');

    Route::post('/dashboard/upgrade/{categoryId}', function ($categoryId) {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please sign in again.',
            ], 401);
        }
        
        $category = \App\Models\UserCategory::findOrFail($categoryId);
        
        // Create upgrade request
        $upgradeRequest = \App\Models\UpgradeRequest::create([
            'user_id' => $user->id,
            'from_category_id' => $user->category_id,
            'to_category_id' => $categoryId,
            'amount' => $category->price,
            'payment_url' => 'https://pay.cryptomus.com/pay/' . uniqid() . '-' . substr(md5($user->id . $categoryId . time()), 0, 8),
            'expires_at' => now()->addHours(2),
            'status' => 'pending_payment',
        ]);
        
        return response()->json([
            'success' => true,
            'upgradeRequestId' => $upgradeRequest->id,
        ]);
    })->name('dashboard.upgrade.process');

    Route::get('/dashboard/upgrade/invoice/{id}', function ($id) {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $upgradeRequest = \App\Models\UpgradeRequest::with(['toCategory'])->findOrFail($id);
        
        // Check if user owns this request
        if ($upgradeRequest->user_id != $user->id) {
            abort(403);
        }
        
        return view('dashboard.upgrade-invoice', [
            'upgradeRequest' => $upgradeRequest,
        ]);
    })->name('dashboard.upgrade.invoice');

    Route::get('/dashboard/upgrade/invoice/{id}/content', function ($id) {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please sign in again.',
            ], 401);
        }
        
        $upgradeRequest = \App\Models\UpgradeRequest::with(['toCategory'])->findOrFail($id);
        
        // Check if user owns this request
        if ($upgradeRequest->user_id != $user->id) {
            abort(403);
        }
        
        $html = view('dashboard.upgrade-invoice-modal', [
            'upgradeRequest' => $upgradeRequest,
        ])->render();
        
        return response()->json([
            'success' => true,
            'html' => $html,
            'paymentUrl' => $upgradeRequest->payment_url,
        ]);
    })->name('dashboard.upgrade.invoice.content');

    Route::post('/dashboard/upgrade/invoice/{id}/submit', function (\Illuminate\Http\Request $request, $id) {
        $user = auth()->user();
        
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Session expired. Please sign in again.',
            ], 401);
        }
        
        $upgradeRequest = \App\Models\UpgradeRequest::findOrFail($id);
        
        // Check if user owns this request
        if ($upgradeRequest->user_id != $user->id) {
            abort(403);
        }
        
        $validated = $request->validate([
            'payment_screenshot' => 'required|image|max:5120', // 5MB max
        ]);
        
        // Store the screenshot
        $path = $request->file('payment_screenshot')->store('payment-screenshots', 'public');
        
        // Update upgrade request
        $upgradeRequest->update([
            'payment_screenshot' => $path,
            'status' => 'pending_approval',
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Payment screenshot submitted! Your upgrade request is pending admin approval.',
        ]);
    })->name('dashboard.upgrade.submit-payment');

    Route::get('/dashboard/tasks', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $completedTasks = \App\Models\TaskCompleted::where('user_id', $user->id)
            ->with(['task', 'taskStatus'])
            ->orderBy('date_time', 'desc')
            ->get();
        
        return view('dashboard.tasks', ['completedTasks' => $completedTasks]);
    })->name('dashboard.tasks');

    Route::get('/dashboard/earnings', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        return view('dashboard.earnings');
    })->name('dashboard.earnings');

    Route::get('/dashboard/activity', function () {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        return view('dashboard.activity');
    })->name('dashboard.activity');

    Route::get('/dashboard/task/{taskId}', function ($taskId) {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $task = \App\Models\Task::findOrFail($taskId);
        return view('dashboard.task-detail', ['task' => $task]);
    })->name('dashboard.task.show');

    Route::get('/dashboard/task/{taskId}/complete', function ($taskId) {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $task = \App\Models\Task::findOrFail($taskId);
        return view('dashboard.task-complete', ['task' => $task]);
    })->name('dashboard.task.complete.form');

    Route::post('/dashboard/task/{taskId}/complete', function (\Illuminate\Http\Request $request, $taskId) {
        $user = auth()->user();
        
        if (!$user) {
            return redirect()->route('public.home')->with('error', 'Session expired. Please sign in again.');
        }
        
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'notes' => 'nullable|string',
        ]);

        // Store the uploaded image
        $imagePath = $request->file('image')->store('task_completions', 'public');

        // Create task completion record
        \App\Models\TaskCompleted::create([
            'task_id' => $taskId,
            'user_id' => $user->id,
            'image_path' => $imagePath,
            'notes' => $request->notes,
            'date_time' => now(),
        ]);

        return redirect()->route('dashboard.home')->with('success', 'Task submission received! We will review and process your completion.');
    })->name('dashboard.task.complete');
});

Route::get('/components', function () {
    return view('components.flyonui-components');
})->name('components');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('admin.dashboard');

Route::get('/admin/users', function () {
    return view('admin.users.index');
})->name('admin.users');

Route::get('/admin/users/{id}', function ($id) {
    // Mock user data - in production, fetch from database
    $users = [
        1 => ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com', 'joined_date' => '2023-06-15', 'earnings' => 2450.50],
        2 => ['id' => 2, 'name' => 'Sarah Miller', 'email' => 'sarah@example.com', 'joined_date' => '2023-08-22', 'earnings' => 3200.75],
        3 => ['id' => 3, 'name' => 'Mike Johnson', 'email' => 'mike@example.com', 'joined_date' => '2023-09-10', 'earnings' => 1890.25],
        4 => ['id' => 4, 'name' => 'Emily Davis', 'email' => 'emily@example.com', 'joined_date' => '2023-10-05', 'earnings' => 4100.00],
        5 => ['id' => 5, 'name' => 'Robert Wilson', 'email' => 'robert@example.com', 'joined_date' => '2023-11-12', 'earnings' => 2750.90],
        6 => ['id' => 6, 'name' => 'Jessica Brown', 'email' => 'jessica@example.com', 'joined_date' => '2024-01-08', 'earnings' => 3500.40],
        7 => ['id' => 7, 'name' => 'David Taylor', 'email' => 'david@example.com', 'joined_date' => '2024-02-14', 'earnings' => 2100.60],
        8 => ['id' => 8, 'name' => 'Amanda White', 'email' => 'amanda@example.com', 'joined_date' => '2024-03-20', 'earnings' => 3850.75],
    ];
    
    $user = $users[$id] ?? null;
    
    if (!$user) {
        abort(404, 'User not found');
    }
    
    return view('admin.users.show', ['user' => $user]);
})->name('admin.user.show');

Route::get('/admin/tasks', function () {
    return view('admin.tasks.index');
})->name('admin.tasks');

Route::get('/admin/tasks/create', function () {
    return view('admin.tasks.create');
})->name('admin.tasks.create');

Route::get('/admin/tasks/{id}', function ($id) {
    // Mock task data - in production, fetch from database
    $tasks = [
        1 => ['id' => 1, 'name' => 'Website Design', 'description' => 'Design a modern website layout', 'fee' => 500.00, 'count' => 3],
        2 => ['id' => 2, 'name' => 'API Development', 'description' => 'Build RESTful API endpoints', 'fee' => 750.00, 'count' => 5],
        3 => ['id' => 3, 'name' => 'Database Setup', 'description' => 'Configure database schema', 'fee' => 300.00, 'count' => 2],
        4 => ['id' => 4, 'name' => 'Mobile App', 'description' => 'Develop iOS and Android app', 'fee' => 1200.00, 'count' => 8],
        5 => ['id' => 5, 'name' => 'Content Writing', 'description' => 'Write product descriptions', 'fee' => 150.00, 'count' => 12],
        6 => ['id' => 6, 'name' => 'SEO Optimization', 'description' => 'Optimize website for search', 'fee' => 400.00, 'count' => 4],
        7 => ['id' => 7, 'name' => 'Testing & QA', 'description' => 'Test application functionality', 'fee' => 350.00, 'count' => 6],
        8 => ['id' => 8, 'name' => 'Deployment', 'description' => 'Deploy to production server', 'fee' => 200.00, 'count' => 1],
    ];
    
    $task = $tasks[$id] ?? null;
    
    if (!$task) {
        abort(404, 'Task not found');
    }
    
    return view('admin.tasks.show', ['task' => $task]);
})->name('admin.task.show');

Route::get('/admin/finance', function () {
    return view('admin.finance.index');
})->name('admin.finance');

Route::get('/admin/testimonials', function () {
    $testimonials = \App\Models\Testimonial::orderBy('created_at', 'desc')->get();
    return view('admin.testimonials.index', ['testimonials' => $testimonials]);
})->name('admin.testimonials');

Route::get('/admin/testimonials/create', function () {
    return view('admin.testimonials.create');
})->name('admin.testimonials.create');

Route::post('/admin/testimonials', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'feedback' => 'required|string',
        'stars' => 'required|integer|min:1|max:5',
        'is_active' => 'boolean',
    ]);

    if ($request->hasFile('photo')) {
        $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
    }

    \App\Models\Testimonial::create($validated);

    return redirect()->route('admin.testimonials')->with('success', 'Testimonial created successfully!');
})->name('admin.testimonials.store');

Route::get('/admin/testimonials/{id}/edit', function ($id) {
    $testimonial = \App\Models\Testimonial::findOrFail($id);
    return view('admin.testimonials.edit', ['testimonial' => $testimonial]);
})->name('admin.testimonials.edit');

Route::put('/admin/testimonials/{id}', function (\Illuminate\Http\Request $request, $id) {
    $testimonial = \App\Models\Testimonial::findOrFail($id);
    
    $validated = $request->validate([
        'customer_name' => 'required|string|max:255',
        'job_title' => 'required|string|max:255',
        'email' => 'nullable|email|max:255',
        'phone' => 'nullable|string|max:20',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'feedback' => 'required|string',
        'stars' => 'required|integer|min:1|max:5',
        'is_active' => 'boolean',
    ]);

    if ($request->hasFile('photo')) {
        // Delete old photo if exists and not default
        if ($testimonial->photo !== 'default_profile_pic.jpg' && \Storage::disk('public')->exists($testimonial->photo)) {
            \Storage::disk('public')->delete($testimonial->photo);
        }
        $validated['photo'] = $request->file('photo')->store('testimonials', 'public');
    }

    $testimonial->update($validated);

    return redirect()->route('admin.testimonials')->with('success', 'Testimonial updated successfully!');
})->name('admin.testimonials.update');

Route::delete('/admin/testimonials/{id}', function ($id) {
    $testimonial = \App\Models\Testimonial::findOrFail($id);
    
    // Delete photo if exists and not default
    if ($testimonial->photo !== 'default_profile_pic.jpg' && \Storage::disk('public')->exists($testimonial->photo)) {
        \Storage::disk('public')->delete($testimonial->photo);
    }
    
    $testimonial->delete();

    return redirect()->route('admin.testimonials')->with('success', 'Testimonial deleted successfully!');
})->name('admin.testimonials.destroy');

Route::get('/admin/approvals', function () {
    return view('admin.approvals.index');
})->name('admin.approvals');

// User approval routes
Route::post('/admin/users/{id}/approve', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    $user->update(['status_id' => 2]); // 2 = Approved
    
    // Send approval email
    \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\UserApproved($user));
    
    return redirect()->route('admin.users')->with('success', 'User approved successfully! Approval email sent.');
})->name('admin.user.approve');

Route::post('/admin/users/{id}/reject', function ($id) {
    $user = \App\Models\User::findOrFail($id);
    $user->update(['status_id' => 3]); // 3 = Rejected
    
    return redirect()->route('admin.users')->with('success', 'User rejected.');
})->name('admin.user.reject');

Route::get('/admin/approvals/{id}', function ($id) {
    $approval = \App\Models\TaskCompleted::with(['task', 'user', 'taskStatus'])->findOrFail($id);
    
    return view('admin.approvals.show', ['approval' => $approval]);
})->name('admin.approval.show');

// Approve task completion
Route::post('/admin/approvals/{id}/approve', function ($id) {
    $approval = \App\Models\TaskCompleted::with('task')->findOrFail($id);
    $approval->update(['status' => 2]); // 2 = Accepted
    
    // Create user earning record with current task earning value
    \App\Models\UserEarning::create([
        'user_id' => $approval->user_id,
        'task_id' => $approval->task_id,
        'earning' => $approval->task->earning,
    ]);
    
    return redirect()->route('admin.approvals')->with('success', 'Task completion approved successfully!');
})->name('admin.approval.approve');

// Reject task completion
Route::post('/admin/approvals/{id}/reject', function ($id) {
    $approval = \App\Models\TaskCompleted::findOrFail($id);
    $approval->update(['status' => 3]); // 3 = Rejected
    
    return redirect()->route('admin.approvals')->with('success', 'Task completion rejected.');
})->name('admin.approval.reject');

// Admin upgrade requests routes
Route::get('/admin/upgrade-requests', function (\Illuminate\Http\Request $request) {
    $status = $request->get('status', 'pending_approval');
    
    $requests = \App\Models\UpgradeRequest::with(['user', 'fromCategory', 'toCategory'])
        ->where('status', $status)
        ->orderBy('created_at', 'desc')
        ->paginate(15);
    
    $pendingCount = \App\Models\UpgradeRequest::where('status', 'pending_approval')->count();
    
    return view('admin.upgrade-requests', [
        'requests' => $requests,
        'pendingCount' => $pendingCount,
    ]);
})->name('admin.upgrade-requests');

Route::post('/admin/upgrade-requests/{id}/approve', function (\Illuminate\Http\Request $request, $id) {
    $upgradeRequest = \App\Models\UpgradeRequest::with('user')->findOrFail($id);
    
    // Update user's category
    $upgradeRequest->user->update([
        'category_id' => $upgradeRequest->to_category_id,
    ]);
    
    // Update request status
    $upgradeRequest->update([
        'status' => 'approved',
        'admin_notes' => $request->admin_notes,
    ]);
    
    return redirect()->route('admin.upgrade-requests', ['status' => 'approved'])
        ->with('success', 'Upgrade request approved! User has been upgraded to ' . $upgradeRequest->toCategory->name . ' plan.');
})->name('admin.upgrade-requests.approve');

Route::post('/admin/upgrade-requests/{id}/reject', function (\Illuminate\Http\Request $request, $id) {
    $upgradeRequest = \App\Models\UpgradeRequest::findOrFail($id);
    
    $request->validate([
        'admin_notes' => 'required|string',
    ]);
    
    $upgradeRequest->update([
        'status' => 'rejected',
        'admin_notes' => $request->admin_notes,
    ]);
    
    return redirect()->route('admin.upgrade-requests', ['status' => 'rejected'])
        ->with('success', 'Upgrade request rejected.');
})->name('admin.upgrade-requests.reject');
