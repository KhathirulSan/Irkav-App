<x-app-layout title="User Dashboard | Inventori">
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
                    <div class="d-flex align-items-center justify-conten-between">
                        <h3 class="mb-0 p-2">Daftar Barang</h3>
                        <a href=" {{ route('user/inventori/cetak-inventori') }}" class="btn btn-success ml-auto m-2"
                            target="_blank">Cetak Data <i class="bi bi-printer"></i>
                        </a>

                    </div>
                    <hr />
                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif

                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Jumlah Barang</th>
                                <th>Status Barang</th>
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
</x-app-layout>
