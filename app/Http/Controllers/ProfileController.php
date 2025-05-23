<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        return view('profile', compact('user'));
    }

    public function ubah()
    {
        $user = Auth::user();

        return view('password', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required',
                'email' => 'required',
            ]);

            $user->Update($validatedData);
            return redirect()->back()->with('success', 'Akun Berhasil di Dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Merubah Akun, Email / Password Salah');
        }
    }

    public function password(Request $request, User $user)
    {
        try {
            $request->validate([
                'current_password' => 'required|min:8',
                'password' => 'required|confirmed|min:8',
            ]);

            if (!Hash::check($request->current_password, $user->password)) {
                throw ValidationException::withMessages([
                    'current_password' => 'Password lama tidak sesuai.',
                ]);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()->with('success', 'Password Berhasil di Dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Merubah Password');
        }
    }

    public function foto(Request $request, User $user)
    {
        try {
            $validatedData = $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            if ($request->hasFile('foto')) {
                if ($user->foto && Storage::exists('public/' . $user->foto)) {
                    Storage::delete('public/' . $user->foto);
                }
                $validatedData['foto'] = $request->file('foto')->store('profile', 'public');
            }

            $user->Update($validatedData);
            return redirect()->back()->with('success', 'Foto Profile Berhasil di Dirubah');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Merubah Foto Profile');
        }
    }

    public function reset(User $user)
    {
        try {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }

            $user->update(['foto' => null]);

            return redirect()->back()->with('success', 'Foto Profile Berhasil di Direset');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mereset Foto Profile');
        }
    }
}
