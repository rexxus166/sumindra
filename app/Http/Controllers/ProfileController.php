<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Alamat;

class ProfileController extends Controller
{
    // Menampilkan halaman setting
    public function index()
    {
        $user = Auth::user();
        return view('page.setting.index', compact('user'));
    }

    // Update nama dan password
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:10',
            'password' => 'nullable|confirmed|min:6',
        ]);

        // Update nama
        $user->name = $request->name;

        // Update Username
        $user->username = $request->username;

        // Update password jika ada
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profil')->with('success', 'Profil berhasil diperbarui!');
    }

    // Update alamat
    public function updateAlamat(Request $request)
    {
        $user = Auth::user();
        $alamat = $user->alamat ?? new Alamat();

        // Validasi alamat
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'no_tlp' => 'required|string|max:15',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'nama_jalan' => 'required|string|max:255',
            'gedung' => 'nullable|string|max:255',
            'no_rumah' => 'nullable|string|max:255',
        ]);

        // Menyimpan alamat
        $alamat->nama_lengkap = $request->nama_lengkap;
        $alamat->no_tlp = $request->no_tlp;
        $alamat->provinsi = $request->provinsi;
        $alamat->kota = $request->kota;
        $alamat->kecamatan = $request->kecamatan;
        $alamat->kode_pos = $request->kode_pos;
        $alamat->nama_jalan = $request->nama_jalan;
        $alamat->gedung = $request->gedung;
        $alamat->no_rumah = $request->no_rumah;
        $alamat->user_id = $user->id;

        $alamat->save();

        return redirect()->route('profil')->with('success', 'Alamat berhasil diperbarui!');
    }
}