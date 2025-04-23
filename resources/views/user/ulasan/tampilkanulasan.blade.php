<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $buku->judul }} - Ulasan</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="text-center mt-5">Ulasan Buku</h1>
        {{-- <a href="{{ route('ulasanbuku.create') }}" class="btn btn-primary mb-3">Berikan Ulasan</a> --}}
        <div class="container my-4">
            <form action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-4 mt-5">
                        <div class="card h-100 shadow-sm">
                            <img src="{{ asset('fotobuku/' . $buku->foto) }}" class="card-img-top mx-auto d-block mt-5"
                                alt="{{ $buku->judul }}" style=" width:200px; height: 300px; object-fit: cover;">
                            <div class="card-body text-center d-flex flex-column">
                                <h5 class="card-title">{{ $buku->judul }}</h5>
                                <p class="card-text">Penulis: {{ $buku->penulis }}</p>
                                <p class="card">Penerbit: {{ $buku->penerbit }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="text-center mt-5">
                            <h3>Ulasan Buku</h3>
                            {{-- <label for="exampleFormControlTextarea1" class="form-label"><b>Ulasan Buku Ini</b></label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="20"></textarea> --}}
                            @if ($ulasan->isEmpty())
                                <h5 class="card">Belum ada ulasan untuk buku ini.</h5>
                            @else
                                <ul class="list-group mb-4">
                                    @foreach ($ulasan as $item)
                                        <li class="list-group-item">
                                            <strong>{{ $item->user->name }}</strong> memberi rating Bintang
                                            <strong>{{ $item->Rating }}</strong>
                                            <br>
                                            {{ $item->Ulasan }}
                                            <br>
                                            <small class="text-muted">Ditulis pada
                                                {{ $item->created_at->format('d M Y') }}</small>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                </div>
                <a href="{{ route('ulasanbuku') }}" class="btn btn-secondary mt-5">Kembali</a>
            </form>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
