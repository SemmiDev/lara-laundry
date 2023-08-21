@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Harga</h2>
        <div class="d-flex flex-column gap-2 mb-4">
            @foreach ($price_lists as $price_list)
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $price_list->name }} - Rp {{ number_format($price_list->price, 2) }} / {{$price_list->unit}}</span>
                    <div class="d-flex gap-1">
                        <form action="{{ route('price_lists.destroy', [$laundry, $price_list]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                data-confirm-delete="true"
                                type="submit" class="btn btn-danger btn-sm confirm-button">
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


@section('scripts')
    <script>
        $('.confirm-button').click(function(event) {
            const form =  $(this).closest("form");
            event.preventDefault();

            swal({
                title: `Apakah anda yakin ingin menghapus data harga ini?`,
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

