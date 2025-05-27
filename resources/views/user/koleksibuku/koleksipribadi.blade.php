<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Laravel - Data Kategori Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Toastr CSS -->
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
        {{-- <h1 class="text-center mb-4">Perpustakaan Digital</h1> --}}

        <div class="container">
            <h2 class="text-center mt-5">Koleksi Pribadi Saya</h2>
            <div class="container my-4">
            @if ($koleksi->isEmpty())
                <h5 class="card col-md-3">Belum ada buku di koleksi pribadi.</h5>
            @else
                    <form action="" method="POST">
                        @csrf
                        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                            @foreach ($koleksi as $item)
                                <div class="col">
                                    <div class="card h-100 shadow-sm">
                                        @if ($item->buku->foto)
                                            <img src="{{ asset('fotobuku/' . $item->buku->foto) }}"
                                                class="card-img-top mx-auto d-block mt-3" alt="{{ $item->buku->judul }}"
                                                style="width: 200px; height: 300px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('fotobuku/default.jpg') }}"
                                                class="card-img-top mx-auto d-block mt-3" alt="Default Image"
                                                style="width: 200px; height: 300px; object-fit: cover;">
                                        @endif
                                    
                                        <div class="card-body text-center d-flex flex-column">
                                            <h5 class="card-title">{{ $item->buku->judul }}</h5>
                                            <p class="card-text">Penulis: {{ $item->buku->penulis }}</p>
                                        </div>
                                    </form>
                                        <div class="card-footer bg-white border-0 text-center">
                                            <form action="{{ route('hapuskoleksi', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                    
                                </div>
                            @endforeach
                        </div>
            @endif
        </div>
        <a href="{{ route('tambahkoleksi') }}" class="btn btn-primary">Tambah Koleksi Buku</a>
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">Kembali</a>
        </div>
</main>
<footer>
    <div class="container mt-5">
        <p>&copy; <a href="/dashboard">Perpustakaan Digital 2025</a></p>
    </div>
</footer>
</body>

</html>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
    @if (Session::has('success'))
      toastr.success("{{ Session::get('success') }}");
    @endif
  </script>