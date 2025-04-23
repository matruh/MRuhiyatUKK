<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
</head>

<body>
    <header>

    </header>
    <main>
        <h1 class="text-center">update Daftar Buku</h1>
        <div class="container my-5">
            <form action="/updatebuku/{{ $buku->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
                    <input type="text" name="judul" class="form-control" id="exampleFormControlInput1" value="{{ $buku->judul }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">penulis</label>
                    <input type="text" name="penulis" class="form-control" id="exampleFormControlInput1" value="{{ $buku->penulis }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">penerbit</label>
                    <input type="text" name="penerbit" class="form-control" id="exampleFormControlInput1" value="{{ $buku->penerbit }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tahun Terbit</label>
                    <input type="number" name="tahunterbit" class="form-control" id="exampleFormControlInput1" value="{{ $buku->tahunterbit }}">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control" id="exampleFormControlInput1" value="{{ $buku->stok }}">
                </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Foto sebelumnya</label>
                        <input value="{{ $buku->foto }}" readonly> 
                            <img src="{{ asset('fotobuku/' . $buku->foto) }}" style="width: 100px" class="d-flex">
                    </div>
                    <div>
                        <label for="exampleInputEmail1" class="form-label">Upload Foto</label>
                        <input type="file" name="foto"class="form-control" id="exampleInputEmail1" value="{{ $buku->foto }}" 
                            aria-describedby="emailHelp">
                    </div>

                <button type="submit" class="btn btn-primary mt-5">Update Buku</button>
        <a href="{{ route('databuku') }}" class="btn btn-secondary mt-5">Kembali</a>
            </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>

</html>
