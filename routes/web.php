<?php

use Illuminate\Support\Facades\Route;

// Public or general routes
Route::get('/login', function () {
    return redirect('/admin/login');
});

Route::get('/login', function () {
    return redirect('/admin/login');
});

// Include admin routes from separate file
require __DIR__ . '/admin_routes.php';
