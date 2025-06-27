<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Carbon\Carbon;

class AuthController extends Controller
{
    // direct dashboard page
    public function dashboard()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        } else {
            return redirect()->route('user#home');
        }
    }

    // direct login page
    public function loginPage()
    {
        return view('login');
    }

    // direct register page
    public function registerPage()
    {
        return view('register');
    }

    // proses register + kirim OTP
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Simpan user sementara, belum diverifikasi
        $otp = rand(100000, 999999);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'otp' => $otp,
            'otp_expires_at' => Carbon::now()->addMinutes(5),
        ]);

        // Kirim OTP ke email
        Mail::raw('Kode OTP Anda adalah: ' . $otp, function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verifikasi Email - Kode OTP');
        });

        // Simpan user_id di session sementara
        session(['otp_user_id' => $user->id]);

        return redirect()->route('verify.form')->with('success', 'Kode OTP telah dikirim ke email Anda.');
    }
}
