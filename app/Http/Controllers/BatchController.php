<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Batchs\BatchRepository;
use App\Http\Requests\Batchs\StoreRequest;

class BatchController extends Controller
{
    public function __construct() {
        $this->repository = new BatchRepository();
    }

    public function index(Request $request){
        $batchs = $this->repository->getBatchs() ;
        abort_if( !$batchs, 500 ,'Error del servidor');
        
        return response()->json($batchs, 200);
    }
    
    public function store (StoreRequest $request){
        info($request->validated());
        $batch = $this->repository->create($request->validated());

        return response()->json($batch , 200);
    }

    public function groupBatchs(Request $request) {
        $batchs = $this->repository->getBatchsGroup($request->group_id);
        abort_if( !$batchs, 500 ,'Error del servidor');
        
        return response()->json($batchs, 200);

    }

}
