@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Paket - {{ $laundry->name }}</h1>

        <form method="POST" action="{{ route('packages.update', [$laundry, $package]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                       name="name" value="{{ old('name', $package->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                       name="price" value="{{ old('price', $package->price) }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
