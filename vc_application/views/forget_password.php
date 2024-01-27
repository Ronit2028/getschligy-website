<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/aboutt2.png" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
                    <h1 class="page-title">Forgot Password</h1>
                    <ul>
                        <li>
                            <a class="active" href="http://campus4success.com">Home</a>
                        </li>
                        <li>Forgot Password</li> 
                    </ul>
                </div>
            </div> 
		<!--/ End Breadcrumbs --> 
	<section class="signin">
	<div class="container">
	<div class="">
	
		

 <div class="registerrr fdr2"><h1 class="mrgnn"> Forgot Password</h1>
 <?php 
		 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Please Check Email OR Password.!</strong> ';
          echo '</div>';       
        } 

      }
	   
      
		echo validation_errors();

		?>
	  <div id="forget-msg-div"></div>
<form action=""   method="POST">
<p><label>Customer Id</label> <input type="text" required name="user_name" class="form-control" placeholder="Enter your User ID"></p>

 <input type="submit" class="btn btn-primary" name="submit" value="Reset Password">
<a href="<?php echo base_url() ?>signin" class="btn btn-primary">Login</a>
</p>

</form>
</div>
</div>
</div>
</section>