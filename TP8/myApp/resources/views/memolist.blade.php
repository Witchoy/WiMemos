@extends('layouts.mainLayout')

@section('title', 'See my memos')

@section('header')
    <meta charset="UTF-8">
@endsection

@section('content')
    <h1>List of Memos</h1>

    <ul>
        @forelse ($memos as $memo)
            <li>{{ $memo->title }} - {{ $memo->content }}</li>
        @empty
            <li> No memo found ! </li>
        @endforelse
    </ul>

    <p><a href="{{ route('view_Account') }}">Back to Account</a></p>
@endsection