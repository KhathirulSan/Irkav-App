<?php

namespace App\Http\Controllers;

use App\Models\Surat;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\QueryException;
use Carbon\Carbon;


class SuratController extends Controller
{
    public function admin()
    {
        // $mails = Surat::orderBy('id', 'desc')->get();
        $mails = Surat::paginate(5);
        return view('admin.surat.surat', compact('mails'));
    }
    // public function rt()
    // {
    //     $mails = Surat::all();
    //     return view('rt.surat.surat', compact('mails'));
    // }

    public function create()
    {
        return view('admin.surat.create');
    }

    public function indexAdmin(Request $request)
    {
        $search = $request->input('search');
        $mails = Surat::query()
            ->where('Jenis_Surat', 'like', '%' . $search . '%')
            ->orWhere('No_Surat', 'like', '%' . $search . '%')
            ->orWhere('Tanggal_Surat', 'like', '%' . $search . '%')
            ->orWhere('Perihal', 'like', '%' . $search . '%')
            ->orWhere('Status', 'like', '%' . $search . '%')
            ->get();

        return view('admin.surat.surat', compact('mails'));
    }


    public function store(Request $request)
    {
        $validation = $request->validate([
            'Jenis_Surat' => 'required',
            'No_Surat' => 'required|numeric|unique:mails',
            'Tanggal_Surat' => 'required|date_format:m/d/Y',
            'Perihal' => 'required',
            'File' => 'required|file|mimes:doc,docx,pdf',
            'Status' => 'nullable',
            'Alasan' => 'nullable',
        ]);

        try {
            // Menangani file yang diunggah
            if ($request->hasFile('File')) {
                $file = $request->file('File');
                // $filename = $file->getClientOriginalName(); // Menggunakan nama file asli
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('storage/upload_file'), $filename);

                // Menyimpan nama file yang diubah ke dalam array validasi
                $request->merge(['File' => $filename]);
            }

            // Menangani tanggal datepicker
            if ($request->has('Tanggal_Surat')) {
                $formattedDate = Carbon::createFromFormat('m/d/Y', $request->Tanggal_Surat)->format('Y-m-d');
                $request->merge(['Tanggal_Surat' => $formattedDate]);
            }

            // Logika untuk menyimpan data surat
            Surat::create($request->all());
            return redirect()->route('admin.surat')->with('success', 'Data surat berhasil ditambahkan.');
        } catch (QueryException $e) {
            if ($e->errorInfo[1] == 1062) {
                return back()->withErrors(['No_Surat' => 'Nomor Surat sudah ada.'])->withInput();
            }
            return back()->withErrors(['error' => 'Terjadi kesalahan.'])->withInput();
        }

        // Menangani file yang diunggah
        // $file = $request->file('File');
        // $filename = time() . '.' . $file->getClientOriginalExtension();
        // $file->move(public_path('storage/upload_file'), $filename);

        // Menyimpan nama file yang diubah ke dalam array validasi
        $validation['File'] = $filename;

        // Memformat tanggal sesuai format yang diinginkan
        // $formattedDate = Carbon::createFromFormat('m/d/Y', $request->Tanggal_Surat)->format('Y-m-d');

        // Membuat instance baru dari model Surat
        $surat = new Surat([
            'Jenis_Surat' => $validation['Jenis_Surat'],
            'No_Surat' => $validation['No_Surat'],
            'Tanggal_Surat' => $validation['Tanggal_Surat'],
            'Perihal' => $validation['Perihal'],
            'File' => $validation['File'],
            'Status' => $validation['Status'] ?? null, // Menggunakan null coalescing operator
            'Alasan' => $validation['Alasan'] ?? null,
        ]);

        // Menyimpan data ke database
        $data = $surat->save();

