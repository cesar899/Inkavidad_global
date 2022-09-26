<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Orders\OrderRepository;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Batch;

class OrderController extends Controller
{
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function store (StoreRequest $request){
        $orderData = $request->validated();
        if($request->amount !== 0){
            $orderData['bank_name'] = $request->bank_name;
            $orderData['ref_number'] = $request->ref_number;
            $orderData['voucher'] = $request->voucher;
        }
        $order = $this->repository->create($orderData);
       
        return response()->json($order , 200);
    }
}

