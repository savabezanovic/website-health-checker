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


                <button class="form-control" type="submit">Edit</button>

            </form>

        </div>
    </div>
</div>
@endsection