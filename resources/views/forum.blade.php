@extends('layouts.app')

@section('judul')
{{ $destination->title }}
@endsection

    <!-- Form untuk membuat posting baru -->
    <div class="card mb-4">
        <div class="card-header">Create Post</div>
        <div class="card-body">
            <form action="{{ route('forum.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body" rows="5" required>{{ old('body') }}</textarea>
                    @error('body')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Daftar posting -->
    @foreach ($posts as $post)
        <div class="card mb-4">
            <div class="card-header">{{ $post->user->name }} posted:</div>
            <div class="card-body">
                <h5 class="card-title">{{ $post->title }}</h5>
                <p class="card-text">{{ $post->body }}</p>
            </div>
            <div class="card-footer text-muted">
                Posted on {{ $post->created_at->format('d M Y, H:i') }}
            </div>
        </div>
    @endforeach
</div>
@endsection
