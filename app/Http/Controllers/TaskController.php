<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index($project_id)
    {
        return redirect("/projects/{$project_id}");
    }

    public function show($project_id)
    {
        return redirect("/projects/{$project_id}");
    }

    public function store($project_id, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        $data["project_id"] = $project_id;

        Task::create($data);
        
        return redirect("/projects/{$project_id}");
    }

    public function update($project_id, $task_id)
    {
        // Return json file
        // return request()->all();

        Task::where("id", $task_id)->update([
            // ->has('check_status') is a method of the request instance, used to check if the request contains a parameter named 'check_status'.
            // if not it will return 0 if yes it will return 1
            'active' => request()->has('check_status')
        ]);

        // if($request->check_status !== null) {
        //     Task::where('id', $task_id)->update(['active' => 1]);
        // } else {
        //     Task::where('id', $task_id)->update(['active' => 0]);
        // }

        return redirect("/projects/{$project_id}");
    }

    public function destroy($pro_id, $task_id) {
        Task::where("project_id", $pro_id)->where("id", $task_id)->delete();

        return redirect("/projects/{$pro_id}");
    }
}
