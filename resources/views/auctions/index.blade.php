@extends('layouts.app')

@section('content')
    <div class="container">
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection