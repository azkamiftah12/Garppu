<!DOCTYPE html>
<html lang="en">

<head>
    <title>Garppu - {{ $pageTitle }}</title>
    <meta name="description"
        content="Garppu merupakan singkatan dari Gerakan Pemantau Pemilu yang memiliki tujuan untuk memonitor kegiatan pemilu.">
    <link rel="icon" href="{{ asset('images/garppu-logo.png') }}" type="image/x-icon">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .form-label {
            font-weight: 900;
        }

        .btn-whatsapp {
            background-color: #25D366;
            color: var(--color-white);
        }

        .btn-whatsapp:hover {
            color: var(--color-soft-blue);
        }

        .btn-login {
            background-color: var(--color-soft-blue);
            color: var(--color-white);
            justify-content: center;
            font-weight: 700;
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
    @if (request()->getHost() == 'garppu.online')
        <div class="alert alert-danger text-center mb-0">
            This Website for Demo and Development. Go to <a href="https://garppu.com">garppu.com</a>
        </div>
    @endif
    <div class="container my-5 d-flex justify-content-center">
        <div class="col-lg-6 col-sm-3">

            <div class="card shadow-lg bg-body rounded" style="background-color: var(--color-white)">
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
