<?php

namespace App\Http\Controllers;


use App\Models\KelAnggota;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class KelAnggotaController extends Controller
{
    public function admin()
    {
        $members = KelAnggota::all();
        return view('admin.anggota.anggota', compact('members'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $members = KelAnggota::query()
            ->where('Nama_Anggota', 'like', '%' . $search . '%')
            ->orWhere('Jenis_Kelamin', 'like', '%' . $search . '%')
            ->orWhere('Usia', 'like', '%' . $search . '%')
            ->orWhere('Jabatan', 'like', '%' . $search . '%')
            ->orWhere('Status_Pekerjaan', 'like', '%' . $search . '%')
            ->orWhere('Status', 'like', '%' . $search . '%')
            ->get();

        return view('admin.anggota.anggota', compact('members'));
    }

    public function create()
    {
        return view('admin.anggota.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'Nama_Anggota' => 'required',
            'Jenis_Kelamin' => 'required',
            'Usia' => 'required',
            'Jabatan' => 'required',
            'Status_Pekerjaan' => 'required',
            'Status' => 'required',
            'name' => 'required|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
        ]);

        $members = new KelAnggota([
            'Nama_Anggota' => $validation['Nama_Anggota'],
            'Jenis_Kelamin' => $validation['Jenis_Kelamin'],
            'Usia' => $validation['Usia'],
            'Jabatan' => $validation['Jabatan'],
            'Status_Pekerjaan' => $validation['Status_Pekerjaan'],
            'Status' => $validation['Status'],
            'user_id' => $user->id,
        ]);
        $members->save();

        if ($members) {
            Alert::success('Berhasil', 'Anggota Berhasil Ditambahkan');
            return redirect()->route('admin.anggota');
        } else {
            Alert::error('Gagal', 'Anggota Gagal Ditambahkan');
            return redirect()->route('admin.anggota.create');
        }
    }
}
