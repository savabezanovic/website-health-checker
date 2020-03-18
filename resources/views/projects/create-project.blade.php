@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
           
            <h1>Create Project</h1>

            <form action="{{action('ProjectController@store')}}" method="POST" xmlns="http://www.w3.org/1999/html">

                @csrf

                <label for="name">Name</label>

                <input class="form-control" name="name" type="text" placeholder="Project name">
                <input name="user_id" type="hidden" value="{{auth()->user()->id}}">
                
                <br>

                <button class="btn btn-primary" type="submit">Submit</button>

            </form>

        </div>
    </div>
</div>
@endsection
