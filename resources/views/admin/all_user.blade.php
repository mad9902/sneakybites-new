@extends('layouts.app')

@section('judul')
Kelola User
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">Kelola User</h2>
    <p class="fw-bold text-secondary">Daftar semua user:</p>
    <a href="{{ route('users.create') }}" class="btn btn-info fw-bold text-white mb-3">Tambah Restoran</a>
    <div class="row">
        <div class="col-md-12">
            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th class="text-center" scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                {{ $user->is_admin ? 'Admin' : ($user->is_resto ? 'Restaurant' : 'User') }}

                            </td>
                            <td class="text-center">
                                <a href="{{ route('users.edit', $user->id) }}"
                                    class="btn btn-info fw-bold text-white btn-sm">Ubah</a>
                                <a href="#" class="btn btn-danger btn-sm fw-bold"
                                    onclick="event.preventDefault();document.getElementById('confirm_delete-{{ $user->id }}').submit(); return confirm('Anda yakin ingin menghapus?');">
                                    Hapus
                                    <form id="confirm_delete-{{ $user->id }}" method="POST"
                                        action="{{ route('users.destroy', $user->id) }}" class="d-none">
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
    </div>
</div>
@endsection