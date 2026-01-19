<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
