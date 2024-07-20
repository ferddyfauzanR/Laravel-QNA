@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">List Pertanyaan</h3>
@endsection
@section('content')
    <a href="/pertanyaan/create" class="btn btn-sm btn-primary">Create Pertanyaan </a>
    <div class="row">
        @forelse ($pertanyaan as $item)
            <div class="col-lg-3">
                <div class="card border shadow mb-3">
                    <img class="card-img-top" src="{{ asset('images/' . $item->images) }}" style="object-fit:cover;"
                        alt="Card image cap" width="100px" height="180px">
                    <div class="card-body">
                        <h5><a href="/pertanyaan/{{ $item->id }}" class="text-bold">{{ $item->judul }}</a></h5>
                        <h6 class="card-text">Penulis : {{ $item->name }}</h6>
                        <p class="card-text"><small class="text-muted">{!! Str::limit($item->content, 100) !!}</small></p>
                        <h6><a href="/category" class="text-bold"><button class="badge-cs badge-warning-cs">{{ $item->categoriesName }}</button></a></h6>
                        <p class="card-text"><small class="text-muted">{{ $item->created_at->diffForHumans() }}</small></p>
                        <form action="/pertanyaan/{{ $item->id }}" class="row row-cols-lg-auto g-3 align-items-center"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="/pertanyaan/{{ $item->id }}/edit" class="btn btn-primary btn-sm mx-2">Edit</a>
                            <input type="submit" class="btn btn-danger btn-sm my-1" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        @empty
            <h1>Tidak ada Pertanyaan</h1>
        @endforelse
    </div>
@endsection
