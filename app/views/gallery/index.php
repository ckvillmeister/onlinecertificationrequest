<!DOCTYPE html>
<html>

<head>
  <?php require 'app/views/components/header.php'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

<div class="wrapper">
  <?php require 'app/views/components/navbar.php'; ?>
  <?php require 'app/views/components/sidebar.php'; ?>

    <div class="content-wrapper">
        <div class="content-header">
          <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Gallery</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo ROOT; ?>main">Main</a></li>
                <li class="breadcrumb-item active">Gallery</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="card">

            <div class="row p-3 shadow-none m-3 bg-light rounded">
              <div class="col-lg-12 align-self-center">
                <button class="btn btn-sm btn-primary" id="btn_new_photo" data-toggle="modal" data-target="#modal_photo_form"><icon class="fas fa-plus mr-2"></icon>New Photo</button>
                <button class="btn btn-sm btn-secondary" id="btn_active"><icon class="fas fa-check mr-2"></icon>Active</button>
                <button class="btn btn-sm btn-danger" id="btn_trash"><icon class="fas fa-trash mr-2"></icon>Trash</button>
              </div>
            </div>

            <div id="gallery_list" class="mr-3 ml-3 mb-3">
            </div>

          </div>    
        </div>
      </section>
    </div>

    <div class="modal fade" id="modal_photo_form" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modal_title">Upload Photo</h5>
          </div>
          <div class="modal-body">

            <div class="row mt-3">
              <div class="col-lg-3 align-self-center">
                  Caption:
              </div>
              <div class="col-lg-9">
                  <input type="text" class="form-control form-control-sm" id="text_caption">
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-lg-3 align-self-center">
                  Upload:
              </div>
              <div class="col-lg-9">
                <input type="file" accept="image/*" id="upload_photo" onchange="imagePreview(this);">
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-lg-3 align-self-center">
              </div>
              <div class="col-lg-9">
                <img class="rounded border border-info" width="300" height="300" id="img_photo_preview">
              </div>
            </div>

            <div class="row mt-3 mr-0 ml-0 p-2 bg-light rounded">
              <div class="col-lg-8">
                <span id="message"></span>
              </div>
              <div class="col-lg-4">
                <div class="float-right">
                  <button class="btn btn-sm btn-success" id="btn_submit"><icon class="fas fa-thumbs-up mr-2"></icon>Submit</button>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

<?php require 'app/views/components/footer_banner.php'; ?>
</div>

</body>
<?php require 'app/views/components/footer.php'; ?>
<script type="text/javascript" src="<?php echo ROOT.'public/js/gallery.js'; ?>"></script>
<script type="text/javascript">
  function imagePreview(input){
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        $('#img_photo_preview')
            .attr('src', e.target.result);
      };
      reader.readAsDataURL(input.files[0]);
    } 
  }
</script>
</html>