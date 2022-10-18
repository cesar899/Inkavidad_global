<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Orders\OrderRepository;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Batch;
use App\Models\Sale;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function store (StoreRequest $request){
         // $userRepo = new UserRepository();
        //$orderData = $request->validated();
        // $newUser = $userRepo->create($request->safe()->only(['name','last_name', 'dni', 'address','phone_number']));

        /*if($request->amount !== 0){

            $sale = new Sale();
            $sale->user_id = $request->user_id;
            $sale->seller_id = 2;
            $sale->batch_id = 2;
            $sale->status = 0;
            $sale->amount = 1000;
            $sale->amount_paid = 200;
            $sale->cuote_account = 5;
            $sale->cuote_paid = 1;
            $sale->paid->comming = 5;
            $sale->day_payment = Carbon::now();
            $sale->save();

            $orderData['bank_name'] = $request->bank_name;
            $orderData['ref_number'] = $request->ref_number;
            $orderData['voucher'] = $request->voucher;
        }
        $order = $this->repository->create($orderData);

        return response()->json($order , 200);*/


        if($request->amount !== 0){

            $sale = new Sale();
            $sale->user_id = $request->user_id;
            $sale->seller_id = 2;
            $sale->batch_id = 2;
            $sale->status = 0;
            $sale->amount = 1000;
            $sale->amount_paid = 200;
            $sale->cuote_account = 5;
            $sale->cuote_paid = 1;
            $sale->paid->comming = 5;
            $sale->day_payment = Carbon::now();
            $sale->save();

            $order = new Order();
            $order->bank_name = $request->bank_name;
            $order->user_id = $request->user_id;
            $order->sale_id = $sale->id;
            $order->seller_id = $request->seller_id;
            $order->ref_number = $request->ref_number;
            $order->status = 0;
            $order->voucher = $request->voucher;

             //Guardamos el voucher
            $voucher  = $request->file('voucher');
            $name = time() . "." . $voucher ->extension();
            $voucher->move(public_path('storage') . '/voucher/', $name);
            $order->payment_proof = '' . $name;

        }
        //$orderNew = $this->repository->create($order);

        return response()->json($order , 200);
    }

    public function showOrder() {
        return $this->repository->show();
    }
}

