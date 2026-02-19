<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SecurityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;

// Public routes
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

// Authenticated routes
Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('users/export/csv', [UserController::class, 'exportCsv'])->name('users.export.csv');
        Route::get('users/export/pdf', [UserController::class, 'exportPdf'])->name('users.export.pdf');
        Route::post('users/bulk-destroy', [UserController::class, 'bulkDestroy'])->name('users.bulk-destroy');
        Route::resource('users', UserController::class);
        Route::get('roles/export/csv', [RoleController::class, 'exportCsv'])->name('roles.export.csv');
        Route::get('roles/export/pdf', [RoleController::class, 'exportPdf'])->name('roles.export.pdf');
        Route::post('roles/bulk-destroy', [RoleController::class, 'bulkDestroy'])->name('roles.bulk-destroy');
        Route::get('roles/{role}/data', [RoleController::class, 'data'])->name('roles.data');
        Route::resource('roles', RoleController::class)->except(['show', 'create', 'edit']);
        Route::get('permissions/export/csv', [PermissionController::class, 'exportCsv'])->name('permissions.export.csv');
        Route::get('permissions/export/pdf', [PermissionController::class, 'exportPdf'])->name('permissions.export.pdf');
        Route::post('permissions/bulk-destroy', [PermissionController::class, 'bulkDestroy'])->name('permissions.bulk-destroy');
        Route::get('permissions/{permission}/data', [PermissionController::class, 'data'])->name('permissions.data');
        Route::resource('permissions', PermissionController::class)->except(['show', 'create', 'edit']);

        Route::prefix('security')->name('security.')->group(function () {
            Route::get('/', [SecurityController::class, 'index'])->name('index');
            Route::get('/{securityLog}', [SecurityController::class, 'show'])->name('show');
            Route::post('/block-ip/{ipAddress}', [SecurityController::class, 'blockIp'])->name('block-ip');
            Route::put('/unblock-ip/{ipAddress}', [SecurityController::class, 'unblockIp'])->name('unblock-ip');
            Route::get('/export', [SecurityController::class, 'export'])->name('export');
            Route::get('/export/pdf', [SecurityController::class, 'exportPdf'])->name('export.pdf');
        });
    });
});
