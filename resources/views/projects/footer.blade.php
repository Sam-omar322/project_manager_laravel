<div class="mt-3 px-1 d-flex justify-content-between align-items-center">
    <h5>Tasks: <span>{{ $project->tasks->count() }}</span></h5>
    <div class="d-flex gap-2">
        <a href="/projects/{{ $project->id }}/edit" class="btn btn-primary">Edit</a>
        <form action="/projects/{{ $project->id }}" method="POST">
            @csrf
            @method("DELETE")
            <button type="button" class="btn btn-danger" onclick='confirm("Are you sure you want to delete this project ?") === true ? this.form.submit() : ""'>Delete</button>
        </form>
    </div>
</div>