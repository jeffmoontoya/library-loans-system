<?php

namespace App\Http\Controllers;

use App\Http\Requests\Lend\CreateLendRequest;
use App\Http\Requests\Lend\UpdateLendRequest;
use App\Models\Lend;
use App\Models\User;
use Illuminate\Http\Request;


class LendController extends Controller
{
	public function getAnLend(Lend $lend) //Metodo mágico consulta usuario
	{
		return response()->json(['lend' => $lend], 200); //devuelve datos en arreglo asociativo
	}

	public function getAllLends(){
		$lends = Lend::get();
		return response()->json(['lends' => $lends], 200);
	}


	public function createLend(CreateLendRequest $request)
	{
		$Lend = new Lend($request->all());
		//$Lend -> owner_user_id = $owner;
		//$Lend -> customer_user_id = $customer;
		$Lend -> save();
		return response()-> json(['lend'=>$Lend], 201);
	}

	public function updateLend(Lend $lend, UpdateLendRequest $request){
		$lend->update($request->all());
		return response()->json(['lend' => $lend->refresh()], 201);
	}

	public function deleteLend(Lend $lend){
		$lend->delete();
		return response()->json([], 204);
	}
}
