@extends('layouts.app')

@section('judul')
{{ $destination->title }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-7 bg-light rounded p-4">
            <img src="{{ asset('storage/images/' . $destination->image) }}" alt="image" class="rounded">
            <div class="my-3">
                <h2 class="fw-bold">{{ $destination->title }}</h2>
                <p class="mt-3">{{ $destination->description }}</p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="col-md-12 rounded shadow p-3 container-detail">
                <h4 class="fw-bold">Restoran</h4>
                <hr>
                <h4>Alamat</h4>
                <p class="mt-3">{{ $destination->alamat }}</p>
                <h4>Kisaran harga</h4>
                <p class="mt-3">{{ $destination->range }}</p>
                <form action="{{ route('order_ticket', $destination->id) }}" method="POST">
                    <h4>Rating</h4>
                    <div class="mt-3 d-flex flex-direction-column">
                        @php

                        @endphp
                        @if ($destination->total_rating <= 1)
                            <img style="height:-webkit-fill-available" src="{{ asset('images/Bintang 1.png') }}"
                                alt="1 Star">
                        @elseif ($destination->total_rating <= 2)
                            <img style="height:-webkit-fill-available" src="{{ asset('images/Bintang 2.png') }}"
                                alt="2 Stars">
                        @elseif ($destination->total_rating <= 3)
                            <img style="height:-webkit-fill-available" src="{{ asset('images/Bintang 3.png') }}"
                                alt="3 Stars">
                        @elseif ($destination->total_rating <= 4)
                            <img style="height:-webkit-fill-available" src="{{ asset('images/Bintang 4.png') }}"
                                alt="4 Stars">
                        @else
                            <img style="height:-webkit-fill-available" src="{{ asset('images/Bintang 5.png') }}"
                                alt="5 Stars">
                        @endif
                        <p><?php

echo "($destination->total_rating)"
                          ?></p>
                    </div>
                    <div class="button-container">
                        <button class="btn btn-primary w-100">Lihat Menu</button>
                        <button class="btn btn-primary w-100">Lihat Lokasi</button>
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Lihat Review Restoran ini</a>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Tambahkan Review Anda</a>
                            <a href="{{ route('login') }}" class="btn btn-primary w-100">Tambahkan favorit</a>
                        @else
                            @if (Auth::user()->is_admin == 0)
                                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                    data-bs-target="#reviewModal">Tambahkan Review Anda</button>
                                <button type="button" class="btn btn-primary w-100">Lihat Review Restoran ini</button>
                                <button type="button" class="btn btn-primary w-100">Tambahkan favorit</button>
                            @else
                                <a href="#" class="btn btn-primary w-100" style="">Lihat Review Restoran
                                    ini</a>
                                <a href="#" class="btn btn-secondary w-100" style="cursor: not-allowed">Tambahkan Review Anda
                                    ini</a>
                                <a href="#" class="btn btn-secondary w-100" style="cursor: not-allowed">Tambahkan favorit</a>
                            @endif
                        @endguest
                </form>
            </div>

            <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="reviewModalLabel">Tulis Review</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Form untuk review -->
                            <form action="{{ route('create_reviews', $destination->id) }}" method="POST"
                                enctype="multipart/form-data">

                                @csrf
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Rating</label>
                                    <!-- Input untuk rating bintang -->
                                    <input type="number" class="form-control" id="rating" name="rating" min="1" max="5"
                                        required>
                                </div>
                                <div class="mb-3">
                                    <label for="comment" class="form-label">Komentar</label>
                                    <!-- Input untuk komentar -->
                                    <textarea class="form-control" id="comment" name="comment" rows="3"
                                        required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="photo" class="form-label">Unggah Foto</label>
                                    <!-- Input untuk unggah foto -->
                                    <input type="file" class="form-control" id="photo" name="photo">
                                </div>
                                <button type="submit" class="btn btn-primary">Kirim</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@if ($reviewHistory->isEmpty())
    <div class="col-md-7 bg-light rounded p-4">
        <h4><strong>Reviews</strong></h4>
        <strong>Tidak ada Review</strong>
    </div>
@else
    <div class="col-md-7 bg-light rounded p-4">
        <h4><strong>Reviews</strong></h4>
        <hr>
        @foreach ($reviewHistory as $review)
            <div class="col-md-7 bg-light rounded p-4">
                <div class="d-flex flex-direction-column gap-5">
                    <img style="width:10%; object-fit:contain; margin-bottom:30px" src="{{ asset('images/user.png') }}" alt="">
                    <div>
                        <p class="">{{ $review->user->name }}</p>
                        @if ($review->rating <= 1)
                            <img style="width:50px;" src="{{ asset('images/Bintang 1.png') }}" alt="1 Star">
                        @elseif ($review->rating <= 2)
                            <img style="width:50px;" src="{{ asset('images/Bintang 2.png') }}" alt="2 Stars">
                        @elseif ($review->rating <= 3)
                            <img style="width:50px;" src="{{ asset('images/Bintang 3.png') }}" alt="3 Stars">
                        @elseif ($review->rating <= 4)
                            <img style="width:50px;" src="{{ asset('images/Bintang 4.png') }}" alt="4 Stars">
                        @else
                            <img style="width:50px;" src="{{ asset('images/Bintang 5.png') }}" alt="5 Stars">
                        @endif
                    </div>
                </div>
                <div class="d-flex flex-direction-row gap-5">
                    <p>{{ $review->comment }}</p>
                </div>
                <td>
                    @if($review->image)
                        <img src="{{ asset('storage/' . $review->image) }}" alt="Review Image"
                            style="max-width: 100px; max-height: 100px;">
                    @else
                        No Image
                    @endif
                </td>
            </div>
            <hr>
        @endforeach
        <div class="pagination2 justify-content-center">
            @if ($reviewHistory->previousPageUrl())
                <a href="{{ $reviewHistory->previousPageUrl() }}" class="btn btn-primary">&laquo; Previous</a>
            @endif
            @if ($reviewHistory->nextPageUrl())
                <a href="{{ $reviewHistory->nextPageUrl() }}" class="btn btn-primary">Next &raquo;</a>
            @endif
        </div>
    </div>
@endif
    </div>
</div>
</div>
@endsection

<style>

    .container-detail {
        margin-left: 30px;
        margin-top: 80px;
    }

    .rounded {
        max-width: 400px;
    }

    .star-icon {
        width: 10px;
        height: 20px !important;
    }

    .rating-container {
        display: flex;
        align-items: center;
    }

    .star-icon {
        width: 20px;
        height: auto;
        margin-right: 5px;
    }

    .button-container {
        display: flex;
        flex-direction: column;
    }

    .button {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
        margin-top: 10px;
        transition: background-color 0.3s;
    }

    .btn-primary,
    .btn-secondary {
        margin-top: 10px;
    }
</style>