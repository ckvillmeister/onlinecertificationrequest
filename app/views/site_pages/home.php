<html lang="en">

<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title id="sys_title"><?php echo ($data['settings']['Title']['desc']) ? $data['settings']['Title']['desc'] : "" ; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/img/favicon.png" rel="icon">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/icofont/icofont.min.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/venobox/venobox.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/jquery-confirm.min.css">
  <!-- Template Main CSS File -->
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/css/style.css" rel="stylesheet">

</head>

<body>
  <!-- ======= Top Bar ======= -->
  <div id="topbar" class="d-none d-lg-flex align-items-center fixed-top">
    <div class="container d-flex">
      <div class="contact-info mr-auto">
        <i class="icofont-envelope"></i> <a href="mailto:contact@example.com"><?php echo ($data['settings']['E-mail Address']['desc']) ? $data['settings']['E-mail Address']['desc'] : "" ; ?></a>
        <i class="icofont-phone"></i> <?php echo ($data['settings']['Contact Number']['desc']) ? $data['settings']['Contact Number']['desc'] : "" ; ?>
        <i class="icofont-google-map"></i> <?php echo ($data['settings']['Business Address']['desc']) ? $data['settings']['Business Address']['desc'] : "" ; ?>
      </div>
      <div class="social-links">
        <a href="#" class="twitter"><i class="icofont-twitter"></i></a>
        <a href="#" class="facebook"><i class="icofont-facebook"></i></a>
        <a href="#" class="instagram"><i class="icofont-instagram"></i></a>
        <a href="#" class="skype"><i class="icofont-skype"></i></a>
        <a href="#" class="linkedin"><i class="icofont-linkedin"></i></i></a>
      </div>
    </div>
  </div>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

      <h1 class="logo mr-auto">
        <a href="<?php echo ROOT; ?>" style="color: #218838">
        <?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?>
        </a>
      </h1>
      <!-- Uncomment below if you prefer to use an image logo -->
      <!-- <a href="index.html" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

      <nav class="nav-menu d-none d-lg-block">
        <ul>
          <li class="active"><a href="<?php echo ROOT; ?>">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#services">Services</a></li>
          <li><a href="#contact">Contact</a></li>
          <li><a href="#" id="login_link">Login</a></li>
        </ul>
      </nav><!-- .nav-menu -->

      <a href="#appointment" class="appointment-btn scrollto">Request Certificate</a>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center" style='background: url("<?php echo ROOT.MEDILAB_BS; ?>assets/img/banner.jpg") top center;'>
    <div class="container">
      <!--<h2>Welcome to</h2>
      <h1><?php //echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?></h1>
      <h2><?php //echo ($data['settings']['Clinic Doctor']['desc']) ? $data['settings']['Clinic Doctor']['desc'] : "" ; ?></h2>
      <a href="#about" class="btn-get-started scrollto">Get Started</a>-->
    </div>
  </section><!-- End Hero -->

  <main id="main">

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
      <div class="container">

        <div class="row">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="content">
              <h3><?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?></h3>
              <p>
                <?php echo ($data['settings']['Clinic Doctor']['desc']) ? $data['settings']['Clinic Doctor']['desc'] : "" ; ?>
              </p>
              <div class="text-center">
                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div>
          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-receipt"></i>
                    <h4>Corporis voluptates sit</h4>
                    <p>Consequuntur sunt aut quasi enim aliquam quae harum pariatur laboris nisi ut aliquip</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-cube-alt"></i>
                    <h4>Ullamco laboris ladore pan</h4>
                    <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt</p>
                  </div>
                </div>
                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-images"></i>
                    <h4>Labore consequatur</h4>
                    <p>Aut suscipit aut cum nemo deleniti aut omnis. Doloribus ut maiores omnis facere</p>
                  </div>
                </div>
              </div>
            </div><!-- End .content-->
          </div>
        </div>

      </div>
    </section><!-- End Why Us Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container-fluid">

        <div class="row">
          <div class="col-xl-5 col-lg-6 video-box d-flex justify-content-center align-items-stretch">
            <a href="https://www.youtube.com/watch?v=jDDaplaOz7Q" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>Enim quis est voluptatibus aliquid consequatur fugiat</h3>
            <p>Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi. Libero laboriosam sint et id nulla tenetur. Suscipit aut voluptate.</p>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-fingerprint"></i></div>
              <h4 class="title"><a href="">Lorem Ipsum</a></h4>
              <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-gift"></i></div>
              <h4 class="title"><a href="">Nemo Enim</a></h4>
              <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque</p>
            </div>

            <div class="icon-box">
              <div class="icon"><i class="bx bx-atom"></i></div>
              <h4 class="title"><a href="">Dine Pad</a></h4>
              <p class="description">Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis</p>
            </div>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p></p>
        </div>

        <div class="row">
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch">
            <div class="icon-box">
              <div class="icon"><i class="icofont-heart-beat"></i></div>
              <h4><a href="">Lorem Ipsum</a></h4>
              <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0">
            <div class="icon-box">
              <div class="icon"><i class="icofont-drug"></i></div>
              <h4><a href="">Sed ut perspiciatis</a></h4>
              <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0">
            <div class="icon-box">
              <div class="icon"><i class="icofont-dna-alt-2"></i></div>
              <h4><a href="">Magni Dolores</a></h4>
              <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="icofont-heartbeat"></i></div>
              <h4><a href="">Nemo Enim</a></h4>
              <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="icofont-disabled"></i></div>
              <h4><a href="">Dele cardo</a></h4>
              <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4">
            <div class="icon-box">
              <div class="icon"><i class="icofont-autism"></i></div>
              <h4><a href="">Divera don</a></h4>
              <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Certficate Request ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Request Certificate</h2>
          <p></p>
        </div>

        <!--<form action="" method="post" role="form" class="php-email-form">-->
        <div class="php-email-form">
          <div class="form-row">
            <div class="col-md-3 form-group">
              <input type="text" name="name" class="form-control" id="text_firstname" placeholder="First Name" data-rule="minlen:1" data-msg="Please enter your first name">
              <div class="error-message-firstname"></div>
            </div>
            <div class="col-md-3 form-group">
              <input type="text" class="form-control" name="text" id="text_middlename" placeholder="Middle Name">
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group">
              <input type="tel" class="form-control" name="phone" id="text_lastname" placeholder="Last Name" data-rule="minlen:1" data-msg="Please enter your last name">
              <div class="error-message-lastname"></div>
            </div>
            <div class="col-md-3 form-group">
              <select id="cbo_extension" class="form-control">
                <option value=""> [ Extension ] </option>
                <option value="Jr.">Jr.</option>
                <option value="Sr.">Sr.</option>
                <option value="I">I</option>
                <option value="II">II</option>
                <option value="III">III</option>
                <option value="IV">IV</option>
                <option value="V">V</option>
              </select>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-3 form-group">
              <select id="cbo_sex" class="form-control">
                <option value=""> [ Sex ] </option>
                <option value="MALE">Male</option>
                <option value="FEMALE">Female</option>
              </select>
            </div>
            <div class="col-md-3 form-group">
              <input type="datetime" name="text_dob" class="form-control datepicker" id="text_dob" placeholder="Date of Birth" data-rule="minlen:4" data-msg="Please select date of birth">
              <div class="validate"></div>
            </div>
            <div class="col-md-3 form-group">
              <input type="text" class="form-control" name="text" id="text_contactno" placeholder="Contact Number" data-rule="minlen:1" data-msg="Please enter your contact number">
              <div class="error-message-contactno"></div>
            </div>
            <div class="col-md-3 form-group">
              <input type="datetime" name="text_pickupdate" class="form-control datepicker" id="text_pickupdate" placeholder="Pick-up Date" data-rule="minlen:4" data-msg="Please select pick-up date">
              <div class="validate"></div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-12 form-group">
              <input type="text" name="name" class="form-control" id="text_address" placeholder="Complete Address" data-rule="minlen:1" data-msg="Please enter your complete address">
              <div class="error-message-address"></div>
            </div>
          </div>
          <div class="mb-3">
            <div class="message-request"></div>
          </div>
          <div class="text-center"><button type="submit" id="btn_submitrequest">Submit Request</button></div>
        </div>
        <!--</form>-->

      </div>
    </section>
    <br>
    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg mt-5">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p></p>
        </div>

        <div class="faq-list">
          <ul>
            <li data-aos="fade-up">
              <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
              <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                <p>
                  Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
                </p>
              </div>
            </li>
          </ul>
        </div>

      </div>
    </section>
    <!-- End Frequently Asked Questions Section -->

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container">

        <div class="section-title">
          <h2>Gallery</h2>
          <p></p>
        </div>
      </div>

      <div class="container-fluid">
        <div class="row no-gutters">

          <div class="col-lg-3 col-md-4">
            <div class="gallery-item">
              <a href="assets/img/gallery/gallery-1.jpg" class="venobox" data-gall="gallery-item">
                <img src="<?php echo ROOT.MEDILAB_BS; ?>assets/img/gallery/gallery-1.jpg" alt="" class="img-fluid">
              </a>
            </div>
          </div>

        </div>
      </div>
    </section><!-- End Gallery Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="section-title">
          <h2>Contact Information and Location</h2>
          <p></p>
        </div>
      </div>

      <div class="container">
        <div class="row">

          <div class="col-lg-4">
            <div class="info">
              <div class="email">
                <i class="icofont-google-map"></i>
                <h4>Location:</h4>
                <p><?php echo ($data['settings']['Business Address']['desc']) ? $data['settings']['Business Address']['desc'] : "" ; ?></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info">
              <div class="email">
                <i class="icofont-envelope"></i>
                <h4>Email:</h4>
                <p><?php echo ($data['settings']['E-mail Address']['desc']) ? $data['settings']['E-mail Address']['desc'] : "" ; ?></p>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="info">
              <div class="phone">
                <i class="icofont-phone"></i>
                <h4>Call:</h4>
                <p><?php echo ($data['settings']['Contact Number']['desc']) ? $data['settings']['Contact Number']['desc'] : "" ; ?></p>
              </div>
            </div>
          </div>

        </div>

      <div class="mr-3 ml-3 mt-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d245.51536068332967!2d124.34343790958081!3d10.078937286893186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a9f99a64e63b33%3A0xb03df9111446536a!2sCebuana%20Lhuillier%20Pawnshop%20-%20TRINIDAD%20BOHOL!5e0!3m2!1sen!2sph!4v1617351579828!5m2!1sen!2sph" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
      </div>

      </div>
    </section>e
    <!-- End Contact Section -->

    <div class="modal fade" id="login">
        <div class="modal-dialog">
          <div class="modal-content" style="background-color: #fcfcfa;">
            <img src="<?php echo ROOT.MEDILAB_BS; ?>assets/img/sure-care.png" class="mt-5 ml-5 mr-5">

            <div class="form-row mt-5 ml-5 mr-5">
              <div class="col-md-12 form-group">
                <input type="text" name="text_username" class="form-control" id="text_username" placeholder="Username">
              </div>
            </div>
            <div class="form-row ml-5 mr-5"> 
              <div class="col-md-12 form-group">
                <input type="password" class="form-control" name="text_password" id="text_password" placeholder="Password">
              </div>
            </div>
            <div class="form-row ml-5 mr-5"> 
              <div class="col-md-6 form-group">
                <button class="btn btn-md btn-primary form-control" id="btn_login">Log In</button>
              </div>
              <div class="col-md-6 form-group">
                <button class="btn btn-md btn-secondary form-control" data-dismiss="modal" id="btn_login">Close</button>
              </div>
            </div>
            <div class="form-row ml-5 mr-5 mb-5">
              <div id="authentication-message"></div>
            </div>

          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="container d-md-flex py-4">

      <div class="mr-md-auto text-center text-md-left">
        <div class="copyright">
          <strong><span><?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?></span></strong>. 
        </div>
        <div class="credits">
          Credits to <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/jquery.easing/jquery.easing.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/venobox/venobox.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/waypoints/jquery.waypoints.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/counterup/counterup.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
  <script src="<?php echo ROOT.BOOTSTRAP; ?>dist/js/jquery-confirm.min.js"></script>
  <!-- Template Main JS File -->
  <script src="<?php echo ROOT.MEDILAB_BS; ?>assets/js/main.js"></script>
  <script src="<?php echo ROOT; ?>public/js/home.js"></script>
  <script type="text/javascript">
    $('#login_link').click(function(){
      setTimeout(function() { $('#text_username').focus() }, 500);
      $('#login').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
    });
  </script>
</body>

</html>