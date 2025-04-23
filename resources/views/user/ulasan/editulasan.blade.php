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
        <h2>Edit Ulasan</h2>
        <div class="card h-100 shadow-sm">
            @if ($buku->foto)
                <img src="{{ asset('fotobuku/' . $buku->foto) }}" class="card-img-top mx-auto d-block mt-5"
                    alt="{{ $buku->judul }}"
                    style=" width:200px; height: 300px; object-fit: cover;">
            @else
                <img src="{{ asset('fotobuku/default.jpg') }}" class="card-img-top mx-auto d-block"
                    alt="Default Image" style="width:200px; height: 300px; object-fit: cover;">
            @endif
        </div>
        <form action="/updateulasan/{{ $ulasan->id }}" method="POST">
            @csrf
            <input type="hidden" name="id_buku" value="{{ $buku->id }}">
            <div class="mb-3">
                <label for="Rating" class="form-label">Rating</label>
                <select id="Rating" name="Rating" class="form-select" value="{{ $ulasan->Rating }}">
                    <option value=""></option>
                    @for ($i = 1; $i <= 5; $i++)
                        <option value="{{ $i }}">{{ $i }} Star</option>
                    @endfor
                </select>
            </div>
            <div class="mb-3">
                <label for="Ulasan" class="form-label">Ulasan</label>
                <textarea id="Ulasan" name="Ulasan" class="form-control" rows="4" value="{{ $ulasan->Ulasan }}"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Kirim Ulasan</button>
            <a href="{{ route('ulasanbuku') }}" class="btn btn-secondary">Kembali</a>

        </form>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</html>
