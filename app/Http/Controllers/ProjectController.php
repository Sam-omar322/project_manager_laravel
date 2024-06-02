<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Models\Task;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    // This function allow users to login first
    public function __construct() {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = auth()->user()->projects->sortByDesc('created_at');
        return view("projects.index", compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("projects.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // add user id
        $data["user_id"] = auth()->user()->id;

        Project::create($data);
        
        return redirect("/projects");
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        $tasks = Task::where('project_id', $project->id)->get();

        // Check if the authenticated user owns the project
        if (auth()->user()->id !== $project->user_id) {
            abort(403, 'Unauthorized');
        }

        return view("projects.show", compact("project", "tasks"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        return view("projects.edit", compact("project"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, project $project)
    {
        $data = $request->validate([
            'title' => 'sometimes|required',
            'description' => 'sometimes|required',
            'status' => 'sometimes|required'
        ]);

        Project::where('id', $project->id)->update($data);

        return redirect("/projects/{$project->id}");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        Project::where('id', $project->id)->delete();

        return redirect("/projects");
    }
}
