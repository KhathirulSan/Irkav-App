<x-app-layout title="Admin Dashboard | Kelola Keuangan - Pemasukan">
    {{-- Style CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Keuangan - Pemasukan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="me-auto p-2">Daftar Pemasukan</h3>
                    </div>
                    {{-- Form untuk filter berdasarkan bulan, tahun, dan nama anggota --}}
                    {{-- <form action="#" method="GET">
                        <div class="row mb-3">
                            <div class="col">
                                <select class="form-control" name="tahun">
                                    <option value="">Pilih Tahun</option>
                                    @foreach (range(date('Y'), date('Y') + 10) as $tahun)
                                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <select class="form-control" name="nama_anggota">
                                    <option value="">Pilih Nama Anggota</option>
                                    @foreach ($namaAnggota as $member)
                                        <option value="{{ $member->id }}">{{ $member->Nama_Anggota }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form> --}}

                    {{-- Form untuk pencarian berdasarkan nama anggota --}}
                    <form action="{{ route('admin.keuangan.pemasukan.index') }}" method="GET">
                        <div class="row mb-2">
                            <div class="col">
                                <select class="form-control userbox" name="search">
                                    <option value="" disabled selected>Pilih Nama Anggota</option>
                                    @foreach ($namaAnggota as $member)
                                        <option value="{{ $member->Nama_Anggota }}"
                                            {{ request('search') == $member->Nama_Anggota ? 'selected' : '' }}>
                                            {{ $member->Nama_Anggota }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Cari</button>
                            </div>
                        </div>
                    </form>

                    <!-- Tabel Pemasukan -->
                    <table class="table table-hover">
                        <thead class="table-primary text-white">
                            <tr>
                                <th colspan="15" class="text-center table-success">Penarikan Uang Kas Bulanan Tahun
                                    {{ date('Y') }}</th>
                            </tr>
                            <tr>
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                @foreach ($dataBulan as $bulan)
                                    <th>{{ $bulan }}</th>
                                @endforeach
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($namaAnggota as $index => $anggota)
                                <tr>

                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $anggota->Nama_Anggota }}</td>
                                    @foreach ($dataBulan as $bulan)
                                        <td>{!! $anggota->{$bulan . '_status'} == 'Lunas' ? '<i class="fa-solid fa-check"></i>' : '' !!}
                                        </td>
                                    @endforeach
                                    <td>
                                        <a href="#" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal{{ $anggota->id }}">Edit</a>

                                        <!-- Modal Edit -->
                                        <div class="modal fade" id="editModal{{ $anggota->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Pemasukan</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('admin.keuangan.pemasukan.store') }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="Nama_Anggota" class="form-label">Nama
                                                                    Anggota</label>
                                                                <input type="text" class="form-control"
                                                                    id="Nama_Anggota" name="Nama_Anggota"
                                                                    value="{{ $anggota->Nama_Anggota }}" readonly>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggal" class="form-label">Tanggal</label>
                                                                <input type="date" class="form-control"
                                                                    id="tanggal" name="tanggal"
                                                                    value="{{ $anggota->tanggal }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="jumlah" class="form-label">Jumlah
                                                                    Bayar</label>
                                                                <div class="input-group">
                                                                    <span>Rp</span>
                                                                    <input type="number" class="form-control"
                                                                        id="jumlah" name="jumlah"
                                                                        value="{{ $anggota->Status_Pekerjaan == 'Bekerja' ? 10000 : 5000 }}"
                                                                        readonly>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label for="status_pembayaran"
                                                                        class="form-label">Status
                                                                        Pembayaran</label>
                                                                    <select class="form-control" id="status_pembayaran"
                                                                        name="status_pembayaran">
                                                                        <option value="Belum Lunas"
                                                                            {{ $anggota->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>
                                                                            Belum Lunas</option>
                                                                        <option value="Lunas"
                                                                            {{ $anggota->status_pembayaran == 'Lunas' ? 'selected' : '' }}>
                                                                            Lunas</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">Batal</button>
                                                                <button type="submit" class="btn btn-primary">Simpan
                                                                    Perubahan</button>
                                                            </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>



                </div>
            </div>
        </div>
    </div>
    {{-- Script --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.userbox').select2({
                allowClear: true
            });
        });
    </script>
</x-app-layout>
