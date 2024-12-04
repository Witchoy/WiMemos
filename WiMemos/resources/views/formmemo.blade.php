@extends('layouts.mainLayout')

@section('title', 'Create a Memo')

@section('header')
    <meta charset="UTF-8">
@endsection

@section('content')
    <h1>Create a New Memo</h1>

    <form action="{{ route('memo_add') }}" method="post">
        @csrf
        <div>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <div>
            <label for="content">Content:</label>
            <textarea id="content" name="content" required></textarea>
        </div>
        <div>
            <button type="submit">Add Memo</button>
        </div>
    </form>

    <p><a href="{{ route('view_Account') }}">Cancel</a></p>
@endsection
