<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;
use App\Http\Controllers\FamilyMemberController;

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

Route::get('/', [FamilyController::class, 'index'])->name('families.index');
Route::get('/families', [FamilyController::class, 'index'])->name('families.index');
Route::get('/families/create', [FamilyController::class, 'create'])->name('families.create');
Route::post('/families', [FamilyController::class, 'store'])->name('families.store');

Route::get('/family-member/create/{id}', [FamilyMemberController::class, 'create'])->name('family-members.create');

Route::get('/family-member/{id}', [FamilyMemberController::class, 'index'])->name('family-members.index');

Route::post('/family-member', [FamilyMemberController::class, 'store'])->name('family-members.store');


Route::get('/families/{family}', [FamilyController::class, 'show'])->name('families.show');
Route::get('/families/{family}/edit', [FamilyController::class, 'edit'])->name('families.edit');
Route::put('/families/{family}', [FamilyController::class, 'update'])->name('families.update');
Route::delete('/families/{family}', [FamilyController::class, 'destroy'])->name('families.destroy');
