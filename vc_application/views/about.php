<?php



/*$phone = 9888995669;

$sms_msg = urlencode("Hi Rahul Singh,\nYour account details are summarized below : User Name : RA12345\n Password : 123456\nTeam Getscholify");
				
    			$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829447161980";
    		    		
echo file_get_contents($smstext);
$otp_crt = rand(1000,9999);
    				
$data['veryfied_msg_otp'] = $otp_crt;
$this->session->set_userdata('otp_number',$otp_crt);
$sms_msg = urlencode("Your OTP for Getscholify registration is ".$otp_crt."\nThank you\nTeam Getscholify");

$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
					
    		    		
echo file_get_contents($smstext);*/

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
                    <img src="campus/assets/images/breadcrumbs/aboutttttt.png" alt="Breadcrumbs Image">
                </div>
                <div class="breadcrumbs-text white-color">
				<a href="#">
                    <h1 class="page-title">About Us</h1>
					</a>
					<ul>
                        <li>Education is a right path to reach to the destination</li>
                    </ul>
                    <!--<ul>
                        <li>
                            <a class="active" href="index.html">Home</a>
                        </li>
                        <li>About Us</li>
                    </ul>-->
                </div>
            </div>


<div id="rs-about" class="rs-about style3 pt-100 md-pt-70"> 
                <div class="container">
                    <div class="row y-middle">
                        <div class="col-lg-12 lg-pr-0 md-mb-30">
                            <div class="about-intro">
                                <div class="sec-title">
                                    
                                    <div class="desc big">Getscholify is a bridge between students, educators, and corporates. It is a digital platform designed to help the students of India with scholarships. The students getting scholarships to pursue their dream careers. Getscholify allows corporates & individuals to contribute to the education of these deserving children, and in doing that we are keeping everything transparent with the contributors. Donors can track their donations and can also get information about the scholarship recipient including the institution where students are studying.</div>
									<div class="desc big">Getscholify further allows every student who is receiving a scholarship to choose the college he/she wants to study and the city or state he/she wants to live in while studying. This initiative has helped many students to follow their passion. We believe in fulfilling the dreams of students by acting as a bridge between the willing donors and the deserving meritorious students. Our journey started after the COVID-19 pandemic. When millions of Indians lost their job and college dreams of many were shattered. This was the time when we realised, that we should help these college spirants get rightful education and that is when Getscholify was formed.</div>
                                </div> 
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
			<div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5 padding-0 md-pl-15 md-pr-15 md-mb-30">
							<div class="img-part">
								<img class="" src="campus/assets/images/about/logooo2.png" alt="About Image">
							</div>
						</div>
						<div class="col-lg-7 pr-70 md-pr-15">
							<div class="sec-title">
								<h2 class="title mb-17">Our Philosophy</h2>
								<div class="sub-title orange">karma unites us with god</div>
								<div class="bold-text mb-22">We at Getscholify knows the role of education in the development of our country. Approximately, 20% of population in India is of (15 to 24) years of age, but only 27% attends college. We know Getscholify that for the better growth of a country we should educate our youth first. That is why we have created a platform which offers scholarships to every student of India. Our philosophy while building this platform was to support the dreams of young Indians, so that they can explore their field of interest and build a limitless career.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="rs-cta about">
                <div class="cta-img">
                    <img src="campus/assets/images/cta/cta-bg2.jpg" alt="">
                </div>
                <div class="cta-content text-center">
                    <div class="sec-title sm-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                        <h2 class="title white-color extra-bold mb-16 sm-mb-5">Our vision</h2>
                        <h2 class="sub-title capitalize white-color mb-0">To emerge as an bridge between colleges & corporate in the fields of engineering, technology and management in serving the industry and the nation by empowering students with a high degree of technical, managerial and practical competence.</h2>
                    </div>
                   
                </div>
            </div>
			
			
			<div class="rs-cta style2 about">
				<div class="partition-bg-wrap inner-page">
					<div class="container">
						<div class="row y-bottom">
							<div class="col-lg-6 pb-50 md-pt-50 md-pb-50">
								
							</div>
							<div class="col-lg-6 pl-62 pt-50 pb-50 md-pt-50 md-pb-50 md-pl-15">
								<div class="sec-title mb-40 md-mb-20">
										<h2 class="title mb-16">Our mission</h2>
										<div class="desc">Our Mission is to reinforce the youth of India with quality education. More than 2 million students every year quit their higher education because of a shortage of funds. Our mission is to help those students by providing them scholarships.</div>
										<div class="desc">Our mission is to unite the corporates, Colleges & students in a cooperative network. This network will keep supporting the needy students forever. With this vision, we aim to increase the percentage of students pursuing higher education in India, so that our nation becomes a land of excellence. We believe in  fulfilling the dreams of students by acting as a bridge between the willing donors and the deserving meritorious students.</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="rs-cta Ourcore home11-style SScholarship pt-30 pb-30 md-pt-70 md-pb-70">
                 <div class="wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                    <div class="container">
					<div class="sec-title mb-50 text-center">
							<h2 class="title mb-0">Our <span>core </span>values</h2>
							
						</div>
					<div class="content  text-center">
                         <div class="row rs-counter couter-area">
                                <div class="col-md-4 sm-mb-30">
                                    <div class="counter-item one">
										<div class="cta-img">
											<img src="campus/assets/images/cta/head.png" alt="">
										</div>
                                    </div>
									<h2>Discipline</h2>
                                </div>
							
                                <div class="col-md-4 sm-mb-30">
                                    <div class="counter-item two">
										<div class="cta-img">
											<img src="campus/assets/images/cta/dedication.png" alt="">
										</div>
                                    </div> 
									<h2>Dedication</h2>
                                </div>
								
                                <div class="col-md-4">
                                    <div class="counter-item three">
									<div class="cta-img">
										<img src="campus/assets/images/cta/iocn3.png" alt="">
									</div>
                                    </div>
									<h2>Honesty</h2>
                                </div>
                            </div>
                    </div>
                    </div>
                </div>
            </div>
			
			
			
			
