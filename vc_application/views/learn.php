<?php

 			/*	$to = 'hackertool9888@gmail.com';

				$headers = "MIME-Version: 1.0" . "\r\n";

				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

				$headers .= 'From: getscholify <info@getscholify.com>' . "\r\n"; 

				$subject = 'Thank you for joining getscholify..';

				
				$message = '

				Respected  <b style="color:orange">Rahul</b>,<br><br>

With all our heartiest congratulations, we welcome you to the family of getscholify <br>

This letter confirms your registration to the world of prosperity and squad of team workers. It also offers you unprecedented opportunities, financial security, source of never ending opportunity and all of things, peace of mind and leisure.<br><br>

ID-NO:- <b style="color:orange">Customer id</b><br>

Password:- <b style="color:orange">123456</b><br>

<br>

Thank you for joining the getscholify..<br>

Looking forward to a continuous and a fruitful business partnership with you.

<br>

Regards,

<br>

getscholify';
$message .= "<html><head></head><body>";
				$message .= '<img src="'.base_url().'/assets/images/logo.png" width=150></body></html>'; 

				echo mail($to,$subject,$message,$headers);*/







/*$this->load->config('email');
        $this->load->library('email');
        
        $from = $this->config->item('smtp_user');
        $to = "developer.rahul9888@gmail.com"; 
        $subject = "Test";
        $message = "test";

        $this->email->set_newline("\r\n");
        $this->email->from($from);
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);

        if ($this->email->send()) {
            echo 'Your Email has successfully been sent.';
        } else {
            show_error($this->email->print_debugger());
        }*/

  /*$dest = "developer.rahul9888@gmail.com"; 
  $fromaddy = "info@getscholify.com"; 
  mail("<$dest>","Test from php mail","Test","From:<$fromaddy>","-f$fromaddy"); */


			//	die();

?>
	
		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="<?php echo base_url();?>campus/assets/images/breadcrumbs/aboutttttt.png" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
				<a href="#">
                    <h1 class="page-title">Latest Scholarship</h1>
					</a>
					<ul>
                        <li>Education is a right path to reach to the destination</li>
                    </ul>
                    
                </div>
            </div>


			<div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5 padding-0 md-pl-15 md-pr-15 md-mb-30">
							<div class="img-part">
							<?php if($get_schloshipsss[0]['image'] !='') { echo '<img src="'.base_url().'main-admin/images/'.$get_schloshipsss[0]['image'].'">'; }else{echo '<img src="'.base_url().'main-admin/images/Eligibility.png">';} ?>
							</div>
						</div>
						<div class="col-lg-7 pr-70 md-pr-15">
							<div class="sec-title">
								<h2 class="title mb-17"><?php echo $get_schloshipsss[0]['title'];?></h2>
								<div class="bold-text mb-22"><?php echo $get_schloshipsss[0]['discription'];?></div>
							</div>
							<div class="btn-part">
                               <a class="Enroll" href="https://www.getscholify.com/ApplyNow/">Enroll Now</a>
						</div>
					</div>
				</div>
			</div>
		
