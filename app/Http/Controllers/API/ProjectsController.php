<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Support\Facades\Validator;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        return $this->sendResponse(ProjectResource::collection($project),'All data retrieved successfully!');
    }

    public function trashedProjects(){
        $project = Project::onlyTrashed()->get();
        return $this->sendResponse(ProjectResource::collection($project),'All data retrieved successfully!');
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deadline' => 'required|date',
            'status' => 'string'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $project = Project::create($input);
        return $this->sendResponse(new ProjectResource($project),'Project created successfully!');
    }


    public function show(Project $project)
    {
        $this->sendResponse(new ProjectResource($project),'Data retrieved successfully!');
    }


    public function update(Request $request, Project $project)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deadline' => 'required|date',
            'status' => 'string'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $project->title = $input['title'];
        $project->description = $input['description'];
        $project->user_id = $input['user_id'];
        $project->client_id = $input['client_id'];
        $project->deadline = $input['deadline'];
        $project->status = $input['status'];
        $project->save();
        return $this->sendResponse(new ProjectResource($project),'Project updated successfully!');
    }


    public function destroy(Project $project)
    {
        $project->delete($project->id);
        return $this->sendResponse(new ProjectResource($project),'Project deleted successfully!');
    }
}
