@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>This is the data from one project</h1>
            <p>{{$project->name}}</p>
            <a href="/project/edit/{{$project->slug}}">Edit Project</a>
            <form action="{{action('ProjectController@delete', $project->slug)}}" method="POST">

                @method("DELETE")

                @csrf

                <input type="submit" value="Delete">

            </form>
        </div>
    </div>
</div>

@endsection