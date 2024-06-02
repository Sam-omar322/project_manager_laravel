@extends('layouts.app')

@section('content')

<div class="row">
    <div class="col-lg-3 offset-lg-1">
        <div class="card p-3">
            @switch($project->status)
                @case(0)
                    <h6 class="text-warning">Processing</h6>
                    @break
                @case(1)
                    <h6 class="text-success">Done</h6>    
                    @break
                @default
                    <h6 class="text-danger">Canceled</h6>    
                    
            @endswitch
            <h3>{{$project->title}}</h3>
            <p class="mt-3">{{ $project->description }}</p>
        </div>
        @include('projects.footer')

        <div class="mt-4">
            <h3>Change Status</h3>
            <form action="/projects/{{ $project->id }}" method="POST">
                @csrf
                @method("PATCH")
                <select name="status" class="form-control" onchange="this.form.submit()">
                    <option value="0" {{ $project->status == 0 ? 'selected' : '' }}>Processing</option>
                    <option value="1" {{ $project->status == 1 ? 'selected' : '' }}>Done</option>
                    <option value="2" {{ $project->status == 2 ? 'selected' : '' }}>Canceled</option>
                </select>
            </form>
        </div>
    </div>
    <div class="col-lg-8">
        @forelse ($tasks as $task)    
        <div class="card px-4 py-3 task mb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="task_title mb-0" style="{{ $task->active == 1 ? 'text-decoration: line-through; opacity: 0.3' : '' }}">{{ $task->title }}</h3>
                    <div class="control_task d-flex align-items-center">
                        <form action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method("patch")
                            <input type="checkbox" name="check_status" class="form-check-input task-checkbox" {{ $task->active == 1 ? "checked" : "" }} onchange="this.form.submit()">
                        </form>
                        <form action="/projects/{{ $project->id }}/tasks/{{ $task->id }}" method="POST">
                            @csrf
                            @method("delete")
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            @endforelse
            <form action="/projects/{{ $project->id }}/tasks" method="POST">
                @csrf
                <div>
                    <div class="d-flex gap-3 mt-4">
                        <input type="text" class="form-control" name="title">
                        <button type="submit" class="btn btn-primary w-25">Add New Task</button>
                    </div>
                    @error('title')
                    <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </form>
    </div>
</div>
<a class="mt-5 d-inline-block" href="/projects">Back to projects</a>
@endsection