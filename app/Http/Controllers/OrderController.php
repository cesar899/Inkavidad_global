<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Orders\OrderRepository;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Batch;

class OrderController extends Controller
{
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function store (StoreRequest $request){
        // $userRepo = new UserRepository();
        $orderData = $request->validated();
        // $newUser = $userRepo->create($request->safe()->only(['name','last_name', 'dni', 'address','phone_number'])); 
        
        if($request->amount !== 0){
            $orderData['bank_name'] = $request->bank_name;
            $orderData['ref_number'] = $request->ref_number;
            $orderData['voucher'] = $request->voucher;
        }
        $order = $this->repository->create($orderData);
       
        return response()->json($order , 200);
    }
}

