@extends('layouts/mainLayout')

@section('title', 'Signup')

@section('header')
	<meta charset="utf-8">
@endsection

@section('content')
	<h1>Signup</h1>
	<form action= {{ route('user_Create') }} method="post" class="form-example">
		@csrf
		<div class="form-example">
			<label for="login">Login</label>
			<input type="text" id="login" name="login" required autofocus>
		</div>
		<div class="form-example">
			<label for="password">Password</label>
			<input type="password" id="password" name="password" required>
		</div>
		<div class="form-example">
			<label for="password_confirmation">Password confirmation</label>
			<input type="password" id="password_confirmation" name="password_confirmation" required>
		</div>
		<div class="form-example">
			<input type="submit" value="Signup">
		</div>
	</form>

	<p>Already have an account? <a href= {{ route('view_Signin') }} >Sign in here</a></p>
@endsection
