<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Middleware\AdminAuthMiddleware;
use App\Http\Middleware\UserAuthMiddleware;
use App\Http\Middleware\RedirectIfAuthenticated;

Route::get('/', function () {
    return redirect(route('login'));
});
//**********  login/register/logout

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'userLogin']);
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
});

//********* user routes

Route::middleware([UserAuthMiddleware::class])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/{tax_account}', [UserController::class, 'switchCompany'])->name('dashboard.switchCompany');
});
//******** admin routes

Route::prefix('admin')->middleware([AdminAuthMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('companies', CompanyController::class);
    Route::get('/companies-crate', [CompanyController::class,'create'])->name('admin.companies.create');
    Route::get('/companies-edit/{id}', [CompanyController::class,'edit'])->name('admin.companies.edit');
    Route::post('/companies-delete/{id}', [CompanyController::class,'delete'])->name('admin.companies.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
    Route::post('/block-user/{id}', [AdminController::class, 'blockUser'])->name('admin.blockUser');

    Route::get('/users/{id}/assign-companies', [AdminController::class, 'showAssignedCompany'])->name('admin.users.showAssignedCompany');
    Route::post('/users/{id}/add-company-on-user', [AdminController::class, 'addCompanyOnUser'])->name('admin.users.addCompanyOnUser');
    Route::post('/users/{id}/delete-company-on-user', [AdminController::class, 'deleteCompanyOnUser'])->name('admin.users.deleteCompanyOnUser');

});

Route::middleware([RedirectIfAuthenticated::class])->group(function () {
    Route::get('/login', [AuthController::class, 'showUserLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'userLogin']);
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AuthController::class, 'adminLogin']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
