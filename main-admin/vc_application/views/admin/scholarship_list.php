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
        <h2>Manage Schlorship</h2>
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

	  <div class="table-responsive tabb1">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S No.</th> <th>Application No.</th><th>Name</th><th>Course</th><th> Date</th><th> Status</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;
foreach($scholarship as $con){
	echo '<tr><td><a href="'.base_url().'admin/scholarship/edit/'.$con['id'].'">'.$i.'</a></td><td><a href="'.base_url().'admin/scholarship/edit/'.$con['id'].'">'.$con['f_name'].' '.$con['l_name'].'</a></td><td>'.$con['course'].'</td><td>'.$con['rdate'].'</td><td>'.$con['status'].'</td>';
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/scholarship/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>
</form>
 <?php echo form_close(); ?>