<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;

use App\Models\Book;

// Home Route
Route::get('/', [BookController::class, 'showHomeWithBooks'])->name('home');

// Users Rpoutes..
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	// Show all users
	Route::get('/', 'showAllUsers')->name('users');
	// Show create user form
	Route::get('/CreateUser', 'showCreateUser')->name('user.create');
	// Show edit user form
	Route::get('/EditUser/{user}', 'showEditUser')->name('user.edit');
	// Create user
	Route::post('/CreateUser', 'createUser')->name('user.create.post');
	// Update user
	Route::put('/EditUser/{user}', 'updateUser')->name('user.edit.put');
	// Delete user
	Route::delete('/DeleteUser/{user}', 'deleteUser')->name('user.delete');
});

// Books Routes..
Route::group(['prefix' => 'Books', 'controller' => BookController::class], function () {
	Route::get('/', 'showBooks')->name('books');
	// Route::get('/CreateUser', 'showCreateUser')->name('user.create');
	// Route::get('/EditUser/{user}', 'showEditUser')->name('user.edit');

	// Route::post('/CreateUser', 'createUser')->name('user.create.post');
	// Route::put('/EditUser/{user}', 'updateUser')->name('user.edit.put');
	// Route::delete('/DeleteUser/{user}', 'deleteUser')->name('user.delete');
});

// Login Routes...
Route::group(['controller' => LoginController::class], function () {
	// Show the login form
	Route::get('login', 'showLoginForm')->name('login');
	// Post the login form to log the user in
	Route::post('login', 'login');
	// Logout the user
	Route::post('logout', 'logout')->name('logout');
});

// Forgot password Routes...
Route::group(['controller' => ForgotPasswordController::class], function () {
	// Display the form to request a password reset link
	Route::get('password/reset', 'showLinkRequestForm')
		->name('password.request');
	// Send a password reset link to the user
	Route::post('password/email', 'sendResetLinkEmail')
		->name('password.email');
});

// Reset password Routes...
Route::group(['controller' => ResetPasswordController::class], function () {
	// Show the password reset form
	Route::get('password/reset/{token}', 'showResetForm')
		->name('password.reset');
	// Reset the user's password
	Route::post('password/reset', 'reset')
		->name('password.update');
});

// Confirm password Routes...
Route::group(['controller' => ConfirmPasswordController::class], function () {
	// Password Confirmation Routes...
	Route::get('password/confirm', 'Auth\ConfirmPasswordController@showConfirmForm')
		->name('password.confirm');
	Route::post('password/confirm', 'Auth\ConfirmPasswordController@confirm');
});

// Email Verification Routes...
Route::group(['controller' => VerificationController::class], function () {
	// Show the email verification notice
	Route::get('email/verify', 'show')
		->name('verification.notice');

	// Verify the user's email address
	Route::get('email/verify/{id}/{hash}', 'verify')
		->name('verification.verify');

	// Resend the email verification notification
	Route::post('email/resend', 'resend')
		->name('verification.resend');
});
