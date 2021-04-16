<table class="table table-sm table-bordered table-striped display nowrap bg-white" id="table_new_request_list">
  <thead>
    <tr>
      <th class="text-center">#</th>
      <th class="text-center">Fullname</th>
      <th class="text-center">Address</th>
      <th class="text-center">Contact Number</th>
      <th class="text-center">Date Requested</th>
      <th class="text-center">Pick-up Date</th>
      <th class="text-center">Control</th>
    </tr>
  </thead>
  <tbody>
  	<?php
  		$ctr = 1;
      foreach ($data['requests'] as $key => $request) {
  	?>	
  	<tr>
  		<td class="text-center"><?php echo $ctr++; ?></td>
  		<td><?php echo ucwords(strtolower($request['firstname']).' '.strtolower(trim($request['middlename'])).' '.strtolower($request['lastname']).' '.strtolower(trim($request['extension']))); ?></td>
  		<td><?php echo $request['address']; ?></td>
      <td><?php echo $request['contact_number']; ?></td>
      <td><?php echo $request['request_date']; ?></td>
      <td><?php echo $request['pickup_date']; ?></td>
  		<td>
        <?php 
          if ($request['status'] == 1 | $request['status'] == 2){
        ?>
            <button class="btn btn-sm btn-success" id="btn_approve" value="<?php echo $request['id']; ?>"><icon class="fas fa-thumbs-up mr-2"></icon>Approve</button>
            <button class="btn btn-sm btn-danger" id="btn_reject" value="<?php echo $request['id']; ?>"><icon class="fas fa-times mr-2"></icon>Reject</button></td>
        <?php 
          }
          elseif ($request['status'] == 3){
        ?>
            <button class="btn btn-sm btn-primary" id="btn_view" value="<?php echo $request['id']; ?>"><icon class="fas fa-eye mr-2"></icon>View</button>
            <button class="btn btn-sm btn-info" id="btn_print" value="<?php echo $request['id']; ?>"><icon class="fas fa-print mr-2"></icon>Print</button>
        <?php 
          }
          elseif ($request['status'] == 0){
        ?>
            <button class="btn btn-sm btn-secondary mr-1" id="btn_reactivate" value="<?php echo $request['id']; ?>"><icon class="fas fa-undo mr-2"></icon>Re-activate</button>
        <?php 
          }
        ?>
  	</tr>
	<?php
		}
	?>    
  </tbody>
</table>