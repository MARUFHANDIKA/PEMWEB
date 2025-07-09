@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
  <!-- Hero Section -->
  <section class="hero"
    style="background: url('{{ asset('images/header.jpg') }}') no-repeat center center; background-size: cover; padding: 100px 0;color: white; text-align: center; width: 100%; box-sizing: border-box;">
    <!-- Hero Section -->
    <section class="hero" style="background-image: url('{{ asset('images/header.jpg') }}');">
    <div class="overlay"></div>
    <div class="content container">
      <h1 style="color: yellow;">
      Nikmati Lezatnya <span style="color: yellow;">Mie Ayam Bakar</span> Spesial Pakde Joyo!
      </h1>
      <p style="color: white;">
      Rasa autentik khas rumahan, harga bersahabat, dan cepat disajikan
      </p>

      <a href="{{ route('auth#loginPage') }}" class="btn-primary">Pesan Sekarang</a>
    </div>
    </div>
    </section>

    <div class="container">

    <a href="{{ route('auth#loginPage') }}" class="btn-primary">Pesan Sekarang</a>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section class="about container" style="padding: 50px 0;">
    <h2>Tentang Kami</h2>
    <div class="about-content" style="display: flex; align-items: center; flex-wrap: wrap; gap: 30px;">
    <div class="about-text" style="flex: 1;">
      <p>Mie Ayam Bakar Pakde Joyo adalah kuliner unik di Purbalingga yang menyajikan mie ayam dengan topping ayam bakar
      utuh—bukan suwiran seperti biasanya. Dengan paduan bumbu manis dan gurih yang meresap sempurna, tekstur ayamnya
      empuk dan mudah dinikmati, sehingga menciptakan sensasi rasa berbeda yang mudah bikin ketagihan.</p>
      <p>Mie Ayam Bakar Pakde Joyo menghadirkan konsep unik yang membawa mie ayam ke level baru—menggabungkan
      kelezatan mie ayam tradisional dengan sentuhan modern berupa ayam bakar utuh. Selain harga bersahabat, pilihan
      varian
      dan porsi lengkap menjadikan usaha ini favorit lokal yang siap bersaing di ranah kuliner digital.</p>
    </div>
    <div class="about-img" style="flex: 1; text-align: center;">
      <img src="{{ asset('images/Logo.png') }}" alt="Logo" class="img-fluid" style="max-width: 300px;">
    </div>
    </div>
  </section>

  <!-- Menu Favorit -->
  <section class="menu-favorit" id="menu" style="padding: 50px 0; background-color: #f9f9f9;">
    <div class="container">
    <h2>Menu Favorit</h2>
    <p>Pilihan terbaik yang selalu dinanti pelanggan</p>
    <div class="menu-grid"
      style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-top: 30px;">
      @foreach($products as $product)
      <div class="card" style="border: 1px solid #ddd; padding: 20px; border-radius: 10px; text-align: center;">
      <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
      style="width: 100%; height: 180px; object-fit: cover; border-radius: 10px;">
      <h4 style="margin-top: 15px;">{{ $product->name }}</h4>
      <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
      <a href="{{ route('login') }}" class="btn">Lihat Detail</a>
      </div>
    @endforeach
    </div>
    </div>
  </section>

  <!-- Kenapa Pilih Kami -->
  <section class="why-us" style="padding: 50px 0;">
    <div class="container">
    <h2>Kenapa Pilih Kami?</h2>
    <div class="features" style="display: flex; flex-wrap: wrap; gap: 30px; justify-content: center; margin-top: 30px;">
      <div class="feature" style="flex: 1; max-width: 300px; text-align: center;">
      <div class="icon" style="font-size: 40px;">🍜</div>
      <h4>Rasa Tradisional</h4>
      <p>Resep turun temurun yang telah terbukti memuaskan ribuan pelanggan</p>
      </div>
      <div class="feature" style="flex: 1; max-width: 300px; text-align: center;">
      <div class="icon" style="font-size: 40px;">⚡</div>
      <h4>Cepat & Hangat</h4>
      <p>Pesanan siap dalam 5-10 menit dengan kualitas terjaga</p>
      </div>
      <div class="feature" style="flex: 1; max-width: 300px; text-align: center;">
      <div class="icon" style="font-size: 40px;">💸</div>
      <h4>Harga Bersahabat</h4>
      <p>Kualitas premium dengan harga yang terjangkau untuk semua kalangan</p>
      </div>
    </div>
    </div>
  </section>

  <!-- Call to Action -->
  <section class="cta" style="padding: 60px 0; text-align: center; background-color: #ffebcd;">
    <div class="container">
    <h2>Sudah Siap Memesan Mie Ayam Terenak di Kota?</h2>
    <p>Bergabunglah dengan ribuan pelanggan yang sudah merasakan kelezatan mie ayam Pakde Joyo</p>
    <a href="{{ route('auth#loginPage') }}" class="btn" style="margin-top: 20px;">Login untuk Memesan</a>
    </div>
  </section>
@endsection