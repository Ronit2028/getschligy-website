    <?php $this->load->view('includes/admin/sidebar'); ?>
<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
     <div class="container">
      <div class="content">
        <div class="content-container">
<div class="page-heading">
        <h2>Sales</h2> 
      </div>
 
   
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S.NO.</th> <th>User ID</th><th>TxnId</th><th>Total Paid</th><th>Date</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($sale as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/pin_invoice/'.$con['id'].'">'.$con['customer'].'</a></td><td>'.$con['id'].'</td><td><a href="'.base_url().'admin/pin_invoice/'.$con['id'].'">'.$con['gtotal'].'</a></td><td>'.date('d F Y',strtotime($con['tdate'])).'</td>';
?>
	
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</div>
</div>
</div>
</form>