<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garppu - {{ $pageTitle }}</title>
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/icon type">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .btn-login {
            background-color: var(--color-dark-blue);
            color: var(--color-white);
            justify-content: center
        }

        .btn-login:hover {
            color: var(--color-yellow);
        }

        .card {
            width: 100%;
            aspect-ratio: 3/2
        }
    </style>
</head>

<body style="background-color: var(--color-white-brown); color: var(--color-dark-blue);">
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-lg-6 col-sm-3">

            <div class="card shadow-lg bg-body rounded">
                <div class="card-header text-center"
                    style="background-color: var(--color-dark-blue); color: var(--color-white)">
                    {{ $pageTitle }}
                </div>
                <div class="card-body mt-3 mb-4">
                    <div class="d-flex justify-content-center mb-5">

                        <img src="{{ asset('images/garppu-logo.png') }}" alt="Garppu Logo" width="140"
                            height="100">
                    </div>
                    @yield('content')
                </div>

            </div>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
</body>

</html>
