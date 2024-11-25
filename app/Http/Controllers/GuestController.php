<?php

namespace App\Http\Controllers;

use App\Models\Pesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuestController extends Controller
{
    /**
     * Display the dashboard
     */
    public function dashboard()
    {
        $pesan = Pesan::with(['guest', 'balasan'])
                      ->where('code_guest', session('kode_guest')) // Changed from guest_id to kode_guest
                      ->orderBy('created_at', 'desc')
                      ->get();

        return view('front.dashboard', compact('pesan'));
    }

    /**
     * Show the form for editing the specified message
     */
    public function editPesan($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        // Verify that the message belongs to the current guest using kode_guest
        if ($pesan->code_guest !== session('kode_guest')) {
            return redirect()->route('front.dashboard')
                           ->with('error', 'You are not authorized to edit this message');
        }

        return view('front.editpesan', compact('pesan'));
    }

    /**
     * Update the specified message
     */
    public function updatePesan(Request $request, $id)
    {
        $pesan = Pesan::findOrFail($id);
        
        // Verify that the message belongs to the current guest using kode_guest
        if ($pesan->code_guest !== session('kode_guest')) {
            return redirect()->route('front.dashboard')
                           ->with('error', 'You are not authorized to edit this message');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $pesan->isi = $request->message;
        $pesan->save();

        return redirect()->route('front.dashboard')
                        ->with('success', 'Message updated successfully');
    }

    /**
     * Delete the specified message
     */
    public function deletePesan($id)
    {
        $pesan = Pesan::findOrFail($id);
        
        // Verify that the message belongs to the current guest using kode_guest
        if ($pesan->code_guest !== session('kode_guest')) {
            return redirect()->route('front.dashboard')
                           ->with('error', 'You are not authorized to delete this message');
        }

        // Delete attachment if exists
        if ($pesan->lampiran) {
            Storage::delete($pesan->lampiran);
        }

        $pesan->delete();

        return redirect()->route('front.dashboard')
                        ->with('success', 'Message deleted successfully');
    }
}