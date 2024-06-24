<x-app-layout title="Admin Dashboard | Inventori">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mb-0">Tambah Barang</h4>
                    <hr />
                    @if (Session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.inventori') }}" class="btn btn-primary">Kembali</a></p>
                    <form action="{{ route('admin/inventori/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="Nama_Barang" class="form-control" placeholder="Nama Barang">
                            </div>
                            @error('Nama_Barang')
                                <span class="text-danger">{{ 'Nama Barang Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Kategori" class="form-control" placeholder="Kategori Barang">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Perlengkapan Umum">Perlengkapan Umum</option>
                                    <option value="Perlengkapan Lomba">Perlengkapan Lomba</option>
                                    <option value="Perlengkapan Lainnya">Perlengkapan Lainnya</option>
                                </select>
                            </div>\
                            @error('Kategori')
                                <span class="text-danger">{{ 'Kategori Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="number" name="Jumlah_Barang" class="form-control"
                                    placeholder="Jumlah Barang" min="0">
                            </div>
                            @error('Jumlah_Barang')
                                <span class="text-danger">{{ 'Jumlah Barang Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Status" class="form-control">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                    <option value="Hilang">Hilang</option>
                                </select>
                            </div>
                            @error('Status')
                                <span class="text-danger">{{ 'Status Barang Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="d-grid">
                                <button class="btn btn-success">Submit</button>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
