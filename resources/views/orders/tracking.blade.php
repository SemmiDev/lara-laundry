@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Riwayat Pelacakan Pesanan</h1>

        <form action="{{ route('tracking.index') }}" method="GET">
            <div class="mb-3">
                <label for="code" class="form-label">Masukkan Kode Pesanan</label>
                <input type="text"
                       value="{{ old('code') }}"
                       class="form-control" id="code" name="code" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-search"></i>
                Lacak Pesanan</button>
        </form>

        @isset($order)
            @if ($order)
                <div class="card mt-3">
                    <div class="card-header">
                        <h2>Detail Pesanan</h2>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Nomor Pesanan:</dt>
                            <dd class="col-sm-9">{{ $order->code }}</dd>

                            <dt class="col-sm-3">Nama Pelanggan:</dt>
                            <dd class="col-sm-9">{{ $order->customer_name }}</dd>

                            <dt class="col-sm-3">Status:</dt>
                            <dd class="col-sm-9">{{ $order->status }}</dd>

                            <dt class="col-sm-3">Total Harga:</dt>
                            <dd class="col-sm-9">Rp {{ number_format($order->total_price, 2) }}</dd>
                        </dl>
                    </div>
                </div>

                @isset($orderStatuses)
                    <div class="card mt-3">
                        <div class="card-header">
                            <h2>Riwayat Pelacakan</h2>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach ($orderStatuses as $status)
                                <li class="list-group-item">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <strong>Tanggal & Waktu:</strong><br>
                                            {{ \Carbon\Carbon::parse($status->created_at)->format('d M Y H:i:s') }}
                                        </div>
                                        <div class="col-sm-6">
                                            <strong>Status:</strong><br>
                                            {{ $status->status }}
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endisset
            @endif
        @endisset
    </div>
@endsection

