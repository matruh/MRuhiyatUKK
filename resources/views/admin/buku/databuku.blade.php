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
        <h1 class="text-center">Data Daftar Buku</h1>
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
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Penerbit</th>
                        <th scope="col">Tahun Terbit</th>
                        <th scope="col">Stok</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Aksi</th>
        
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp
                    {{-- @foreach ($data as $index => $row) --}}
                    @foreach ($buku as $no => $databuku)
                        <tr>
                            <td>{{ $no + $buku->firstItem() }}</td>
                            <td>{{ $databuku->judul }}</td>
                            <td>{{ $databuku->penulis }}</td>
                            <td>{{ $databuku->penerbit }}</td>
                            <td>{{ $databuku->tahunterbit }}</td>
                            <td>{{ $databuku->stok }}</td>
                            <td>
                                <img src="{{ asset('fotobuku/' . $databuku->foto) }}" alt="foto"
                                    style="width : 30px">
                            </td>
                            <td>
                                <a href="/editbuku/{{ $databuku->id }}" class="btn btn-info btn-sm">Edit</a>
                                <a href="/hapusbuku/{{ $databuku->id }}" class="btn btn-danger btn-sm">Hapus</a>
                                    <button class="btn btn-danger btn-sm delete" data-id="{{ $databuku->id }}"
                                        data-judul="{{ $databuku->judul }}">Hapus</button>
                            </td>
                        </tr>
                    @endforeach
        
                </tbody>
            </table>
{{ $buku->links() }}

        </div>
    </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
<script>
    $(document).ready(function() {
        $('.delete').click(function() {
            var bukuid = $(this).data('id');
            var judul = $(this).data('judul');
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: "btn btn-success",
                    cancelButton: "btn btn-danger"
                },
                buttonsStyling: false
            });
            swalWithBootstrapButtons.fire({
                title: "Yakin?",
                text: "Anda akan menghapus data Buku dengan Judul " + judul + "?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus data!",
                cancelButtonText: "Tidak!",
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "/hapusbuku/" + bukuid;
                    swalWithBootstrapButtons.fire({
                        title: "Deleted!",
                        text: "Data telah dihapus.",
                        icon: "success"
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    swalWithBootstrapButtons.fire({
                        title: "Cancelled",
                        text: "Data tidak jadi dihapus :)",
                        icon: "error"
                    });
                }
            });
        });
    });
</script>
@if (Session::has('success'))
    <script>
        toastr.success("{{ Session::get('success') }}");
    </script>
@endif
</html>
