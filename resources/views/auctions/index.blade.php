@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start mb-3">
            <div class="col-md-8">
                <a href="{{ route('home') }}" class="btn btn-primary btn-lg">Go to Home</a>
            </div>
        </div>
        <div class="row">
            @foreach ($auctions as $auction)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ asset('storage/' . $auction->photo) }}" class="card-img-top" alt="Auction Photo">
                        <div class="card-body">
                            <h5 class="card-title">{{ $auction->name }}</h5>
                            <p class="card-text">Condition: {{ $auction->condition }}</p>
                            <p class="card-text">Category: {{ $auction->category }}</p>
                            <p class="card-text">Price: {{ $auction->price }}</p>
                            <p class="card-text">End Date: {{ $auction->endDate }}</p>
                            <p class="card-text">Sold: {{ $auction->isSold ? 'true' : 'false' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
