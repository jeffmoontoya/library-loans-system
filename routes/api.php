<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LendController;
use App\Http\Controllers\UserController;

// Define un grupo de rutas con el prefijo '/users'
Route::group(['prefix' => 'Users', 'controller' => UserController::class], function () {
	// Aquí se pueden definir las rutas relacionadas con la gestión de usuarios
	Route::get('/GetAllUsers', 'getAllUsers'); //GET -> traer data;
	Route::get('/GetAnUser/{user}', 'getAnUser'); //GET -> traer data;
	Route::get('/GetAllLendsByUser/{user}', 'getAllLendsByUser'); //GET -> traer data;
	Route::get('/GetAllUsersWithLends/', 'getAllUsersWithLends');
	Route::post('/CreateUser', 'createUser'); //POST -> Crear data;
	Route::put('/UpdateUser/{user}', 'updateUser'); //PUT -> Actualizar data;
	Route::delete('/DeleteUser/{user}', 'deleteUser'); //DELETE -> Eliminar data;
});


Route::group(['prefix' => 'Lends', 'controller' => LendController::class], function () {

	Route::get('/GetAnLend/{lend}', 'getAnLend');
	Route::get('/GetAllLends', 'getAllLends');
	Route::post('/CreateLend', 'createLend');
	Route::put('/UpdateLend/{lend}', 'updateLend');
	Route::delete('/DeleteLend/{lend}', 'deleteLend');
});


Route::group(['prefix' => 'Books', 'controller' => BookController::class], function () {

	Route::get('/GetABook/{book}', 'getABook');
	Route::get('/GetAllBooks', 'getAllBooks');
	Route::post('/CreateBook', 'createBook');
	Route::put('/UpdateBook/{book}', 'updateBook');
	Route::delete('/DeleteBook/{book}', 'deleteBook');
});
