 
 <?php $this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 
 <div class="container"> 
 <div class="content">    
 <div class="content-container"> 
 <div class="col-sm-12">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2><?php echo $page_title;?></h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
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
      
     //echo form_open('admin/category/', $attributes);
      ?>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr>
<th scope="col">S.No</th><th scope="col">Email</th><th scope="col">Phone</th><th scope="col">DOJ</th><th scope="col">Subject</th><th scope="col">message</th><th scope="col">rating</th><th scope="col">Status</th>
</tr> </thead> 
<tbody> 
<?php 
if(!empty($feedback)) {
	$i = 1;
	foreach($feedback as $friend) {
		if($friend['status'] != '' && $friend['status'] > 0) { $st='act'; $status = 'Active'; } else {  $st=''; $status = ''; }
		echo '<tr align="center" class='.$st.'><td>'.$i.'</td><td>'.$friend['email'].'</td><td>'.$friend['phone'].'</td><td>'.date('d F Y',strtotime($friend['date'])).'</td><td>'.$friend['subject'].'</td><td>'.$friend['message'].'</td><td>'.$friend['rating'].'</td><td>'.$friend['status'].'</td></tr>';
		$i++;
	}
} ?>
</tbody> 


</table>
</div>
</div></div></div></div>
 <?php //echo form_close(); ?>