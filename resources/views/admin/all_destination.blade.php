@extends('layouts.app')

@section('judul')
Kelola Restoran
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">Kelola Restoran</h2>
    <p class="fw-bold text-secondary">Kelola Restoran yang dibuat khusus untuk admin :
    </p>
    <a href="{{ route('create_resto_list') }}" class="btn btn-info fw-bold text-white mb-3">Tambah Restoran</a>
    <div class="row">
        <div class="col-md-7">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="text-center">No</th>
                        <th scope="col" style="width: 20%">Gambar</th>
                        <th scope="col" style="width: 15%">Restoran</th>
                        <th scope="col" style="width: 25%">Deskripsi</th>
                        <th scope="col">Range Harga</th>
                        <th scope="col" class="text-center" style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($destinations as $destination)
                        <tr>
                            <th scope="row" class="text-center">{{ $loop->iteration }}</th>
                            <td>
                                <img src="{{ asset('storage/images/' . $destination->image) }}" alt="image"
                                    class="img-fluid rounded">
                            </td>
                            <td>{{ $destination->title }}</td>
                            <td>{{ substr($destination->description, 0, 50) . '...' }}</td>
                            <td>{{ $destination->range}}</td>
                            <td class="text-center">
                                <a href="{{ route('edit_resto_list', $destination->id) }}"
                                    class="btn btn-info fw-bold text-white btn-sm">Ubah</a>
                                <a href="#" class="btn btn-danger btn-sm fw-bold"
                                    onclick="event.preventDefault();document.getElementById('confirm_delete-{{ $destination->id }}').submit(); return confirm('Anda yakin ingin menghapus?');">
                                    Hapus

                                    <form id="confirm_delete-{{ $destination->id }}" method="POST"
                                        action="{{ route('destroy_resto_list', $destination->id) }}" class="d-none">
                                        @method('delete')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('images/illustration.png') }}" alt="images" class="w-100">
        </div>
    </div>
</div>
@endsection