@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('User Panel') }}</div>

                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="mb-4">{{ __('Welcome to User Panel') }}</h2>
                        </div>

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="d-flex flex-column align-items-center">
                            <a href="{{ route('user.auctions.listed') }}" class="btn btn-primary btn-lg mb-3">{{ __('My Auctions') }}</a>
                            <a href="{{ route('user.auctions.bought') }}" class="btn btn-primary btn-lg mb-3">{{ __('Bought Items') }}</a>
                            <a href="{{ route('user.showAddMoneyForm') }}" class="btn btn-primary btn-lg">{{ __('Add Money') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
