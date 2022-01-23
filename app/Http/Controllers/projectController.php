<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;

class projectController extends Controller
{

    public function index()
    {
        $projects = Project::paginate(20);
        return view('projects.index')->with('projects',$projects);
    }


    public function create()
    {
        $user = User::all()->pluck('name','id');
        $client = Client::all()->pluck('company_name','id');
        return view('projects.create')->with('users',$user)->with('clients',$client);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deadline' => 'required|date',
            'status' => 'string'
        ]);

        $project = Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' =>$request->user_id,
            'client_id' => $request->client_id,
            'deadline' =>$request->deadline,
            'status' => $request->status
        ]);
        return redirect()->route('projects.index');
    }

    public function show(Project $project)
    {
        return view('projects.show')->with('project',$project);
    }


    public function edit(Project $project)
    {
        $user = User::all()->pluck('name','id');
        $client = Client::all()->pluck('company_name','id');
        return view('projects.edit')->with('project',$project)->with('users',$user)->with('clients',$client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->validate($request,[
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'deadline' => 'required|date',
            'status' => 'string'
        ]);
        $project->title = $request->title;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        $project->client_id = $request->client_id;
        $project->deadline = $request->deadline;
        $project->status =$request->status;
        $project->save();
        return redirect()->route('projects.index');
        }

    public function trashedProjects(){
        $projects= Project::onlyTrashed()->paginate(20);
        return view('projects.trash')->with('projects',$projects);
    }
    public function restore($id)
    {
        $project = Project::onlyTrashed()->where('id',$id)->restore();
        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        $project->delete($project->id);
        return redirect()->back();
    }

    public function delete($id)
    {
        $project = Project::onlyTrashed()->where('id',$id)->forceDelete();
        return redirect()->back();
    }
}
