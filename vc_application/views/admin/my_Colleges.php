 <?php $this->load->view('includes/admin/sidebar'); ?>
  <?php $user = $profile[0];
if($user['gender']=='Male'){$tit="Mr.";}
elseif($user['gender']=='Female'){$tit="Ms.";}
elseif($user['gender']=='Company'){$tit="M/S";}
else{$tit=" ";}  ?>
 <!-- /.mainbar -->
 <link rel="stylesheet" type="text/css" media="print" href="<?php echo base_url(); ?>assets/css/print.css">
 <div class="container">
  <div class="content">
    <div class="content-container">

<div class="page-heading"> 
        <h2>Suggested Colleges</h2>
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
      ?><div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <tr> <th width="100">Sr.</th> <!---<th>Order ID</th> ---><th>Colleges Name</th> <!--<th>Email</th><th>Phone</th><th>Status</th><th>Date</th> --></tr> </thead> 
<tbody>  
<?php 
$i = 1;
foreach($order as $con){
	
	echo '<tr><td>'.$i.'</td><!---<td><a href="'.base_url().'admin/order/'.$con['id'].'">#'.$con['id'].'</a></td> --> <td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_name'].'</a></td> <!--<td><a href="'.base_url().'admin/order/'.$con['id'].'">'.$con['p_email'].'</a></td><td>'.$con['p_phone'].'</td><td>'.$con['status'].'</td><td>'.$con['o_date'].'</td>-->';
?>
	
<!--td><a class="delete" onclick="javascript:deleteConfirm('<?php //echo base_url().'admin/order/del/'.$con['id'];?>');" deleteConfirm href="#">Delete</a></td-->
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
 <?php //echo form_close(); ?>