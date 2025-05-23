<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login()
    {
        return view('login.signin');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);

        $login = $request->input('login');
        $password = $request->input('password');
        $remember = $request->has('remember');

        $user = User::where('email', $login)->orWhere('name', $login)->first();

        // if ($user && $user->password === $password) {

        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user, $remember);
            // if (Auth::user()->role == 'user') {
            //     return redirect('/welcome')->with('success', 'Login successful');
            // } elseif (Auth::user()->role == 'admin') {
                return redirect('/dashboard')->with('success', 'Login successful');
            // }
        } else {
            return redirect()->route('login')->with('error', 'Email, username or password is incorrect');
        }
    }

    public function register()
    { return view('login.signup'); }

    // public function register_proses(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required',
    //         'password' => 'required|confirmed|min:8',
    //     ]);
    //     try {
    //         $user = User::create([
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => Hash::make($request->password),
    //         ]);

    //         return redirect()->route('login')->with('success', 'Akun Sudah Terbuat');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput()->with('error', 'Gagal membuat akun / Email Sudah Terdaftar ');
    //     }
    // }

    public function forgot()
    {
        return view('login.forgot');
    }

    public function forgot_proses(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);

            $token = Str::random(64);

            DB::table('password_reset_tokens')->updateOrInsert(['email' => $request->email], ['token' => $token, 'created_at' => now()]);

            $resetLink = route('reset', ['token' => $token]);
            Mail::send('login.email-reset', ['resetLink' => $resetLink], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password Notification');
            });

            return back()->with('success', 'Reset link sent to your email address.');
        } catch (\Exception $e) {
            return back()->with('error', 'Email address provided is not registered');
        }
    }

    public function reset($token)
    {
        $record = DB::table('password_reset_tokens')->where('token', $token)->first();

        if (!$record) {
            return redirect()
                ->route('forgot')
                ->with(['error' => 'Token is invalid or expired.']);
        }

        $createdAt = Carbon::parse($record->created_at);

        if ($createdAt->addMinutes(60)->isPast()) {
            return redirect()
                ->route('forgot')
                ->with(['error' => 'Token is invalid or expired.']);
        }

        return view('login.reset', [
            'email' => $record->email,
            'token' => $token,
        ]);
    }

    public function reset_proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed',
            'password_confirmation' => 'required',
            'token' => 'required',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record) {
            return back()->with(['error' => 'Token is invalid.']);
        }

        $createdAt = Carbon::parse($record->created_at);

        if ($createdAt->addMinutes(60)->isPast()) {
            return back()->with(['error' => 'Token is expired.']);
        }

        $user = User::where('email', $request->email)->first();
        $user->update(['password' => Hash::make($request->password)]);

        DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->delete();

        return redirect()->route('login')->with('success', 'Password has been reset successfully.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
