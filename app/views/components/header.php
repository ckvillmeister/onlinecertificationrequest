<?php
	$settings_model = new settingsModel();
	$imgurl = $settings_model->get_sys_info('System Logo');
	$imgurl = ($imgurl) ? $imgurl : '';

   $accessrole_model = new accessroleModel();
  $accounts_model = new accountsModel();

  if (isset($_SESSION['user_id'])){
    $userinfo = $accounts_model->get_user_info($_SESSION['user_id']);
    $role = $userinfo['role'];
  }
?>

  <title id="sys_title">Sure Care Medical Clinic </title><!-- <?php //echo ($data['system_name']) ? $data['system_name'] : "" ; ?> -->
  <link rel="icon" href="<?php echo ROOT.MEDILAB_BS; ?>assets/img/scfavicon.png"><!-- <?php //echo ($imgurl) ? ROOT.$imgurl['desc'] : "" ; ?> -->
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/adminlte.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/jquery-confirm.min.css">
  <link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
