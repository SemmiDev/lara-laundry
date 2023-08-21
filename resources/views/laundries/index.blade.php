@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="position-fixed bottom-0 end-0 px-3 pb-5">
            <a class="btn btn-primary rounded-2" href="{{ route('laundries.create') }}"><i class="bi bi-plus"></i>
                Tambah Laundry</a>
        </div>

        <div class="btn-group" role="group" aria-label="Filter">
            <a href="{{ route('laundries.index') }}" class="btn btn-primary">
                <i class="bi bi-house"></i>
                Semua</a>
            <a id="filterAllLink" href="{{ route('laundries.index') }}" class="btn btn-secondary">
                <i class="bi bi-geo-alt"></i>
                Terdekat</a>
        </div>

        <div class="row mt-5">
            @foreach($laundries as $laundry)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body text-break">
                            <h4 class="card-title"> {{ $laundry->name }}</h4>
                            <i class="bi bi-house"></i>
                            {{ $laundry->address }}
                        </div>

                        <div class="card-footer">
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('orders.create', $laundry) }}"
                                   class="btn btn-outline-dark flex-shrink-0">
                                    <i class="bi bi-bag-plus"></i> Buat Pesanan
                                </a>

                                <a href="{{ route('orders.index', $laundry) }}" class="btn btn-primary">
                                    <i class="bi bi-bag"></i> Daftar Pesanan
                                </a>

                                <a href="{{route('price_lists.index', $laundry)}}" class="btn btn-warning">
                                    <i class="bi bi-currency-dollar"></i> Daftar Harga
                                </a>

                                <a href="{{ route('packages.index', $laundry) }}" class="btn btn-secondary">
                                    <i class="bi bi-eye"></i> Daftar Paket
                                </a>

                                <a href="{{ route('statistics.index', $laundry) }}" class="btn btn-dark">
                                    <i class="bi bi-graph-up"></i> Statistik
                                </a>

                                <a href="https://maps.google.com/?q={{ $laundry->latitude }},{{ $laundry->longitude }}"
                                   target="_blank" class="btn btn-success">
                                    <i class="bi bi-geo-alt"></i> Lokasi
                                </a>

                                <a href="https://api.whatsapp.com/send?phone={{ $laundry->phone_number }}"
                                   target="_blank" class="btn btn-success">
                                    <i class="bi bi-whatsapp"></i> Whatsapp
                                </a>

                                <a href="{{ route('laundries.edit', $laundry) }}" class="btn btn-info">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('laundries.destroy', $laundry) }}" method="POST"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            data-confirm-delete="true"
                                            class="btn btn-danger confirm-button">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function (position) {
                const userLatitude = position.coords.latitude;
                const userLongitude = position.coords.longitude;

                const filterAllLink = document.querySelector("#filterAllLink");
                filterAllLink.href = `/laundries?user_latitude=${userLatitude}&user_longitude=${userLongitude}`;
            });
        }

        $('.confirm-button').click(function (event) {
            const form = $(this).closest("form");
            event.preventDefault();

            swal({
                title: `Apakah anda yakin ingin menghapus laundry ini?`,
                text: "Data yang dihapus tidak dapat dikembalikan!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Hapus",
                cancelButtonText: "Batal"
            })
                .then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
        });
    </script>
@endsection
