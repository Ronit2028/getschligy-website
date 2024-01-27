<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">
<!--<a class="btn btn-primary flr" href="<?php echo base_url().'admin/gallery/add'; ?>">Add New</a>-->
        <h2>Individual Request</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> product updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/gallery/', $attributes);
      ?>
	  <div class="table-responsive">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S No.</th> <th>Name</th><th>Email</th><th>Phone</th><th>Currency</th><th>Amount</th><th>Nationality</th><th>Date</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($individaul_list as $con){ 
	
	echo '<tr><td>'.$i.'</td><td>'.$con['cname'].'</td><td>'.$con['email'].'</td><td>'.$con['phone'].'</td><td>'.$con['currency'].'</td><td>'.$con['amount'].'</td><td>'.$con['state'].'</td><td>'.date('Y-m-d',strtotime($con['date'])).'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/individual/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>