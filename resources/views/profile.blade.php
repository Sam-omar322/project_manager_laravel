@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card p-4">
                <div class="avatar"><img src="{{ asset('storage/' . auth()->user()->image) }}" alt="image"></div>
                <h4 class="text-center my-3">{{$user->name}}</h4>
                <form action="/profile", method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="mb-2">
                        <label for="name">Username</label>
                        <input class="form-control mt-1" id="name" type="text" name="name" value="{{ $user->name }}">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="email">Email</label>
                        <input class="form-control mt-1" id="email" type="email" name="email" value="{{ $user->email }}">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input class="form-control mt-1" id="password" type="password" name="password">
                        @error('password')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation">Password Confirm</label>
                        <input class="form-control mt-1" id="password_confirmation" type="password" name="password_confirmation">
                        @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label for="image">Change Profile Picture</label>
                        <div class="custom-file mt-1">
                            <input type="file" name="image" id="image" class="custom-file-input">
                            <label for="image" id="image-label" class="custom-file-label" data-browse="Browse"></label>
                        </div>
                        @error('image')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mt-4 text-end">
                        <button type="submit" class="btn btn-danger" form="logout">Logout</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                <form action="/logout" id="logout" method="post">
                    @csrf
                </form>
            </div>
        </div>
    </div>
@endsection