@extends('layouts.app') {{-- Atau sesuaikan dengan layout kamu, misalnya guest.blade.php --}}

@section('content')
    <div class="container mt-4">
        <h3 class="mb-3">Kontak Kami</h3>

        @if ($setting)
            <div class="card">
                <div class="card-body">
                    <p><strong>Nama Usaha:</strong> {{ $setting->store_name }}</p>
                    <p><strong>Alamat:</strong> {{ $setting->address }}</p>
                    <p><strong>No. WhatsApp:</strong> <a
                            href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $setting->phone) }}"
                            target="_blank">{{ $setting->phone }}</a></p>
                    <p><strong>Email:</strong> <a href="mailto:{{ $setting->email }}">{{ $setting->email }}</a></p>
                    <p><strong>Jam Buka:</strong> {{ $setting->opening_hours ?? 'Tidak tersedia' }}</p>
                    <p><strong>Deskripsi:</strong> {{ $setting->description ?? '-' }}</p>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-3">
                Informasi kontak belum tersedia.
            </div>
        @endif
    </div>
@endsection