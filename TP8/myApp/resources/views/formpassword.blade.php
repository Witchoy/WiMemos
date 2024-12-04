@extends('layouts/mainLayout')

@section('title', 'Change password')

@section('header')
    <meta charset="UTF-8">
@endsection

@section('content')
    <p><a href= {{ route('view_Account') }} >Cancel</a></p>

    <form action= {{ route('user_UpdatePassword') }} method="post" >
        @csrf
        <label for="password">Enter new password: </label> 
            <input type="password" name="password" required autofocus>
        <label for="password_conf">Confirm password: </label>
            <input type="password" name="password_conf" required>
        <input type="submit" value="Change password" />
    </form>
@endsection