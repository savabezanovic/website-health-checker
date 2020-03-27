@extends("layouts.app")

@section("content")

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <a href="/project/{{$slug}}/add/url">Add URL</a>

            @foreach($projectUrls as $projectUrl)


            @dd($projectUrl->project->user_id)

            <p>{{$projectUrl->url}}</p>

            <p>{{$projectUrl->frequency->name}}</p>

            <a href="/project/{{$slug}}/edit/url/{{$projectUrl->id}}">Edit URL</a>

            <form method="POST" action="{{action('ProjectUrlController@delete', $projectUrl->id)}}">

                @csrf
                @method("DELETE")

                <button type="submit">Delete URL</button>

            </form>

            @endforeach

        </div>
    </div>
</div>
@endsection