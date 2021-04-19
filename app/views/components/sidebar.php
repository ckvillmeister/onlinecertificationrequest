<?php

$url = "";
$arr_url = array();
$link = "";
$link_2 = "";

if (isset($_GET['url'])){
  $url = $_GET['url'];
  $arr_url = explode('/', rtrim($url, '/'));
  $link = rtrim($arr_url[0], '/');
  

  if (count($arr_url) > 1){
     $link_2 = ltrim($arr_url[1], '/');
  }
}

$transaction_model = new transactionModel();
$new_reqs = count($transaction_model->get_requests(1));
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="<?php echo ROOT; ?>main" class="brand-link"> 
    <!-- <div class="text-center"> -->
      <img src="<?php echo ROOT.$imgurl['desc']; ?>" class="brand-image img-circle elevation-3 mr-3">
      <span class="brand-text font-weight-light">
        <?php
              $sys_title_arr = explode(' ', $data['system_name']);
              $initials = '';
              foreach ($sys_title_arr as $key => $word) {
                 $initials .= substr($word, 0, 1);
              }
        ?>
        <strong><?php echo $initials ?></strong>
      </span>
    <!-- </div> -->
  </a>

  <div class="sidebar">

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <?php if ($accessrole_model->check_access($role, 'dashboard')): ?>
        <li class="nav-item">
          <a href="<?php echo ROOT; ?>dashboard" class="nav-link <?php echo ($link == 'dashboard') ? 'active' : ''; ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <?php endif; ?>

        <?php if ($accessrole_model->check_access($role, 'transactions')): ?>
        <li class="nav-item has-treeview <?php if ($link=='transaction'){ echo 'menu-open'; } ?>">
          <a href="#" class="nav-link <?php if ($link=='transaction'){ echo 'active'; } ?>">
            <i class="nav-icon fas fa-exchange-alt"></i>
            <p>
              Transactions
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($accessrole_model->check_access($role, 'certification')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>transaction/certification" class="nav-link <?php echo ($link_2 == 'certification') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Certification</p>
                <span class="badge badge-danger navbar-badge" id="requests_notif"><?php echo ($new_reqs) ? $new_reqs.' New Requests' : ''; ?></span>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </li>
        <?php endif; ?>

        <?php //if ($accessrole_model->check_access($role, 'transactions')): ?>
        <li class="nav-item has-treeview <?php if ($link=='site'){ echo 'menu-open'; } ?>">
          <a href="#" class="nav-link <?php if ($link=='site'){ echo 'active'; } ?>">
            <i class="nav-icon fas fa-user"></i>
            <p>
              Manage Site
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <?php //if ($accessrole_model->check_access($role, 'certification')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>site/faqs" class="nav-link <?php echo ($link_2 == 'faqs') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>FAQs</p>
              </a>
            </li>
            <?php //endif; ?>

            <?php //if ($accessrole_model->check_access($role, 'certification')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>site/services" class="nav-link <?php echo ($link_2 == 'services') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Services</p>
              </a>
            </li>
            <?php //endif; ?>

            <?php //if ($accessrole_model->check_access($role, 'certification')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>site/gallery" class="nav-link <?php echo ($link_2 == 'gallery') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Gallery</p>
              </a>
            </li>
            <?php //endif; ?>

          </ul>
        </li>
        <?php //endif; ?>
          
        <?php if ($accessrole_model->check_access($role, 'reports')): ?>
        <li class="nav-item has-treeview <?php if ($link=='report' & $link_2 != 'search'){ echo 'menu-open'; } ?>">
          <a href="#" class="nav-link <?php if ($link=='report' & $link_2 != 'search'){ echo 'active'; } ?>">
            <i class="nav-icon fas fa-file-alt"></i>
            <p>
              Report
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($accessrole_model->check_access($role, 'reprequest')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>report/requests" class="nav-link <?php echo ($link_2 == 'requests') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Request List</p>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </li>
        <?php endif; ?>

        <?php if ($accessrole_model->check_access($role, 'maintenance')): ?>
        <li class="nav-item has-treeview <?php if (($link == 'candidates' & ($link_2 == '' | $link_2 == 'profile')) | ($link == 'voter' & $link_2 == '') | ($link == 'settings' & $link_2 == 'barangay') | $link=='accessrole' | $link=='accounts' | $link=='settings' | $link=='checklist'){ echo 'menu-open'; } ?>">
          <a href="#" class="nav-link <?php if (($link == 'candidates' & ($link_2 == '' | $link_2 == 'profile')) | ($link == 'voter' & $link_2 == '') | ($link == 'settings' & $link_2 == 'barangay') | $link=='accessrole' | $link=='accounts' | $link=='settings' | $link =='checklist'){ echo 'active'; } ?>">
            <i class="nav-icon fas fa-wrench"></i>
            <p>
              Maintenance
              <i class="right fas fa-angle-left"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <?php if ($accessrole_model->check_access($role, 'checklist')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>checklist" class="nav-link <?php echo ($link == 'checklist') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Checklist</p>
              </a>
            </li>
            <?php endif; ?>

            <?php if ($accessrole_model->check_access($role, 'roles')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>accessrole" class="nav-link <?php echo ($link == 'accessrole') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Access Roles</p>
              </a>
            </li>
            <?php endif; ?>

            <?php if ($accessrole_model->check_access($role, 'accounts')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>accounts" class="nav-link <?php echo ($link == 'accounts') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>User Accounts</p>
              </a>
            </li>
            <?php endif; ?>

            <?php if ($accessrole_model->check_access($role, 'settings')): ?>
            <li class="nav-item">
              <a href="<?php echo ROOT; ?>settings" class="nav-link <?php echo ($link == 'settings' & $link_2 == '') ? 'active' : ''; ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>System Settings</p>
              </a>
            </li>
            <?php endif; ?>

          </ul>
        </li>
        <?php endif; ?>

    </nav>
  </div>
</aside>