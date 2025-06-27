<form action="{{ route('verify.otp') }}" method="POST" class="mb-3">
    @csrf
    <div class="mb-3">
        <label for="otp" class="form-label">Masukkan Kode OTP</label>
        <input type="text" class="form-control" name="otp" id="otp" required>
    </div>
    <button type="submit" class="btn btn-success">Verifikasi</button>
</form>

<form action="{{ route('resend.otp') }}" method="POST">
    @csrf
    <button type="submit" class="btn btn-secondary">Kirim Ulang OTP</button>
</form>