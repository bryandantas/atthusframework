<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{LoginController, AdminController, UserController};
use App\Enums\PermissionType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('admin.login');
    Route::post('/login', [LoginController::class, 'login'])->name('admin.login_post');

    Route::group(['middleware' => ['permission:' . PermissionType::LOGIN_ADMIN, 'auth']], function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.home');

        Route::get('usuarios', [UserController::class, 'index'])->name('admin.users');
        Route::post('usuarios', [UserController::class, 'create'])->name('admin.users.create');
        Route::get('usuarios/{id}', [UserController::class, 'view'])->name('admin.users.user');
        Route::patch('usuarios/{id}/info', [UserController::class, 'updateInfo'])->name('admin.users.user.update_info');
        Route::patch('usuarios/{id}/password', [UserController::class, 'updatePassword'])->name('admin.users.user.update_password');
        Route::delete('usuarios/{id}', [UserController::class, 'delete'])->name('admin.users.user.delete');

        Route::get('perfil', [AdminController::class, 'profile'])->name('admin.profile');

        Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');
    });
});
