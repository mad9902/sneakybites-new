@extends('layouts.app')

@section('judul')
Ubah Restoran
@endsection

@section('content')
<div class="container mt-3">
    <h2 class="fw-bold text-info">Ubah Restoran</h2>
    <p class="fw-bold text-secondary">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi consequuntur
        amet necessitatibus! Quam veniam
    </p>
    <div class="row">
        <div class="col-md-7">
            <form action="{{ route('update_resto_list', $destination->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')
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
                        <div class="col-md-4 mt-5">
                            <img src="{{ asset('storage/images/' . $destination->menu) }}" alt="current menu"
                                class="img-fluid rounded">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label">Ganti Menu</label>
                            <input type="file" name="menu" class="form-control">
                            @error('menu')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Restoran</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title') == null ? $destination->title : old('title') }}"
                        placeholder="Nama Restoran">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">maps</label>
                    <input type="text" name="maps" class="form-control @error('maps') is-invalid @enderror"
                        value="{{ old('maps') == null ? $destination->maps : old('maps') }}"
                        placeholder="Nama Restoran">
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
                                    value="{{ old('range') == null ? $destination->range : old('range') }}"
                                    placeholder="Range Harga">
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
                    <textarea name="description" rows="5"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Deskripsi">{{ old('description') == null ? $destination->description : old('description') }}</textarea>
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