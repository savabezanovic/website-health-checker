@extends("layouts.app")

@section("content")

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <form method="POST" action="{{action('ProjectUrlController@store', $slug)}}">
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

        </div>
    </div>
</div>
@endsection