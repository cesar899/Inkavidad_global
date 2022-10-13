<?php 

namespace App\Repositories\Sales;

use App\Models\Sale;

class SaleRepository 
{
	public function sales() {
		$sale = Sale::with(
			'user',
			'seller',
			'batch.project',
		)->get();
		
		return response()->json($sale, 200);
	}
}