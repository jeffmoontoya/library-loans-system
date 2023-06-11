<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
	/**
	 * Obtiene todos los usuarios.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAllUsers()
	{
		//$users = User::all(); Trae todos los usuarios

		// $users = User::where('id', '<', 100)   Ejemplo de consulta GET
		//      ->orderBy('name')
		//      ->get();

		$users = User::get();

		//return response()->json($users , 201);  //devolver datos
		return response()->json(['users' => $users], 200); //devuelve datos en arreglo asociativo
	}

	public function getAllLendsByUser(User $user)
	{
		$customerLends = $user->load(['CustomerLends.Book.Category', 'CustomerLends.Book.Author'])->CustomerLends;
		return response()->json(['customer_lends' => $customerLends], 200);
	}

	public function getAllUsersWithLends()
	{
		$users = User::with("CustomerLends.Book")->has("CustomerLends")->get();
		return response()->json(['users' => $users], 200);
	}

	/**
	 * Obtiene un usuario específico.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function getAnUser(user $user) //Metodo mágico consulta usuario
	{
		return response()->json(['user' => $user], 200); //devuelve datos en arreglo asociativo
	}

	/**
	 * Crea un nuevo usuario.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function createUser(CreateUserRequest $request)
	{
		$user = new User($request->all());
		$user->save();
		return response()->json(['user' => $user], 201);
	}

	/**
	 * Actualiza un usuario existente.
	 *
	 * @param  \App\Models\User        $user
	 * @param  \Illuminate\Http\Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function updateUser(user $user, UpdateUserRequest $request)
	{
		$user->update($request->all());
		return response()->json(['user' => $user->refresh()], 201);
	}

	/**
	 * Elimina un usuario existente.
	 *
	 * @param  \App\Models\User $user
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function deleteUser(user $user)
	{
		$user->delete();
		return response()->json([], 204);
	}
}
