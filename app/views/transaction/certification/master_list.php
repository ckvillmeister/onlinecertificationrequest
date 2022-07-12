<link rel="icon" href="<?php echo ($imgurl) ? ROOT.$imgurl['desc'] : "" ; ?>">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/fontawesome-free/css/all.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/adminlte.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="<?php echo ROOT.BOOTSTRAP; ?>dist/css/jquery-confirm.min.css">
<div style="text-align: center">
<h2><strong>MASTER LIST</strong><br><?php echo date('F d, Y'); ?></h2>
<br>
</div>
<table class="table table-sm table-bordered table-striped display bg-white">
	<thead>
		<tr>
			<th class="text-center">No.</th>
			<th class="text-center">Lastname</th>
			<th class="text-center">Firstname</th>
			<th class="text-center">Middlename</th>
			<th class="text-center">Request Date</th>
			<th class="text-center">Pick-up Date</th>
		</tr>
	</thead>
	<tbody>
	<?php
		$settings = $data['settings'];
		$count = 1;

		foreach ($data['requests'] as $key => $request) {

	?>
		<tr>
			<td class="text-center"><?php echo $count++; ?></td>
			<td><?php echo $request['lastname']; ?></td>
			<td><?php echo $request['firstname'].' '.$request['extension']; ?></td>
			<td><?php echo $request['middlename']; ?></td>
			<td><?php echo $request['request_date']; ?></td>
			<td><?php echo $request['pickup_date']; ?></td>
		</tr>
	<?php
		}
	?>
	</tbody>
</table>