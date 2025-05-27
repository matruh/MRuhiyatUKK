<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ secure_asset('assets/css/sidebar.css') }}">

    </head>

<body>
    <header>
        <nav class="navbar sticky-bottom bg-body-tertiary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Perpustakaan Digital</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="/ulasanbuku">Ulasan Buku</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link active" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Peminjaman
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/peminjaman">Peminjaman Buku</a></li>
                                <li><a class="dropdown-item" href="/riwayatpeminjaman">Riwayat Peminjaman Buku</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle nav-link active" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Koleksi
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/koleksipribadi">Koleksi Buku Pribadi</a></li>
                                <li><a class="dropdown-item" href="/tambahkoleksi">Tambah Koleksi Buku</a></li>
                                {{-- <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li> --}}
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle nav-link active" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
                    {{-- <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form> --}}
                </div>
            </div>
        </nav>
    </header>
    <main>

        <h1 class="text-center mt-5">
            Selamat Datang {{ Auth::user()->name }} 
        </h1>
        <h2 class="text-center">
            Di Perpustakaan Digital
        </h2>
        <div class="row">
            <div class="col-md-4 mt-5 m-auto">
                <div class="card">
                    <img src="img/tambahbuku.jpg" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Daftar Peminjaman Buku</h5>
                        <p class="card-text">Deskripsi singkat tentang peminjaman buku.</p>
                        <a href="/peminjaman" class="btn btn-primary">Lihat Daftar Buku</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5 m-auto">
                <div class="card">
                    <img src="img/perpustakaan.jpg" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Riwayat Peminjaman & Pengembalian Buku</h5>
                        <p class="card-text">Deskripsi singkat tentang riwayat peminjaman.</p>
                        <a href="/riwayatpeminjaman" class="btn btn-primary">Lihat Riwayat</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5 m-auto">
                <div class="card">
                    <img src="img/koleksibuku.png" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Koleksi Buku Pribadi</h5>
                        <p class="card-text">Deskripsi singkat tentang koleksi buku.</p>
                        <a href="/koleksipribadi" class="btn btn-primary">Lihat Koleksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5 m-auto">
                <div class="card">
                    <img src="img/tambahkoleksi.jpg" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Tambah Koleksi Buku</h5>
                        <p class="card-text">Deskripsi singkat tentang koleksi buku.</p>
                        <a href="/tambahkoleksi" class="btn btn-primary">Tambah Koleksi</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-5 m-auto">
                <div class="card">
                    <img src="img/ulasanbuku.jpg" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ulasan Buku</h5>
                        <p class="card-text">Berisi Ulasan Mengenai buku.</p>
                        <a href="/ulasanbuku" class="btn btn-primary">Ulasan Buku</a>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4 mt-5">
                <div class="card">
                    <img src="img/perpustakaan.jpg" class="card-img-top" alt="..." style="width: auto" height="250px">
                    <div class="card-body text-center">
                        <h5 class="card-title">()</h5>
                        <p class="card-text">()</p>
                        <a href="/#" class="btn btn-primary">()</a>
                    </div>
                </div>
            </div> --}}
        </div>
            
        
    </main>
    <footer>
        <div class="container mt-5">
            <p>&copy; <a href="/dashboard">Perpustakaan Digital 2025</a></p>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif

</html>
