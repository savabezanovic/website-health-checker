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

                <span for="url">Add URL:</span>

                <input class="form-control" type="text" name="url"></input>

                <label for="frequency">Choose a frequency:</label>
                <select name="frequency">
                @foreach($frequencies as $frequency)
                
                    <option value="{{$frequency->id}}">{{$frequency->name}}</option>
                   
                
                @endforeach
                </select>
                <button class="form-control" type="submit">Add URL</button>

            </form>



            @foreach($project->projectUrls as $projectUrl)
                
            <form method="POST" action="{{action('ProjectUrlController@update', $projectUrl->id)}}">
                @csrf

                @method("PUT")

                <span for="url">Edit URL:</span>

                <input class="form-control" type="text" name="url" value="{{$projectUrl->url}}" required></input>
                
                <label for="frequency">Choose a frequency:</label>

                <select name="frequency">
                @foreach($frequencies as $frequency)
        
                    <option @if($projectUrl->frequency_id === $frequency->id) selected @endif value="{{$frequency->id}}">{{$frequency->name}}</option>
    
                @endforeach
                </select>

                <button class="form-control" type="submit">Edit URL</button>

            </form>

            <form method="POST" action="{{action('ProjectUrlController@delete', $projectUrl->id)}}">
                @csrf
                @method("DELETE")

                <button class="form-control" type="submit">Delete URL</button>

            </form>

            @endforeach



        </div>
    </div>
</div>
@endsection