<?php

namespace App\Repositories\Projects;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;

// Models
use App\Models\Project;
use App\Constants\CProject;
use App\Constants\CBatchStatus;

class ProjectRepository
{
	public function create($data) {
		
		// $path = Storage::disk('public')->put('featured_image/', $data['featured_image']);
		$project = Project::create([
            'name' => $data['name'],
			'plan' => $data['plan'],
			'status' => intval($data['status']),
			'group_quantity' => intval($data['group_quantity']),
            // 'featured_image' => $path ?? null,
            'featured_image' => $data['featured_image']->getClientOriginalName() ?? null,
        ]);
		
		$data['featured_image']
			->storePubliclyAs(
				"{$project->id}/",
				$data['featured_image']->getClientOriginalName(),
				'public'
			);
		
		$path = $data['featured_image']->move( public_path("images/featured_image/{$project->id}/"), $data['featured_image']->getClientOriginalName());
		$deleted = Storage::deleteDirectory("/public/{$project->id}");

		return $project;
	}

	public function getProjects() {
		$itemList = Project::withCount([
			'groups as total_groups',
			'batchs as total_batchs',
			'batchs as available_batchs_count' => function (Builder $query) {
				$query->where('status', 1);
			},
			'batchs as pending_batchs_count' => function (Builder $query) {
				$query->where('status', CBatchStatus::BATCH_PENDING);
			},
			'batchs as sold_batchs_count' => function (Builder $query) {
				$query->where('status', CBatchStatus::BATCH_SOLD);
			}
		])->get();
		
		$itemList->each( function( $item, $key){
			$item->featured_image = asset("images/featured_image/$item->id/$item->featured_image");
		});

		return $itemList;
	}

	public function update($id,$data) {
		return Project::where('id' , $id)->update($data);
	}

	public function find($id) {
		$item = Project::find($id);
		if(!$item) return null;
		$item->featured_image = asset("images/featured_image/$item->id/$item->featured_image");
		
		return $item;
	}

	public function getAvailableProjects() {
		$itemList = Project::where('status', CProject::PROJECT_ACTIVE)->get();
		if(!$itemList) return null;

		$itemList->each( function( $item, $key){
			$item->featured_image = asset("images/featured_image/$item->id/$item->featured_image");
		});
		
		return $itemList;
	}

	public function validateGroupQuantity($projectId){
		$item = Project::withCount(['groups as total_groups'])->where('id', $projectId)->first();

		return $item->group_quantity - $item->total_groups > 1;
	}

}
