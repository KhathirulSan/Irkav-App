<x-app-layout title="RT Dashboard | Detail Dokumen ">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- {{ __('Berikut Merupakan Halaman Inventori SIIRKAV') }} --}}
                    {{-- <div class="d-flex align-items-center mb-3">
                        <h4 class="me-auto p-2">Detail Surat</h4>

                        {{-- <div class="p-2">
                            <form action="{{ route('admin/surat/index') }}" method="GET">
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="Cari Data..."
                                        value="{{ request('search') }}">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </form>
                        </div> --}}
                    {{-- <a href="{{ route('admin/surat/create') }}" class="btn btn-primary p-2">Tambah
                        Pengajuan</a>
                </div> --}}
                    <div class="container">
                        <div class="row">
                            <!-- Bagian Kiri: Informasi Surat -->
                            <div class="col-md-6">
                                <a href="{{ route('rt.surat') }}" class="btn btn-warning mb-3">Kembali</a>
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Detail Surat</h4>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-striped">
                                            <tr>
                                                <th>Jenis Surat</th>
                                                <td>{{ $mails->Jenis_Surat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Nomor Surat</th>
                                                <td>{{ $mails->No_Surat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Tanggal Surat</th>
                                                <td>{{ $mails->Tanggal_Surat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Perihal</th>
                                                <td>{{ $mails->Perihal }}</td>
                                            </tr>
                                            <tr>
                                                <th>Status</th>
                                                <td>{{ $mails->Status }}</td>
                                            </tr>
                                        </table>

                                    </div>
                                    <button class="btn btn-success edit-btn" id="edit-btn">Edit Status</button>
                                    <div class="hover-buttons" id="action-buttons">
                                        <form action="{{ route('rt/surat/detail/update', ['id' => $mails->id]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit" name="Status" value="Diterima"
                                                class="btn btn-primary">Terima</button>
                                            <button type="submit" name="Status" value="Ditolak"
                                                class="btn btn-danger">Tolak</button>
                                        </form>
                                    </div>
                                </div>

                            </div>

                            <!-- Bagian Kanan: Tampilan PDF dan Tombol Download -->
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Dokumen Surat</h4>
                                        <a href="{{ route('rt/surat/downloadPdf', $mails->File) }}"
                                            class="btn btn-primary float-right">Download PDF</a>
                                    </div>
                                    <div class="card-body">
                                        <?php
                                        $filePath = asset('storage/upload_file/' . $mails->File);
                                        Log::info('File path: ' . $filePath);
                                        ?>
                                        <iframe src="{{ $filePath }}" width="100%" height="500px"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('edit-btn').addEventListener('click', function(e) {
            e.preventDefault();
            document.getElementById('action-buttons').style.display = 'inline-block';
        });
    </script>
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
                        window.location.href = `/admin/surat/delete/${itemId}`;
                    }
                });
            });
        });
    </script> --}}
    <style>
        .hover-buttons {
            display: none;
        }

        .edit-btn:hover+.hover-buttons {
            display: inline-block;
        }
    </style>
</x-app-layout>
