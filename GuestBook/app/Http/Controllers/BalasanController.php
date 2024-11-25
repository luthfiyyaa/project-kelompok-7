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
        $balasans = Balasan::with(['pesan', 'admin'])->get();
        return view('balasan.index', compact('balasan'));
    }

    // Menampilkan form untuk membuat balasan baru
    public function create()
    {
        $pesans = Pesan::all(); // Untuk memilih pesan
        $admins = Admin::all(); // Untuk memilih admin
        return view('balasan.create', compact('pesan', 'admin'));
    }

    // Menyimpan balasan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'pesan_id' => 'required|exists:pesan,id_pesan',
            'code_admin' => 'required|exists:admins,kode_admin',
            'isi_balasan' => 'required',
        ]);

        Balasan::create([
            'pesan_id' => $request->pesan_id,
            'code_admin' => $request->code_admin,
            'isi_balasan' => $request->isi_balasan,
        ]);

        return redirect()->route('balasan.index')->with('success', 'Balasan berhasil dikirim.');
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