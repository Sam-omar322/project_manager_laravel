<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Auth::routes();
Route::get('/', function() {
    return redirect("projects");
});

// Projects
Route::resource("/projects", ProjectController::class);

// Users
Route::get("/profile", [ProfileController::class, "index"]);
Route::patch("/profile", [ProfileController::class, "update"]);

// Tasks
Route::get("/projects/{id}/tasks", [TaskController::class, "index"]);
Route::get("/projects/{id}/tasks/{task_id}", [TaskController::class, "show"]);
Route::post("/projects/{id}/tasks", [TaskController::class, "store"]);
Route::patch("/projects/{id}/tasks/{task_id}", [TaskController::class, "update"]);
Route::delete("/projects/{id}/tasks/{task_id}", [TaskController::class, "destroy"]);