@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Tambah Harga - {{ $laundry->name }}</h1>

        <form method="POST" action="{{ route('price_lists.store', $laundry) }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input
                    autofocus
                    placeholder="Contoh: Selimut"
                    type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                       name="name" value="{{ old('name') }}" required>
                @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input
                    placeholder="Contoh: 10000"
                    type="text" class="form-control @error('price') is-invalid @enderror" id="price"
                       name="price" value="{{ old('price') }}" required>
                @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Satuan</label>
                <select name="unit" id="unit" class="form-control @error('unit') is-invalid @enderror" required>
                    <option value="">Pilih Satuan</option>
                    <option value="kg" {{ old('unit') == 'kg' ? 'selected' : '' }}>Kilogram</option>
                    <option value="pcs" {{ old('unit') == 'pcs' ? 'selected' : '' }}>Pcs</option>
                    <option value="meter" {{ old('unit') == 'meter' ? 'selected' : '' }}>Meter</option>
                    <option value="set" {{ old('unit') == 'set' ? 'selected' : '' }}>Set</option>
                    <option value="lembar" {{ old('unit') == 'lembar' ? 'selected' : '' }}>Lembar</option>
                </select>
                @error('unit')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
