<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Guest;
use App\Models\Pesan;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index(){
        session()->forget(['id_admin', 'kode_guest']);

        return view('front.home');
    }

    public function loginGuest(){
        return view('front.login-guest');
    }
    public function guestlogin(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'kode_guest' => 'required|string',
                'nama' => 'required|string'
            ], [
                'kode_guest.required' => 'Kode admin harus diisi',
                'nama.required' => 'Nama harus diisi'
            ]);

            // Cek credentials di database
            $guest = Guest::where('kode_guest', $request->kode_guest)
                        ->where('nama', $request->nama)
                        ->first();

            if (!$guest) {
                return redirect()->back()
                            ->withInput()
                            ->with('error', 'Kode guest atau nama tidak valid');
            }

            // Simpan data guest ke session
            session([
                'guest_id' => $guest->id,
                'kode_guest' => $guest->kode_guest,
                'nama_guest' => $guest->nama,
                'alamat' => $guest->alamat
            ]);

             // Ambil pesan dengan eager loading untuk guest dan balasan
                $pesan = Pesan::with(['guest', 'balasan' => function($query) {
                    $query->orderBy('created_at', 'desc'); // Urutkan balasan dari yang terbaru
                }])
                ->where('code_guest', session('kode_guest')) // Gunakan guest_id, bukan code_guest
                ->orderBy('created_at', 'desc') // Urutkan pesan dari yang terbaru
                ->get();

                // dd($pesan);

            return view('front.dashboard',compact('pesan'))->with('success', 'Login berhasil');

        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors($e->errors());
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Terjadi kesalahan sistem');
        }
    }

    public function loginAdmin(){
        return view('front.login-admin');
    }
    public function adminlogin(Request $request)
    {
        try {
            // Validasi input
            $request->validate([
                'id_admin' => 'required|string',
                'nama' => 'required|string'
            ], [
                'id_admin.required' => 'id admin harus diisi',
                'nama.required' => 'Nama harus diisi'
            ]);

            // Cek credentials di database
            $admin = Admin::where('id_admin', $request->id_admin)
                        ->where('nama', $request->nama)
                        ->first();

            if (!$admin) {
                return redirect()->back()
                            ->withInput()
                            ->with('error', 'Kode admin atau nama tidak valid');
            }

            // Simpan data admin ke session
            session([
                'guest_id' => $admin->id,
                'id_admin' => $admin->id_admin,
                'nama_guest' => $admin->nama
            ]);

            return redirect()->route('admin.index')
                            ->with('success', 'Login berhasil');

        } catch (ValidationException $e) {
            return redirect()->back()
                            ->withInput()
                            ->withErrors($e->errors());
        } catch (Exception $e) {
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Terjadi kesalahan sistem');
        }
    }


}
