<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesanController extends Controller
{
     // Menampilkan semua pesan
     public function index()
     {
         $pesan = Pesan::with('guest')->get();
         return view('front.view-pesan', compact('pesan'));
     }
 
     // Menampilkan form untuk membuat pesan baru
     public function create()
     {
         $guests = Guest::all(); // Untuk memilih kode_guest
         return view('front.createpesan', compact('guests'));
     }
 
     // Menyimpan pesan baru ke database
     // PesanController.php
     public function store(Request $request)
     {
         // Validasi input
         $request->validate([
             'isi' => 'required|string',
             'lampiran' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
         ]);
         
         try {
             // Debug untuk melihat request
            //  dd($request->all());
             
             $pesan = new Pesan();
             $pesan->code_guest = session('kode_guest');
             $pesan->isi = $request->isi;
             
             if ($request->hasFile('lampiran')) {
                 $file = $request->file('lampiran');
                 
                 // Debug untuk melihat file
                 // dd($file);
                 
                 if ($file->isValid()) {
                     // Dapatkan ekstensi file asli
                     $extension = $file->getClientOriginalExtension();
                     
                     // Buat nama file yang unik dengan ekstensi asli
                     $fileName = time() . '_' . uniqid() . '.' . $extension;
                     
                     // Simpan file ke storage public
                     try {
                         $file->move(public_path('storage/lampiran'), $fileName);
                         $pesan->lampiran = 'lampiran/' . $fileName;
                     } catch (\Exception $e) {
                         dd($e->getMessage()); // Debug jika ada error saat memindahkan file
                     }
                 }
             }
             
             $pesan->save();
             
             return view('front.thanks')->with('success', 'Pesan berhasil dikirim!');
             
         } catch (\Exception $e) {
             return redirect()->back()
                 ->with('error', 'Gagal mengirim pesan: ' . $e->getMessage())
                 ->withInput();
         }
     }
     public function show(){
        $pesan = Pesan::all();
        return view('front.view-pesan',compact('pesan'));
     }
}