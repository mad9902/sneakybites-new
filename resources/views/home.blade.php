@extends('layouts.app')

@section('judul')
    Beranda
@endsection

@section('content')
    <div class="container mt-4">
        <div id="carouselExampleCaptions" class="carousel slide mb-5">
            <div class="carousel-indicators">
                @for ($i = 0; $i < count($destinations); $i++)
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $i }}"
                        @if ($i == 0) class="active" @endif aria-current="true"
                        aria-label="Slide {{ $i + 1 }}"></button>
                @endfor
            </div>
            <div class="carousel-inner rounded shadow-sm">
                @foreach ($destinations as $destination)
                    <div class="carousel-item @if ($loop->iteration == 1) active @endif"
                        style="background: url({{ asset('storage/images/' . $destination->image) }})">
                        <div class="carousel-caption d-none d-md-block rounded">
                            <h5 class="fw-bold">{{ $destination->title }}</h5>
                            <p>{{ substr($destination->description, 0, 100) . '...' }}</p>
                        </div>
                    </div>
                @endforeach
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>

        <div class="search mb-4">
            <div class="row align-items-center justify-content-between">
                <div class="col-md-3">
                    <h2 class="fw-bold text-info">Restoran Hidden Gems</h2>
                </div>

                <div class="col-md-3">
                    <form action="{{ route('search') }}" method="GET">
                        <input type="text" class="form-control" name="search" placeholder="Cari Restoran Disini...">
                        <button class="d-none" type="submit"></button>
                    </form>
                </div>

                <div class="col-md-3">
    <form action="{{ route('search') }}" method="GET" onsubmit="updateSearchInputOnSubmit()">
        <div class="input-group">
            <input type="text" class="form-control" name="search" id="searchInput" placeholder="Cari lokasi..." readonly>

            <select name="filter" class="form-select" id="filterSelect" onchange="updateSearchInput()">
                <option value="Jakarta">Jakarta</option>
                <option value="Bogor">Bogor</option>
                <option value="Depok">Depok</option>
                <option value="Tangerang">Tangerang</option>
                <option value="Bekasi">Bekasi</option>
            </select>
            <button class="btn btn-primary" type="submit">Cari</button>
        </div>
    </form>
</div>

<script>
function updateSearchInput() {
    const filterSelect = document.getElementById('filterSelect');
    const searchInput = document.getElementById('searchInput');

    const filterValue = filterSelect.value;

    if (!filterValue && searchInput.value.trim() === '') {
        searchInput.value = "Jakarta";
    }
}

function updateSearchInputOnSubmit() {
    const filterSelect = document.getElementById('filterSelect');
    const searchInput = document.getElementById('searchInput');

    const filterValue = filterSelect.value;

    if (!filterValue) {
        searchInput.value = "Jakarta";
    } else {
        searchInput.value = filterValue; 
    }
}
</script>
            </div>
        </div>

        <div class="row">
            @foreach ($destinations as $destination)
                <div class="col-md-3 mb-3">
                    <div class="col-md-12 shadow-sm">
                        <div class="destination-image"
                            style="background: url({{ asset('storage/images/' . $destination->image) }})"></div>
                        <div class="card-body p-3">
                            <h5 class="card-title fw-bold">{{ $destination->title }}</h5>
                            <p class="card-title fw-bold text-secondary">{{ $destination->range }}</p>
                            <p class="card-text">{{ substr($destination->description, 0, 70) . '...' }}</p>
                           <a href="{{ url('/resto-list/' . $destination->id) }}" class="btn btn-info fw-bold text-white w-100 mt-3">Lihat Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
