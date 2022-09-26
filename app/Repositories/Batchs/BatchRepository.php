<?php

namespace App\Repositories\Batchs;

// Models
use App\Models\Batch;

class BatchRepository
{

	public function create($data) {
		return Batch::create($data);
	}

	public function getBatchs() {
		$itemList = Batch::all();
		return $itemList;
	}

	public function getBatch($id) {
		$batch = Batch::find($id);
		return $batch;
	}

	public function update($id,$data) {
		return Batch::where('id' , $id)->update($data);
	}

	public function getBatchsGroup ($groupId) {
		return Batch::where('group_id' , $groupId)->get();
	}

}
