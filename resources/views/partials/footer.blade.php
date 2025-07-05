<!-- resources/views/partials/footer.blade.php -->
<footer class="bg-dark text-white py-4 mt-5">
    <div class="container row mx-auto">
        <div class="col-md-3">
            <h5>Mie Ayam Bakar Pakde Joyo</h5>
            <p>Melayani dengan cita rasa autentik sejak 2010</p>
        </div>
        <div class="col-md-3">
            <h5>Menu</h5>
            <a href="{{ route('user#home') }}" class="d-block text-white">Home</a>
            <a href="{{ route('user#home') }}#menu" class="d-block text-white">Menu</a>
            <a href="{{ route('user#home') }}#about" class="d-block text-white">Tentang Kami</a>
            <a href="{{ route('user#home') }}#contact" class="d-block text-white">Kontak</a>
        </div>
        <div class="col-md-3">
            <h5>Kontak</h5>
            <p><i class="fa fa-phone me-1"></i> +62 882-0089-01178</p>
            <p><i class="fa fa-envelope me-1"></i> info@mieayampakdejoyo.com</p>
            <p><i class="fa fa-map-marker-alt me-1"></i> Jl. Raya Rupakpicis, babakan slatri, klapasawit, Kec. Kalimanah, Kabupaten Purbalingga, Jawa Tengah</p>
        </div>
        <div class="col-md-3">
            <h5>Ikuti Kami</h5>
            <a href="https://www.instagram.com/mie_ayam_pakde_joyo?igsh=eTUwMm54eG4wOXMz " target="_blank" class="d-block text-white">Instagram</a>
            <a href="https://maps.app.goo.gl/PnJzTMjiqgRjfLR9A?g_st=aw" target="_blank" class="d-block text-white">Gmaps</a>
        </div>
    </div>
    <div class="text-center mt-4">&copy; 2025 Mie Ayam Bakar Pakde Joyo. All rights reserved.</div>
</footer>