<table class="table table-sm table-bordered table-striped display bg-white" id="table_faq_list" style="width: 100%">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Question</th>
      <th class="text-center">Answer</th>
      <th class="text-center" style="width: 100px">Control</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		$ctr = 1;

  		foreach ($data['faqs'] as $key => $faq) {
  		
  	?>	
  	<tr>
  		<td class="text-center"><?php echo $ctr++; ?></td>
  		<td><?php echo $faq['question']; ?></td>
      <td><?php echo $faq['answer']; ?></td>
  		<td class="text-center">
  			<?php 
  				if ($faq['status']){
  			?>
  			<button class="btn btn-sm btn-warning" id="btn_edit_faq" value="<?php echo $faq['id']; ?>" title="Edit FAQ"><i class="fas fa-edit"></i></button>
  			<button class="btn btn-sm btn-danger" id="btn_delete_faq" value="<?php echo $faq['id']; ?>" title="Delete FAQ"><i class="fas fa-trash"></i></button>
  			<?php
  				}
  				else{
  			?>
  			<button class="btn btn-sm btn-success" id="btn_activate_faq" value="<?php echo $faq['id']; ?>" title="Re-activate FAQ"><i class="fas fa-undo"></i></button>
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
  var table = $('#table_faq_list').DataTable({
    "scrollX": true,
    "ordering": false,
    styles: {
      tableHeader: {
        fontSize: 8
      }
    }
  });
</script>