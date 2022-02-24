<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Pengadaan </title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('arsha/assets/img/favicon.png')}}" rel="icon">
    <link href="{{asset('arsha/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Jost:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{asset('arsha/assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('arsha/assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{asset('arsha/assets/css/style.css')}}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha - v4.7.1
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top ">
        <div class="container d-flex align-items-center">

            <h1 class="logo me-auto"><a href="index.html">Pengajuan</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <!.... masukan menu ..>
                @include('home.parsial.menu');

            </div>
        </header><!-- End Header -->

        <!-- ======= Hero Section ======= -->
        <section id="hero" class="d-flex align-items-center">

            <div class="container">
                <div class="row">
                    <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1" data-aos="fade-up" data-aos-delay="200">
                        <h1>Memberikan Kesempatan Kepada UMKM</h1>
                        <h2>Kami Memberikan Kesempatan Kepada UMKM yang ingin mengajukan Pengajuan barang atau jasa yang dimiliki</h2>
                        <div class="d-flex justify-content-center justify-content-lg-start">
                          @if($token == 'kosong')
                          <a href="/registrasi" class="btn-get-started scrollto">Daftar Sekarang</a>
                          @else
                          <a href="/listSup" class="btn-get-started scrollto">Ajukan  Sekarang</a>
                          <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
                          @endif
                      </div>
                  </div>
                  <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-in" data-aos-delay="200">
                    <img src="{{asset('arsha/assets/img/hero-img.png')}}" class="img-fluid animated" alt="">
                </div>
            </div>
        </div>

    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Clients Section ======= -->
        <section id="clients" class="clients section-bg">
            <div class="container">

                <div class="row" data-aos="zoom-in">

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-1.png')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-2.png')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-3.png')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-4.png')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-5.png')}}" class="img-fluid" alt="">
                    </div>

                    <div class="col-lg-2 col-md-4 col-6 d-flex align-items-center justify-content-center">
                        <img src="{{asset('arsha/assets/img/clients/client-6.png')}}" class="img-fluid" alt="">
                    </div>

                </div>

            </div>
        </section><!-- End Cliens Section -->


        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Ketentuan</h2>
                    <p>Untuk Pengajuan Pengadaan Memiliki Ketentuan Sebagai Berikut</p>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch" data-aos="zoom-in" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bxl-dribbble"></i></div>
                            <h4><a href="">Memiliki Izin Usaha</a></h4>
                            <p>Bagi Peserta Yang Ingin Mengajukan Pengajuan Wajib Terdaftar Atau Memiliki Izin Usaha</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="zoom-in" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-file"></i></div>
                            <h4><a href="">Usaha Min 3 Tahun</a></h4>
                            <p>Bagi Kamu Yang Memiliki Usaha Sudah Lama Lebih Atau Sama Dengan 3 Tahun Bisa Mengajukan Pengajuan</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-tachometer"></i></div>
                            <h4><a href="">Usaha Berbadan Hukum</a></h4>
                            <p>Usaha Kamu Wajib Berbadan Hukum Minimal CV dan Sudah Terdaftar Sekurang-kurangya 3 Tahun</p>
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6 d-flex align-items-stretch mt-4 mt-xl-0" data-aos="zoom-in" data-aos-delay="400">
                        <div class="icon-box">
                            <div class="icon"><i class="bx bx-layer"></i></div>
                            <h4><a href="">Memiliki Rekening Perusahaan</a></h4>
                            <p>Untuk Rekening usaha Wajib Terpisah Dari Rekening Pribadi Dan Untuk Bank Yang Terdaftar Wajib BUMN</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Cta Section ======= -->
        <!-- End Cta Section -->

        <!-- ======= Portfolio Section ======= -->
        <section id="portfolio" class="portfolio">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Daftar Pengadaan</h2>
                    <p>Berikut Adalah Daftar Pengadaan Yang Sedang Aktif</p>
                </div>

                <div class="row portfolio-container" data-aos="fade-up" data-aos-delay="200">

                    @foreach($pengadaan as $p)
                    <a href="{{$p->deskripsi}}" target="_blank">
                        <div class="col-lg-4 col-md-6 portfolio-item filter-app">
                            <div class="portfolio-img"><img src="{{asset(Storage::url($p->gambar))}}" class="img-fluid" alt=""></div>
                            <div class="portfolio-info">
                                <h4>{{$p->nama_pengadaan}}</h4>
                                <p>Anggaran: Rp{{number_format($p-> anggaran,0,",",".")}}</p>

                            </div>
                        </a>
                    </div>

                    @endforeach
                </div>
            </section><!-- End Portfolio Section -->



            <div class="d-flex justify-content-center">{{$pengadaan->links()}}</div>

            <section id="cta" class="cta">
                <div class="container" data-aos="zoom-in">

                    <div class="row">
                        <div class="col-lg-9 text-center text-lg-start">
                            <h3>Ajukan Pengajuan</h3>
                            <p>Kamu Dapat Daftarkan Usaha Kamu Agar Dapat Mengajukan Pengajuan Dari Setiap Bidang Yang Dibutuhkan</p>
                        </div>
                        <div class="col-lg-3 cta-btn-container text-center">
                           @if($token == 'kosong')
                           <a class="cta-btn align-middle" href="/registrasi">Daftar Sekarang</a>
                           @else
                           <a class="cta-btn align-middle" href="/listSup">Ajukan Sekarang</a>
                           @endif
                       </div>
                   </div>

               </div>
           </section>


           <!-- ======= Footer ======= -->
           <footer id="footer">
            <div class="footer-top">
                <div class="container">
                    <div class="row">

                        <div class="col-lg-3 col-md-6 footer-contact">
                            <h3>Pengadaan</h3>
                            <p>
                                A108 Adam Street <br>
                                New York, NY 535022<br>
                                United States <br><br>
                                <strong>Phone:</strong> +1 5589 55488 55<br>
                                <strong>Email:</strong> info@example.com<br>
                            </p>
                        </div>
                        <div class="col-lg-3 col-md-6 footer-links">
                            <h4>Our Social Networks</h4>
                            <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                            <div class="social-links mt-3">
                                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container footer-bottom clearfix">
                <div class="copyright">
                    &copy; Copyright <strong><span>Pengadaan</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
        </footer><!-- End Footer -->

        <div id="preloader"></div>
        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

        <!-- Vendor JS Files -->
        <script src="{{asset('arsha/assets/vendor/aos/aos.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/waypoints/noframework.waypoints.js')}}"></script>
        <script src="{{asset('arsha/assets/vendor/php-email-form/validate.js')}}"></script>

        <!-- Template Main JS File -->
        <script src="{{asset('arsha/assets/js/main.js')}}"></script>

    </body>

    </html>