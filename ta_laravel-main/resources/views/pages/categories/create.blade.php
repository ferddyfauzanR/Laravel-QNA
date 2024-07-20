@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">Category</h3>
    <h3>Create</h3>
@endsection
@section('content')
    <div class="col-12 grid-margin">
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Halaman Tambah Category</h4>
                <p class="card-description">
                    Tambah Category
                </p>
                <form action="/category" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Name Category :</label><br>
                        <input type="text" name="name" class="@error('name') is-invalid @enderror form-control">
                    </div>
                    @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Tambah Category</button>
                    <a href="/category" class="btn btn-light"> Kembali </a>
                </form>
            </div>
        </div>
    </div>
    </div>
@endsection
