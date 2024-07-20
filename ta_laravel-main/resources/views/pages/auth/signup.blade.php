<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <title>{{ $title }} | FunVerse</title>
</head>

<body class="">
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="../pages/dashboard.html">
                FunVerse
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-4">
                  <li class="nav-item">
                    <a class="nav-link " href="/user/signup">
                      <i class="fas fa-user-circle opacity-6 text-dark me-1"></i>
                      Sign Up
                    </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/user/signin">
                      <i class="fas fa-key opacity-6 text-dark me-1"></i>
                      Sign In
                    </a>
                  </li>
                </ul>
              </div>
          </div>
        </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-5">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">FunVerse</h1>
                            <p class="text-lead text-white">Use these awesome forms to login or create new account in
                                your project for free.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-8 col-lg-8 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center ">
                                <h5>Register</h5>
                            </div>
                            <div class="card-body">
                                <form action="/user/signup" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <h4>Users</h4>
                                    <hr>
                                    <div class="form-group mb-2">
                                        <label for="username">Username <span class="small"
                                                id="usernameError"></span></label><br>
                                        <input type="text" name="username" id="username"
                                            class="form-control @if ($errors->has('email')) border-danger @endif"
                                            value='{{ old('username') }}' placeholder="Username">
                                        @if ($errors->has('username'))
                                            <span class="text-danger">{{ $errors->first('username') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="email">Email</label><br>
                                        <input type="email" name="email" id="email"
                                            class="form-control @if ($errors->has('email')) border-danger @endif"
                                            value='{{ old('email') }}' placeholder="Email">
                                        @if ($errors->has('email'))
                                            <span class="text-danger">{{ $errors->first('email') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="password">Password</label><br>
                                        <input type="password" name="password" id="password"
                                            class="form-control @if ($errors->has('password')) border-danger @endif"
                                            placeholder="Password">
                                        @if ($errors->has('password'))
                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                        @endif
                                    </div>
                                    <h4 class="mt-4">Profil</h4>
                                    <hr>
                                    <div class="form-group mb-2">
                                        <label for="name">Full Name</label><br>
                                        <input type="text" name="name" id="name"
                                            class="form-control @if ($errors->has('name')) border-danger @endif"
                                            value='{{ old('name') }}' placeholder="Full Name">
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
                                                    value='{{ old('phone') }}'
                                                    placeholder="ex : 085795465812 or 85795465812">
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
                                                    value='{{ old('address') }}' placeholder="Address">
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
                                                    value='{{ old('city') }}' placeholder="City">
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
                                                    value='{{ old('region') }}' placeholder="Region">
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
                                                    value='{{ old('postal_code') }}' placeholder="Postal Code">
                                                @if ($errors->has('postal_code'))
                                                    <span
                                                        class="text-danger">{{ $errors->first('postal_code') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group mb-2">
                                                <label for="birthday">Birthday</label><br>
                                                <input type="date" name="birthday" id="birthday"
                                                    class="form-control @if ($errors->has('birthday')) border-danger @endif"
                                                    value='{{ old('birthday') }}' placeholder="Birthday">
                                                @if ($errors->has('birthday'))
                                                    <span class="text-danger">{{ $errors->first('birthday') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Image Profil (max 1MB | square image)</label><br>
                                        <input type="file" name="image" id="image"
                                            class="form-control @if ($errors->has('image')) border-danger @endif"
                                            accept="image/png, image/jpg, image/jpeg" placeholder="Image Profil">
                                        @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                        @endif
                                        <div>
                                            <img src="{{ asset('assets/img/preview.png') }}" class="mt-3" id="imgPreview" width="150px" alt="">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-gradient-dark w-100">Sign up</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Already have an account? <a href="/user/signin" class="text-dark font-weight-bolder">Sign in</a></p>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <footer>
            <div class="mx-auto text-center">
              <p class="text-secondary">
                Copyright © <script>
                  document.write(new Date().getFullYear())
                </script> Soft by Creative Tim.
              </p>
            </div>
          </footer>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>

    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
    <script>
        // validasi tidak boleh ada space dan harus toLowerCase
        let inputUsername = document.getElementById("username");
        let usernameError = document.getElementById("usernameError");
        inputUsername.addEventListener("keyup", function() {
            var inputString = this.value;
            inputUsername.value = inputString.toLowerCase();
            if (inputString.indexOf(' ') !== -1) {
                this.classList.add('border-danger');
                usernameError.innerHTML = "Jangan Ada Space";
                usernameError.classList.add('text-danger');
                inputUsername.value = inputString.toLowerCase().replace(/\s/g, "");
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
</body>

</html>
