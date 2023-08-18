<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Vesperr
  * Updated: Jul 27 2023 with Bootstrap v5.3.1
  * Template URL: https://bootstrapmade.com/vesperr-free-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <div class="logo">
        <h1><a href="index.html">Stock Opname</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
            <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
            <ul class="navbar-nav ms-auto mb-2 mb-md-0">
                        @auth
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="btn btn-dark" type="submit"><i class="fas fa-sign-out-alt"></i>
                                        Logout</button>
                                </form>
                        @else
                                <a  class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Sign In</a>
                        @endauth
            </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">

    <div class="container">
      <div class="row">
        <div class="col-lg-6 pt-5 pt-lg-0 order-2 order-lg-1 d-flex flex-column justify-content-center">
          <h1 data-aos="fade-up">Stock Opname</h1>
          <h2 data-aos="fade-up" data-aos-delay="400">Stock opname adalah proses menghitung fisik barang 
            yang kami miliki dan memastikan data dalam sistem sesuai.</h2>
          <div data-aos="fade-up" data-aos-delay="800">
            <ul class="btn-get-started scrollto">
                        @auth
                                <form action="/logout" method="post">
                                    @csrf
                                    <button class="btn btn-dark" type="submit"><i class="fas fa-sign-out-alt"></i>
                                        Logout</button>
                                </form>
                        @else
                                <a  class="nav-link" href="/login"><i class="fas fa-sign-in-alt"></i>Sign In</a>
                        @endauth
            </ul>
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="fade-left" data-aos-delay="200">
          <img src="assets/img/hero-img.png" class="img-fluid animated" alt="">
        </div>
      </div>
    </div>

  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Table ======= -->
    <section id="about" class="about">
      <div class="container">
         <table class="table">
               <thead>
                  <tr>
                     <th scope="col">No</th>
                     <th scope="col">Nama Barang</th>
                     <th scope="col">Jenis Barang</th>
                     <th scope="col">Jumlah Barang</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <th scope="row">1</th>
                     <td>Mark</td>
                     <td>Otto</td>
                     <td>@mdo</td>
                  </tr>
                  <tr>
                     <th scope="row">2</th>
                     <td>Jacob</td>
                     <td>Thornton</td>
                     <td>@fat</td>
                  </tr>
                  <tr>
                     <th scope="row">3</th>
                     <td colspan="2">Larry the Bird</td>
                     <td>@twitter</td>
                  </tr>
               </tbody>
         </table>
      </div>
    </section>
    <!-- ======= End Table ======= -->

    <!-- ======= About Us Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="section-title" data-aos="fade-up">
          <h2>About Us</h2>
        </div>

        <div class="row content">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="150">
            <p>
            Stock opname memiliki peran yang krusial dalam operasional perusahaan kami. Beberapa alasan mengapa stock opname penting:
            </p>
            <ul>
              <li><i class="ri-check-double-line"></i> Akurasi Persediaan</li>
              <li><i class="ri-check-double-line"></i> Deteksi Kehilangan atau Kehilangan Barang</li>
              <li><i class="ri-check-double-line"></i> Perencanaan dan Pengelolaan Persediaan yang Lebih Baik</li>
            </ul>
          </div>
          <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-up" data-aos-delay="300">
            <p>
            Stock opname merupakan proses penghitungan, pemeriksaan, dan pencatatan jumlah fisik dari semua barang atau produk yang tersedia di perusahaan
            pada suatu waktu tertentu. Tujuannya adalah untuk membandingkan jumlah fisik dengan catatan pada sistem informasi atau 
            catatan lainnya, guna memastikan keakuratan dan integritas persediaan kami.
            </p>
            <a href="#" class="btn-learn-more">Learn More</a>
          </div>
        </div>

      </div>
    </section><!-- End About Us Section -->
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <div class="row d-flex align-items-center">
        <div class="col-lg-6 text-lg-left text-center">
          <div class="copyright">
            &copy; Copyright <strong>StockOpname</strong>. All Rights Reserved
          </div>
          <div class="credits">
            <!-- All the links in the footer should remain intact. -->
            <!-- You can delete the links only if you purchased the pro version. -->
            <!-- Licensing information: https://bootstrapmade.com/license/ -->
            <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/vesperr-free-bootstrap-template/ -->
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
        </div>
        <div class="col-lg-6">
          <nav class="footer-links text-align-right text-center">
            <a href="#intro" class="scrollto">Home</a>
            <a href="#about" class="scrollto">About</a>
          </nav>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>