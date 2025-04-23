<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <header>

    </header>
    <main>
        <div class="container">
            <h1 class="text-center mt-5">Tulis Ulasan Buku</h1>
            {{-- <a href="{{ route('ulasanbuku.create') }}" class="btn btn-primary mb-3">Berikan Ulasan</a> --}}
            <div class="container my-4">
                {{-- <form action="" method="POST"> --}}
                    {{-- @csrf --}}
                    <div class="row">
                        <div class="col-md-4 mt-5">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('fotobuku/' . $buku->foto) }}"
                                    class="card-img-top mx-auto d-block mt-5" alt="{{ $buku->judul }}"
                                    style=" width:200px; height: 300px; object-fit: cover;">
                                <div class="card-body text-center d-flex flex-column">
                                    <h5 class="card-title">{{ $buku->judul }}</h5>
                                    <p class="card-text">Penulis: {{ $buku->penulis }}</p>
                                    <p class="card">Penerbit: {{ $buku->penerbit }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-center mt-5">
                                <h3>Berikan Rating Buku</h3>
                                <form action="{{ route('prosesulasan') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id_buku" value="{{ $buku->id }}">
                                    <div class="mb-3">
                                        <label for="Rating" class="form-label">Rating</label>
                                        <select id="Rating" name="Rating" class="form-select" required>
                                            <option value="">-- Pilih Rating --</option>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }} Star</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Ulasan" class="form-label">Ulasan</label>
                                        <textarea id="Ulasan" name="Ulasan" class="form-control" rows="4" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
                                    <a href="{{ route('ulasanbuku') }}" class="btn btn-secondary">Kembali</a>

                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- <a href="{{ route('ulasanbuku') }}" class="btn btn-secondary mt-5">Kembali</a> --}}
                {{-- </form> --}}
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
