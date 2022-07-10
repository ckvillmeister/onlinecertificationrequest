<html lang="en">

<head>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title id="sys_title"><?php echo ($data['settings']['Title']['desc']) ? $data['settings']['Title']['desc'] : "" ; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
   <link rel="icon" href="<?php echo ($data['settings']['System Logo']['desc']) ? ROOT.$data['settings']['System Logo']['desc'] : "" ; ?>">
  <link href="<?php echo ROOT.MEDILAB_BS; ?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->

  <!-- Vendor CSS Files -->
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/fontawesome-free/css/all.min.css">
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
  <style type="text/css">
    .sure_care_image{
      z-index: 2;
      position: absolute;
      margin-top: 8%;
    }

    .overlay-wrapper{
      z-index: 2;
      position: absolute;
    top: 50%;
    left: 50%;
    margin-top: -50px;
    margin-left: -50px;
    width: 100px;
    height: 100px;
    }

    @media (max-width: 991px) {
      .sure_care_image{
        margin-top: 30%;
        width: 100%;
        height: 10%;
        text-align: center;
      }

      .bisname{
        font-size: 10pt;
      }
      
    }

    @media (max-width: 1199px) {
      .sure_care_image{
        margin-top: 5%;
        width: 100%;
        height: 50%;
        text-align: center;
      }

      #main{
        margin-top: -5%;
      }

      .bisname{
        font-size: 10pt;
      }
    }
  </style>
<div id="basicloader" style="display:none;width: 100%;position: fixed;left: 0px;top: 0px;height: 100%;z-index: 10000;background-color:rgba(0,0,0,0.5);">
    <img src="<?php echo ROOT; ?>public/image/loader.gif" style="position: absolute;top: 0px;left: 0px;right: 0px;bottom: 0px;margin: auto;width: 80px;height: auto;">
    <div style="position: absolute;top: 150px;left: 0px;right: 0px;bottom: 0px;margin: auto; width: 100%;height: 100px;text-align:center; padding-top:20px" ><h3 style="color:white;" id="basic-loader-msg">Loading...</h3></div>
