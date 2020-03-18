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

            <form method="POST" action="{{action('ProjectUrlController@store', $project->slug)}}">
                @csrf

                <span for="url"> URL:</span>

                <input class="form-control" type="text" name="url"></input>

                <button class="form-control" type="submit">Add URL</button>

            </form>



            @foreach($project->projectUrls as $projectUrl)
            
            <form method="POST" action="{{action('ProjectUrlController@delete', $projectUrl->id)}}">
                @csrf
                @method("DELETE")

                <span for="url"> URL:</span>

                <input class="form-control" type="text" name="url" value="{{$projectUrl->url}}" required></input>

                <button class="form-control" type="submit">Delete URL</button>

            </form>

            @endforeach



        </div>
    </div>
</div>
@endsection