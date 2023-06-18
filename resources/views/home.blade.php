@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="text-center">
                            <h2 class="mb-4">{{ __('Welcome to Buy Sell Portal') }}</h2>
                            <p class="lead">{{ __('You are logged in!') }}</p>
                        </div>

                        <div class="mt-5 d-flex justify-content-center">
                            <a href="{{ route('auctions.index') }}" class="btn btn-primary btn-lg">{{ __('Go to Auctions') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
