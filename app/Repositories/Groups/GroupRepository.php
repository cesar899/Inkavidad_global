<?php

namespace App\Repositories\Groups;

// Models
use App\Models\Group;
use App\Constants\CGroupStatus;
use App\Constants\CBatchStatus;

class GroupRepository
{

	public function create($data) {
		return Group::create($data);
	}

	public function getGroups() {
		$itemList = Group::where('project_id', null)->get();
		return $itemList;
	}

	public function update($id,$data) {
		return Group::where('id' , $id)->update($data);
	}

	public function updateGroupsByProject($projectId, $groups) {
		
		try {
			$groupToUpdate = Group::where('project_id' , $projectId)
						->whereIn('id', $groups)
						->get();

			$groupToUpdate->each(function ($item, $key) {
				$item->status = !$item->status;
				$item->save();
			});
			return true;
		} catch (\Throwable $th) {
			return false;
		}
	}

	public function getGroupsByProject($id) {
		$itemList = Group::where('project_id', $id)
						->get();

		return $itemList;
	}

	public function getGroupBatchsByProject($id){
		$itemList = Group::where('project_id', $id)
						->with('batchs')
						->get();

        return $itemList;
    }

	public function groupsByProjectForSale($projectId){
		$itemList = Group::has('batchs')
						->where('project_id', $projectId)
						->where('status',CGroupStatus::GROUP_ACTIVE)
						->with(['batchs'=> function ($query) {
							$query->where('status', CBatchStatus::BATCH_AVAILABLE);
							$query->orWhere('status', CBatchStatus::BATCH_PENDING);
						}])
						->get();
		
		return $itemList;
	}

}
