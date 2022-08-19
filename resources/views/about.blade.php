<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ env('APP_NAME') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

    <link rel='stylesheet prefetch' href='{{ asset('assets/tentang/style.css') }}'>
    <link rel='stylesheet prefetch'
        href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css'>
    <link rel="stylesheet" href="{{ asset('assets/login/css/style.css') }}">


</head>
<style>
    @media only screen and (max-width: 400px) {
        img {
            width: 100%;
        }
    }

</style>

<body>

    <div class="ma3">
        <article class="tc w-75 center pt5 pb2 ph3 mw6-ns ba bw1 b--light-gray" style="background: #fff;">
            <header class="mb4">
                <img class="br-100" style="width: 200px" src="{{ asset('assets/banner/grandfther.png') }}" alt="Profile headshot" />
                <h1 class="f3 lh-title mv2 dark-gray">SISTEM PAKAR UNTUK MENDIAGNOSA PENYAKIT DEGENERATIF PADA LANJUT USIA</h1>
                <p class="f6 silver mt2 mb0"><a class="link dim silver"><button style="margin-bottom: 10px;"
                            type="button" class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                            title="Pengembang Aplikasi"><i class="fa fa-user" aria-hidden="true"></i> AGUNG</button></a>
                    <a class="link dim silver"><button style="margin-bottom: 10px;" type="button"
                            class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                            title="Pakar Aplikasi"><i class="fa fa-user-md" aria-hidden="true"></i></button></a>
                    <a class="link dim silver"><button style="margin-bottom: 10px;" type="button"
                            class="btn btn-secondary" data-toggle="tooltip" data-placement="bottom"
                            title="Dosen Pembimbing"><i class="fa fa-user-plus" aria-hidden="true"></i> </button></a></p>
                <br>
                <h2 class="f5 silver mt2 mb1">Sistem Pakar, Diagnosa Penyakit Degeneratif Pada Lanjut Usia</h2>
                <h2 class="f5 silver mt2 mb1">Copyright © 2022, <a class="link dim silver"></a></h2>
                <br>

            </header>
            <p class="f6 tl lh-copy silver" style="margin: 20px;">Sistem pakar yang mampu mendiagnosa penyakit pada lanjut usia(LANSIA)
                berdasarkan pengetahuan yang diberikan langsung dari pakar/ahlinya dan melalui studi literatur.
                Penelitian ini menggunakan metode perhitungan Certainty Factor (CF) dalam menghitung tingkat kepakaran.
                Data penelitian ini terdiri dari data gejala dan data penyakit pada lansia, serta data aturan. Sistem pakar
                pada bertujuan untuk analisis penyakit pada lansia.</p>
        </article>
    </div>
</body>

</html>
