<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/dashboard', function () {
//     return view('users.dashboard');
// })->middleware('auth')->name('users_dashboard');

Route::controller(AuthController::class)->group(function () {
    Route::get('/register', 'registre_show')->name('register_show');
    Route::post('/register', 'registre')->name('register');

    Route::get('/login', 'login_show')->name('login_show');
    Route::post('/login', 'login')->name('login');
    Route::get('/logout', 'logout')->name('logout');

    // Route::get('/user-dashboard', 'users_dashboard')->name('users_dashboard')->middleware('auth');
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('redirectIfAuthenticated');

    Route::get('/admin', 'admin_show')->name('admin_show');
    Route::post('/admin', 'admin_login')->name('admin_login');
    Route::get('/admin/logout', 'admin_logout')->name('admin_logout');

    Route::get('forget_password', 'forget_password_show')->name('forget_password_show');
});


Route::controller(AdminController::class)->group(function () {
    Route::get('/projects', 'projects')->name('projects')->middleware('admin');
    Route::get('add-project', 'add_project_show')->name('add_project_show')->middleware('admin');
    Route::post('add-project', 'add_project')->name('add_project')->middleware('admin');

    Route::get('/users', 'users')->name('users')->middleware('admin');
    Route::get('/project-detail/{id}', 'project_detail')->name('project_detail')->middleware('admin');
    Route::get('/project-edit/{id}', 'project_edit')->name('project_edit')->middleware('admin');
    Route::post('/edit-project', 'edit_project')->name('edit_project')->middleware('admin');
    Route::get('/delete-project/{id}', 'delete_project')->name('delete_project')->middleware('admin');
});
