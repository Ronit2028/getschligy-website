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

<div class="col-sm-12 no-print">
<a class="btn btn-primary flr " href="<?php echo base_url('admin');?>">Back</a>

<h2>Scholarship Letter</h2>
 
</div>
<div class="row"> 
<div class="col-md-8 col-md-offset-2 print-div welcome-letter">
  <?php if($profile[0]['file']!='') { ?>
    <div class="growindia">
          <iframe src="<?php echo base_url(); ?>assets/images/<?php echo $profile[0]['file']; ?>" type="application/pdf" width="100%" height="600px"></iframe>
        </div>  
 <?php } ?>
	


</div>
</div>
</div>
</div>
</div>