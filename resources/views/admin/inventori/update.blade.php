<x-app-layout title="Admin Dashboard | Inventori">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Barang') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mb-0">Edit Barang</h4>
                    <hr />
                    @if (Session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.inventori') }}" class="btn btn-warning">Kembali</a></p>
                    <form id="updateForm" action="{{ route('admin/inventori/update', $inventoris->id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Nama_Barang">Nama Barang</label>
                            <input type="text" class="form-control" id="Nama_Barang" name="Nama_Barang"
                                value="{{ old('Nama_Barang', $inventoris->Nama_Barang) }}">
                            @error('Nama_Barang')
                                <span class="text-danger">{{ 'Nama Barang Tidak Boleh Kosong!' }}</span>
                            @enderror
                        </div>


                        <div class="form-group">
                            <label for="Kategori">Kategori Barang</label>
                            <select name="Kategori" class="form-control" placeholder="Kategori Barang">
                                <option value="" disabled selected>Pilih Kategori</option>
                                <option value="Perlengkapan Umum">Perlengkapan Umum</option>
                                <option value="Perlengkapan Lomba">Perlengkapan Lomba</option>
                                <option value="Perlengkapan Lainnya">Perlengkapan Lainnya</option>
                            </select>
                            @error('Kategori')
                                <span class="text-danger">{{ 'Kategori Tidak Boleh Kosong!' }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Jumlah_Barang">Jumlah Barang</label>
                            <input type="number" class="form-control" id="Jumlah_Barang" name="Jumlah_Barang"
                                value="{{ old('Jumlah_Barang', $inventoris->Jumlah_Barang) }}" min="0">
                            @error('Jumlah_Barang')
                                <span class="text-danger">{{ 'Jumlah Barang Tidak Boleh Kosong!' }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="Status">Status</label>
                            <select class="form-control" id="Status" name="Status">
                                <option value="Baik"
                                    {{ old('Status', $inventoris->Status) == 'Baik' ? 'selected' : '' }}>Baik
                                </option>
                                <option value="Rusak"
                                    {{ old('Status', $inventoris->Status) == 'Rusak' ? 'selected' : '' }}>Rusak
                                </option>
                                <option value="Hilang"
                                    {{ old('Status', $inventoris->Status) == 'Hilang' ? 'selected' : '' }}>Hilang
                                </option>
                            </select>
                            @error('Status')
                                <span class="text-danger">{{ 'Status Barang Diperlukan' }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="d-grid">
                                <button type="submit" class="btn btn-success">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
