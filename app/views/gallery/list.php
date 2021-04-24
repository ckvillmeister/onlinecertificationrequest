<table class="table table-sm table-bordered table-striped display bg-white" id="table_gallery" style="width: 100%">
  <thead>
    <tr>
      <th class="text-center" style="width:20px">#</th>
      <th class="text-center" style="width:150px">Photo</th>
      <th class="text-center">Caption</th>
      <th class="text-center" style="width: 100px">Control</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		$ctr = 1;

  		foreach ($data['photos'] as $key => $photo) {
  		
  	?>	
  	<tr>
  		<td class="text-center"><?php echo $ctr++; ?></td>
  		<td class="text-center"><img height="150" width="150" src="<?php echo ROOT.$photo['url']; ?>"></td>
      <td><?php echo $photo['caption']; ?></td>
  		<td class="text-center">
  			<?php 
  				if ($photo['status']){
  			?>
  			<button class="btn btn-sm btn-danger" id="btn_delete_photo" value="<?php echo $photo['id']; ?>" title="Delete Photo"><i class="fas fa-trash"></i></button>
  			<?php
  				}
  				else{
  			?>
  			<button class="btn btn-sm btn-success" id="btn_activate_photo" value="<?php echo $photo['id']; ?>" title="Re-activate Photo"><i class="fas fa-undo"></i></button>
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
  var table = $('#table_gallery').DataTable({
    "ordering": false,
    styles: {
      tableHeader: {
        fontSize: 8
      }
    }
  });
</script>