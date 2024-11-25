<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use App\Models\Guest;
use Illuminate\Http\Request;

class PesanController extends Controller
{
    // Menampilkan semua pesan
    public function index()
    {
        $pesans = Pesan::with('guest')->get();
        return view('pesan.index', compact('pesan'));
    }

    // Menampilkan form untuk membuat pesan baru
    public function create()
    {
        $guests = Guest::all(); // Untuk memilih kode_guest
        return view('pesan.create', compact('guest'));
    }

    // Menyimpan pesan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'code_guest' => 'required|exists:guest,kode_guest',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,png,mp4|max:2048',
        ]);

        $path = null;
        if ($request->hasFile('lampiran')) {
            $path = $request->file('lampiran')->store('lampiran', 'public');
        }

        Pesan::create([
            'code_guest' => $request->code_guest,
            'isi' => $request->isi,
            'lampiran' => $path,
        ]);

        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dikirim.');
    }

    // Menampilkan detail pesan
    public function show(Pesan $pesan)
    {
        return view('pesan.show', compact('pesan'));
    }

    // Menampilkan form untuk mengedit pesan
    public function edit(Pesan $pesan)
    {
        $guests = Guest::all(); // Untuk memilih ulang kode_guest
        return view('pesan.edit', compact('pesan', 'guest'));
    }

    // Memperbarui pesan di database
    public function update(Request $request, Pesan $pesan)
    {
        $request->validate([
            'code_guest' => 'required|exists:guests,kode_guest',
            'isi' => 'required',
            'lampiran' => 'nullable|file|mimes:jpg,png,mp4|max:2048',
        ]);

        $path = $pesan->lampiran;
        if ($request->hasFile('lampiran')) {
            if ($pesan->lampiran) {
                \Storage::delete('public/' . $pesan->lampiran);
            }
            $path = $request->file('lampiran')->store('lampiran', 'public');
        }

        $pesan->update([
            'code_guest' => $request->code_guest,
            'isi' => $request->isi,
            'lampiran' => $path,
        ]);

        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    // Menghapus pesan dari database
    public function destroy(Pesan $pesan)
    {
        if ($pesan->lampiran) {
            \Storage::delete('public/' . $pesan->lampiran);
        }
        $pesan->delete();

        return redirect()->route('pesan.index')->with('success', 'Pesan berhasil dihapus.');
    }
}