@extends("layouts.app")
@section("content")
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>This is the data from projects</h1>
            <a href="/project/create">Create Project</a>
            
            @foreach($projects as $project)
            <a href="/project/{{$project->slug}}">
                <p>{{$project->name}}</p>

            </a>
            @endforeach
        </div>
    </div>
</div>
@endsection