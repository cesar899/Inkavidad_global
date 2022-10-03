<?php

namespace App\Repositories\Orders;

use Illuminate\Support\Facades\Storage;
// Models
use App\Models\Order;

class OrderRepository
{
	public function create($data) {

		$path = Storage::disk('public')->put('payment_proof', $data['voucher']);
		$data['payment_proof'] = $path ?? null; 
		$path = $data['voucher']->move( public_path("images/payment_proof/"), $path);
		$deleted = Storage::deleteDirectory("/public/payment_proof");

		return Order::create($data);
	}
}
