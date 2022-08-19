<title>Beranda - Certainty Factor</title>

	<div class='row'>
        <div class='col-lg-3 col-xs-6'>
          <!-- small box -->
          <div class='small-box bg-aqua'>
            <div class='inner'>
              <h3> {{ $gejala }}</h3>
              <p>Total Gejala</p>
            </div>
            <div class='icon'>
              <i class='ion ion-thermometer'></i>
            </div>
          </div>
        </div>
        <!-- ./col -->

        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{ $pengetahuan }}</h3>

              <p>Total Pengetahuan</p>
            </div>
            <div class="icon">
              <i class="ion ion-erlenmeyer-flask"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3> {{ $penyakit }}</h3>

                <p>Total Penyakit</p>
              </div>
              <div class="icon">
                <i class="ion ion-bug"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
                <h3>{{ $user }}</h3>
              <p>Total Admin Pakar</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
      </div>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                  <li data-target="#carousel-example-generic" data-slide-to="0" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="1" class=""></li>
                  <li data-target="#carousel-example-generic" data-slide-to="2" class="active"></li>
                </ol>
                <div class="carousel-inner">
                  <div class="item active">
                    <img src="{{ asset('assets/banner/slider_1.jpg') }}" alt="First slide">
                    <div class="carousel-caption">
                    </div>
                  </div>
                  <div class="item">
                    <img src="{{ asset('assets/banner/slider_2.jpg') }}" alt="Second slide">
                    <div class="carousel-caption">
                    </div>
                  </div><!--
                  <div class="item active">
                    <img src="aset/banner/daging.jpg" alt="Third slide">
                    <div class="carousel-caption">
                    </div>
                  </div>-->
                </div>
                <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                  <span class="fa fa-angle-left"></span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                  <span class="fa fa-angle-right"></span>
                </a>
              </div>
			  <br>
            <div class="row">
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="300ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 300ms; animation-name: fadeIn;">
                    <div class="single-service">

                            <img style="width: 100px" src="{{ asset('assets/banner/icon_1.gif') }}" alt="">

                        <h2>Aplikasi Responsif</h2>
                        <p>Aplikasi sistem pakar ini dapat menyesuaikan ukuran perangkat anda, jadi walupun di akses melalui perangkat mobile tetap nyaman juga.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="600ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 600ms; animation-name: fadeIn;">
                    <div class="single-service">


                        <img style="width: 100px" src="{{ asset('assets/banner/icon_1.gif') }}" alt="">

                        <h2>Akurat</h2>
                        <p>Sistem Pakar ini terus di sesuaikan perhitungan diagnosanya, supaya akurasi terhadap penyakit yang diderita lebih sesuai dan  menjadi acuan setiap pengguna.</p>
                    </div>
                </div>
                <div class="col-sm-4 text-center padding wow fadeIn animated" data-wow-duration="1000ms" data-wow-delay="900ms" style="visibility: visible; animation-duration: 1000ms; animation-delay: 900ms; animation-name: fadeIn;">
                    <div class="single-service">

                        <img style="width: 100px" src="{{ asset('assets/banner/icon_1.gif') }}" alt="">
                        <h2>Admin Pakar</h2>
                        <p>Terdapat fitur admin pakar, untuk mengatur pengetahuan dan CF pakar, telah di sesuaikan tampilannya sehingga pakar bisa lebih mengeksplore aplikasi.</p>
                    </div>
                </div>
            </div>
        <div></div>
