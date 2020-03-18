@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>Edit Project</h1>
            <form action="{{action('ProjectController@update', $project->slug)}}" method="POST">
                @csrf
                @method("PUT")

                <span for="name">Project Name:</span>
                <input class="form-control" type="text" name="name" value="{{$project->name}}" required></input>

                <input type="hidden" name="user_id" value="{{auth()->user()->id}}">

                <button class="form-control" type="submit">Edit</button>

        </div>
    </div>
</div>
@endsection