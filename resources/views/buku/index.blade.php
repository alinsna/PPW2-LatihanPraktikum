@extends('layouts.buku.main')

@section('title', 'Daftar Buku')

@section('content')
    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <!--<th>ID</th>-->
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <!--<td>{{ $buku->id }}</td>-->
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ "Rp. " . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($buku->tanggal_terbit)->format('d/m/Y') }}</td>
                    <td>
                        <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Apakah yakin akan dihapus?')" type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @if ($data_buku->isEmpty())
                <tr>
                    <td colspan="7" class="text-center">Tidak ada buku</td>
                </tr>
            @endif
        </tbody>
    </table>

    <p>Total jumlah buku: {{ $jumlah_buku }}</p>
    <p>Total harga semua buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>
@endsection


