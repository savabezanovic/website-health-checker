@extends("layouts.app")
@section("content")

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h1>Project Notifications</h1>

            <p>{{$project->name}}</p>

            @foreach($notifications as $notification)

            <form action="{{action('ProjectController@notificationSetting', $notification->id)}}" method="POST">

                @method("PUT")

                @csrf

                <input type="submit" 
                value="Notification Setting: {{$notification->notificationType->type}} 
                @if($notification->setting === 0) OFF 
                @else ON @endif">

            </form>

            @endforeach

        </div>
    </div>
</div>

@endsection