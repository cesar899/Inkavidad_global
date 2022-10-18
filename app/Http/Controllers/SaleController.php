<?php

namespace App\Http\Controllers;

use App\Repositories\Sales\SaleRepository;
use App\Models\Sale;
use App\Models\Order;
use Illuminate\Http\Request;

class SaleController extends Controller
{
	public function __construct() {
		$this->repository = new SaleRepository();
	}

    public function index() {
    	$sale = $this->repository->sales();

    	return $sale;
    }
    public function show($id)
    {
        $order = Order::where('sale_id',$id)->with('user')->with('seller')->get();
        return response()->json($order, 200);
    }

    public function Sales()
    {
        $sale = Sale::with('user')->with('seller')->with('lote.project')->with('lote.group')->get();
        return response()->json($sale, 200);
    }
}
