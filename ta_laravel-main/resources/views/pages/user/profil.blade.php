@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">Profil</h3>
@endsection
@section('content')
    <h3 class="display-6">{{ $datas->name }}</h3>
    <img src="{{ asset($datas->image) }}" class="img-thumbnail border-0">
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    @if(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show mt-4" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="card my-4">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <h5 class="card-title">Username</h5>
                    <p class="card-text">{{ $datas->username }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Email</h5>
                    <p class="card-text">{{ $datas->email }}
                        @if ($datas->email_verified_at == null)
                            <a href="/user/verifikasiEmail"><span class="badge bg-danger">Verifikasi Email</span></a>
                        @else
                            <span class="badge bg-success">Verified</span>
                        @endif
                    </p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Phone</h5>
                    <p class="card-text">{{ $datas->phone }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Birthday</h5>
                    <p class="card-text">{{ $datas->birthday }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Address</h5>
                    <p class="card-text">{{ $datas->address }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">City</h5>
                    <p class="card-text">{{ $datas->city }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Region</h5>
                    <p class="card-text">{{ $datas->region }}</p>
                    <hr>
                </div>
                <div class="col-lg-6">
                    <h5 class="card-title">Postal Code</h5>
                    <p class="card-text">{{ $datas->postal_code }}</p>
                    <hr>
                </div>
            </div>
        </div>
    </div>
    <div class="accordion accordion-flush" id="accordionFlushExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Edit profile
                </button>
            </h2>
            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Aksi ini akan hanya mengubah data profil <code>{{ $datas->username }}</code>, yang berkaitan dengan biodata<br>
                    <a href="/edit/profil/{{ $datas->username }}" class="btn btn-warning btn-sm mt-2">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    Edit user
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Aksi ini akan hanya mengubah data user <code>{{ $datas->username }}</code>, yang berkaitan dengan login<br>
                    <a href="/edit/user/{{ $datas->username }}" class="btn btn-warning btn-sm mt-2">Edit Profile</a>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    Logout account
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    Aksi ini akan mengeluarkan akun <code>{{ $datas->username }}</code><br>
                    <form action="/user/signout" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-secondary mt-2">Logout</button>    
                    </form>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    Delete account
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    This action deletes your account <code>{{ $datas->username }}</code> and everything this transaction. There is no going back.<br>                    
                    <button class="btn btn-danger btn-sm mt-2" id="deleteProfile" data-id="{{ $datas->username }}">Delete Profile</button>
                </div>
            </div>
        </div>  
    </div>
    
    
@endsection

@push('scripts')
    <script>
        let button = document.getElementById('deleteProfile');
        let auth = document.getElementById('authDelete');
        let html = `
        <form action="/user/delete/${button.getAttribute('data-id')}" method="POST">
            @method('DELETE')
            @csrf
            <div class='row'>
                <div class='col-lg-4'>
                    <div class="form-group">
                        <span>Masukan password untuk menghapus akun</span>
                        <div class="input-group mb-3">
                            <input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        <form>        
        `;
        button.addEventListener("click", function() {
            auth.innerHTML = html;
        });
    </script>
@endpush
