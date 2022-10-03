<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Projects\ProjectRepository;
use App\Http\Requests\Projects\StoreRequest;
use App\Models\Group;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    public function __construct() {
        $this->repository = new ProjectRepository();
    }

    public function index(Request $request){
        $projects = $this->repository->getProjects();
        abort_if( !$projects, 500 ,'Error del servidor');
        
        return response()->json($projects, 200);
    }
    
    public function store (StoreRequest $request){
        $project = $this->repository->create($request->validated());
        $selectedGroups = json_decode($request->selectedGroups, true);
        $savedGroups = Group::whereIn('id', $selectedGroups)
                    ->update(['project_id' => $project->id ]);

        return response()->json($project , 200);
    }

    public function show(Request $request){
        info($request->project);
        $project = $this->repository->find($request->project);
        abort_if( !$project, 404 ,'No se ha encontrado registro');

        return response()->json($project , 200);
    }

    public function availableProjects(){
        $projects = $this->repository->getAvailableProjects();
        abort_if( !$projects, 404 ,'No existen proyectos disponibles');
        
        return response()->json($projects, 200);
    }

}
