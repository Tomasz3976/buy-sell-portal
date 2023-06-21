@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buy Auction') }}</div>

                    <div class="card-body">
                        <h5>{{ $auction->name }}</h5>
                        <p>Condition: {{ $auction->condition }}</p>
                        <p>Category: {{ $auction->category }}</p>
                        <p>Price: {{ $auction->price }}</p>
                        <p>End Date: {{ $auction->endDate }}</p>

                        @if ($auction->photo)
                            <img src="{{ asset('storage/' . $auction->photo) }}" class="img-fluid" alt="Auction Photo">
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('auctions.confirmBuy', $auction->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary">{{ __('Confirm Purchase') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection