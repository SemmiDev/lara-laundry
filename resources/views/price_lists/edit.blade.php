@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Harga - {{ $laundry->name }}</h1>

        <form method="POST" action="{{ route('price_lists.update', [$laundry, $price_list]) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                       name="name" value="{{ old('name', $price_list->name) }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                       name="price" value="{{ old('price', $price_list->price) }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Satuan</label>
                <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" required>
                    <option value="">Pilih Satuan</option>
                    <option value="kg" {{ old('unit', $price_list->unit) == 'kg' ? 'selected' : '' }}>Kilogram</option>
                    <option value="pcs" {{ old('unit', $price_list->unit) == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="meter" {{ old('unit', $price_list->unit) == 'meter' ? 'selected' : '' }}>Meter</option>
                    <option value="set" {{ old('unit', $price_list->unit) == 'set' ? 'selected' : '' }}>Set</option>
                    <option value="lembar" {{ old('unit', $price_list->unit) == 'lembar' ? 'selected' : '' }}>Lembar</option>
                </select>
                @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
