<x-app-layout title="Admin Dashboard | Kelola Surat">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Data') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mb-0">Tambah Data</h4>
                    <hr />
                    @if (Session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.surat') }}" class="btn btn-primary">Kembali</a></p>
                    <form action="{{ route('admin/surat/store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Jenis_Surat" class="form-control" placeholder="Jenis Surat">
                                    <option value="" disabled selected>Pilih Jenis Surat</option>
                                    <option value="Proposal">Proposal</option>
                                    <option value="Surat Undangan">Surat Undangan</option>
                                    <option value="Surat Pemberitahuan">Surat Pemberitahuan</option>
                                </select>
                            </div>
                            @error('Jenis_Surat')
                                <span class="text-danger">{{ 'Jenis Surat Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="number" name="No_Surat" class="form-control" placeholder="Nomor Surat"
                                    min="0">
                            </div>
                            @if (Session()->has('error'))
                                <div>
                                    {{ session('error') }}
                                </div>
                            @endif
                            @error('No_Surat')
                                <span
                                    class="text-danger">{{ 'Nomor surat sudah ada, silahkan gunakan nomor surat yang lain.' }}</span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <div class="col input-group date" id="datepicker">
                                <input type="text" class="form-control" name="Tanggal_Surat"
                                    placeholder="Pilih Tanggal">
                                <span class="input-group-append">
                                    <span class="input-group-text bg-white d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            {{-- @error('Tanggal_Surat')
                                <span class="text-danger">{{ 'Tanggal Surat Diperlukan' }}</span>
                            @enderror --}}
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="Perihal" class="form-control" placeholder="Perihal">
                            </div>
                            @error('Perihal')
                                <span class="text-danger">{{ 'Perihal Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label for="formFile" class="form-label">Masukkan File Dokumen</label>
                                <input class="form-control" type="file" id="formFile" name="File">
                                <small class="form-text text-muted">Format file yang diperbolehkan: PDF, DOC,
                                    DOCX</small>
                            </div>
                            @error('File')
                                <span class="text-danger">{{ 'File Diperlukan' }}</span>
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

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker();
        });
    </script>
</x-app-layout>
