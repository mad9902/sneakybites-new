@extends('layouts.app')

@section('judul')
    Tambah Restoran
@endsection

@section('content')
    <div class="container mt-3">
        <h2 class="fw-bold text-info">Tambah Restoran</h2>
        <p class="fw-bold text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi consequuntur amet necessitatibus! Quam veniam
        </p>
        <div class="row">
            <div class="col-md-7">
                <form action="{{ route('create_resto_list') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Gambar Restoran</label>
                        <input type="file" name="image" class="form-control">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Menu Restoran</label>
                        <input type="file" name="menu" class="form-control">
                        @error('menu')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Restoran</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                            value="{{ old('title') }}" placeholder="Nama Restoran">
                        @error('title')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Menu</label>
                        <input type="text" name="maps" class="form-control @error('maps') is-invalid @enderror"
                            value="{{ old('maps') }}" placeholder="Nama Restoran">
                        @error('maps')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="row">
                            <div class="col">
                                <label class="form-label">Range Harga</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text">Rp</span>
                                    <input type="text" name="range"
                                        class="form-control @error('range') is-invalid @enderror"
                                        value="{{ old('range') }}" placeholder="Range Harga">
                                </div>
                                @error('range')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" rows="5" class="form-control @error('description') is-invalid @enderror"
                            placeholder="Deskripsi">{{ old('description') }}</textarea>
                        @error('description')
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
