<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as Controller;
use App\Models\Task;
use App\Http\Resources\TasksResource;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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


    public function show($id)
    {
        $task = Task::find($id);
        return $this->sendResponse(new TasksResource($task),'Your Task is here :D');
    }


    public function update(Request $request, $id)
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
        $task = Task::where('id',$id)->first();
        $task->title = $input['title'];
        $task->description = $input['description'];
        $task->user_id = $input['user_id'];
        $task->client_id = $input['client_id'];
        $task->project_id = $input['project_id'];
        $task->deadline = $input['deadline'];
        $task->status = $input['status'];
        $task->save();
        return $this->sendResponse(new TasksResource($task),'Task updated successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::where('id',$id)->first();
        $task->delete($id);
        return $this->sendResponse(new TasksResource($task),'Task deleted successfully!');
    }
}
