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
<a class="btn btn-primary flr" href="<?php echo base_url().'admin/myschlorship/add'; ?>">Add New</a> 
        <h2>Scholarship List</h2>
      </div>
 
 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open('admin/news/', $attributes);
      ?>
<table id="example" class="table table-bordered table-hover news-table"> 
	<thead> <tr><th>S.No.</th> <th>Title</th><th>Status</th><th>Type</th><th>Delete</th> </tr> </thead> 
<tbody> 
<?php 
$i = 1;

foreach($myschlorship_list as $con){ 
	
	echo '<tr><td>'.$i.'</td><td><a href="'.base_url().'admin/myschlorship/edit/'.$con['id'].'">'.$con['title'].'</a></td><td>'.$con['status'].'</td><td>'.$con['type'].'</td>';
/* if($con['user_level']=='5') { echo 'Supper Admin'; }
elseif($con['user_level']=='2') { echo 'Nucleus Staff / Coordinator'; }
elseif($con['user_level']=='3') { echo 'Fabulous Staff'; }
else { echo ''; } */
?>
	
<td><a class="delete" onclick="javascript:deleteConfirm('<?php echo base_url().'admin/myschlorship/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</form>
 <?php echo form_close(); ?>