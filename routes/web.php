<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departments', DepartmentController::class);
    Route::resource('files', FileController::class)->middleware(['role:super-admin|admin|primary-user']);
});

Route::group(['middleware' => ['role:super-admin|admin']], function () {
    // Route::group(['middleware' => ['isAdmin']], function () {
   
        Route::resource('permissions', PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);
        
        Route::resource('roles', RoleController::class);
        Route::get('roles/{roleId}/delete', [RoleController::class, 'destroy'])->middleware('permission:delete role');
        
        Route::get('roles/{roleId}/give-permissions', [RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [RoleController::class, 'givePermissionToRole']);
        
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);
    });
    

// Add this route to check admin role permissions
Route::get('/check-admin-permissions', function() {
    // Fetch the 'admin' role
    $adminRole = Role::findByName('admin');

    // Get all permissions assigned to the 'admin' role
    $permissions = $adminRole->getAllPermissions();

    // Output the permissions
    return response()->json($permissions);
});

// Add this route to revoke 'delete role' permission from admin
Route::get('/revoke-delete-role-permission', function() {
    // Fetch the 'admin' role
    $adminRole = Role::findByName('admin');

    // Revoke the 'delete role' permission
    $adminRole->revokePermissionTo('delete role');

    return 'Delete role permission revoked from admin role';
});

Route::get('/check-super-admin-permissions', function() {
    $superAdminRole = Role::findByName('super-admin');
    $permissions = $superAdminRole->getAllPermissions();

    return response()->json($permissions);
});

require __DIR__.'/auth.php';
