@extends('templates.app')
@section('title')
	Account Page
@endsection
@section('content')
	<div class="container">
		<section class="row justify-content-md-center new-post">
	        <div class="col-md-6 ">
	            <header><h3>Your Account</h3></header>
	            <form action="{{ route('account.save') }}" method="post" enctype="multipart/form-data">
	                <div class="form-group">
	                    <label for="email">Email</label>
	                    <input type="email" name="email" class="form-control" value="{{ $user->email }}" id="email">
	                </div>
	                <div class="form-group">
	                    <label for="first_name">First Name</label>
	                    <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" id="first_name">
	                </div>
	                <div class="form-group">
	                    <label for="image">Image (only .jpg)</label>
	                    <input type="file" name="image" class="form-control" id="image">
	                </div>
	                <button type="submit" class="btn btn-primary">Save Account</button>
	                <input type="hidden" value="{{ Session::token() }}" name="_token">
	            </form>
	        </div>
	    </section>
	        <section class="row new-post">
	            <div class="col-md-6 col-md-offset-3">
	                <img src="{{ route('account.image', ['filename' =>  "storage/app/public/images/$user->image" ]) }}" alt="" class="img-responsive">
	                <img src="public/storage/images/{{ $user->image}}" />
	                <img src="{{ URL::to('/') }}/images/{{ $user->image }}"  />
	                <img src="{{ asset("public/uploads/1.jpg")}}"  />
	                <img src="C:/xampp/htdocs/socialnetwork/public/storage/images{{ $user->image }}">

	                <img src="file:///C:/xampp/htdocs/socialnetwork/public/storage/images/1_1540517640.jpg">
	            </div>
	        </section>
    </div>
     
@endsection