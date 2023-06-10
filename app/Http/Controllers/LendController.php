<?php

namespace App\Http\Controllers;

use App\Models\Lend;
use App\Models\User;
use Illuminate\Http\Request;


class LendController extends Controller
{
	public function createLend(Request $request)
	{
		$Lend = new Lend($request->all());
		//$Lend -> owner_user_id = $owner;
		//$Lend -> customer_user_id = $customer;
		$Lend -> save();
		return response()-> json(['lend'=>$Lend], 201);
	}
}
