<style type="text/css">
  #table_new_request_list thead tr th text-center, #table_new_request_list tbody td{
    font-size: 10pt;
  }
</style>

<div class="row">
  <div class="col-sm-12 align-self-center">

    <table class="table table-sm table-bordered table-striped display bg-white" style="width: 100%" id="table_new_request_list">
      <thead>
        <tr>
          <th class="text-center">#</th>
          <th class="text-center">Fullname</th>
          <th class="text-center">Address</th>
          <th class="text-center">Contact Number</th>
          <th class="text-center">Date Requested</th>
          <th class="text-center">Pick-up Date</th>
          <th class="text-center" style="width: 130px">Control</th>
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
  </div>
</div>

<script type="text/javascript">
  var table = $('#table_new_request_list').DataTable({
    "scrollX": true,
    "ordering": false,
    styles: {
      tableHeader: {
        fontSize: 8
      }
    }
  });
</script>