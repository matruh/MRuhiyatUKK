<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{asset('assets/css/sidebar.css')}}">

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
        <h1 class="text-center">Data Koleksi Buku</h1>
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
                        <th scope="col">Aksi</th>
        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    @foreach ($koleksi as $no => $datakoleksi)
                    <tr>
                        <td>{{ $no+$koleksi->firstitem() }}</td>
                        <td>{{ $datakoleksi->user ? $datakoleksi->user->name : 'Nama tidak ditemukan' }}</td>
                        <td>{{ $datakoleksi->buku ? $datakoleksi->buku->judul : 'Buku tidak ditemukan' }}</td>
                        <td>
                            <img src="{{ asset('fotobuku/' . $datakoleksi->buku->foto) }}" alt="foto"
                                style="width : 30px">
                        </td>
                        <td>
                          <a href="/tampilkandata/{{ $datakoleksi->id }}" class="btn btn-info btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                          <button class="btn btn-danger btn-sm delete" data-id="{{ $datakoleksi->id }}" data-nama="{{ $datakoleksi->nama_buku }}"><i class="bi bi-trash"></i> Delete</button>
                        </td>
                      </tr>
                    @endforeach
                </tbody>
            </table>
{{ $koleksi->links() }}
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
