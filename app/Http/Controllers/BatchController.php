<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Batchs\BatchRepository;
use App\Http\Requests\Batchs\StoreRequest;
use App\Constants\CBatchStatus;

class BatchController extends Controller
{
    public function __construct() {
        $this->repository = new BatchRepository();
    }

    public function index(Request $request){
        $batchs = $this->repository->getBatchs();
        abort_if( !$batchs, 500 ,'Error del servidor');
        
        return response()->json($batchs, 200);
    }

    public function show(Request $request){
        $batch = $this->repository->getBatch($request->batch);
        info($batch);
        abort_if( !$batch, 404 ,'No se encontro registro');
        abort_if( $batch->status != CBatchStatus::BATCH_AVAILABLE, 404 ,'Lote no disponible');
        
        return response()->json($batch, 200);
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
