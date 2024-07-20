@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">FunVerse</h3><h3>Home</h3>
@endsection
@section('content')
    <p>kamu adalah <strong> {{ auth()->user()->type }}</strong></p>

    <div class="mb-3" id="menu">
        <a href="/user/profil/{{ auth()->user()->username }}" class="text-decoration-none">Profil</a> ||
        <a href="/category" class="text-decoration-none">Category</a> ||
        <a href="/pertanyaan" class="text-decoration-none">Pertanyaan</a>
    </div>
    <form action="/user/signout" method="POST">
        @csrf
        <button class="btn btn-sm btn-secondary">Logout</button>    
    </form>
@endsection