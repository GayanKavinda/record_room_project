<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('departments', DepartmentController::class);
    Route::resource('files', FileController::class)->middleware(['role:super-admin|admin|primary-user']);
    Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
    Route::post('/files/send-to-record-room', [FileController::class, 'sendToRecordRoom'])->name('files.sendToRecordRoom');
});

Route::middleware(['auth', 'role:super-admin'])->group(function () {
    Route::get('/record-room', [FileController::class, 'recordRoomIndex'])->name('record-room.index');
    Route::post('/files/{id}/assign-rack-location', [FileController::class, 'assignRackLocation'])->name('files.assignRackLocation');
    Route::post('/files/{id}/store-record-room', [FileController::class, 'storeRecordRoom'])->name('files.storeRecordRoom');  // New route for storing in record room
    Route::get('/stored-files', [FileController::class, 'storedFiles'])->name('record-room.storedFiles');
});


Route::middleware(['auth', 'role:super-admin|admin|primary-user'])->group(function () {
    Route::get('/files', [FileController::class, 'index'])->name('files.index');
    Route::put('/files/{id}', [FileController::class, 'update'])->name('files.update');
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
