@php use App\Models\OrderStatus; @endphp
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Pesanan</h1>

        <div class="table-responsive">

            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Pelanggan</th>
                    <th>Status</th>
                    <th>Total Harga</th>
                    <th>Tanggal Dibuat</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{
                        $loop->iteration + $orders->perPage() * ($orders->currentPage() - 1)
}}</td>
                        <td>{{ $order->customer_name }}</td>
                        <td>
                            <form action="{{ route('orders.update', ['laundry' => $laundry, 'order' => $order]) }}"
                                  method="POST">
                                @csrf
                                @method('PATCH')
                                <div class="input-group">
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option
                                            value="{{ OrderStatus::OrderStatusPending }}" {{ $order->status == OrderStatus::OrderStatusPending ? 'selected' : '' }}>{{ OrderStatus::OrderStatusPending }}</option>
                                        <option
                                            value="{{ OrderStatus::OrderStatusProcessed }}" {{ $order->status == OrderStatus::OrderStatusProcessed ? 'selected' : '' }}>{{ OrderStatus::OrderStatusProcessed }}</option>
                                        <option
                                            value="{{ OrderStatus::OrderStatusDone }}" {{ $order->status == OrderStatus::OrderStatusDone ? 'selected' : '' }}>{{ OrderStatus::OrderStatusDone }}</option>
                                        <option
                                            value="{{ OrderStatus::OrderStatusCanceled }}" {{ $order->status == OrderStatus::OrderStatusCanceled ? 'selected' : '' }}>{{ OrderStatus::OrderStatusCanceled }}</option>
                                        <option
                                            value="{{ OrderStatus::OrderStatusTaken }}" {{ $order->status == OrderStatus::OrderStatusTaken ? 'selected' : '' }}>{{ OrderStatus::OrderStatusTaken }}</option>
                                    </select>
                                </div>
                            </form>
                        </td>
                        <td>Rp {{ number_format($order->total_price, 2) }}</td>
                        <td>{{\Carbon\Carbon::parse($order->created_at)->format('d M Y H:i:s')}}</td>
                        <td class="d-flex gap-2 flex-wrap">
                            <a href="{{ route('tracking.index', ['code' => $order->code]) }}"
                               class="btn btn-primary">
                                <i class="bi bi-search"></i>
                                Lacak</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