        // Memberikan respons berdasarkan hasil penyimpanan
        if ($data) {
            Alert::success('Dokumen Berhasil Ditambahkan!');
            return redirect(route('admin.surat'));
        } else {
            Alert::error('Dokumen Gagal Ditambahkan!');
            return redirect(route('admin.surat.create'));
        }
    }
    public function delete($id)
    {
        $surat = Surat::findOrFail($id);
        if ($surat->delete()) {
            session()->flash('success', 'Data Berhasil Dihapus');
        } else {
            session()->flash('error', 'Data Gagal Dihapus');
        }
        return redirect(route('admin.surat'));
    }

    public function edit($id)
    {
        $mails = Surat::findOrFail($id);
        // Konversi format tanggal ke m/d/Y
        $mails->Tanggal_Surat = Carbon::createFromFormat('Y-m-d', $mails->Tanggal_Surat)->format('m/d/Y');
        return view('admin.surat.update', compact(['mails']));
    }

    public function update(Request $request, $id)
    {
        $validation = $request->validate([
            'Jenis_Surat' => 'required',
            'No_Surat' => 'required|numeric|unique:mails,No_Surat,' . $id,
            'Tanggal_Surat' => 'required|date_format:m/d/Y',
            'Perihal' => 'required',
            'File' => 'required|file|mimes:doc,docx,pdf',
        ]);

        $mails = Surat::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('File')) {
            // Hapus file lama jika ada
            $oldFile = public_path('storage/upload_file') . '/' . $mails->File;
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }

            // Simpan file baru
            $file = $request->file('File');
            // $filename = $request->$file->getClientOriginalName();
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/upload_file'), $filename);
            $mails->File = $filename; // Update nama file di database
        }

        // Konversi format tanggal
        if ($request->has('Tanggal_Surat')) {
            $formattedDate = Carbon::createFromFormat('m/d/Y', $request->Tanggal_Surat)->format('Y-m-d');
            $mails->Tanggal_Surat = $formattedDate;
        }
        // Update data lainnya
        $mails->Jenis_Surat = $request->Jenis_Surat;
        $mails->No_Surat = $request->No_Surat;
        $mails->Perihal = $request->Perihal;

        $data = $mails->save();

        if ($data) {
            alert::success('Data Berhasil Diupdate!');
            return redirect(route('admin.surat'));
        } else {
            alert::error('Data Gagal Diupdate!');
            return redirect(route('admin.surat.update', ['id' => $id]));
        }
    }

    public function detail($id)
    {
        $mails = Surat::findOrFail($id);
        return view('admin.surat.detail', compact('mails'));
    }

    public function downloadPdf($filename)
    {
        $filePath = public_path('storage/upload_file/' . $filename);
        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return back()->with('error', 'File tidak ditemukan.');
        }
    }

    // RT
    public function rt()
    {
        $mails = Surat::orderBy('id', 'desc')->get();
        return view('rt.surat.surat', compact('mails'));
    }
    public function rtDetail($id)
    {
        $mails = Surat::findOrFail($id);
        return view('rt.surat.detail', compact('mails'));
    }

    public function indexRT(Request $request)
    {
        $search = $request->input('search');
        $mails = Surat::query()
            ->where('Jenis_Surat', 'like', '%' . $search . '%')
            ->orWhere('No_Surat', 'like', '%' . $search . '%')
            ->orWhere('Tanggal_Surat', 'like', '%' . $search . '%')
            ->orWhere('Perihal', 'like', '%' . $search . '%')
            ->orWhere('Status', 'like', '%' . $search . '%')
            ->get();

        return view('rt.surat.surat', compact('mails'));
    }


    public function rtEdit($id)
    {
        $mails = Surat::findOrFail($id);
        return view('rt.surat.detail.update' . $id, compact('mails'));
    }

    public function rtUpdate(Request $request, $id)
    {
        $request->validate([
            'Status' => 'required|string',
        ]);

        $mail = Surat::findOrFail($id);
        try {
            $mail->Status = $request->input('Status');
            $mail->save();
            Alert::success('Berhasil', 'Status surat berhasil diperbarui.');
        } catch (\Exception $e) {
            Alert::error('Gagal', 'Status surat gagal diperbarui.');
            return back()->withInput();
        }

        return redirect()->route('rt.surat', ['id' => $id]);
    }

    public function saveRT(Request $request)
    {

        $validation = $request->validate([
            'Status' => 'required',
            'Alasan' => 'nullable',
        ]);
        $data = Surat::create($validation);
        if ($data) {
            alert::success('Data Berhasil Diupdate!');
            return redirect(route('rt.surat'));
        } else {
            alert::error('Data Gagal Diupdate!');
            return redirect(route('rt.surat.detail' . $data->id));
        }
    }
}
