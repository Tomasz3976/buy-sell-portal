@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="mb-4">{{ __('All Auctions') }}</h2>
                        </div>
                        @if (session('success'))
                            <div class="alert alert-success mb-4">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mb-4">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (count($auctions) > 0)
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
                                                <div class="d-flex justify-content-between">
                                                    <a href="{{ route('admin.auctions.edit', $auction->id) }}" class="btn btn-primary">{{ __('Edit') }}</a>
                                                    <form action="{{ route('admin.auctions.delete', $auction->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" data-confirm="Are you sure you want to delete this auction on Buy Sell Portal?">{{ __('Delete') }}</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p>{{ __('No auctions found.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
