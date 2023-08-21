@extends('layouts.app')

@section('content')
    <div class="container">

        <h2>Daftar Pesanan</h2>
        <div class="row">
            @foreach ($orders as $order)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $order->description }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $orders->links() }}

        <h2>Daftar Harga</h2>
        <div class="d-flex flex-column gap-2 mb-4">
            @foreach ($price_lists as $price_list)
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $price_list->name }} - Rp {{ number_format($price_list->price, 2) }}</span>
                    <div class="d-flex gap-1">
                        <form action="{{ route('price_lists.destroy', [$laundry, $price_list]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>

                        <a href="{{ route('price_lists.edit', ['laundry' => $laundry,'price_list' => $price_list]) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>

                    </div>
                </div>
            @endforeach
            <a href="{{ route('price_lists.create', $laundry) }}" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah Harga
            </a>
        </div>
    </div>
@endsection
