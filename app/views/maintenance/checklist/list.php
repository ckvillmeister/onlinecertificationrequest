<table class="table table-sm table-bordered table-striped display nowrap bg-white" id="table_checklist">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Checklist Item Description</th>
      <th class="text-center">Control</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		$ctr = 1;

  		foreach ($data['roles'] as $key => $accessrole) {
  		
  	?>	
  	<tr>
  		<td class="text-center"><?php echo $ctr++; ?></td>
  		<td><?php echo $accessrole['description']; ?></td>
  		<td class="text-center">
  			<?php 
  				if ($accessrole['status']){
  			?>
  			<button class="btn btn-sm btn-warning" id="btn_edit_checklistitem" value="<?php echo $accessrole['id']; ?>" title="Edit Access Role"><i class="fas fa-edit"></i></button>
  			<button class="btn btn-sm btn-danger" id="btn_delete_checklistitem" value="<?php echo $accessrole['id']; ?>" title="Delete Access Role"><i class="fas fa-trash"></i></button>
  			<?php
  				}
  				else{
  			?>
  			<button class="btn btn-sm btn-success" id="btn_activate_checklistitem" value="<?php echo $accessrole['id']; ?>" title="Re-activate Access Role"><i class="fas fa-undo"></i></button>
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