<x-app-layout title="RT Dashboard | Pengajuan Dokumen ">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pengajuan Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="me-auto p-2">Daftar Pengajuan Surat</h3>

                        <div class="p-2">
                            <form action="{{ route('rt/surat/index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Data..."
                                        value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari Surat</button>
                                </div>
                            </form>
                        </div>

                        {{-- @if ($role === 'admin')
                            <div class="p-2">
                                <a href="{{ route('admin/surat/create') }}" class="btn btn-primary">Tambah Pengajuan</a>
                            </div>
                        @endif --}}
                    </div>
                    <hr />
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Jenis Surat</th>
                                <th>No. Surat</th>
                                <th>Tanggal Surat</th>
                                <th>Perihal</th>
                                <th>File</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($mails as $surat)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $surat->Jenis_Surat }}</td>
                                    <td class="align-middle">{{ $surat->No_Surat }}</td>
                                    <td class="align-middle">{{ $surat->Tanggal_Surat }}</td>
                                    <td class="align-middle">{{ $surat->Perihal }}</td>
                                    <td class="align-middle">{{ $surat->File }}</td>
                                    <td class="align-middle">
                                        <div class="status-action-container">
                                            <div
                                                class="status-label {{ $surat->Status == 'Diterima' ? 'status-diterima' : ($surat->Status == 'Ditolak' ? 'status-ditolak' : 'status-belum-dibaca') }}">
                                                {{ $surat->Status }}
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <div class="action-buttons">
                                            <a href="{{ route('rt/surat/detail', $surat->id) }}"
                                                class="btn btn-primary"><i class="bi bi-info-circle"></i></a>
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

</x-app-layout>
