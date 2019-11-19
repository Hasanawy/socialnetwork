@extends('templates.app')
    @section('content')
    <!-- -->
    <div class = "container">
    @include('includes.message-block')

        <div class="row">
            <div class="col-md-6">
                <h3>Sign Up</h3>
                <form action="{{ route('signup') }}" method = "post" enctype="multipart/form-data">
                       
                        {{csrf_field()}}

                    <div class="form-group {{ $errors->has('email') ? 'alert alert-danger' : '' }}">
                        <label for="email">Your E-Mail</label>
                        <input class = "form-control" type="email" name = "email" id = "email" 
                        value="{{ Request::old('email')}}">
                    </div>
                    <div class="form-group {{ $errors->has('first_name') ? 'alert alert-danger' : '' }}">
                        <label for="first_name">Your First Name</label>
                        <input class = "form-control" type="text" name = "first_name" id = "first_name" 
                        value="{{ Request::old('first_name') }}">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'alert alert-danger' : '' }}">
                        <label for="password">Your Password</label>
                        <input class = "form-control" type="password" name = "password" id = "password"
                        value="{{ Request::old('password') }}">
                    </div>
                     <div class="form-group">
                        <label for="image">Image (only .jpg)</label>
                        <input type="file"  name="image" class="form-control" id="image">
                    </div>
                    <button type = "submit" class = "btn btn-primary">Sign Up</button>
                </form>
            </div>
              <div class="col-md-6">
                <h3>Sign In</h3>
                <form action="{{ route('signin') }}" method = "post">
                        {{csrf_field()}}
                    <div class="form-group {{ $errors->has('email') ? 'alert alert-danger' : '' }}">
                        <label for="email">Your E-Mail</label>
                        <input class = "form-control" type="email" name = "email" id = "email"
                         value="{{ Request::old('email') }}">
                    </div>
                    <div class="form-group {{ $errors->has('password') ? 'alert alert-danger' : '' }}">
                        <label for="password">Your Password</label>
                        <input class = "form-control" type="password" name = "password" id = "password"
                         value="{{ Request::old('password') }}">
                    </div>
                    <button type = "submit" class = "btn btn-primary">Sign In</button>

                </form>
            </div>
        </div>
    </div>
    @endsection
    