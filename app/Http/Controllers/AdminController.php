<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $pesan = Pesan::with('guest')->get();
        // dd($pesan);
        return view('front.welcome-admin', compact ('pesan'));
    }
    public function dashboard(){


        $pesan = Pesan::with(['guest', 'balasan' => function($query) {
            $query->orderBy('created_at', 'desc'); // Urutkan balasan dari yang terbaru
        }]) // Urutkan pesan dari yang terbaru
        ->get();

        return view('admin.dashboard',compact('pesan'));
    }
}
