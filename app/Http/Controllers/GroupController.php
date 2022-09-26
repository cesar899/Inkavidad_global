<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Repositories\Groups\GroupRepository;
use App\Repositories\Projects\ProjectRepository;
use App\Http\Requests\Groups\StoreRequest;

class GroupController extends Controller
{
    public function __construct() {
        $this->repository = new GroupRepository();
    }

    public function index(Request $request){
        $groups = $this->repository->getGroups();
        abort_if( !$groups, 404 ,'No hay Grupos disponibles');
        
        return response()->json($groups, 200);
    }

    public function store (StoreRequest $request){
        $projectRepo = new ProjectRepository(); 
        $hasGroupSpace = $projectRepo->validateGroupQuantity($request->safe()->only(['project_id']));
        abort_if( !$hasGroupSpace, 500 ,'Proyecto no acepta mas Grupos' );

        $group = $this->repository->create($request->validated());
        
        return response()->json($group , 200);
    }

    public function updateProjectGroups(Request $request){
        $groupSaved = $this->repository->updateGroupsByProject($request->project_id, $request->groups);
        abort_if(!$groupSaved, 500, 'No pudieron guardarse los cambios');
        
        return response()->json($groupSaved , 200);
    }

    public function projectGroups(Request $request){
        $groups = $this->repository->getGroupsByProject($request->project_id);
        abort_if( !$groups, 500 ,'Error del servidor');
        
        return response()->json($groups, 200);
    }

    public function groupBatchsByProject(Request $request){
        $groups = $this->repository->getGroupBatchsByProject($request->project_id);
        abort_if( !$groups, 404 ,'No se encontraron grupos disponibles');
        
        return response()->json($groups, 200);
    }

    public function groupsByProjectForSale(Request $request){
        $groups = $this->repository->groupsByProjectForSale($request->project_id);
        abort_if( !$groups, 404 ,'No se encontraron grupos disponibles');
        
        return response()->json($groups, 200);
    }
}
