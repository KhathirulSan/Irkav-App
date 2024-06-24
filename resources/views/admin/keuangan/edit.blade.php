<x-app-layout title="Admin Dashboard | Kelola Keuangan - Pemasukan">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Keuangan - Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <h3>Edit Pemasukan</h3>
                    </div>
                    <hr />
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('admin.keuangan.pemasukan.update', $keuangan->id) }}">

                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="status_pembayaran" class="form-label">Status Pembayaran:</label>
                            <select name="status_pembayaran" id="status_pembayaran" class="form-control">
                                <option value="Lunas" {{ $keuangan->status_pembayaran == 'Lunas' ? 'selected' : '' }}>
                                    Lunas</option>
                                <option value="Belum Lunas"
                                    {{ $keuangan->status_pembayaran == 'Belum Lunas' ? 'selected' : '' }}>Belum Lunas
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Perbarui</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
