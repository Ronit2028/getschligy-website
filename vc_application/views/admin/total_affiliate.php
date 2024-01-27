<?php $this->load->view('includes/admin/sidebar'); ?>

<div class="container">
  <div class="content">
    <div class="content-container">

<div class="page-heading"> 
        <h2>Total Affiliates</h2>
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
      ?><div class="row"><div class="col-md-12 col-sm-12">
	  
	  
	 
	  
	 
	  
	 
	  <div class="col-md-12 col-sm-12 martintb">
	  <div class="table-responsive">
	  <div>
	  <table cellspacing="0" rules="all" class="table table-bordered table-striped" border="1" id="ContentPlaceHolder1_GridView1" style="border-collapse:collapse;width: 100%">
	 <tbody>
<tr>
<th scope="col">S.No</th><th scope="col">LA ID</th><th scope="col">LA Name</th><th scope="col">DOJ</th><th scope="col">Sponser ID</th><th scope="col">Status</th>
</tr>
<?php $no_user_found = 'true';
if(!empty($myfriends)) { //echo '<pre>'; print_r($myfriends); echo '</pre>';
	$i = 1;
	foreach($myfriends as $friend) {
		
			
				 $no_user_found = 'false';
				echo '<tr align="center"><td>'.$i.'</td><td><a href="total_affiliate/'.$friend['customer_id'].'">'.$friend['customer_id'].'</a></td><td>'.$friend['f_name'].' '.$friend['l_name'].'</td><td>'.date('d F Y',strtotime($friend['rdate'])).'</td><td>'.$friend['parent_customer_id'].'</td><td>'.$friend['status'].'</td></tr>';
				$i++;
			
		
	}
} 
if($no_user_found == 'true') { echo '<tr><td colspan="8">No user found</td></tr>'; } 
?>
</tbody>
	  </table></div></div></div><span id="ContentPlaceHolder1_Label2" style="color:Red;font-weight:bold;display: none;"></span></div></div>
 <?php //echo form_close(); ?>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>