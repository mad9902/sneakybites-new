@extends('layouts.app')

@section('judul')
Histori Order
@endsection

@section('content')
<div class="container rounded shadow p-5 mt-5">
    <h1 class="fw-bold text-info">Histori Review</h1>
    <p class="fw-bold text-secondary">Berikut merupakan history review yang dibuat:</p>
    @if ($reviewHistory->isEmpty())
        <p class="text-center">Belum ada Review yang dibuat</p>
    @else
        <hr>
        <table class="table table-striped">
            <thead>
                <tr class="text-center">
                    <th scope="col">#</th>
                    @if (Auth::user()->is_admin)
                        <th scope="col">Customer</th>
                    @endif
                    <th scope="col">Destination</th>
                    <th scope="col">Rating</th>
                    <th scope="col">Komentar</th>
                    <th scope="col">Gambar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reviewHistory as $order)
                                <tr class="text-center">
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    @if (Auth::user()->is_admin)
                                        <td>{{ $order->user->name }}</td>
                                    @endif
                                    <td>{{ $order->travel->title }}</td>
                                    <td>{{ $order->rating }}</td>
                                    <td>{{ $order->comment }}</td>
                                    <td>
                                        @if($order->image)
                                            <img src="{{ asset('storage/' . $order->image) }}" alt="Review Image"
                                                style="max-width: 100px; max-height: 100px;">
                                        @else
                                            No Image
                                        @endif
                                    </td>
                                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection