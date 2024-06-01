@extends('layouts.app')

@section('judul')
Edit Profil
@endsection

@section('content')
<div class="background" style="padding: 100px 0;">
    <div class="col-md-4 mx-auto auth-background rounded p-5">
        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        <h2 class="fw-bold">
            @if (Auth::user()->is_resto)
                Edit Profil Restoran
            @else
                Edit Profil Pengguna
            @endif
        </h2>
        <form method="POST" action="{{ route('show_profile', Auth::user()->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')

            @if (Auth::user()->is_resto)
                <!-- Form untuk Restoran -->
                <div class="mb-3">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/images/' . $destination->image) }}" alt="current image"
                                class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Ganti Gambar</label>
                            <input type="file" name="image" class="form-control">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror"
                        placeholder="Deskripsi"
                        style="height: 100px">{{ old('description') == null ? $destination->description : old('description') }}</textarea>
                    <label>Deskripsi</label>

                    @error('description')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="range" class="form-control @error('range') is-invalid @enderror"
                        placeholder="Range Harga" value="{{ old('range') == null ? $destination->range : old('range') }}">
                    <label>Range Harga</label>

                    @error('range')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @else
                <!-- Form untuk Pengguna -->
                <div class="form-floating mb-3">
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Nama Lengkap" value="{{ old('name') == null ? Auth::user()->name : old('name') }}">
                    <label>Nama Lengkap</label>

                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                        placeholder="Email" value="{{ old('email') == null ? Auth::user()->email : old('email') }}">
                    <label>Email</label>

                    @error('email')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <input type="number" name="phone_number"
                        class="form-control @error('phone_number') is-invalid @enderror" placeholder="Nomor Telepon"
                        value="{{ old('phone_number') == null ? Auth::user()->phone_number : old('phone_number') }}">
                    <label>No. Telepon</label>

                    @error('phone_number')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-floating mb-3">
                    <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                        placeholder="Alamat Tinggal"
                        style="height: 100px">{{ old('address') == null ? Auth::user()->address : old('address') }}</textarea>
                    <label>Alamat Tinggal</label>

                    @error('address')
                        <span class="invalid-feedback">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            @endif

            <div class="mb-3 text-center">
                <button type="submit" class="btn btn-info fw-bold text-white">
                    @if (Auth::user()->is_resto)
                        Update Resto
                    @else
                        Update Profil
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
@endsection