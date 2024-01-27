
<div class="grievance">
<div class="container grv">
<h2 class="text-center">Register Grievance</h2>
<?php
      //flash messages
        if(!empty($feedback))
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Your Grievance Submitted successfully.Your Reference No. is '.$tr_pin.'  ';
          echo '</div>';       
        } 
	  
 
?>
<div class="bck">
   <form id="" action="" method="POST" class="">
<div class="col-md-8 col-md-offset-2">
	                  
				
				<br>
				<br>
				<div class="form-group col-md-12" style="padding:0px;">
				<h4>Date:  <?php echo date('d-M Y'); ?></h4>
				</div>
				
                                                    <div class="form-group">
                                                        <label>Name</label>
                                                      <input class="form-control" name="name" id="name" required="" data-validation-required-message="Please enter your name." autocomplete="off" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=""> LA Code </label>
                                                        <input class="form-control" id="code" name="bliss_code" required="" data-validation-required-message="Please enter your LA code" autocomplete="off" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="">Contact No. </label>
                                                        <input class="form-control" id="number" name="phone" required="" data-validation-required-message="Please enter your contact number" autocomplete="off" type="text">
                                                    </div>
                                                    <div class="form-group">
                                                        <label class=""> Email Id </label>
                                                        <input class="form-control" name="email" id="email" required="" data-validation-required-message="Please enter your email id" autocomplete="off" type="text">
                                                    </div>
													  <div class="form-group">
                                                        <label class=""> Description </label>
                                                        <textarea class="form-control" name="message" id="message" required="" data-validation-required-message="Please enter your description" autocomplete="off"></textarea>
                                                    </div>
                                            
</div>

<div class="form-group col-md-8 col-md-offset-2 text-center">
               <button type="submit" class="btn btn-larger btn-block">Thank you for writing to us</button>
                </div>
    </form>
	
</div>
<br>
</div>
</div>