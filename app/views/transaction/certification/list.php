<style type="text/css">
  #table_new_request_list thead tr th text-center, #table_new_request_list tbody td{
    font-size: 10pt;
  }
</style>

<div class="row">
  <div class="col-sm-12 align-self-center">

    <table class="table table-sm table-bordered table-striped display nowrap bg-white" style="width: 100%" id="table_new_request_list">
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

  $('body').on('click', '#btn_print_all', function(){
    
    var request_ids = [], ctr = 0, symptomstat = $('#cbo_symptomstat').val();

    if (! table.data().any()){
      $.alert({
            title: 'Empty!',
            type: 'red',
            content: 'No displayed list of request to be printed!',
        });
    }
    else{
      $('#table_new_request_list #btn_print').each(function(){
        request_ids[ctr] = $(this).val();
        ctr++;
      });

      print_mult_certificate(request_ids, symptomstat);
    }
    
  });

  function print_mult_certificate(ids, sym_stat){
    $.ajax({
        url: 'print_certificate',
          method: 'POST',
          data: {ids: ids, sym_stat: sym_stat},
          dataType: 'html',
        success: function(result) {
          var mywindow = window.open('', 'Medical Certificate', 'height=800,width=1020,scrollbars=yes');
          mywindow.document.write('<html><head>');
          mywindow.document.write('<title>Medical Certificate</title>');
          mywindow.document.write('</head><body>');
          mywindow.document.write(result);
          mywindow.document.write('</body></html>');
          mywindow.document.close();
          setTimeout(function(){
              mywindow.focus();
              mywindow.print();    
          },350);

        },
        error: function(obj, err, ex){
          $.alert({
              title: 'Error!',
              content: err + ": " + obj.toString() + " " + ex,
              type: 'red',
          });
      }
    })
  }
</script>