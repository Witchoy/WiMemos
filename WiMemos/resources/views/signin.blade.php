@extends('layouts/mainLayout')

@section('title', 'Signin')

@section('header')
	<meta charset="utf-8">
@endsection

@section('content')
	<h1>Signin</h1>
	<form action= {{ route('user_Authenticate') }} method="post">
		@csrf
		<label for="login">Login</label>      
			<input type="text" id="login" name="login" autofocus>
		<label for="password">Password</label> 
			<input type="password" id="password" name="password">
		<input type="submit" value="Signin">
	</form>
	<p>Don't have an account yet? <a href= {{ route('view_Signup') }} >Sign up here</a></p>
@endsection
