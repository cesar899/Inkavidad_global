<?php

namespace App\Http\Controllers;

use App\Repositories\Sales\SaleRepository;
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
}
