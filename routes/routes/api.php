<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;


Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	Route::get('/GetAllUsers', 'getAllUsers'); //GET -> traer data
	Route::get('/GetAnUser/{user}', 'getAnUser'); //GET -> traer data
	Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser');
	Route::get('/GetAllUsersWithLends', 'getAllUsersWithLends');


	Route::post('/CreateUser', 'createUser'); //POST -> crea data
	Route::put('/UpdateUser/{user}', 'updateUser'); //PUT -> edita data
	Route::delete('/DeleteUser/{user}', 'deleteUser'); //DELETE -> elimina data
});

Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {
	Route::post('/CreateLend', 'createLend');
});


Route::group(['prefix' => 'Books', 'controller' => BookController::class], function () {
	Route::get('/GetAllBooks', 'getAllBooks');
	Route::post('/SaveBook', 'saveBook');
});

Route::group(['prefix' => 'Categories', 'controller' => CategoryController::class], function () {
	Route::get('/GetAllCategories', 'getAllCategories');
});

Route::group(['prefix' => 'Authors', 'controller' => AuthorController::class], function () {
	Route::get('/GetAllAuthors', 'getAllAuthors');
});
