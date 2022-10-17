<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function getCustomers() {
    	$cliente = User::where('rol', 5)
    	->with(
    		'batches',
    		'buy',
    	)->get();
    	
    	return response()->json($cliente, 200);
    }

    public function customerDetails($id) {
    	$details = User::where('id', $id)
    	->with(
    		'buy', 
    		'batches', 
    		'orders'
    	)->get();

    	return response()->json($details, 200);
    }
}
