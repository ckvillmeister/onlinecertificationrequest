<?php
	$client_info = $data['info'];
	$settings = $data['settings'];
	$fullname = strtoupper(trim($client_info['firstname'].' '.$client_info['middlename'].' '.$client_info['lastname'].' '.$client_info['extension']));
	$address = strtoupper($client_info['address']);
	$sex = strtoupper($client_info['sex']);
	
	$birthdate = new DateTime(date("Y-m-d", strtotime($client_info['dob'])));
    $today= new DateTime(date("Y-m-d"));           
    $age = $birthdate->diff($today)->y;
?>
<style>
	body {
	  -webkit-print-color-adjust: exact !important;
	}

	.content{
		font-size: 20pt;
	}
	.info, .purpose, .issuance-date{
		text-indent: 50px;
		text-align: justify;
  		text-justify: inter-word;
  		line-height: 1.6;
	}
	.note{
		text-indent: 50px;
	}

	.findings{
		text-indent: 20%;
	}
	
	.title{
		font-family: 'Times New Roman';
		font-size: 40pt;
		color: #0c97c2;
		letter-spacing: 10px;
	}

	.doctor-signatory, .seal {
		font-size: 20pt;
	}

	.line{
		color:#6b2900 !important;
		background: #6b2900 !important;
		height: 6px;
	}

	@page {
  		margin: 12mm 25.6mm 12mm 25.6mm;  
  	} 
</style>
<link rel="icon" href="<?php echo ($imgurl) ? ROOT.$imgurl['desc'] : "" ; ?>">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/jquery-confirm.min.css">
<div class="wrapper">
	<div class="row">
		<div class="col-lg-12 text-center">
			<img src="<?php echo ROOT.MEDILAB_BS; ?>assets/img/sure-care.png" class="">
			<h4><strong><?php echo $settings['Business Address']['desc']; ?></strong></h4>
			<h4><strong><?php echo $settings['E-mail Address']['desc']; ?></strong></h4>
			<hr class="line">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<br>
			<h1 class="title">TMC PHYSICIAN</h1>
			<h1 class="title">MEDICAL CERTIFICATE</h1>
			<br><br>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<!-- TMC Physician -->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<!-- Medical Certificate -->
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 text-center">
			<!-- Medical Certificate -->
		</div>
	</div>
	<div class="row content">
		<div class="col-lg-12">
			<p>
				TO WHOM IT MAY CONCERN
			</p>
		</div>
	</div>
	<div class="row content info">
		<div class="col-lg-12">
			<p>
				This is to certify that <strong><?php echo $fullname; ?></strong>, <strong><?php echo $age; ?></strong> years old, <strong><?php echo $sex; ?></strong>, and a resident of <strong><?php echo $address; ?></strong>, was seen and examined by the undersigned in this clinic on, with the following findings as per record available:
			</p>
		</div>
	</div>
	<div class="row content findings">
		<div class="col-lg-12">
			<?php
				foreach ($data['findings'] as $key => $finding) {
			?>
				<!--<div class="row">
					<div class="col-lg-12">-->
						<p><i class="fas fa-circle mr-5" style="font-size: 8pt !important"></i><?php echo $finding['finding']; ?></p>
				<!--	</div>
				</div>-->
			<?php
				}
			?>
		</div>
	</div>
	<div class="row content purpose">
		<div class="col-lg-12">
			<p>
				This certification is issued upong the request of the patient and for whatever any legal purpose it may serve <?php echo (strtolower($sex) == 'male') ? 'him' : 'her'; ?> best.
			</p>
		</div>
	</div>
	<div class="row content issuance-date">
		<div class="col-lg-12">
			<p>
				Done this day <strong><?php echo date('jS'); ?></strong> of <strong><?php echo date('F Y'); ?></strong> at <strong><?php echo $data['settings']['Business Name']['desc'].' '.$data['settings']['Business Address']['desc']; ?></strong>.
			</p>
		</div>
	</div>
	<div class="row content note">
		<div class="col-lg-12">
			<br><br>
			<p class="mr-3">Note:&nbsp;<?php echo ($data['note']['note']) ? $data['note']['note'] : "None"; ?></p>
		</div>
	</div>
	<div class="row singatories">
		<div class="col-sm-6 seal text-center">
			<br><br><br><br><br>
			Not valid without <?php echo $settings['Business Name']['desc']; ?> Official Seal
		</div>
		<div class="col-sm-6 doctor-signatory text-center">
			<br><br>
			<strong style="text-decoration: underline;"><?php echo strtoupper($settings['Clinic Doctor']['desc']); ?></strong>
			<br>
			<strong><?php echo "License No.: ".$settings['License Number']['desc']; ?></strong>
			<br>
			<strong><?php echo "PTR ".$settings['PTR']['desc']; ?></strong>
		</div>
	</div>
</div>