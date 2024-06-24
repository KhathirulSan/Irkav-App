<x-app-layout title="Admin Dashboard | Kelola Anggota">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Anggota') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h4 class="mb-0">Tambah Anggota</h4>
                    <hr />
                    @if (Session()->has('error'))
                        <div>
                            {{ session('error') }}
                        </div>
                    @endif
                    <p><a href="{{ route('admin.anggota') }}" class="btn btn-primary">Kembali</a></p>
                    <form action="{{ route('admin/anggota/save') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="Nama_Anggota" class="form-control"
                                    placeholder="Nama Anggota">
                            </div>
                            @error('Nama_Anggota')
                                <span class="text-danger">{{ 'Nama Anggota Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="text" name="name" class="form-control" placeholder="Username"
                                    required>
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Jenis_Kelamin" class="form-control" placeholder="Jenis Kelamin">
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            @error('Jenis_Kelamin')
                                <span class="text-danger">{{ 'Jenis Kelamin Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="number" name="Usia" class="form-control" placeholder="Usia"
                                    min="0">
                            </div>
                            @error('Usia')
                                <span class="text-danger">{{ 'Usia Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Jabatan" class="form-control">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    <option value="Ketua">Ketua</option>
                                    <option value="Sekretaris">Sekretaris</option>
                                    <option value="Bendahara">Bendahara</option>
                                    <option value="Anggota">Anggota</option>
                                </select>
                            </div>
                            @error('Jabatan')
                                <span class="text-danger">{{ 'Jabatan Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Status_Pekerjaan" class="form-control" placeholder="Status Pekerjaan">
                                    <option value="" disabled selected>Pilih Status Pekerjaan</option>
                                    <option value="Pelajar">Pelajar</option>
                                    <option value="Bekerja">Bekerja</option>
                                    <option value="Tidak Bekerja">Tidak Bekerja</option>
                                </select>
                            </div>
                            @error('Status_Pekerjaan')
                                <span class="text-danger">{{ 'Status Pekerjaan Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <select name="Status" class="form-control">
                                    <option value="" disabled selected>Pilih Status</option>
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                            @error('Status')
                                <span class="text-danger">{{ 'Status Diperlukan' }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="password" class="form-control" placeholder="Password"
                                    required>
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Konfirmasi Password" required>
                            </div>
                            @error('password_confirmation')
                                <span class="text-danger">{{ $message }}</span>
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
