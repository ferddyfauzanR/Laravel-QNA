@extends('template.user.main')
@section('title')
    Show
@endsection
@section('content')
<div class="col-lg-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Halaman Detail Category</h4>
        <p class="card-description">
            Show Categories {{$categories->name}}
        </p>
<h2>{{$categories->name}}</h2>

<div class="row">
    @forelse ($categories->pertanyaan as $item)
    <div class="col-4">
      <div class="card border shadow mb-3">
          <img class="card-img-top" src="{{ asset('images/' . $item->images) }}" style="object-fit:cover;" alt="Card image cap" width="100px" height="180px">
          <div class="card-body">
              <h5><a href="/pertanyaan/{{$item->id}}"  class="text-bold">{{$item->judul}}</a></h5>
              <h6 class="card-text">Penulis : {{ $item->name }}</h6>
              <h6><a href="/kategori"  class="text-bold"><button class="badge badge-warning"></button></a></h6>
            <p class="card-text"><small class="text-muted">{{$item->created_at->diffForHumans()}}</small></p>
            @auth
            
            <form action="/pertanyaan/{{$item->id}}" class="row row-cols-lg-auto g-3 align-items-center" method="POST">
                <a href="/pertanyaan/{{$item->id}}/edit" class="btn btn-primary btn-sm mx-2">Edit</a>
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn btn-danger btn-sm my-1" value="Delete">
                </form>
            @endif
            
          </div>
        </div>
  </div>
    @empty
        <h1>Tidak ada Pertanyaan di Kategori ini</h1>
    @endforelse
</div>
<br>
<br>
<a href="/category" class="btn btn-light"> Kembali </a>
      </div>
    </div>
</div>
@endsection