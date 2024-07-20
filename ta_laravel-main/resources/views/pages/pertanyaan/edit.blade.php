@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">Pertanyaan</h3>
    <h3>Create</h3>
@endsection
@section('content')
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Buat Pertanyaan Baru</h4>
                <p class="card-description">
                    Silahkan Tanya :
                </p>
                <form action="/pertanyaan/{{ $id }}/edit" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="title">Judul</label>
                        <input type="text" class="@error('judul') is-invalid @enderror form-control" value= {{ $pertanyaan->judul }} name="judul"
                            id="judul" placeholder="Masukkan Judul Pertanyaan">
                    </div>
                    @error('judul')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Content </label>
                        <input id="x" type="hidden" name="content" value="{{ $pertanyaan->content }}">
                        <trix-editor input="x" class="trix-content"></trix-editor>
                    </div>
                    @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Category</label>
                        <select name="categories_id" class="form-control" id="">
                            <option value="">---Pilih Category---</option>
                            @forelse ($categories as $item)
                                <option value="{{ $item->id }}" @selected($pertanyaan->categories_id==$item->id)>{{ $item->name }}</option>
                            @empty
                                <option value="">---Data Category Kosong---</option>
                            @endforelse
                        </select>
                    </div>
                    @error('categories_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="form-group">
                        <label for="title">Gambar</label>
                        <input type="file" class="form-control" name="images" id=""
                            placeholder="Silakan pilih salah satu images">
                    </div>
                    @error('images')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Tambah pertanyaan</button>
                    <a href="/category" class="btn btn-light"> Kembali </a>
                </form>
            </div>

        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{ asset('/assets/js/trix/trix.js')}}"></script>
    <script>
        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });
    </script>
@endpush
