@extends('layouts/mainLayout')

@section('title', 'Account')

@section('header')
	<meta charset="utf-8">
	<link rel="stylesheet" href="{{ asset('css/account.css') }}">
@endsection

@section('content')
	@parent
	<p>Welcome on your account.</p>
	<p><a href="{{ route('view_formmemo') }}">Create a new memo</a></p>
	<p><a href="{{ route('memo_show') }}">Show all memos</a></p>
	<p><a href= {{ route('user_Signout') }} >Sign out</a></p>
	<p><a href= {{ route('view_Formpassword') }} >Change password</a></p>
	<p><a href= {{ route('user_Delete') }} >!! DELETE ACCOUNT !!</a></p>
@endsection
