@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Daftar Jenis Paket</h2>
        <div class="d-flex flex-column gap-2 mb-4">
            @foreach ($packages as $package)
                <div class="d-flex justify-content-between align-items-center">
                    <span>{{ $package->name }} - Rp {{ number_format($package->price, 2) }}</span>
                    <div class="d-flex gap-1">
                        <form action="{{ route('packages.destroy', [$laundry, $package]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button
                                data-confirm-delete="true"
                                type="submit" class="btn btn-danger btn-sm confirm-button">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <a href="{{ route('packages.edit', ['laundry' => $laundry,'package' => $package]) }}"
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                    </div>
                </div>
            @endforeach
            <a href="{{ route('packages.create', $laundry) }}" class="btn btn-primary">
                <i class="bi bi-plus"></i> Tambah Paket
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
                title: `Apakah anda yakin ingin menghapus data paket ini?`,
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

