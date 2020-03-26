@extends("layouts.app")

@section("content")
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">
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

        </div>
    </div>
</div>
@endsection