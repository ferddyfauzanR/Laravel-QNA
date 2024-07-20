@extends('template.user.main')
@section('title')
    <h3 class="display-4 mb-4">Edit Profile</h3>
@endsection
@section('content')
    <form action="/edit/{{ $section }}/{{ $datas->username }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @if ($section=='profil')          
            <h4 class="mt-4">Profil</h4>
            <hr>
            <div class="form-group mb-2">
                <label for="name">Full Name</label><br>
                <input type="text" name="name" id="name"
                    class="form-control @if ($errors->has('name')) border-danger @endif" value='{{ $datas->name }}'
                    placeholder="Full Name">
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <label for="address">Phone Only Region Indonesia</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text" id="basic-addon1">+62</span>
                        <input type="text" name="phone" id="phone"
                            class="form-control @if ($errors->has('phone')) border-danger @endif"
                            value='{{ $datas->phone }}' placeholder="ex : 085795465812 or 85795465812">
                    </div>
                    @if ($errors->has('phone'))
                        <span class="text-danger">{{ $errors->first('phone') }}</span>
                    @endif
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="address">Address</label><br>
                        <input type="text" name="address" id="address"
                            class="form-control @if ($errors->has('address')) border-danger @endif"
                            value='{{ $datas->address }}' placeholder="Address">
                        @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="city">City</label><br>
                        <input type="text" name="city" id="city"
                            class="form-control @if ($errors->has('city')) border-danger @endif"
                            value='{{ $datas->city }}' placeholder="City">
                        @if ($errors->has('city'))
                            <span class="text-danger">{{ $errors->first('city') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="region">Region</label><br>
                        <input type="text" name="region" id="region"
                            class="form-control @if ($errors->has('region')) border-danger @endif"
                            value='{{ $datas->region }}' placeholder="Region">
                        @if ($errors->has('region'))
                            <span class="text-danger">{{ $errors->first('region') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="postal_code">Postal Code</label><br>
                        <input type="number" name="postal_code" id="postal_code"
                            class="form-control @if ($errors->has('postal_code')) border-danger @endif"
                            value='{{ $datas->postal_code }}' placeholder="Postal Code">
                        @if ($errors->has('postal_code'))
                            <span class="text-danger">{{ $errors->first('postal_code') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="birthday">Birthday</label><br>
                        <input type="date" name="birthday" id="birthday"
                            class="form-control @if ($errors->has('birthday')) border-danger @endif"
                            value='{{ $datas->birthday }}' placeholder="Birthday">
                        @if ($errors->has('birthday'))
                            <span class="text-danger">{{ $errors->first('birthday') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <div class="form-group mb-2">
                <label for="image">Image Profil (max 1MB | square image)</label><br>
                <input type="file" name="image" id="image"
                    class="form-control @if ($errors->has('image')) border-danger @endif"
                    accept="image/png, image/jpg, image/jpeg" placeholder="Image Profil">
                @if ($errors->has('image'))
                    <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <div class="m-t-10">
                    <img src="{{ asset($datas->image) }}" class="mt-3 img-thumbnail avatar border-0"
                        id="imgPreview" width="150px" alt="">
                </div>
            </div>
        @else
            <h4 class="mt-4">User</h4>
            <hr>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="username">Username</label><br>
                        <input type="text" name="username" id="username"
                            class="form-control @if ($errors->has('username')) border-danger @endif"
                            value='{{ $datas->username }}' placeholder="Username">
                        @if ($errors->has('username'))
                            <span class="text-danger">{{ $errors->first('username') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="email">Email</label><br>
                        <input type="email" name="email" id="email"
                            class="form-control @if ($errors->has('email')) border-danger @endif"
                            value='{{ $datas->email }}' placeholder="Email">
                        @if ($errors->has('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="password">Password</label><br>
                        <input type="password" name="password" id="password"
                            class="form-control @if ($errors->has('password')) border-danger @endif"
                            value='{{ $datas->region }}' placeholder="Password">
                        @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group mb-2">
                        <label for="confirmPassword">Confirm Password</label><br>
                        <input type="password" name="confirmPassword" id="confirmPassword"
                            class="form-control @if ($errors->has('confirmPassword')) border-danger @endif"
                            value='{{ $datas->region }}' placeholder="Confirm Password">
                        @if ($errors->has('confirmPassword'))
                            <span class="text-danger">{{ $errors->first('confirmPassword') }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        <hr>
        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ url()->previous() }}" class="btn btn-danger mt-2">Batal</a>
        </p>
    </form>
@endsection
@push('scripts')
    <script>
        // validasi tidak boleh ada space dan harus toLowerCase
        let inputUsername=document.getElementById("username");
        let usernameError=document.getElementById("usernameError");
        inputUsername.addEventListener("keyup", function() {
            var inputString = this.value;
            inputUsername.value=inputString.toLowerCase();
            if (inputString.indexOf(' ') !== -1) {
                this.classList.add('border-danger');
                usernameError.innerHTML = "Jangan Ada Space";
                usernameError.classList.add('text-danger');
                inputUsername.value=inputString.toLowerCase().replace(/\s/g, "");
            } else {
                this.classList.remove('border-danger');
                usernameError.innerHTML = "";
            }
        });

        let img = document.getElementById('imgPreview');
        let input = document.getElementById('image');

        input.onchange = (e) => {
            if (input.files[0]) {
                img.src = URL.createObjectURL(input.files[0]);
            }
        }
    </script>
@endpush
