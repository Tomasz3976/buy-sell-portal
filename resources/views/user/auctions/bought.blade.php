@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Bought Items') }}</div>

                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="mb-4">{{ __('Your Bought Items') }}</h2>
                        </div>

                        @if ($auctions && count($auctions) > 0)
                            <div class="row">
                                @foreach ($auctions as $auction)
                                    <div class="col-md-6">
                                        <div class="card mb-4">
                                            @if ($auction->photo)
                                                <img src="{{ asset('storage/' . $auction->photo) }}" class="card-img-top" alt="Auction Photo">
                                            @endif
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
                        @else
                            <p>{{ __('You have not bought any items.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
