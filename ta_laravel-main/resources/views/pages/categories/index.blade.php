@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">Category</h3>
    <h3>LIST</h3>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(function() {
            $('#users-table').DataTable();
        });
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Halaman Data category</h4>
                    <p class="card-description">
                        menampilkan semua category
                    </p>
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible fade show mt-4 text-white" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
                        </div>
                    @endif
                    @if (session()->has('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-4 text-white" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close text-white" data-bs-dismiss="alert" aria-label="Close">x</button>
                        </div>
                    @endif
                    <a href="/category/create" class="btn btn-primary mb-3">Tambah category</a>
                    <div class="table-responsive pt-3">
                        <table class="table table-bordered table-striped" id="users-table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>category</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($categories as $key=>$value)
                                    <tr>
                                        <td>{{ $key + 1 }}</th>
                                        <td>{{ $value->name }}</td>
                                        <td>
                                            <form action="/category/{{ $value->id }}" method="POST">
                                                <a href="/category/{{ $value->id }}"
                                                    class="btn btn-info py-2 btn-sm">Show</a>
                                                <a href="/category/{{ $value->id }}/edit"
                                                    class="btn btn-primary py-2 btn-sm">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" class="btn btn-danger py-2 btn-sm" value="Delete">
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr colspan="3">
                                        <td>No data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
