<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <style>
        html,
        body {
        height: 100%
        }

    </style>
    <title>{{ $title }} | FunVerse</title>
</head>

<body class="bg-body-tertiary">
    <div class="h-100 d-flex flex-column align-items-center justify-content-center text-body-secondary">
        <h2>Welcome to the FunVerse</h2>
                <h1>Email Verification</h1>
                <p>Please verify your email address by following these steps:</p>

                <ol>
                    <li>Click this link <a href="/user/verifikasiEmail/{{ auth()->user()->username }}" class="text-decoration-none">Verifikasi Your Email
                        {{ auth()->user()->username }}</a> </li>
                    <li>Open your email</li>
                    <li>Look for an email from us with the subject "Email Verification"</li>
                    <li>Open the email and click the verification link</li>
                </ol>

                <p>If you didn't receive the verification email, please check your "Spam" or "Promotions" folder in your
                    email inbox.</p>
      </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js"
        integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous">
    </script>
</body>

</html>
