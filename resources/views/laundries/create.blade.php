@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <i class="bi bi-house-add">
                        </i> Tambah Laundry Baru
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('laundries.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label"><i class="bi bi-x-diamond">
                                    </i> Nama
                                    Laundry</label>
                                <input type="text"
                                       autofocus
                                       placeholder="Masukkan nama laundry"
                                       class="form-control @error('name') is-invalid @enderror" id="name"
                                       name="name" value="{{ old('name') }}" required>
                                @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label"><i class="bi bi-house"></i> Alamat</label>
                                <input type="text"
                                       placeholder="Masukkan alamat laundry"
                                       class="form-control @error('address') is-invalid @enderror"
                                       id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label"><i class="bi bi-telephone"></i> Nomor
                                    Telepon</label>
                                <input type="text"
                                       placeholder="Masukkan nomor telepon"
                                       class="form-control @error('phone_number') is-invalid @enderror"
                                       id="phone_number" name="phone_number" value="{{ old('phone_number') }}" required>
                                @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <input type="hidden" id="latitude" name="latitude" value="{{ old('latitude') }}">
                            <input type="hidden" id="longitude" name="longitude" value="{{ old('longitude') }}">

                            <a href="{{ route('laundries.index') }}" class="btn btn-warning"><i class="bi bi-x-lg"></i>
                                Batal</a>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            swal("Informasi", "Lokasi anda saat ini akan digunakan sebagai lokasi laundry secara otomatis", "info");

            const latitudeInput = document.getElementById("latitude");
            const longitudeInput = document.getElementById("longitude");

            if ("geolocation" in navigator) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    latitudeInput.value = position.coords.latitude;
                    longitudeInput.value = position.coords.longitude;
                });
            } else {
                alert("Geolocation tidak didukung di perangkat Anda.");
            }
        });
    </script>
@endsection
