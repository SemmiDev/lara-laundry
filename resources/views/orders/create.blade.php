@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-plus-circle"></i> Tambah Pesanan
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('orders.store', [$laundry]) }}">
                            @csrf
                            <div class="mb-3">
                                <label for="customer_name" class="form-label">
                                    <i class="bi bi-person"></i> Nama Pelanggan</label>
                                <input type="text"
                                       autofocus
                                       placeholder="Masukkan nama pelanggan"
                                       class="form-control @error('customer_name') is-invalid @enderror"
                                       id="customer_name"
                                       name="customer_name" value="{{ old('customer_name') }}" required>
                                @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="packages" class="form-label">
                                    <i class="bi bi-x-diamond"></i> Pilih paket
                                </label>
                                @forelse($package_list as $package)
                                    <div>
                                        <input
                                            id="package_{{ $package->id }}"
                                            class="form-check-input border-success"
                                            type="checkbox"
                                            name="packages[]"
                                            value="{{ $package->id }}"
                                        />
                                        <label
                                            for="package_{{ $package->id }}"
                                        >
                                            {{ $package->name }} (Rp {{ number_format($package->price, 2) }})
                                        </label>
                                    </div>
                                @empty
                                    <div class="alert alert-warning">Belum ada paket yang tersedia.</div>
                                @endforelse
                            </div>

                            <div class="mb-3">
                                <label for="price_list" class="form-label">
                                    <i class="bi bi-list-ul"></i> Detail Cucian
                                </label>
                                @forelse($price_list as $price)
                                    <div>
                                        <label
                                            for="price_{{ $price->id }}"
                                        >
                                            {{ $price->name }} (Rp {{ number_format($price->price, 2) }} / {{ $price->unit }})
                                        </label>

                                        <input
                                            type="number"
                                            name="price_lists[{{ $price->id }}][quantity]"
                                            id="quantity_{{ $price->id }}"
                                            class="form-control"
                                            placeholder="Masukkan jumlah {{ $price->name }} (jika ada)"
                                        >
                                    </div>
                                @empty
                                    <div class="alert alert-warning">Belum ada detail cucian yang tersedia.</div>
                                @endforelse
                            </div>

                            <a href="{{ route('orders.index', [$laundry]) }}" class="btn btn-warning"><i
                                    class="bi bi-x-lg"></i>
                                Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
