<table class="table table-sm table-bordered table-striped display bg-white" id="table_services_list" style="width: 100%">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Service Name</th>
      <th class="text-center">Description</th>
      <th class="text-center" style="width: 100px">Control</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		$ctr = 1;

  		foreach ($data['services'] as $key => $service) {
  		
  	?>	
  	<tr>
  		<td class="text-center"><?php echo $ctr++; ?></td>
  		<td><?php echo $service['name']; ?></td>
      <td><?php echo $service['desc']; ?></td>
  		<td class="text-center">
  			<?php 
  				if ($service['status']){
  			?>
  			<button class="btn btn-sm btn-warning" id="btn_edit_service" value="<?php echo $service['id']; ?>" title="Edit Service"><i class="fas fa-edit"></i></button>
  			<button class="btn btn-sm btn-danger" id="btn_delete_service" value="<?php echo $service['id']; ?>" title="Delete Service"><i class="fas fa-trash"></i></button>
  			<?php
  				}
  				else{
  			?>
  			<button class="btn btn-sm btn-success" id="btn_activate_service" value="<?php echo $service['id']; ?>" title="Re-activate Service"><i class="fas fa-undo"></i></button>
  			<?php
  				}
  			?>
  		</td>
  	</tr>
	<?php
		}
	?>    
  </tbody>
</table>

<script type="text/javascript">
  var table = $('#table_services_list').DataTable({
    "scrollX": true,
    "ordering": false,
    styles: {
      tableHeader: {
        fontSize: 8
      }
    }
  });
</script>