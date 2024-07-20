@extends('template.user.main')
@section('title')
    FunVerse
@endsection
@section('content')
    <p><strong>FunVerse</strong> 
        bisa diartikan sebagai kombinasi kata "Fun" yang berarti "menyenangkan" atau "menghibur" dan "Verse" yang dapat merujuk pada dunia, dimensi, atau lingkungan imajinatif. Jadi, secara keseluruhan, "FunVerse" dapat diartikan sebagai "Dunia yang Menyenangkan" atau "Lingkungan Menghibur"</p>
    <p>ini halaman awal</p>

    @if(auth()->user())
    <form action="/user/signout" method="POST">
        @csrf
        <button class="btn btn-sm btn-secondary mt-2">Logout</button>    
    </form>
    @else
    <a href="/user/signin" class="btn btn-sm btn-success">Login</a>
    @endif
@endsection
