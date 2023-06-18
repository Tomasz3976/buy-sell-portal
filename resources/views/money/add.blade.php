@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Add Money') }}</div>

                    <div class="card-body d-flex justify-content-center">

                        <form action="{{ route('money.add') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="amount">Amount</label>
                                <input type="number" step="0.01" min="0" name="amount" id="amount" class="form-control">
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Add Money</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <a href="{{ route('home') }}" class="btn btn-primary">{{ __('Go to Home') }}</a>
                    </div>
                </div>
            </div>
        </div>
        @if (session('success'))
            <div class="row justify-content-center mt-4">
                 <div class="col-md-8">
                    <div class="alert alert-success text-center" role="alert">
                    {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
