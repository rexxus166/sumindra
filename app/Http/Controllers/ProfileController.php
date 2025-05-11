<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Alamat;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('page.profile.index', compact('user'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('page.setting.index', compact('user'));
    }

    // ✅ Gabungan update profil + alamat
    public function updateAll(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            // Profil
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:10|unique:users,username,' . $user->id,
            'password' => 'nullable|confirmed|min:6',

            // Alamat
            'no_tlp' => 'required|string|max:15',
            'provinsi' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'nama_jalan' => 'required|string|max:255',
            'gedung' => 'nullable|string|max:255',
            'no_rumah' => 'nullable|string|max:255',
        ]);

        // Simpan profil
        $user->name = $validated['name'];
        $user->username = $validated['username'];
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Simpan alamat
        $user->alamat()->updateOrCreate(
            ['user_id' => $user->id],
            collect($validated)->only([
                'no_tlp', 'provinsi', 'kota', 'kecamatan',
                'kode_pos', 'nama_jalan', 'gedung', 'no_rumah'
            ])->toArray()
        );

        return redirect()->route('profil')->with('success', 'Profil dan alamat berhasil diperbarui!');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi dengan pesan custom berbahasa Indonesia
        $validated = $request->validate([
            'current-password' => ['required'],
            'new-password' => ['required', 'min:8', 'confirmed'],
        ], [
            'current-password.required' => 'Password lama wajib diisi.',
            'new-password.required' => 'Password baru wajib diisi.',
            'new-password.min' => 'Password baru minimal terdiri dari 8 karakter.',
            'new-password.confirmed' => 'Konfirmasi password baru tidak cocok.',
        ]);

        // Cek apakah password lama sesuai
        if (!Hash::check($request->input('current-password'), $user->password)) {
            return back()->withErrors(['current-password' => 'Password lama salah.'])->withInput();
        }

        // Simpan password baru
        $user->password = Hash::make($validated['new-password']);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }
}