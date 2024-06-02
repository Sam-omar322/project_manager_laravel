@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card p-4">
                <h4 class="text-center my-3">Create Project</h4>
                <form action="/projects", method="POST">
                    @csrf
                    <div class="mb-2">
                        <label for="title">Title</label>
                        <input class="form-control mt-1" id="title" type="text" name="title">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="description">Description</label>
                        <input class="form-control mt-1" id="description" type="text" name="description">
                        @error('description')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <a href="/projects" type="submit" class="btn">Cancel</a>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection