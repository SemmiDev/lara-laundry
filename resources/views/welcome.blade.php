@extends('layouts.app')

@section('content')
    <div class="container text-center mt-5">
        <h1>Selamat Datang di Lara-Laundry</h1>
        <div class="d-flex gap-2 align-items-center justify-content-center">
            <a href="{{ route('tracking.index') }}" class="btn btn-primary btn-md">
                <i class="bi bi-search"></i>
                Lacak Pesanan</a>
            <a href="{{ route('login') }}" class="btn btn-info btn-md">
                <i class="bi bi-box-arrow-in-right"></i>
                Login</a>
        </div>
    </div>
@endsection
