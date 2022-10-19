<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Orders\OrderRepository;
use App\Repositories\Users\UserRepository;
use App\Http\Requests\Orders\StoreRequest;
use App\Models\Batch;
use App\Models\Order;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Carbon;
use Tymon\JWTAuth\Contracts\Providers\Auth;

class OrderController extends Controller
{
    public function __construct() {
        $this->repository = new OrderRepository();
    }

    public function store (StoreRequest $request){

        if($request->amount !== 0){

            $day = Carbon::now();
            $day_payment =  $day->addDay($request->paid_comming);

            $lote = Batch::where('id', $request->batch_id)->first();
            $amountTotal = $lote->amount;
            $dues = $amountTotal - $request->amount;
            $account_cuote = $amountTotal / $request->amount ;



            $sale = new Sale();
            $sale->user_id = $request->user_id;
            $sale->seller_id = $request->seller;
            $sale->batch_id = $request->batch_id;;
            $sale->status = 0;
            $sale->amount = $amountTotal;
            $sale->amount_paid = $request->amount;
            $sale->cuote_account = $account_cuote;
            $sale->cuote_paid = 1;
            $sale->paid_comming = $request->paid_comming;
            $sale->dues = $dues;
            $sale->next_pay = $day_payment;
            $sale->save();

            $order = new Order();
            $order->bank_name = $request->bank_name;
            $order->user_id = $request->user_id;
            $order->batch_id = $request->batch_id;
            $order->sale_id = $sale->id;
            $order->seller_id = $request->seller;
            $order->amount = $request->amount;
            $order->ref_number = $request->ref_number;
            $order->status = 0;

             //Guardamos el voucher
            $voucher  = $request->file('voucher');
            $name = time() . "." . $voucher ->extension();
            $voucher->move(public_path('storage') . '/voucher/', $name);
            $order->payment_proof = '' . $name;

            $order->save();

        }


        return response()->json($order , 200);
    }

    public function showOrder() {
        return $this->repository->show();
    }
}

