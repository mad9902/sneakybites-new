@extends('layouts.app')

@section('judul')
Ubah Pengguna
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">Ubah Pengguna</h2>
    <p class="fw-bold text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi consequuntur
        amet necessitatibus! Quam veniam
    </p>
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('users.update', $users->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name') == null ? $users->name : old('name') }}"
                        placeholder="Nama Pengguna">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select name="role" id="role" class="form-select">
                        <option value="admin" {{ $users->is_admin ? 'selected' : '' }}>Admin</option>
                        <option value="resto" {{ $users->is_resto ? 'selected' : '' }}>Resto</option>
                        <option value="user" {{ !$users->is_admin && !$users->is_resto ? 'selected' : '' }}>User</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        value="{{ old('email') == null ? $users->email : old('email') }}"
                        placeholder="Email">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi <span class="text-sm text-secondary">(Kosongkan jika tidak ingin
                            mengubah)</span></label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                        placeholder="Kata Sandi">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Konfirmasi Kata Sandi">
                </div>
                <div class="mb-3">
                    <label class="form-label">Nomor Telepon</label>
                    <input type="text" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror"
                        value="{{ old('phone_number') == null ? $users->phone_number : old('phone_number') }}"
                        placeholder="Nomor Telepon">
                    @error('phone_number')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="address" rows="5"
                        class="form-control @error('address') is-invalid @enderror"
                        placeholder="Alamat">{{ old('address') == null ? $users->address : old('address') }}</textarea>
                    @error('address')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <button class="btn btn-info text-white fw-bold w-100">Submit</button>
                </div>
            </form>
        </div>
        <div class="col-md-5">
            <img src="{{ asset('images/illustration.png') }}" alt="images" class="w-100">
        </div>
    </div>
</div>
@endsection
