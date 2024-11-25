<?php

namespace App\Http\Controllers;

use App\Models\Balasan;
use App\Models\Pesan;
use App\Models\Admin;
use Illuminate\Http\Request;

class BalasanController extends Controller
{
    // Menampilkan semua balasan
    public function index()
    {
        $balasan = Balasan::with(['pesan', 'admin'])->get();
        return view('balasan.index', compact('balasan'));
    }

    public function create(Pesan $pesan) // nama parameter konsisten dengan yang digunakan
    {
        $admin_id = session('id_admin');
        return view('balasan.create', compact('pesan', 'admin_id')); 
    }

    // Menyimpan balasan baru ke database
    
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'pesan_id' => 'required|exists:pesan,id_pesan',
            'isi_balasan' => 'required|string',
        ]);
    
        try {
            $balasan = new Balasan();
            $balasan->pesan_id = $request->pesan_id;
            $balasan->code_admin = session('id_admin');
            $balasan->isi_balasan = $request->isi_balasan;
            $balasan->save();
    
            return redirect()->route('pesan.index')
                ->with('success', 'Balasan berhasil dikirim!');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal mengirim balasan: ' . $e->getMessage())
                ->withInput();
        }
    }
    

    // Menampilkan detail balasan
    public function show(Balasan $balasan)
    {
        return view('balasan.show', compact('balasan'));
    }

    // Menampilkan form untuk mengedit balasan
    public function edit(Balasan $balasan)
    {
        $pesans = Pesan::all(); // Untuk memilih ulang pesan
        $admins = Admin::all(); // Untuk memilih ulang admin
        return view('balasan.edit', compact('balasan', 'pesan', 'admin'));
    }

    // Memperbarui balasan di database
    public function update(Request $request, Balasan $balasan)
    {
        $request->validate([
            'pesan_id' => 'required|exists:pesan,id_pesan',
            'code_admin' => 'required|exists:admin,kode_admin',
            'isi_balasan' => 'required',
        ]);

        $balasan->update([
            'pesan_id' => $request->pesan_id,
            'code_admin' => $request->code_admin,
            'isi_balasan' => $request->isi_balasan,
        ]);

        return redirect()->route('balasan.index')->with('success', 'Balasan berhasil diperbarui.');
    }

    // Menghapus balasan dari database
    public function destroy(Balasan $balasan)
    {
        $balasan->delete();
        return redirect()->route('balasan.index')->with('success', 'Balasan berhasil dihapus.');
    }
}