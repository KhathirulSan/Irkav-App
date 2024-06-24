<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventori;
use Barryvdh\DomPDF\Facade\Pdf;
use RealRashid\SweetAlert\Facades\Alert;

class InventoriController extends Controller
{
    public function admin()
    {
        $inventoris = Inventori::orderBy('id', 'desc')->get();
        $total = Inventori::count();
        return view('admin.inventori.inventori', compact(['inventoris', 'total']));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $inventoris = Inventori::query()
            ->where('Nama_Barang', 'like', '%' . $search . '%')
            ->orWhere('Kategori', 'like', '%' . $search . '%')
            ->orWhere('Jumlah_Barang', 'like', '%' . $search . '%')
            ->orWhere('Status', 'like', '%' . $search . '%')
            ->get();
        return view('admin.inventori.inventori', compact('inventoris'));
    }
    public function user()
    {
        $inventoris = Inventori::orderBy('id', 'desc')->get();
        $total = Inventori::count();
        return view('user.inventori.inventori', compact(['inventoris', 'total']));
    }

    // public function downloadData()
    // {
    //     $Inventoris = Inventori::orderBy('id', 'desc')->get();
    //     $pdf = Pdf::loadView('admin.inventori.cetak-inventori', compact('Inventoris'));
    //     return $pdf->download('Laporan-Inventaris.pdf');
    // }

    public function cetakData()
    {
        $Inventoris = Inventori::orderBy('id', 'desc')->get();
        $total = Inventori::count();
        $pdf = Pdf::loadView('admin.inventori.cetak-inventori', compact(['Inventoris', 'total']));
        return $pdf->download('Laporan-Inventaris.pdf');
    }
    public function cetakDataUser()
    {
        $Inventoris = Inventori::orderBy('id', 'desc')->get();
        $total = Inventori::count();
        $pdf = Pdf::loadView('user.inventori.cetak-inventori', compact(['Inventoris', 'total']));
        return $pdf->download('Laporan-Inventaris.pdf');
    }

    public function create()
    {
        return view('admin.inventori.create');
    }

    public function save(Request $request)
    {
        $validation = $request->validate([
            'Nama_Barang' => 'required',
            'Kategori' => 'required',
            'Jumlah_Barang' => 'required',
            'Status' => 'required',
        ]);
        $data = Inventori::create($validation);
        if ($data) {
            alert::success('Barang Berhasil Ditambahkan!');
            return redirect(route('admin.inventori'));
        } else {
            alert::error('Barang Gagal Ditambahkan!');
            return redirect(route('admin.inventori.create'));
        }
    }

    public function delete($id)
    {
        $inventori = Inventori::findOrFail($id);
        if ($inventori->delete()) {
            session()->flash('success', 'Barang Berhasil Dihapus');
        } else {
            session()->flash('error', 'Barang Gagal Dihapus');
        }
        return redirect(route('admin.inventori'));

        // $inventoris = Inventori::findOrFail($id);
        // $inventoris->delete();
        // return redirect(route('admin.inventori'))->with('success', 'Barang berhasil dihapus');
    }



    public function edit($id)
    {
        $inventoris = Inventori::findOrFail($id);
        return view('admin.inventori.update', compact(['inventoris']));
    }



    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'Nama_Barang' => 'required',
            'Kategori' => 'required',
            'Jumlah_Barang' => 'required',
            'Status' => 'required',
        ]);

        $inventoris = Inventori::findOrFail($id);
        $inventoris->Nama_Barang = $request->Nama_Barang;
        $inventoris->Kategori = $request->Kategori;
        $inventoris->Jumlah_Barang = $request->Jumlah_Barang;
        $inventoris->Status = $request->Status;
        $data = $inventoris->save();

        if ($data) {
            alert::success('Data Berhasil Diupdate!');
            return redirect(route('admin.inventori'));
        } else {
            alert::error('Data Gagal Diupdate!');
            return redirect(route('admin.inventori.update', ['id' => $id]));
        }
    }
}
