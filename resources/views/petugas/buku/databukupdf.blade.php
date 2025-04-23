<!DOCTYPE html>
<html>

<head>
    <style>
        #customers {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #customers td,
        #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #customers tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #customers tr:hover {
            background-color: #ddd;
        }

        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
{{-- <link rel="stylesheet" href="{{asset('assets/css/sidebar.css')}}"> --}}
<body>
    <h1 class="text-center">Data Buku Perpustakaan Digital</h1>

    <table id="customers">
        <tr>
            <th>NO</th>
            <th>Judul Buku</th>
            <th>Penulis Buku</th>
            <th>Penerbit Buku</th>
            <th>Tahun Terbit Buku</th>
            <th>Stok Buku</th>
            {{-- <th>Foto Buku</th> --}}
        </tr>
        @php
            $no = 1;
        @endphp
        @foreach ($buku as $databuku)
            <tr>
                <td>{{ $no++ }}</td>
                <td>{{ $databuku->judul }}</td>
                <td>{{ $databuku->penulis }}</td>
                <td>{{ $databuku->penerbit }}</td>
                <td>{{ $databuku->tahunterbit }}</td>
                <td>{{ $databuku->stok }}</td>
                {{-- <td>
                <img src="{{ asset('fotobuku/' . $databuku->foto) }}" alt="foto" style="width: 30px">
            </td> --}}
            </tr>
        @endforeach
    </table>
</body>
</html>
