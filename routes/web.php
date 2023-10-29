<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\VerifyOwnership;
use App\Models\Listing;
use Illuminate\Http\Request;
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

// All listings
Route::get('/', [ListingController::class, 'index'])->name('index');


// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');

// Store listing data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');

// Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class,'edit'])->middleware('auth', VerifyOwnership::class);

// Update listing
Route::put('/listings/{listing}', [ListingController::class,'update'])->middleware('auth', VerifyOwnership::class);

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class,'destroy'])->middleware('auth', VerifyOwnership::class);

// Manage Listings
Route::get('/listings/manage', [ListingController::class, 'manage'])->middleware('auth');


// Register page
Route::get('/register', [UserController::class, "index"])->middleware('guest');

// Register user
Route::post('/users', [UserController::class, "store"]);

// Login page
Route::get('/login', [UserController::class, "login"])->name('login')->middleware('guest');

// Login user post
Route::post('/users/authenticate', [UserController::class, "authenticate"]);

// Logout
Route::post('/logout', [UserController::class,'logout']);

// Single listing  !!Keep Last!!
Route::get('/listings/{listing}', [ListingController::class, 'show']);
