@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Auction') }}</div>

                    <div class="card-body">
                        <form action="{{ route('admin.auctions.update', $auction->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" value="{{ $auction->name }}">
                                @error('name')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="condition">Condition</label>
                                <select name="condition" class="form-control" id="condition">
                                    <option value="new" {{ $auction->condition == 'new' ? 'selected' : '' }}>New</option>
                                    <option value="used" {{ $auction->condition == 'used' ? 'selected' : '' }}>Used</option>
                                </select>
                                @error('condition')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="category">Category</label>
                                <select name="category" class="form-control" id="category">
                                    <option value="electronics" {{ $auction->category == 'electronics' ? 'selected' : '' }}>Electronics</option>
                                    <option value="fashion" {{ $auction->category == 'fashion' ? 'selected' : '' }}>Fashion</option>
                                    <option value="home" {{ $auction->category == 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="other" {{ $auction->category == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('category')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="number" name="price" class="form-control" id="price" value="{{ $auction->price }}">
                                @error('price')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label>
                                <input type="datetime-local" name="endDate" class="form-control" id="endDate" value="{{ $auction->endDate }}">
                                @error('endDate')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="photo">Choose File</label>
                                <input type="file" name="photo" class="form-control-file" id="photo">
                                @error('photo')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
