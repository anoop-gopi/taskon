<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('public.home');
})->name('public.home');

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

Route::get('/admin/approvals', function () {
    return view('admin.approvals.index');
})->name('admin.approvals');

Route::get('/admin/approvals/{id}', function ($id) {
    // Mock approval data - in production, fetch from database
    $approvals = [
        1 => ['id' => 1, 'user_email' => 'john@example.com', 'task_name' => 'Website Design', 'task_id' => 'TASK-001', 'completion_date' => '2024-01-19 14:30:00', 'amount' => 500.00],
        2 => ['id' => 2, 'user_email' => 'sarah@example.com', 'task_name' => 'API Development', 'task_id' => 'TASK-002', 'completion_date' => '2024-01-18 11:45:00', 'amount' => 750.00],
        3 => ['id' => 3, 'user_email' => 'mike@example.com', 'task_name' => 'Database Setup', 'task_id' => 'TASK-003', 'completion_date' => '2024-01-17 09:20:00', 'amount' => 300.00],
        4 => ['id' => 4, 'user_email' => 'emily@example.com', 'task_name' => 'Mobile App', 'task_id' => 'TASK-004', 'completion_date' => '2024-01-16 16:15:00', 'amount' => 1200.00],
        5 => ['id' => 5, 'user_email' => 'robert@example.com', 'task_name' => 'Content Writing', 'task_id' => 'TASK-005', 'completion_date' => '2024-01-15 13:00:00', 'amount' => 150.00],
        6 => ['id' => 6, 'user_email' => 'jessica@example.com', 'task_name' => 'SEO Optimization', 'task_id' => 'TASK-006', 'completion_date' => '2024-01-14 10:30:00', 'amount' => 400.00],
        7 => ['id' => 7, 'user_email' => 'david@example.com', 'task_name' => 'Testing & QA', 'task_id' => 'TASK-007', 'completion_date' => '2024-01-13 15:45:00', 'amount' => 350.00],
        8 => ['id' => 8, 'user_email' => 'amanda@example.com', 'task_name' => 'Deployment', 'task_id' => 'TASK-008', 'completion_date' => '2024-01-12 12:00:00', 'amount' => 200.00],
    ];
    
    $approval = $approvals[$id] ?? null;
    
    if (!$approval) {
        abort(404, 'Approval not found');
    }
    
    return view('admin.approvals.show', ['approval' => $approval]);
})->name('admin.approval.show');
