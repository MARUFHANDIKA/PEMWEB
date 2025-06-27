<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VerificationController extends Controller
{
    public function showVerificationForm()
    {
        return view('verify');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('auth#registerPage')->with('error', 'Sesi OTP kadaluarsa, silakan daftar ulang.');
        }

        if ($user->otp !== $request->otp) {
            return back()->with('error', 'Kode OTP salah.');
        }

        if (Carbon::now()->greaterThan($user->otp_expires_at)) {
            return back()->with('error', 'Kode OTP telah kadaluarsa.');
        }

        // OTP valid, tandai email sudah diverifikasi
        $user->email_verified_at = now();
        $user->otp = null;
        $user->otp_expires_at = null;
        $user->save();

        // Login otomatis
        Auth::login($user);

        return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi.');
    }

    public function resendOtp()
    {
        $user = User::find(session('otp_user_id'));

        if (!$user) {
            return redirect()->route('auth#registerPage')->with('error', 'Sesi OTP tidak ditemukan.');
        }

        $otp = rand(100000, 999999);
        $user->otp = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(5);
        $user->save();

        Mail::raw('Kode OTP baru Anda adalah: ' . $otp, function ($message) use ($user) {
            $message->to($user->email)
                ->subject('Verifikasi Email - Kode OTP Baru');
        });

        return back()->with('success', 'Kode OTP baru telah dikirim.');
    }
}
