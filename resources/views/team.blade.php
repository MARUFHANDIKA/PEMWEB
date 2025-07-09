@extends('user.layout.master') {{-- Sesuaikan jika kamu pakai layout lain --}}

@section('content')
    <style>
        .team-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .team-img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 15px;
            border: 4px solid #f8f9fa;
            transition: transform 0.3s ease;
        }

        .team-img:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Tim Pengembang</h2>
        <div class="row justify-content-center">
            {{-- Developer 1 --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center team-card p-3">
                    <img src="{{ asset('images/team/MyPicture.jpg') }}" class="team-img mx-auto" alt="Agung">
                    <h5 class="mt-2">Agung Septian</h5>
                    <p class="text-muted">Full Stack Developer</p>
                </div>
            </div>

            {{-- Developer 2 --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center team-card p-3">
                    <img src="{{ asset('images/team/rias.jpg') }}" class="team-img mx-auto" alt="rias">
                    <h5 class="mt-2">Rias Estriana</h5>
                    <p class="text-muted">Frontend Engineer</p>
                </div>
            </div>

            {{-- Developer 3 --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center team-card p-3">
                    <img src="{{ asset('images/team/dika.png') }}" class="team-img mx-auto" alt="dika">
                    <h5 class="mt-2">maaruf handika</h5>
                    <p class="text-muted">Backend Engineer</p>
                </div>
            </div>

            {{-- Developer 4 --}}
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card text-center team-card p-3">
                    <img src="{{ asset('images/team/kanzul.jpg') }}" class="team-img mx-auto" alt="kanzul">
                    <h5 class="mt-2">Kanzul</h5>
                    <p class="text-muted">UI/UX Designer</p>
                </div>
            </div>
        </div>
    </div>
@endsection