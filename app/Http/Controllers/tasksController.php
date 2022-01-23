<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Client;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class tasksController extends Controller
{

    public function index()
    {
        $task = Task::paginate(20);
        return view('tasks.index')->with('tasks',$task);
    }

    public function trashedTasks()
    {
        $task = Task::onlyTrashed()->paginate(20);
        return view('tasks.trash')->with('tasks',$task);
    }
    public function create()
    {
        $user = User::all()->pluck('name','id');
        $client = Client::all()->pluck('company_name','id');
        $project = Project::all()->pluck('title','id');
        return view('tasks.create')->with('users',$user)->with('clients',$client)->with('projects',$project);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'description' =>'required|string:max:1000',
            'deadline'=>'required|date',
            'status'=>'required|string'
        ]);

        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'client_id' =>$request->client_id,
            'project_id' =>$request->project_id,
            'deadline' =>$request->deadline,
            'status' =>$request->status
        ]);
        // dd($task);
        return redirect()->route('tasks.index');
    }

    public function show(Task $task)
    {
        return view('tasks.show')->with('task',$task);
    }


    public function edit(Task $task)
    {
        $user = User::all()->pluck('name','id');
        $client = Client::all()->pluck('company_name','id');
        $project = Project::all()->pluck('title','id');
        return view('tasks.edit')->with('users',$user)->with('clients',$client)->with('projects',$project)->with('task',$task);
    }


    public function update(Request $request, Task $task)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'description' =>'required|string:max:1000',
            'deadline'=>'required|date',
            'status'=>'required|string'
        ]);
        $task->title = $request->title;
        $task->description = $request->description;
        $task->user_id = $request->user_id;
        $task->client_id = $request->client_id;
        $task->project_id = $request->project_id;
        $task->deadline = $request->deadline;
        $task->status = $request->status;
        $task->save();
        return redirect()->route('tasks.index');

    }

    public function restore($id)
    {
        $task= Task::onlyTrashed()->where('id',$id)->restore();
        return redirect()->route('tasks.index');
    }

    public function destroy(Task $task)
    {
        $task->delete($task->id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $task= Task::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->back();
    }
}
