@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">FunVerse</h3><h3>Home</h3>
@endsection
@section('content')
<div class="col-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Halaman Edit Kategori</h4>
        <p class="card-description">
            Edit Category {{$categories->id}}
        </p>
    <form action="/category/{{$categories->id}}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="tittle">category</label>
            <input type="text" class="form-control" name="name" value="{{$categories->name}}" id="name" placeholder="Masukkan kategori">
            @error('name')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="/category" class="btn btn-light"> Kembali </a>
    </form>
</div>
    </div>
</div>
@endsection