<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/homepage', function () {
    return view('homepage');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

Route::get('/addexpense', function () {
    return view('users.addexpense');
});

Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');//coreect
Route::get('/expenseindex', [UserController::class, 'welcome'])->name('users.expense.index');//overallviewoflistofstoredasindex
Route::post('/users/{userId}/expenses', [UserController::class, 'store'])->name('users.expenses.store');//corect
Route::put('/expenses/{id}', [UserController::class, 'update'])->name('expenses.update');//correct
Route::delete('/users/expense/{userId}', [UserController::class, 'destroy'])->name('users.expense.destroy');//corect
Route::get('/editpage/{userId}', [UserController::class, 'edit'])->name('users.expense.edit');//correct

Route::get('/users/{userId}/expenses', [UserController::class, 'showExpenses'])->name('users.expenses.index');//wrong

Route::get('/users/index', [UserController::class, 'index'])->name('users.index');//wrong

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('users.dashboard');
    Route::get('/expenseindex', [UserController::class, 'welcome'])->name('users.expense.index');
    Route::post('/users/{userId}/expenses', [UserController::class, 'store'])->name('users.expenses.store');
    Route::put('/expenses/{id}', [UserController::class, 'update'])->name('expenses.update');
    Route::delete('/users/expense/{userId}', [UserController::class, 'destroy'])->name('users.expense.destroy');
    Route::get('/editpage/{userId}', [UserController::class, 'edit'])->name('users.expense.edit');

    // This route seems incorrect, assuming it's meant to show expenses for a specific user
    Route::get('/users/{userId}/expenses', [UserController::class, 'showExpenses'])->name('users.expenses.index');

    // This route also seems incorrect, assuming it's meant to show the index page for users
    Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
});

php artisan storage:link