</div>
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
        <a href="<?php echo ROOT; ?>" style="color: #218838" class="bisname">
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
  <img src="<?php echo ROOT.MEDILAB_BS; ?>assets/img/sure-care.png" class="sure_care_image">
  <section id="hero" class="d-flex align-items-center banner" style='position: relative; z-index: 0; background: url("<?php echo ROOT.MEDILAB_BS; ?>assets/img/banner.jpg") top center;'>
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
              <h3 id="biz_name"><?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?></h3>
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
                    <i class="bx bx-cloud-upload"></i>
                    <h4>Online Medical Certificate Request</h4>
                    <p>Request medical certificate through online</p>
                  </div>
                </div>

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-current-location"></i>
                    <h4>Location</h4>
                    <p><?php echo ($data['settings']['Business Address']['desc']) ? $data['settings']['Business Address']['desc'] : "" ; ?> beside Cebuana Lhuiller Pawnshop</p>
                  </div>
                </div>

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box mt-4 mt-xl-0">
                    <i class="bx bx-time"></i>
                    <h4><?php echo ($data['settings']['Clinic Schedule']['name']) ? $data['settings']['Clinic Schedule']['name'] : "" ; ?></h4>
                    <p><?php echo ($data['settings']['Clinic Schedule']['desc']) ? $data['settings']['Clinic Schedule']['desc'] : "" ; ?></p>
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
            <a href="#" class="venobox play-btn mb-4" data-vbtype="video" data-autoplay="true"></a>
          </div>

          <div class="col-xl-7 col-lg-6 icon-boxes d-flex flex-column align-items-stretch justify-content-center py-5 px-lg-5">
            <h3>About <?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?></h3>
            <p>
              <?php echo ($data['settings']['Business Name']['desc']) ? $data['settings']['Business Name']['desc'] : "" ; ?> 
              located at 
              <?php echo ($data['settings']['Business Address']['desc']) ? $data['settings']['Business Address']['desc'] : "" ; ?> 
              is owned by 
              <?php echo ($data['settings']['Clinic Doctor']['desc']) ? $data['settings']['Clinic Doctor']['desc'] : "" ; ?>.
              
            </p>

            <?php 
              $ctr = 0;
              $icofont = '';
              foreach ($data['services'] as $key => $service) {
            ?>
                <div class="icon-box">
                  <div class="icon"><i class="bx bx-tag-alt"></i></div>
                  <h4 class="title"><a href=""><?php echo $service['name']; ?></a></h4>
                  <p class="description"><?php echo $service['desc']; ?></p>
                </div>
            <?php
                $ctr++;
                if ($ctr == 3){
                  break;
                }
              }
            ?>

          </div>
        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Certficate Request ======= -->
    <section id="appointment" class="appointment section-bg">
      <div class="container">

        <!-- <form id="frmCertRequest"> -->
          <div class="section-title">
            <h2>Request Certificate</h2>
            <p></p>
          </div>
          <div class="overlay-wrapper">
          </div>
          <!--<form action="" method="post" role="form" class="php-email-form">-->
          <div class="php-email-form">
            <div class="form-row">
              <div class="col-md-12 text-dark">
                <p><strong style="color: red"><em>Note: Please book your pick-up date the day after your request</em></strong></p>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-3 form-group">
                <label for="text_firstname"><strong>First Name</strong></label>
                <input type="text" name="name" class="form-control" id="text_firstname" placeholder="" data-rule="minlen:1" data-msg="Please enter your first name" style="border-radius: 5px">
                <div class="error-message-firstname"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="text_middlename"><strong>Middle Name</strong></label>
                <input type="text" class="form-control" name="text" id="text_middlename" placeholder="" style="border-radius: 5px">
                <div class="validate"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="text_lastname"><strong>Last Name</strong></label>
                <input type="text" class="form-control" name="phone" id="text_lastname" placeholder="" data-rule="minlen:1" data-msg="Please enter your last name" style="border-radius: 5px">
                <div class="error-message-lastname"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="cbo_extension"><strong>Name Extension</strong></label>
                <select id="cbo_extension" class="form-control" style="border-radius: 5px">
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
                <label for="cbo_sex"><strong>Sex</strong></label>
                <select id="cbo_sex" class="form-control" style="border-radius: 5px">
                  <option value=""> [ Sex ] </option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                </select>
              </div>
              <div class="col-md-3 form-group">
                <label for="datetime"><strong>Date of Birth</strong></label>
                <input type="datetime" name="text_dob" class="form-control datepicker" id="text_dob" placeholder="Date of Birth" data-rule="minlen:4" data-msg="Please select date of birth" style="border-radius: 5px">
                <div class="validate"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="text_contactno"><strong>Contact Number</strong></label>
                <input type="text" class="form-control" name="text" id="text_contactno" placeholder="(09XX-XXXXXXXX)" data-rule="minlen:1" data-msg="Please enter your contact number" style="border-radius: 5px">
                <div class="error-message-contactno"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="text_pickupdate"><strong>Pick-up Date</strong></label>
                <input type="datetime" name="text_pickupdate" class="form-control datepicker" id="text_pickupdate" placeholder="Pick-up Date" data-rule="minlen:4" data-msg="Please select pick-up date" style="border-radius: 5px">
                <div class="error-message-pickupdate"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-3 form-group">
                <!--<input type="text" name="name" class="form-control" id="text_address" placeholder="Complete Address (Purok, Barangay, Municipality / City, Province" data-rule="minlen:1" data-msg="Please enter your complete address">
                -->
                <label for="text_prov"><strong>Province</strong></label>
                <input type="text" name="name" class="form-control" id="text_prov" placeholder="Address (Province)" value="Bohol" readonly="readonly" style="border-radius: 5px">
                <div class="error-message-address"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="cbo_muncity"><strong>Municipality / City</strong></label>
                <select id="cbo_muncity" class="form-control" style="border-radius: 5px">
                  <option value=""> [ Municipality/City ] </option>
                  <?php
                    foreach ($data['muncities'] as $key => $muncity) {
                      echo "<option data-id='".$muncity['cmcode']."' value='".ucwords(strtolower($muncity['desc']))."'>".ucwords(strtolower($muncity['desc']))."</option>";
                    }
                  ?>
                </select>
                 <div class="error-message-addrmuncity"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="cbo_barangay"><strong>Barangay</strong></label>
                <select id="cbo_barangay" class="form-control" style="border-radius: 5px">
                  <option value=""> [ Barangay ] </option>
                </select>
                <div class="error-message-addrbrgy"></div>
              </div>
              <div class="col-md-3 form-group">
                <label for="cbo_purok"><strong>Purok / Sitio</strong></label>
                <input list="puroks" class="form-control" id="cbo_purok" style="border-radius: 5px">
                <datalist id="puroks">
                  <option value=""> [ Purok ] </option>
                  <option value="Purok 1"> Purok 1 </option>
                  <option value="Purok 2"> Purok 2 </option>
                  <option value="Purok 3"> Purok 3 </option>
                  <option value="Purok 4"> Purok 4 </option>
                  <option value="Purok 5"> Purok 5 </option>
                  <option value="Purok 6"> Purok 6 </option>
                  <option value="Purok 7"> Purok 7 </option>
                </datalist>
                <div class="error-message-course"></div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 form-group">
                <label for="cbo_schools"><strong>Name of School</strong></label>
                <select id="cbo_schools" class="form-control" style="border-radius: 5px">
                  <option value=""> [ School ] - <i>For Students</i> </option>
                  <?php
                    foreach ($data['schools'] as $key => $school) {
                      echo "<option data-id='".$school['id']."' value='".ucwords(strtolower($school['school']))."'>".ucwords(strtolower($school['school']))."</option>";
                    }
                  ?>
                </select>
                <div class="error-message-addrpurok"></div>
              </div>
              <div class="col-md-6 form-group">
                <label for="cbo_courses"><strong>Course</strong></label>
                <select id="cbo_courses" class="form-control" style="border-radius: 5px">
                  <option value=""> [ Course ] - <i>For Students</i> </option>
                </select>
                <div class="error-message-course"></div>
              </div>
            </div>
            <br>
            <div class="form-row">
              <div class="col-md-12 text-center">
                <h5><strong>Symptoms Checklist</strong></h5>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-12 text-dark">
                <p><strong style="">Please check if you're experiencing the following: </strong></p>
              </div>
            </div>
            <div class="form-row" id="symptoms_checklist">
              <?php 
                foreach ($data['checklist'] as $key => $symptom) {
              ?>
                <div class="col-md-4 p-1">
                  <div class="bg-light">
                    <h6>
                      <input type="checkbox" class="align-middle ml-3 mr-2" value="<?php echo $symptom['id']; ?>" data-desc="<?php echo $symptom['desc']; ?>">
                      <?php echo $symptom['desc']; ?>
                    </h6>
                  </div>
                </div>
              <?php
                }
              ?>
            </div>
            <div class="mb-3">
              <div class="message-request"></div>
            </div>
            <div class="text-center"><button type="submit" id="btn_submitrequest">Submit Request</button></div>
          </div>
        <!-- </form> -->

      </div>
    </section>

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container">

        <div class="section-title">
          <h2>Services</h2>
          <p></p>
        </div>

        <div class="row">

          <?php 
              foreach ($data['services'] as $key => $service) {
            ?>
              <div class="col-sm-4 mb-4">
                <div class="icon-box">
                  <div class="icon"><i class="icofont-heart-beat"></i></div>
                  <h4><a><?php echo $service['name']; ?></a></h4>
                  <p><?php echo $service['desc']; ?> </p>
                </div>
              </div>
            <?php
              }
            ?>
          <!--<div class="col-lg-4 col-md-6 d-flex align-items-stretch">
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
          </div>-->

        </div>

      </div>
    </section><!-- End Services Section -->

    <!-- ======= Frequently Asked Questions Section ======= -->
    <section id="faq" class="faq section-bg mt-5">
      <div class="container">

        <div class="section-title">
          <h2>Frequently Asked Questions</h2>
          <p></p>
        </div>

        <div class="faq-list">
          <ul>
            <?php 
              foreach ($data['faqs'] as $key => $faq) {
            ?>
              <li data-aos="fade-up">
                <i class="bx bx-help-circle icon-help"></i> 
                  <a data-toggle="collapse" class="collapse" href="#faq-list-1">
                    <?php echo $faq['question']; ?> 
                    <i class="bx bx-chevron-down icon-show"></i>
                    <i class="bx bx-chevron-up icon-close"></i>
                  </a>
                <div id="faq-list-1" class="collapse show" data-parent=".faq-list">
                  <p>
                    <?php echo $faq['answer']; ?> 
                  </p>
                </div>
              </li>
            <?php
              }
            ?>
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

          <?php 
              foreach ($data['photos'] as $key => $photo) {
            ?>
                <div class="col-lg-3 col-md-4">
                  <div class="gallery-item">
                    <!--<a href="<?php echo ROOT.$photo['url'] ?>" class="venobox" data-gall="gallery-item">-->
                      <img src="<?php echo ROOT.$photo['url'] ?>" alt="<?php echo ROOT.$photo['caption'] ?>" class="img-fluid">
                    <!--</a>-->
                  </div>
                </div>
          <?php
              }
            ?>

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

      <div class="modal fade mobile-nav-overly" id="login">
        <div class="modal-dialog">
          <div class="modal-content"> <!--style="opacity: 0.5 !important;">-->
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

      <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header card-info card-outline">
              <h5 class="modal-title" id="modal_title">Confirm</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="modal_confirm_content">
            </div>
            <div class="modal-footer"> 
              <div class="float-right">
                <button class="btn btn-sm btn-primary mr-2" id="btn_confirm">Confirm</button>
                <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
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
          Credits to <a href="https://bootstrapmade.com/">BootstrapMade</a> and <a href="https://adminlte.io/">AdminLTE</a>
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
      //$('body').toggleClass('mobile-nav-active');
      setTimeout(function() { $('#text_username').focus() }, 500);
      $('#login').modal({
                        backdrop: 'static',
                        keyboard: false
                    })
    });
  </script>
</body>

</html>