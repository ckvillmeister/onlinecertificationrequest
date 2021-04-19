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
              <h1 class="m-0 text-dark">Certification</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo ROOT; ?>main">Main</a></li>
                <li class="breadcrumb-item active">Certification</li>
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
                <button class="btn btn-sm btn-primary" id="btn_new_requests" data-toggle="modal" data-target="#modal_user_account_form"><icon class="fas fa-plus mr-2"></icon>New Requests</button>
                <button class="btn btn-sm btn-secondary" id="btn_approved_requests"><icon class="fas fa-check mr-2"></icon>Approved Requests</button>
                <button class="btn btn-sm btn-danger" id="btn_rejected_requests"><icon class="fas fa-trash mr-2"></icon>Rejected Requests</button>
              </div>
            </div>

            <div class="overlay-wrapper">
            </div>


            <div id="control_buttons" class="pr-3 pl-3 pb-3"> 
              <div class="row">
                <div class="col-lg-3">
                  <button class="btn btn-sm btn-secondary mr-1" style="width:110px" id="btn_approve_all">Approve All</button>
                </div>
              </div>
            </div>

            <div id="request_list" class="pr-3 pl-3 pb-3">
              

            </div>

          </div>    
        </div>
      </section>
    </div>

  <?php require 'app/views/components/footer_banner.php'; ?>
</div>

<div class="modal fade" id="modal_view_info" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header card-info card-outline">
        <h5 class="modal-title" id="modal_title">Patient's Information</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="row mt-3">
          <div class="col-lg-1 align-self-center">
              Fullname:
          </div>
          <div class="col-lg-3">
              <input type="text" class="form-control form-control-sm" placeholder="First Name" id="text_firstname">
          </div>
          <div class="col-lg-3 align-self-center">
              <input type="text" class="form-control form-control-sm" placeholder="Middle Name" id="text_middlename">
          </div>
          <div class="col-lg-3">
              <input type="text" class="form-control form-control-sm" placeholder="Last Name" id="text_lastname">
          </div>
          <div class="col-lg-2">
              <select class="form-control form-control-sm" id="cbo_extension">
                <option value=""> [ Extension ] </option>
              </select>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-1 align-self-center">
              Sex:
          </div>
          <div class="col-lg-3">
              <select class="form-control form-control-sm" id="cbo_sex">
                <option value=""> [ Male / Female ] </option>
                <option value="MALE">Male</option>
                <option value="FEMALE">Female</option>
              </select>
          </div>
          <div class="col-lg-1 align-self-center">
              Birthdate:
          </div>
          <div class="col-lg-3">
              <input type="date" class="form-control form-control-sm" placeholder="Date of Birth" id="text_dob">
          </div>
          <div class="col-lg-1 align-self-center">
              Contact:
          </div>
          <div class="col-lg-3">
              <input type="text" class="form-control form-control-sm" placeholder="Ex. 0909-1234567" id="text_contact">
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-1 align-self-center">
              Address:
          </div>
          <div class="col-lg-11">
              <input type="text" class="form-control form-control-sm" placeholder="Street/House No./Purok, Barangay, Municipality/City, Province" id="text_address">
          </div>
        </div>

        <div class="row p-1 shadow-none mt-3 mb-2 bg-light rounded">
          <div class="col-lg-12 text-center">
            <strong>Findings</strong>
          </div>
        </div>

        <div id="findings">
          <div class="row mt-3" id="always">
            <div class="col-lg-2 align-self-center">
                Finding #1:
            </div>
            <div class="col-lg-9" id="always">
                <input type="text" class="form-control form-control-sm" id="text_finding">
            </div>
            <div class="col-lg-1" id="always">
              <button class="btn btn-sm btn-primary" id="btn_add_findings"><i class="fas fa-plus"></i></button>
            </div>
          </div>
        </div>

        <div class="row p-1 shadow-none mt-5 mb-2 bg-light rounded">
          <div class="col-lg-12 text-center">
            <strong>Note</strong>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-12">
            <textarea class="form-control form-control-sm" rows="6" id="text_note"></textarea>
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-lg-8">
            <span id="message"></span>
          </div>
          <div class="col-lg-4">
            <div class="float-right">
              <button class="btn btn-sm btn-primary" id="btn_save"><icon class="fas fa-thumbs-up mr-2"></icon>Save</button>
              <button class="btn btn-sm btn-secondary" id="btn_print_this"><icon class="fas fa-print mr-2"></icon>Print</button>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

</body>
<?php require 'app/views/components/footer.php'; ?>
<script type="text/javascript" src="<?php echo ROOT.'public/js/transactions.js'; ?>"></script>
</html>