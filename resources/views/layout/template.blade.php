<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? '' }}</title>
    <link href="{{ asset('assets') }}/css/bootstrap-css/bootstrap.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/logo.png" type="image/png">
    <link rel="shortcut icon" href="{{ asset('assets') }}/images/logo/logo.png" type="image/png">
    <style>
        @font-face {
            font-family: 'Sans serif';
            src: url() src: url("{{ asset('assets') }}/font-roboto/roboto_condesend_font.ttf') format('ttf");
            font-weight: normal;
            font-style: normal;
        }

        * {
            font-family: 'Sans serif';
        }

        .text-color-blue {
            color: #01579b;
        }

        .tombol-simpan {
            background-color: #0091ea;
            color: #ffffff;
        }

        .tombol-kembali {
            background-color: #00b0ff;
            color: #ffffff;
        }

        .tombol-simpan:hover {
            border: solid #0091ea 1px;
            color: #0091ea;
        }

        .tombol-kembali:hover {
            border: solid #00b0ff 1px;
            color: #00b0ff;
        }

        body {
            background-image: url('{{ asset('assets') }}/images/background/bupati.jpeg');
            background-size: cover;
            background-position: center;
            height: 100vh;
            margin: 0;
            padding: 0;
        }

        .content {
            position: relative;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            color: white;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand text-color-blue" href="/">BUKU TAMU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-color-blue" aria-current="page" href="/">HOME</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  text-color-blue" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            FORM
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-color-blue" href="/form-tamu">Input data tamu</a></li>
                            <li><a class="dropdown-item text-color-blue" href="/login">Login admin</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        @yield('content')
    </div>
    <script src="{{ asset('assets') }}/js/bootstrap-js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
