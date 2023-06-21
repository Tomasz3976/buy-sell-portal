@extends('layouts.app')

@section('content')
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 mb-3">
                <a href="{{ route('auctions.create') }}" class="btn btn-primary">{{ __('Create Auction') }}</a>
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
                            <a href="{{ route('auctions.buy', ['id' => $auction->id]) }}" class="btn btn-primary">{{ __('Buy') }}</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
