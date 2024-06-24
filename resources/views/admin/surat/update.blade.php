<x-app-layout title="Admin Dashboard | Kelola Dokumen">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengajuan Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mb-0">Edit Pengajuan Dokumen</h4>
                    <hr />
                    @if (Session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.surat') }}" class="btn btn-warning">Kembali</a></p>
                    <form id="updateForm" action="{{ route('admin/surat/update', $mails->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Jenis_Surat">Jenis Surat</label>
                            <select name="Jenis_Surat" class="form-control" placeholder="Jenis Surat">
                                <option value="" disabled
                                    {{ old('Jenis_Surat', $mails->Jenis_Surat) == '' ? 'selected' : '' }}>Pilih Jenis
                                    Surat</option>
                                <option value="Proposal"
                                    {{ old('Jenis_Surat', $mails->Jenis_Surat) == 'Proposal' ? 'selected' : '' }}>
                                    Proposal</option>
                                <option value="Surat Undangan"
                                    {{ old('Jenis_Surat', $mails->Jenis_Surat) == 'Surat Undangan' ? 'selected' : '' }}>
                                    Surat Undangan</option>
                                <option value="Surat Pemberitahuan"
                                    {{ old('Jenis_Surat', $mails->Jenis_Surat) == 'Surat Pemberitahuan' ? 'selected' : '' }}>
                                    Surat Pemberitahuan</option>
                            </select>
                        </div>
                        @error('Jenis_Surat')
                            <span class="text-danger">{{ 'Jenis Surat Diperlukan' }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="No_Surat">No Surat</label>
                            <input type="number" name="No_Surat" class="form-control" placeholder="Nomor Surat"
                                min="0" value="{{ old('No_Surat', $mails->No_Surat) }}">
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

                        <div class="form-group">
                            <label for="Tanggal_Surat">Tanggal Surat</label>
                            <div class="col input-group date" id="datepicker">
                                <input type="text" class="form-control" name="Tanggal_Surat"
                                    placeholder="Pilih Tanggal"
                                    value="{{ old('Tanggal_Surat', $mails->Tanggal_Surat) }}">
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
                        </div>

                        <div class="form-group">
                            <label for="Perihal">Perihal</label>
                            <input type="text" name="Perihal" class="form-control" placeholder="Perihal"
                                value="{{ old('Perihal', $mails->Perihal) }}">
                            @error('Perihal')
                                <span class="text-danger">{{ 'Perihal Diperlukan' }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="formFile" class="form-label">Masukkan File Dokumen</label>
                            <input class="form-control" type="file" id="formFile" name="File">
                            <small class="form-text text-muted">Format file yang diperbolehkan: PDF, DOC, DOCX</small>
                            @error('File')
                                <span class="text-danger">{{ 'File Diperlukan' }}</span>
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
