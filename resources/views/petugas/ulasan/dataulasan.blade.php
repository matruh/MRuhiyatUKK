<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
        <link rel="stylesheet" href="{{ secure_asset('assets/css/sidebar.css') }}">


</head>
<body>
    <header>
    <div class="sidebar">
        <h3 class="text-center text-white mb-4">Admin Panel</h3>
        @auth
            <h5 class="user-info">👤 {{ Auth::user()->name }}</h5>
        @endauth
        {{-- <a href="/#"><i class="bi bi-plus-circle"></i> Transaksi </a> --}}
        <a href="/databuku"><i class="bi bi-table"></i> Data Buku</a>
        <a href="/datauser"><i class="bi bi-file-earmark-pdf"></i> Data User</a>
        <a href="/datapeminjaman"><i class="bi bi-file-earmark-excel"></i> Data Peminjaman</a>
        <a href="/datakoleksi"><i class="bi bi-file-earmark-excel"></i> Koleksi Buku</a>
        <a href="/dataulasan"><i class="bi bi-file-earmark-excel"></i> Data Ulasan</a>
        <a class="" href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
    </header>
    <main>
        <div class="content">
    <div class="container my-5">
        <h1 class="text-center">Data Ulasan Buku</h1>
        <div class="row mb-4">
            <div class="col-md-auto">
                <a href="/tambahbuku" class="btn btn-success w-100">Tambah Buku</a>
            </div>
            <div class="col-md-auto">
                <a href="/databukupdf" class="btn btn-danger w-100">Export PDF</a>
            </div>
            {{-- <div class="col-md-auto">
                <a href="/exportbuku" class="btn btn-info w-100">Export excel</a>
            </div> --}}
        </div>
        <div class="card-table">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">NO</th>
                        <th scope="col">Nama User</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Foto Buku</th>
                        <th scope="col">Ulasan</th>
                        <th scope="col">Rating</th>
                        {{-- <th scope="col">Aksi</th> --}}
        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($ulasan as $no => $dataulasan)
                        <tr>
                            <td>{{ $no+$ulasan->firstItem()}}</td>
                            <td>{{ $dataulasan->user ? $dataulasan->user->name : 'Nama tidak ditemukan'}}</td>
                            <td>{{ $dataulasan->buku ? $dataulasan->buku->judul : 'Buku tidak ditemukan'}}</td>
                            <td>
                                <img src="{{ asset('fotobuku/' . $dataulasan->buku->foto) }}" alt="foto"
                                    style="width : 30px">
                            </td>
                            <td>{{ $dataulasan->Ulasan }}</td>
                            <td>{{ $dataulasan->Rating }}</td>
                            {{-- <td>
                                <a href="/editbuku/{{ $dataulasan->id }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="/hapusbuku/{{ $dataulasan->id }}" class="btn btn-danger btn-sm">Hapus</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
{{ $ulasan->links() }}
        </div>
    </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif
</html>
