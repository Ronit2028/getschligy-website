
<div class="mainbar no-print hidden-xs" >  
<nav class="">
<div class="container">
 <?php $this->load->view('includes/admin/sidebar'); ?>
	</div> <!-- /.container --> 
	</nav>
	</div>

 
 <div class="container">
 
  <div class="content">
    <div class="content-container">
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2><?php echo$page_title; ?></h2>
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
      //echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	 
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table text-center"> 
<thead> <tr> 
<th class="text-center">Sr. No.</th>
<th class="text-center">To Member ID</th>

<th class="text-center">Amout</th>
<th class="text-center">Status</th>
</tr> </thead> 
<tbody> 
<?php 
$i = 1;   
if(!empty($transaction_wallet)) {
foreach($transaction_wallet as $con){ 

if($con['status'] == 'Debit') { $send = $con['send_to'];  $amount = ' - '.$con['amount']; } 
else { $amount = $con['amount']; $send = $con['send_by'];  }
	
	echo '<tr><td>'.$i.'</td><td>'.$con['send_to'].'</td><td>'.$amount.'</td><td>'.$con['status'].'</td>';  
	$i++;
} }
?>

</table>
</div>
</div>
 
 </div>
 </div>
 <?php //echo form_close(); ?>