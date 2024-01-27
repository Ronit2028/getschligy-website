<?php $this->load->view('includes/admin/sidebar'); ?>


  
  
<style>


.progress {
	height: 20px;
	margin-bottom: 20px;
	overflow: hidden;
	background-color: #f5f5f5;
	border-radius: 4px;
	-webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
	box-shadow: inset 0 1px 2px rgba(0,0,0,.1);
}
.progress-bar {
	float: left;
	width: 0%;
	height: 100%;
	font-size: 12px;
	line-height: 20px;
	color: #fff;
	text-align: center;
	background-color: #337ab7;
	-webkit-box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
	box-shadow: inset 0 -1px 0 rgba(0,0,0,.15);
	-webkit-transition: width .6s ease;
	-o-transition: width .6s ease;
	transition: width .6s ease;
}


	.progress-bar.progress-bar-striped.ee.active {
	width: 5% !important;
	background: #dc3545 !important;
}

	.progress-bar.progress-bar-striped.aa.active {
	width: 25% !important;
	background: #dc3545 !important;
}
.progress-bar.progress-bar-striped.bb.active {
	width: 50% !important;
	background: #337ab7 !important;
}
.progress-bar.progress-bar-striped.cc.active {
	width: 75% !important;
	background: #f0ad4e !important;
}
.progress-bar.progress-bar-striped.dd.active {
	width: 100% !important;
	background: #5cb85c !important;
}
	

</style>


<div class="container">
  <div class="content">
    <div class="content-container">


<div class="page-heading"> 
        <h2>Track Your Application</h2>
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



<div class="row">
<div class="col-md-12 col-sm-12">
<div class="tabbable-line boxless tabbable-reversed">
<div class="portlet light bordered">
<div class="portlet-title tabbable-line">
<div id="ContentPlaceHolder1_mainDiv" class="col-md-12 col-sm-12 martintb">
<div class="table-responsive">
<div>
<table cellspacing="0" rules="all" class="table table-striped table-bordered table-hover" border="1" id="ContentPlaceHolder1_GridView1" style="width:100%;border-collapse:collapse;">
<tbody><tr>
<th scope="col">S.No</th> <th scope="col">Application No.</th> <th scope="col">Name </th> <th scope="col">Course</th> <th scope="col">Status</th> <th scope="col">Preview</th>
</tr>
<?php 
if(!empty($scholarship)) {
	$i = 1;
	foreach($scholarship as $friend) {
		echo '<tr align="center"><td>'.$i.'</td> <td>'.$friend['id'].'</td> <td>'.$friend['f_name'].' '.$friend['l_name'].'</td><td>'.$friend['course'].'</td> <td>'.$friend['status'].'</td> ';
		echo '<td><a href="'.base_url().'admin/preview/'.$friend['id'].'">Preview</a></td></tr>';
		$i++;
	}
} ?>

</tbody></table>
</div>
</div>
</div>
</div>
</div>
</div>
<?php if(!empty($scholarship)) {
	if($scholarship[0]['status']=='Pending') { $status = 'ee'; $percentage = 0; }
	elseif($scholarship[0]['status']=='Under Process') { $status = 'aa'; $percentage = 25; }
	elseif($scholarship[0]['status']=='Under Review') { $status = 'bb'; $percentage = 50; }
	elseif($scholarship[0]['status']=='Under Verification') { $status = 'cc'; $percentage = 75; }
	elseif($scholarship[0]['status']=='Approved') { $status = 'dd'; $percentage = 100; }
	else { $status = 'ee'; $percentage = 0; }
	echo '<div class="progress">
    <div class="progress-bar progress-bar-striped '.$status.' active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
      '.$percentage.'%
    </div></div>';



} ?>
  

<?php //echo form_close(); ?>