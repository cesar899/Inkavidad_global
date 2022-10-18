<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;

class SellersController extends Controller
{
    function getSellers() {
        $sellers = User::where('rol', 4)->with('batchesSold')->with('sales')->get();
        return response()->json($sellers, 200);
    }
    function getSellerDetails($id) {
        $sales = Sale::where('seller_id', $id)->get();
        return response()->json($sales, 200);
    }
}
