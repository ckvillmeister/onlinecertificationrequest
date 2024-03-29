<!DOCTYPE html>
<html>

<head>
  <?php require 'app/views/components/header.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" onload="changecolor()">

<div class="wrapper">
  <?php require 'app/views/components/navbar.php'; ?>
  <?php require 'app/views/components/sidebar.php'; ?>

    <?php
      
      $arr_settings = array();
      $settings = $data['settings'];
      foreach ($settings as $key => $setting) {
        $arr_settings[$setting['name']] = $setting['desc'];
      }
    ?>

    <div class="content-wrapper">
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">System Settings</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="main">Main</a></li>
                <li class="breadcrumb-item active">System Settings</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">

            <div class="card p-3 card-primary card-outline">
              <div class="row">
                <div class="col-5 col-sm-3">
                <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist" aria-orientation="vertical">
                  <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home" role="tab" aria-controls="vert-tabs-home" aria-selected="true">System Information</a>
                  <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile" role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Back-up Database</a>
                  <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill" href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages" aria-selected="false">System Images</a>
                </div>
              </div>
              <div class="col-7 col-sm-9">
                <div class="tab-content" id="vert-tabs-tabContent">
                  <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel" aria-labelledby="vert-tabs-home-tab">
                      <br>

                      <div class="row">
                        <div class="col-lg-12 align-self-center text-center">
                          <h4>System Information</h4>
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            System Name:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['System Name']) ? $arr_settings['System Name'] : '' ; ?>" id="text_system_name">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Site Title:
                        </div>
                        <div class="col-lg-6">
                          <input type="text" class="form-control" value="<?php echo ($arr_settings['Title']) ? $arr_settings['Title'] : '' ; ?>" id="text_site_title">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Business Name:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Business Name']) ? $arr_settings['Business Name'] : '' ; ?>" id="text_biz_name">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Business Address:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Business Address']) ? $arr_settings['Business Address'] : '' ; ?>" id="text_biz_add">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Clinic Schedule:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Clinic Schedule']) ? $arr_settings['Clinic Schedule'] : '' ; ?>" id="text_clinic_sched">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            E-mail Address:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['E-mail Address']) ? $arr_settings['E-mail Address'] : '' ; ?>" id="text_email">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Contact Number:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Contact Number']) ? $arr_settings['Contact Number'] : '' ; ?>" id="text_number">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Clinic Doctor:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Clinic Doctor']) ? $arr_settings['Clinic Doctor'] : '' ; ?>" id="text_doctor">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            License Number:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['License Number']) ? $arr_settings['License Number'] : '' ; ?>" id="text_licenseno">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            PTR:
                        </div>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['PTR']) ? $arr_settings['PTR'] : '' ; ?>" id="text_ptr">
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-3 align-self-center">
                            Certificate Font Color:
                        </div>
                        <div class="col-lg-6">
                          <div class="input-group my-colorpicker2">
                            <input type="text" class="form-control" value="<?php echo ($arr_settings['Certificate Font Color']) ? $arr_settings['Certificate Font Color'] : '' ; ?>" id="text_font_color">

                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-square"></i></span>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-lg-12 align-self-center">

                          <div class="float-right">
                            <button class="btn btn-sm btn-primary" id="btn_submit"><icon class="fas fa-thumbs-up mr-2"></icon>Submit</button>
                          </div>
                        </div>
                      </div> 
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel" aria-labelledby="vert-tabs-profile-tab">
                      <br>

                      <div class="row">
                        <div class="col-lg-12 align-self-center text-center">
                          <h4>Backup Database</h4>
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col-sm-12 text-center">
                          <button class="btn btn-sm btn-success" id="btn_backup"><icon class="fas fa-database mr-2"></icon>Click Me to Backup Database!</button>
                        </div>
                      </div>
                     
                  </div>
                  <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel" aria-labelledby="vert-tabs-messages-tab">
                    <br>

                    <div class="row">
                      <div class="col-lg-12 align-self-center text-center">
                        <h4>Upload Image</h4>
                      </div>
                    </div>

                    <div class="row mt-4">
                      <div class="col-lg-4 align-self-center">
                        Site Logo:
                      </div>
                      <div class="col-lg-8 align-self-center">
                          <input type="file" accept="image/*" id="system_image">
                          <button class="btn btn-sm btn-primary" id="btn_save_logo"><i class="fas fa-camera mr-3"></i>Save</button>
                      </div>
                    </div>

                    <div class="row mt-4">
                      <div class="col-lg-4 align-self-center">
                        Home Page Banner:
                      </div>
                      <div class="col-lg-8 align-self-center">
                          <input type="file" accept="image/*" id="system_bg_image">
                          <button class="btn btn-sm btn-primary" id="btn_save_bg_image"><i class="fas fa-camera mr-3"></i>Save</button>
                      </div>
                    </div>

                  </div>
                  <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel" aria-labelledby="vert-tabs-settings-tab">
                     Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate. Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst. Praesent imperdiet accumsan ex sit amet facilisis. 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>    
      </section>
    </div>

  <?php require 'app/views/components/footer_banner.php'; ?>
</div>

<div class="modal fade" id="modal_message_box" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_title"></h5>
      </div>
      <div class="modal-body">
        <h6 class="modal-body" id="modal_body"></h5>
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
</body>
<?php require 'app/views/components/footer.php'; ?>
<script type="text/javascript" src="<?php echo ROOT.'public/js/settings.js'; ?>"></script>
<script type="text/javascript">
  function changecolor(){
    $('.my-colorpicker2 .fa-square').css('color', "<?php echo $arr_settings['Certificate Font Color']; ?>");
  }
</script>
</html>