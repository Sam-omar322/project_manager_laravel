@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="mb-4 d-flex justify-content-between">
            <h2>This is {{ auth()->user()->name }}'s projects</h2>
            <a href="/projects/create" class="btn btn-primary">Create Project</a>
        </div>
            <div class="row">
                @forelse ($projects as $project)
                <div class="col-lg-4">
                    <div class="mb-4">
                        <div class="card p-3 project-card">
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
                            <a class="link" href="/projects/{{ $project->id }}"><h3 class="project-title">{{$project->title}}</h3></a>
                            <p class="mt-3 truncate-paragraph">{{ $project->description }}</p>
                        </div>
                        @include('projects.footer')
                    </div>
                </div>
                    @empty
                        <h3>No Project Found</h3>
                    @endforelse
            </div>
    </div>
</div>

@endsection