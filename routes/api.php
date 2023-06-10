<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Define un grupo de rutas con el prefijo '/users'
Route::group(['prefix' => 'Users', 'controller'=> UserController::class], function () {
	 // Aquí se pueden definir las rutas relacionadas con la gestión de usuarios
	Route::get('GetAllUsers' , 'getAllUsers'); //GET -> traer data;
	Route::get('/GetAnUser/{user}' , 'getAnUser'); //GET -> traer data;
	Route::post('CreateUser' , 'createUser'); //POST -> Crear data;
	Route::put('UpdateUser/{user}' , 'updateUser'); //PUT -> Actualizar data;
	Route::delete('DeleteUser/{user}' , 'deleteUser'); //DELETE -> Eliminar data;
});
