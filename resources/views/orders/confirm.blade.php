@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2><i class="bi bi-check-circle-fill"></i> Konfirmasi Pesanan</h2>
                    </div>
                    <div class="card-body">
                        <!-- Informasi Pelanggan -->
                        <h3>Informasi Pelanggan</h3>
                        <p>Nama Pelanggan: {{ $orderDetails['customer_name'] }}</p>

                        <!-- Rincian Paket -->
                        <h3>Rincian Paket</h3>
                        <ul>
                            @foreach ($orderDetails['packages'] as $package)
                                <li>{{ $package['package_name'] }} (Rp {{ number_format($package['package_price'], 2) }})</li>
                            @endforeach
                        </ul>
                        <p>Total Harga Paket: Rp {{ number_format($orderDetails['total_packages_price'], 2) }}</p>

                        <!-- Rincian Harga -->
                        <h3>Rincian Harga</h3>
                        <ul>
                            @foreach ($orderDetails['price_list'] as $item)
                                <li>{{ $item['price_list_name'] }} ({{ $item['quantity'] }} {{ $item['price_list_unit'] }} x {{number_format($item['price_list_price'],2)}}) - Rp {{ number_format($item['total_price'], 2) }}</li>
                            @endforeach
                        </ul>
                        <p>Total Harga Rincian: Rp {{ number_format($orderDetails['total_price_lists_price'], 2) }}</p>

                        <!-- Total Harga Keseluruhan -->
                        <h3>Total Harga Keseluruhan</h3>
                        <p>Rp {{ number_format($orderDetails['total_price'], 2) }}</p>

                        <!-- Tombol Konfirmasi -->
                        <form method="POST" action="{{ route('orders.confirm', ['laundry' => $laundry]) }}">
                            @csrf
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Konfirmasi Pesanan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
