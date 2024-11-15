<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TypeController;
use App\Models\Task;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('types', TypeController::class);
Route::get('tasks/{id}',[TaskController::class,'index'])->name('task-index');
Route::post('task/store/{taskId}',[TaskController::class,'store'])->name('task-store');
Route::get('assign/{taskId}',[TaskController::class,'assignIndex'])->name('assign-index');
Route::post('assign-to-user/{taskId}',[TaskController::class,'assignUser'])->name('assign-to-user');
Route::get('assigned-to-me',[TaskController::class,'assignedToMe'])->name('assiged-to-me');
Route::post('complete-status/{taskId}',[TaskController::class,'completeStatus'])->name('complete-status');
Route::post('incomplete-status/{taskId}',[TaskController::class,'incompleteStatus'])->name('incomplete-status');
Route::get('User-task',[TaskController::class,'userTask'])->name('user-task');




Route::get('/dashboard', function () {
    return view('layouts.master');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
