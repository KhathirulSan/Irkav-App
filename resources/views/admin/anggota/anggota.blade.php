<x-app-layout title="Admin Dashboard | Kelola Anggota">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Anggota IRKAV') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __('Berikut Merupakan Halaman Kelola Anggota SIIRKAV') }} --}}
                    <div class="d-flex align-items-center mb-3">
                        <h3 class="me-auto p-2">Daftar Anggota</h3>

                        <div class="p-2 ">
                            <form action="{{ route('admin/anggota/index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari Anggota..." value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div>
                        <a href=" {{ route('admin/anggota/create') }}" class="btn btn-primary p-2">Tambah
                            Anggota</a>

                        {{-- <a href=" {{ route('admin/anggota/cetak-anggota') }}" class="btn btn-success p-2 ml-3 "
                            target="_blank">Cetak Data <i class="bi bi-printer"></i>
                        </a> --}}

                    </div>
                    <hr />
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No.</th>
                                <th>Nama Anggota</th>
                                <th>Jenis Kelamin</th>
                                <th>Usia</th>
                                <th>Jabatan</th>
                                <th>Status Pekerjaan</th>
                                <th>Status Anggota</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($members as $member)
                                <tr>
                                    <td class="align-middle">{{ $loop->iteration }}</td>
                                    <td class="align-middle">{{ $member->Nama_Anggota }}</td>
                                    <td class="align-middle">{{ $member->Jenis_Kelamin }}</td>
                                    <td class="align-middle">{{ $member->Usia }}</td>
                                    <td class="align-middle">{{ $member->Jabatan }}</td>
                                    <td class="align-middle">{{ $member->Status_Pekerjaan }}</td>
                                    <td class="align-middle">{{ $member->Status }}</td>
                                    <td class="align-middle">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            {{-- Edit Btn --}}
                                            {{-- <a href="{{ route('admin/anggota/edit', ['id' => $inventori->id]) }}"
                                                type="button" class="btn btn-secondary"><i
                                                    class="bi bi-pencil"></i></a> --}}
                                            {{-- Delete Btn --}}
                                            {{-- <button type="button" class="btn btn-danger delete-button"
                                                data-id="{{ $member->id }}"><i class="bi bi-trash3"></i></button> --}}
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="5">Data Anggota Tidak Ditemukan!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
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
    </script> --}}
</x-app-layout>
