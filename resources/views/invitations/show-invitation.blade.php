@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Project Invitation</h1>

            <p>{{$project->name}}</p>

            <form action="{{action('UserController@joinTeam', $project->id)}}" method="POST">
       
                @method("POST")

                @csrf

                <p>Click here to join the team!</p>

                <input type="submit" value="Join Team">

            </form>

        </div>
    </div>
</div>

@endsection