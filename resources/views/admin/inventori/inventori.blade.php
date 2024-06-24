<x-app-layout title="Admin Dashboard | Inventori">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inventori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __('Berikut Merupakan Halaman Inventori SIIRKAV') }} --}}
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="me-auto p-2">Daftar Barang</h3>

                        <div class="p-2">
                            <form action="{{ route('admin/inventori/index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari Barang..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                        <a href=" {{ route('admin/inventori/create') }}" class="btn btn-primary p-2">Tambah
                            Barang</a>

                        <a href=" {{ route('admin/inventori/cetak-inventori') }}" class="btn btn-success p-2 ml-3 "
                            target="_blank">Cetak Data <i class="bi bi-printer"></i>
                        </a>

                    </div>
                    <hr />
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah Barang</th>
                                <th>Status Barang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($inventoris as $inventori)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $inventori->Nama_Barang }}</td>
                                    <td class="align-middle">{{ $inventori->Kategori }}</td>
                                    <td class="align-middle">{{ $inventori->Jumlah_Barang }}</td>
                                    <td class="align-middle">{{ $inventori->Status }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- Edit Btn --}}
                                            <a href="{{ route('admin/inventori/edit', ['id' => $inventori->id]) }}"
                                                type="button" class="btn btn-secondary"><i
                                                    class="bi bi-pencil"></i></a>
                                            {{-- Delete Btn --}}
                                            <button type="button" class="btn btn-danger delete-button"
                                                data-id="{{ $inventori->id }}"><i class="bi bi-trash3"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Barang Tidak Ditemukan!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.querySelectorAll('.delete-button').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                var itemId = this.getAttribute('data-id');
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Anda tidak akan dapat mengembalikan ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#aaa',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `/admin/inventori/delete/${itemId}`;
                    }
                });
            });
        });
    </script>
</x-app-layout>
