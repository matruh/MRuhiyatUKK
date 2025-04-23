<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpustakaan Digital</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/sidebar.css')}}">

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
            <h2 class="text-center mt-5">Riwayat Peminjaman</h2>
    
            <div class="container my-4">
                
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
                        @foreach ($peminjamans as $peminjaman)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    @if ($peminjaman->buku->foto)
                                        <img src="{{ asset('fotobuku/' . $peminjaman->buku->foto) }}"
                                            class="card-img-top mx-auto d-block mt-5" alt="{{ $peminjaman->buku->judul }}"
                                            style=" width:200px; height: 300px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('fotobuku/default.jpg') }}" class="card-img-top mx-auto d-block"
                                            alt="Default Image" style="width:200px; height: 300px; object-fit: cover;">
                                    @endif
                                    <div class="card-body text-center d-flex flex-column">
                                        {{-- <h6 class="card-title">{{ $peminjaman->user->name }}</h6> --}}
                                        <h5 class="card-title">{{ $peminjaman->buku->judul }}</h5>
                                        <p class="card text">Penulis: {{ $peminjaman->buku->penulis }}</p>
                                        <p class="card text">stok Buku: {{ $peminjaman->buku->stok }}</p>
                                        <p class="card text">Tanggal Pinjam {{ $peminjaman->tanggal_peminjaman }}</p>
                                        <p class="card text">Tanggal pengembalian {{ $peminjaman->tanggal_pengembalian }}
                                        </p>
                                        <p class="card text">Status Peminjaman {{ $peminjaman->status_peminjaman }}</p>
                                        <p class="card text">Denda : Rp. {{ number_format($peminjaman->denda, 0, ',', '.') }}</p>
                                        <!-- Tombol Kembalikan -->
                                        <form action="{{ route('kembalikanbuku', $peminjaman->id) }}" method="POST" class="mt-2">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" class="btn btn-success w-100"
                                                {{ $peminjaman->status_peminjaman !== 'Dipinjam' ? 'disabled' : '' }}>
                                                Kembalikan Buku
                                            </button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
    
                    {{-- <button type="submit" class="btn btn-primary">Pinjam Buku</button> --}}
    <a href="{{ route('peminjaman') }}" class="btn btn-primary mt-5">Pinjam Buku</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mt-5">Kembali</a>
    
            </div>
        </div>
</main>
<footer>
    <div class="container mt-5">
        <p>&copy; <a href="/dashboard">Perpustakaan Digital 2025</a></p>
    </div>
</footer>

    
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
@if (Session::has('success'))
<script>
    toastr.success("{{ Session::get('success') }}");
</script>
@endif