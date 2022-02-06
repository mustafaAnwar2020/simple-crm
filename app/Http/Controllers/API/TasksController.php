<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Models\Task;
use App\Http\Resources\TasksResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:task-list|task-create|task-edit|task-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:task-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:task-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:task-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $task = Task::all();
        return $this->sendResponse(TasksResource::collection($task),'All tasks retrieved!');
    }


    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title'=>'required|string|max:255',
            'description' =>'required|string:max:1000',
            'deadline'=>'required|date',
            'status'=>'required|string'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $task = Task::create($input);
        return $this->sendResponse(new TasksResource($task),'Task created successfully!');
    }


    public function show(Task $Task)
    {
        return $this->sendResponse(new TasksResource($Task),'Your Task is here :D');
    }


    public function update(Request $request, Task $Task)
    {
        $input = $request->all();
        $validator = Validator::make($input,[
            'title'=>'required|string|max:255',
            'description' =>'required|string:max:1000',
            'deadline'=>'required|date',
            'status'=>'required|string'
        ]);
        if ($validator->fails()) {
            return $this->sendError('Validation error' , $validator->errors());
        }
        $Task->title = $input['title'];
        $Task->description = $input['description'];
        $Task->user_id = $input['user_id'];
        $Task->client_id = $input['client_id'];
        $Task->project_id = $input['project_id'];
        $Task->deadline = $input['deadline'];
        $Task->status = $input['status'];
        $Task->save();
        return $this->sendResponse(new TasksResource($Task),'Task updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $Task)
    {

        $Task->delete($Task->id);
        return $this->sendResponse(new TasksResource($Task),'Task deleted successfully!');
    }
}
