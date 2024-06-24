<x-app-layout title="Admin Dashboard | Kelola Dokumen ">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __('Berikut Merupakan Halaman Inventori SIIRKAV') }} --}}
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="me-auto p-2">Daftar Pengajuan Surat</h3>

                        <div class="p-2">
                            <form action="{{ route('admin/surat/index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Data..."
                                        value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                        <a href="{{ route('admin/surat/create') }}" class="btn btn-primary p-2">Tambah
                            Pengajuan</a>
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
                                            <a href="{{ route('admin/surat/detail', $surat->id) }}"
                                                class="btn btn-primary"><i class="bi bi-info-circle"></i></a>
                                            <a href="{{ route('admin/surat/edit', $surat->id) }}"
                                                class="btn btn-success"><i class="bi bi-pencil"></i></a>
                                            <button type="button" class="btn btn-danger delete-button"
                                                data-id="{{ $surat->id }}"><i class="bi bi-trash3"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="8">Tidak ada data!</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                    {{ $mails->links() }}
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
                        window.location.href = `/admin/surat/delete/${itemId}`;
                    }
                });
            });
        });
    </script>
    <style>
        .status-diterima {
            background-color: green;
            color: white;
        }

        .status-ditolak {
            background-color: red;
            color: white;
        }

        .status-belum-dibaca {
            background-color: yellow;
            color: black;
        }
    </style>
</x-app-layout>
