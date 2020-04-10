@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h1>User Settings</h1>
            <p>Notification Preferences:</p>

            @foreach($notificationTypes as $notificationType)

            <p>{{$notificationType->type}}</p>

            <form action="{{action('UserController@notificationON', $notificationType->id)}}" method="POST">

                @method("PUT")

                @csrf

                <input type="submit" value="All {{$notificationType->type}} Notifications: ON">

            </form>


            <form action="{{action('UserController@notificationOFF', $notificationType->id)}}" method="POST">

                @method("PUT")

                @csrf

                <input type="submit" value="All {{$notificationType->type}} Notifications: OFF">

            </form>

            @endforeach
        </div>
    </div>
</div>
@endsection