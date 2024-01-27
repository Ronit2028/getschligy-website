<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Page extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
		$this->load->library('cart');
		$this->load->helper('form');
		 $this->load->library('form_validation');
        $this->load->model('customer_model');	
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship';
                $data['page_title'] = 'Home'; 
		

	        $data['main_content'] = 'Home';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function registration(){
 				$data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'about';
                $data['page_title'] = 'About'; 
	  	       	if($this->session->userdata('is_customer_logged_in')){
				redirect(base_url().'admin');
        		}
			   		//echo '<pre>'; print_r($data['parent']);die();
			if ($this->input->server('REQUEST_METHOD') === 'POST')
                 {
			$otp=$this->input->post('otp');
    		$otp_exist=$this->session->userdata('otp_number');
			//form validation
			$this->form_validation->set_rules('f_name', 'first_name', 'required');
			$this->form_validation->set_rules('l_name', 'last_name', 'required');
			$this->form_validation->set_rules('email', 'email', 'required|valid_email');
		    $this->form_validation->set_rules('pass_word', 'password', 'trim|required|min_length[6]|max_length[32]');
			$this->form_validation->set_rules('c_password', 'confirm password', 'trim|required|min_length[6]|matches[pass_word]');
			$this->form_validation->set_rules('phone', 'phone no', 'required|min_length[10]|max_length[10]');
			$this->form_validation->set_rules('term_condition', 'term and condition', 'required');

			$phone = $this->customer_model->check_phone($this->input->post('phone'));
			$email = $this->customer_model->check_email($this->input->post('email'));
			if(!empty($phone)) {
				$this->form_validation->set_rules('error', 'term and condition', 'required');
				$this->form_validation->set_message('required', 'Phone no. Already exist.');
			}
			elseif(!empty($email)) {
				$this->form_validation->set_rules('error', 'term and condition', 'required');
				$this->form_validation->set_message('required', 'Email Already exist.');
			}

			if($otp_exist!='') {
				//$this->form_validation->set_rules('otp', 'OTP', 'required');
				if($otp_exist!=$otp && $otp!='') {
					$this->form_validation->set_rules('error', 'term and condition', 'required');
					$this->form_validation->set_message('required', 'Incorrect OTP.');
				}
			}
			//$this->form_validation->set_rules('referral_code', 'referral_code', 'required');
			/*$r_code=$this->input->post('referral_code');
				 $data['parent'] = $this->customer_model->fech_data($r_code);
		  
		   if(empty($data['parent']) && $r_code!=''){
			
			  $this->form_validation->set_rules('ftryg', 'referral_code', 'required');
			  $this->form_validation->set_message('required', ' This Referral Code  does not  exist'); 
		  }*/
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
		   
		  if($this->form_validation->run()===TRUE)
				{

				if ($otp=='' || $this->input->post('submit')=='Resend OTP') {
					$phone = $this->input->post('phone');
					if($phone != '') {
	    				$otp_crt = rand(1000,9999);
	    				
	    				$data['veryfied_msg_otp'] = $otp_crt;
	    				$this->session->set_userdata('otp_number',$otp_crt);
	    				$sms_msg = urlencode("Your OTP for Getscholify registration is ".$otp_crt."\nThank you\nTeam Getscholify");

	    				$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
						
	    		    		
						file_get_contents($smstext);

	    				$to = $this->input->post('email');
	    				$subject ="OTP form :- OTP for Getscholify Registration";
	    				$txt = "Your OTP for Getscholify is ".$otp_crt.""; 
	    				$headers = "From: Getscholify.com"."\r\n";
	    				$headers = "MIME-Version: 1.0" . "\r\n";     
	    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
	    				$headers .= 'From: <Getscholify.com>' . "\r\n"; 
	    				mail($to,$subject,$txt,$headers);
	    			}

	    			$this->session->set_flashdata('flash_message', 'otp');
					//redirect('signup');

				}
				else {
							$data_to_store = array(
					     // 'direct_customer_id' => strtoupper($this->input->post('referral_code')),
					     // 'parent_customer_id' => strtoupper($this->input->post('referral_code')),
		                    'f_name' => $this->input->post('f_name'),
		                    'l_name' => $this->input->post('l_name'),
							'email' => $this->input->post('email'),
							'pass_word' => md5($this->input->post('pass_word')),
							'phone' => $this->input->post('phone'),
							'status'=>'active'
							
					); 
					if($this->input->post('referral_code')=='') {
						$data_to_store['direct_customer_id'] = 'SI101';
						$data_to_store['parent_customer_id'] = 'SI101';
					}

		                //if the insert has returned true then we show the flash message
					   $customer_id = $this->customer_model->register($data_to_store);
							

						$data = array('full_name'=>$this->input->post('f_name').' '.$this->input->post('l_name'), 'email'=>$this->input->post('email'), 'bliss_id'=>$customer_id['customer_id'],'cust_id'=>$customer_id['id'], 'rdate'=>date('Y-m-d H:i:s'), 'cust_img'=>'', 'is_customer_logged_in' => true);
		            	$this->session->set_userdata($data);


		            	/***************** SMS ******************/
		    			$sms_msg = urlencode("Hi ".$this->input->post('f_name').' '.$this->input->post('l_name').",\nYour account details are summarized below : User Name : ".$customer_id['customer_id']."\n Password : ".$this->input->post('pass_word')."\nTeam Getscholify"); 
						
		    			$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829447161980";	
						file_get_contents($smstext);
						/***************** SMS ******************/

		            	$to = $this->input->post('email');

						$headers = "MIME-Version: 1.0" . "\r\n";

						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 

						$headers .= 'From: getscholify <info@getscholify.com>' . "\r\n"; 

						$subject = 'Thank you for joining getscholify..';

						
						$message = '

						Respected  <b style="color:orange">'.$this->input->post('f_name').'</b>,<br><br>

		With all our heartiest congratulations, we welcome you to the family of getscholify <br>

		This letter confirms your registration to the world of prosperity and squad of team workers. It also offers you unprecedented opportunities, financial security, source of never ending opportunity and all of things, peace of mind and leisure.<br><br>

		ID-NO:- <b style="color:orange">'.$customer_id['customer_id'].'</b><br>

		Password:- <b style="color:orange">'.$this->input->post('pass_word').'</b><br>

		<br>

		Thank you for joining the getscholify..<br>

		Looking forward to a continuous and a fruitful business partnership with you.

		<br>

		Regards,

		<br>

		getscholify';
		$message .= "<html><head></head><body>";
						$message .= '<img src="'.base_url().'/assets/images/logo.png" width=150></body></html>'; 

						mail($to,$subject,$message,$headers);

						$this->session->unset_userdata('otp_number');
		            		redirect('admin');
		                    $this->session->set_flashdata('flash_message_l', 'Your User ID is <b>'.$customer_id.'</b>');
							redirect('signin');
						}
			   
                
				
                }

            }//validation run
		$data['category_list'] = $this->customer_model->get_category_list();
			
        $data['main_content'] = 'registration'; 
        $this->load->view('includes/front/front_template', $data); 
	  
  }

  public function forget_password(){
	
		$data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Forgot Password';
                $data['page_title'] = 'Forgot Password'; 

		 if ($this->input->server('REQUEST_METHOD') === 'POST')
                 {
			

			$this->form_validation->set_rules('user_name', 'user_name', 'required');
			 
	         $email = $this->input->post('user_name');      
         	$findemail = $this->customer_model->forgotPassword($email);  
	        
	         if(empty($findemail)) {

	         	$this->form_validation->set_rules('fwrg', 'password', 'required');
	         	$this->form_validation->set_message('required', 'Username is not Exist.');
	         }

	         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
		   
		    
		  
				if($this->form_validation->run()===TRUE)
				{
					
					$return = $this->customer_model->sendpassword($findemail); 
					$this->session->set_flashdata('flash_message', 'updated');
					redirect(current_url());
				}

		   }
		
					 
		 $data['main_content'] = 'forget_password'; 
        $this->load->view('includes/front/front_template', $data); 	  
			 
}
	public function about()  
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'about';
                $data['page_title'] = 'About'; 
			//$this->load->config('email');
                $this->load->library('email');
        
        /*$from = "info@campus4success.com";
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

      /*  $config = array(
    'protocol' => 'smtp',
    'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_port' => '465',
    'smtp_user' => "info@campus4success.com", 
    'smtp_pass' => "info@campus4success.com", // change it to yours
    'mailtype'  => 'html', 
    'charset'   => 'utf8'
);


        $config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'ssl://smtp.gmail.com',
    'smtp_port' => '465',
    'smtp_user' => 'info@campus4success.com',
    'smtp_pass' => 'info@campus4success.com',
    'smtp_crypto' => 'security', //can be 'ssl' or 'tls' for example
    'mailtype' => 'html', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);*/

/*$this->load->library('email');

$this->email->set_newline("\r\n");
$this->email->set_crlf( "\r\n" );

$this->email->from("info@campus4success.com");
$this->email->to("developer.rahul9888@gmail.com");         
$this->email->subject("test");
$this->email->message(html_entity_decode("Rahul"));
$this->email->send();*/

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'about';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	public function individual() {
        $data['image_error'] = 'false';
        $cimage = '';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
           	
           
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $otp=$this->input->post('otp');
    		$otp_exist=$this->session->userdata('individual_otp_number');
           	if($otp_exist!='') {
				if($otp_exist!=$otp && $otp!='') {
					$this->form_validation->set_rules('error', 'term and condition', 'required');
					$this->form_validation->set_message('required', 'Incorrect OTP.');
				}
			}

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {


            	if ($otp=='' || $this->input->post('submit')=='Resend OTP') {
					$phone = $this->input->post('phone');
					if($phone != '') {
	    				$otp_crt = rand(1000,9999);
	    				
	    				$data['veryfied_msg_otp'] = $otp_crt;
	    				$this->session->set_userdata('individual_otp_number',$otp_crt);
	    				$sms_msg = urlencode("Your OTP for Getscholify registration is ".$otp_crt."\nThank you\nTeam Getscholify");

	    				$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
						file_get_contents($smstext);

	    				$to = $this->input->post('email');
	    				$subject ="OTP form :- OTP for Getscholify Registration";
	    				$txt = "Your OTP for Getscholify is ".$otp_crt.""; 
	    				$headers = "From: Getscholify.com"."\r\n";
	    				$headers = "MIME-Version: 1.0" . "\r\n";     
	    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
	    				$headers .= 'From: <Getscholify.com>' . "\r\n"; 
	    				mail($to,$subject,$txt,$headers);
	    			}

	    			$this->session->set_flashdata('flash_message', 'otp');
					//redirect('signup');

				} else {
					$data_to_store = array(
                    'currency' => $this->input->post('currency'),
                    'amount' => $this->input->post('amount'),
                    'cname' => $this->input->post('cname'), 
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'),
                    'pan' => $this->input->post('pan')
	                );
	                //if the insert has returned true then we show the flash message
	                if ($this->customer_model->add_individual($data_to_store) == TRUE) {
	                	$this->session->unset_userdata('individual_otp_number');
	                    $this->session->set_flashdata('flash_message', 'updated');
	                    redirect('individual');
	                }
	                else {
	                    $this->session->set_flashdata('flash_message', 'not_updated');
	                }
				}


                
            } //validation run
            
        }
        $data['main_content'] = 'individual';
        $this->load->view('includes/front/front_template', $data);
    }
    
	
	public function learn()  
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'individual';
                $data['page_title'] = 'Individual'; 
		
$id=$this->uri->segment(2);
		    $data['get_schloshipsss'] = $this->customer_model->get_schloshipssss($id);
		//echo '<pre>'; print_r( $data['get_schloshipsss']); die();
	        $data['main_content'] = 'learn';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	public function scholar_more()  
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'individual';
                $data['page_title'] = 'Individual'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'scholar_more';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
	
	
	
	/*public function corpo()  
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'corpo';
                $data['page_title'] = 'corpo'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'corpo';
            $this->load->view('includes/front/front_template', $data); 

	}*/
	
	
	
	public function corpo() {
        $data['image_error'] = 'false';
        $cimage = '';
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            //form validation
           
           
            $this->form_validation->set_rules('amount', 'amount', 'required');
            $otp=$this->input->post('otp');
    		$otp_exist=$this->session->userdata('corpo_otp_number');
           	if($otp_exist!='') {
				if($otp_exist!=$otp && $otp!='') {
					$this->form_validation->set_rules('error', 'term and condition', 'required');
					$this->form_validation->set_message('required', 'Incorrect OTP.');
				}
			}

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {


            	if ($otp=='' || $this->input->post('submit')=='Resend OTP') {
					$phone = $this->input->post('phone');
					if($phone != '') {
	    				$otp_crt = rand(1000,9999);
	    				
	    				$data['veryfied_msg_otp'] = $otp_crt;
	    				$this->session->set_userdata('corpo_otp_number',$otp_crt);
	    				$sms_msg = urlencode("Your OTP for Getscholify registration is ".$otp_crt."\nThank you\nTeam Getscholify");

	    				$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
						file_get_contents($smstext);

	    				$to = $this->input->post('email');
	    				$subject ="OTP form :- OTP for Getscholify Registration";
	    				$txt = "Your OTP for Getscholify is ".$otp_crt.""; 
	    				$headers = "From: Getscholify.com"."\r\n";
	    				$headers = "MIME-Version: 1.0" . "\r\n";     
	    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
	    				$headers .= 'From: <Getscholify.com>' . "\r\n"; 
	    				mail($to,$subject,$txt,$headers);
	    			}

	    			$this->session->set_flashdata('flash_message', 'otp');
					//redirect('signup');

				} else {
					$data_to_store = array(
                    'currency' => $this->input->post('currency'),
                    'amount' => $this->input->post('amount'),
                    'c_name' => $this->input->post('c_name'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'City' => $this->input->post('City'),
                    'state' => $this->input->post('state'),
                    'pan' => $this->input->post('pan')
	                );
	                //if the insert has returned true then we show the flash message
	                if ($this->customer_model->add_corporation($data_to_store) == TRUE) {
	                	$this->session->unset_userdata('corpo_otp_number');
	                    $this->session->set_flashdata('flash_message', 'updated');
	                    redirect('corpo');
	                }
	                else {
	                    $this->session->set_flashdata('flash_message', 'not_updated');
	                }
				}

                
            } //validation run
            
        }
        $data['main_content'] = 'corpo';
        $this->load->view('includes/front/front_template', $data);
    }
    
	
	
	
	
	
	
	
	
	
	
	
	public function landing_page()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'landing_page';
                $data['page_title'] = 'Landing Page'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'landing_page';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function courses()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'courses';
                $data['page_title'] = 'courses'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'courses';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function why_us()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'why_us';
                $data['page_title'] = 'why us'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'why_us';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function scholarship()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship';
                $data['page_title'] = 'Scholarship'; 
		

		    $data['get_schloships'] = $this->customer_model->get_schloships();
		    $data['govt_schloships'] = $this->customer_model->get_govt_schloships();
		  //  $data['store'] = substr($data['get_schloships'][0]['discription'],0, 800);
		//	echo '<pre>'; print_r($data['store']); die();
	        $data['main_content'] = 'scholarship';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function learn_more()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship';
                $data['page_title'] = 'Scholarship'; 
				$id=$this->uri->segment(2); 
	
  
		    $data['get_schloshipss'] = $this->customer_model->get_my_scheme($id);
		//echo '<pre>'; print_r($data['get_schloshipss']); die();
		
		   // $data['govt_schloships'] = $this->customer_model->get_govt_schloships();
			
	        $data['main_content'] = 'scholar_more';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
	
	public function Contribute_with_us()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Contribute_with_us';
                $data['page_title'] = 'Contribute_with_us'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Contribute_with_us';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function join_our_team()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'join_our_team';
                $data['page_title'] = 'join_our_team'; 
			
             $data['contact_form'] = '';	
			if ($this->input->server('REQUEST_METHOD') ==='POST') { 
			
				$otp=$this->input->post('otp');
    			$otp_exist=$this->session->userdata('join_our_team_otp');
    			$this->form_validation->set_rules('f_name', 'first_name', 'required');
				$this->form_validation->set_rules('l_name', 'last_name', 'required');
				$this->form_validation->set_rules('email', 'email', 'required|valid_email');
				$this->form_validation->set_rules('phone', 'phone no', 'required|min_length[10]|max_length[10]');
				if($otp_exist!='') {
					if($otp_exist!=$otp && $otp!='') {
						$this->form_validation->set_rules('error', 'term and condition', 'required');
						$this->form_validation->set_message('required', 'Incorrect OTP.');
					}
				}
				$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
				if($this->form_validation->run()===TRUE)
				{

				if ($otp=='' || $this->input->post('submit')=='Resend OTP') {
					$phone = $this->input->post('phone');
					if($phone != '') {
	    				$otp_crt = rand(1000,9999);
	    				
	    				$data['veryfied_msg_otp'] = $otp_crt;
	    				$this->session->set_userdata('join_our_team_otp',$otp_crt);
	    				$sms_msg = urlencode("Your OTP for Getscholify registration is ".$otp_crt."\nThank you\nTeam Getscholify");

	    				$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161829393545508";
						
	    		    		
						file_get_contents($smstext);

	    				$to = $this->input->post('email');
	    				$subject ="OTP form :- OTP for join our team";
	    				$txt = "Your OTP for Getscholify is ".$otp_crt.""; 
	    				$headers = "From: Getscholify.com"."\r\n";
	    				$headers = "MIME-Version: 1.0" . "\r\n";     
	    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
	    				$headers .= 'From: <Getscholify.com>' . "\r\n"; 
	    				mail($to,$subject,$txt,$headers);
	    			}

	    			$this->session->set_flashdata('flash_message', 'otp');

				} else {

					$data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email')
					); 
				
					$store_data = $this->customer_model->contact_us($data_to_store);
					$to = $this->input->post('email');
					$subject ="contact_form :- ".$this->input->post('f_name');
					$message = "f_name :- ";            
					$headers = "From: info@getscholify.com" . "\r\n";
					$headers = "MIME-Version: 1.0" . "\r\n";     
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
					$headers .= 'From: <info@getscholify.com>' . "\r\n"; 
					$from_email_address = 'info@getscholify.com';
					mail($to,$subject,$message,$headers); 
					$this->session->unset_userdata('join_our_team_otp');
					$this->session->set_flashdata('flash_message', 'updated');
					redirect('join_our_team');
					//$data['contact_form'] = 'Great ! Your request has been submitted successfully. We will get back to you soon.';

				}
				

			}

		   // return $this->input->post('f_name');
	}
	
				
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'join_our_team';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	public function signup()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'signup';
                $data['page_title'] = 'signup'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'signup';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function scholarship_form()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship_form';
                $data['page_title'] = 'scholarship_form'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'scholarship_form';
            $this->load->view('includes/front/front_template', $data); 

	}public function scholarship_form3()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship_form3';
                $data['page_title'] = 'scholarship_form3'; 
			
			$id = $this->session->userdata('cust_id');
            if(!$this->session->userdata('cust_id')) { redirect(base_url().'signup'); }


	    	if($this->input->server('REQUEST_METHOD') == 'POST') {

	
			 $this->form_validation->set_rules('qualification', 'Qualification', 'required');
			 $this->form_validation->set_rules('passing_year', 'Passing_year', 'required');
			 $this->form_validation->set_rules('grade', 'Grade', 'required');
			 $this->form_validation->set_rules('percentage', 'Percentage', 'required');
			 $this->form_validation->set_rules('course', 'Course', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				
            	$session = $this->session->userdata('scholarship');

            	$data_to_store = array(
					'qualification'=>$this->input->post('qualification'),
					'passing_year'=>$this->input->post('passing_year'),
					'grade'=>$this->input->post('grade'),
					'percentage'=>$this->input->post('percentage'),
					'course'=>$this->input->post('course'),
					'user_id'=>$id
				);

            	if(!empty($session)) {
            		$session = array_merge($session,$data_to_store);
            	} else {
            		$session = $data_to_store;
            	}

            	if($session['abled']=='') { $session['abled'] = 'No'; }
            	if($session['orphan']=='') { $session['orphan'] = 'No'; }

            	//echo '<pre>'; print_r($session); die();
				


            	$this->session->set_userdata('scholarship',$session);
            	$this->customer_model->insert_manual('scholarship',$session);
            	$this->session->unset_userdata('scholarship');
            	$this->session->set_flashdata('flash_message','updated');

            	$this->customer_model->update_profile_data($id,array('consume'=>1));
				redirect(base_url().'admin');
					
            }
				
                

            }//validation run
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'scholarship_form3';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function scholarship_form4()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship_form4';
                $data['page_title'] = 'scholarship_form4'; 
		
            if(!$this->session->userdata('cust_id')) { redirect(base_url().'signup'); }


	    	if($this->input->server('REQUEST_METHOD') == 'POST') {

	
			 $this->form_validation->set_rules('pin_code', 'Pin Code', 'required');
			 $this->form_validation->set_rules('state', 'State', 'required');
			 $this->form_validation->set_rules('city', 'City', 'required');
			 $this->form_validation->set_rules('occupation', 'Occupation', 'required');
			 $this->form_validation->set_rules('income', 'Income', 'required');
			 $this->form_validation->set_rules('category', 'Category', 'required');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				
            	$session = $this->session->userdata('scholarship');

            	$data_to_store = array(
					'pin_code'=>$this->input->post('pin_code'),
					'state' => explode('~~',$this->input->post('state'))[1],
					'city'=>$this->input->post('city'),
					'occupation'=>$this->input->post('occupation'),
					'income'=>$this->input->post('income'),
					'category'=>$this->input->post('category'),
					'abled'=>$this->input->post('abled'),
					'orphan'=>$this->input->post('orphan'),
				);

            	if(!empty($session)) {
            		$session = array_merge($session,$data_to_store);
            	} else {
            		$session = $data_to_store;
            	}

				
            	$this->session->set_userdata('scholarship',$session);
				redirect(base_url().'scholarship_form3');
					
            }
				
                

            }//validation run



		    $data['category_list'] = $this->customer_model->get_category_list();
		    $data['states'] = $this->customer_model->get_state_list();

	        $data['main_content'] = 'scholarship_form4';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function sub_constituency() {

		$term_id = $this->input->post('term_id');
		$term_id = explode('~~', $term_id)[0];
		$city = $this->customer_model->select_city($term_id);
		//echo '<pre>'; print_r('city'); die();
		echo '<option value="">Select City</option>';
		if(!empty($city)) {
			foreach ($city as $value) {
				echo '<option value="'.$value['name'].'">'.$value['name'].'</option>';
			}
		}
		
		
	}
	

	public function scholarship_form5()
	{
            $data['page_keywords'] = '';
            $data['page_description'] = '';
            $data['page_slug'] = 'scholarship_form5';
            $data['page_title'] = 'scholarship_form5'; 
			
			$id = $this->session->userdata('cust_id');
	    	$customer_id = $this->session->userdata('bliss_id');
	    	$data['profile'] = $this->customer_model->profile($id);
	    	if(!$this->session->userdata('cust_id')) { redirect(base_url().'signup'); }


	    	if($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_rules('f_name', 'First Name', 'required');
			$this->form_validation->set_rules('l_name', 'Last Name', 'required');
			$this->form_validation->set_rules('phone', 'Phone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required');
			if($data['profile'][0]['consume']>0) {
				$this->form_validation->set_rules('error', 'Email', 'required');
				$this->form_validation->set_message('required', 'You already applied for scholarship.');
			}

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				
            	$session = $this->session->userdata('scholarship');

            	$data_to_store = array(
					'f_name'=>$this->input->post('f_name'),
					'l_name'=>$this->input->post('l_name'),
					'phone'=>$this->input->post('phone'),
					'email'=>$this->input->post('email'),
				);

            	if(!empty($session)) {
            		$session = array_merge($session,$data_to_store);
            	} else {
            		$session = $data_to_store;
            	}

				
            	$this->session->set_userdata('scholarship',$session);
				redirect(base_url().'scholarship_form4');
					
            }
				
                

            }//validation run

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'scholarship_form5';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function engineering()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'engineering';
                $data['page_title'] = 'engineering'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'engineering';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function pharmacy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'pharmacy';
                $data['page_title'] = 'pharmacy'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'pharmacy';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function para_medical()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'para_medical';
                $data['page_title'] = 'para_medical'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'para_medical';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Business_management()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Business_management';
                $data['page_title'] = 'Business_management'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Business_management';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Computer_Application()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Computer_Application';
                $data['page_title'] = 'Computer_Application'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Computer_Application';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Food_Agriculture_forestry()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Food_Agriculture_forestry';
                $data['page_title'] = 'Food_Agriculture_forestry'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Food_Agriculture_forestry';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function law()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'law';
                $data['page_title'] = 'law'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'law';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function hotel_and_turism_management()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'hotel_and_turism_management';
                $data['page_title'] = 'hotel_and_turism_management'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'hotel_and_turism_management';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Education_and_Teaching()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Education_and_Teaching';
                $data['page_title'] = 'Education_and_Teaching'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Education_and_Teaching';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Dental()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'Dental';
                $data['page_title'] = 'Dental'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Dental';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function mass()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'mass';
                $data['page_title'] = 'mass'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'mass';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function Nursing()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = ''; 
                $data['page_slug'] = 'Nursing';
                $data['page_title'] = 'Nursing'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'Nursing';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function bankers()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'bankers';
                $data['page_title'] = 'bankers'; 
			
		    $data['category_list'] = $this->customer_model->get_category_list();
			
	        $data['main_content'] = 'bankers';
            $this->load->view('includes/front/front_template', $data); 

	}
	public function grievance()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'grievance';
                $data['page_title'] = 'Grievance'; 
				$customer = $this->session->userdata('bliss_id');
	
			$data['feedback'] = '';	
				$data['tr_pin'] = str_pad(mt_rand(1,9999),6,'0',STR_PAD_LEFT);
					if ($this->input->server('REQUEST_METHOD') == 'POST') {

	
			 $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
	
			
				$data_to_store = array(
					'bliss_code' => $this->input->post('bliss_code'),
                    'email' => $this->input->post('email'),
                    'phone' => $this->input->post('phone'),
					'name' => $this->input->post('name'),
                    'message' => $this->input->post('message'),
                    'tr_pin' => $data['tr_pin'],
                    'type' => 'grievance',
                    'status' => 'pending'
					
				); 
               
			   $this->customer_model->insert_feedback($data_to_store);
			   
					$to = "info@lamlordventures.com";
					$subject =$this->input->post('subject'); 
				 	$txt = "email :- ".$this->input->post('email')."<br/>site speed :- ".$this->input->post('speed')."<br/>feedback :- ".$this->input->post('message')."<br/>Transaction Pin : ".$data['tr_pin']; 
					$headers = "From: feedback@lamlordventures.com" . "\r\n";	
					$headers = "MIME-Version: 1.0" . "\r\n"; 
					$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
					$headers .= 'From: <lamlordventures.com>' . "\r\n";   
					mail($to,$subject,$txt,$headers);	
					$data['feedback'] = 'mail sent successfully';		
                    $this->session->set_flashdata('flash_message', 'updated');
					$data['feedback'] = 'successfully';	
					
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'grievance';
			$this->load->view('includes/front/front_template', $data); 

	}

	public function store_locator()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'store-locator';
                $data['page_title'] = 'Store Locator';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'store_locator';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function help()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'help';
                $data['page_title'] = 'Help';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'help';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function contact_us()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'join_our_team';
                $data['page_title'] = 'join_our_team'; 
			
             $data['contacts_form'] = '';	
			if ($this->input->server('REQUEST_METHOD') ==='POST') { 
			
			
			$data_to_store = array(
                    'name' => $this->input->post('name'),
                    'subject' => $this->input->post('subject'),
                    'phone' => $this->input->post('phone'),
                    'email' => $this->input->post('email'),
                    'message' => $this->input->post('message')
					
                 
					
				); 
				
				 $stores_data = $this->customer_model->insert_contact_us($data_to_store);
					
				//$this->load->library('email');


				/*$config = Array(
			    'protocol' => 'smtp',
			    'smtp_host' => 'ssl://smtp.googlemail.com',
			    'smtp_port' => 465,
			    'smtp_user' => 'info@getscholify.com',
			    'smtp_pass' => 'info@getscholify.com',
			    'mailtype'  => 'html', 
			    'charset'   => 'iso-8859-1'
			);
			$this->load->library('email', $config);


				$config = array();
				$config['protocol'] = 'smtp';
				$config['smtp_host'] = 'ssl://smtp.googlemail.com';
				$config['smtp_user'] = 'info@getscholify.com';
				$config['smtp_pass'] = 'info@getscholify.com';
				$config['smtp_port'] = 465;
				$this->email->initialize($config);
				//$this->email->set_newline("\r\n");

				$this->email->from('info@getscholify.com', 'Identification');
				$this->email->to('hackertool9888@gmail.com');
				$this->email->subject('Send Email Codeigniter');
				$this->email->message('The email send using codeigniter library');
				echo $this->email->send();

				die();*/
				//$to = "deeksharma321@gmail.com";
				$to = "developer.rahul9888@gmail.com" ;
				$subject ="contact_form :- ".$this->input->post('f_name');
				$message = "f_name :- ";            
				//$headers = "From: info@getscholify.com" . "\r\n";
				//$headers = "MIME-Version: 1.0" . "\r\n";     
				//$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
				//$headers .= 'From: <info@getscholify.com>' . "\r\n"; 
				//$from_email_address = 'info@getscholify.com';
				//mail($to,$subject,$message,$headers); 


				//$to = $this->input->post('email');
				


				/*$from_email_address = 'info@getscholify.com';
				mail($to, $subject, $message, $headers, '-f'.$from_email_address); die();
				//echo mail($to,$subject,$message,$headers);
				$data['contact_form'] = 'Great ! Your request has been submitted successfully. We will get back to you soon.';*/		
				//}

				$from = 'info@getscholify.com';
				$this->load->library('email');
				$this->email->set_mailtype("html");
		        $this->email->from($from,'Getscholify');
		        $this->email->to($to);
		        $this->email->subject($subject);
		        $this->email->message($message);
			   $this->email->send();
    //die();
		$data['contacts_form'] = 'Great ! Your request has been submitted successfully. We will get back to you soon.';

		   // return $this->input->post('f_name');
	}
	
				
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'contact_us';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function mailer()
	{
               	
			if ($this->input->server('REQUEST_METHOD') ) { // die();
				$to = "campus4success@gmail.com";
				//$to = "hackertool9888@gmail.com";
				//$to = $email;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: campus4success <info@campus4success.com>' . "\r\n"; 
				$subject = 'Contact request at campus4success';
				
				$message = "name :- ".$this->input->post('name')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>subject :- ".$this->input->post('subject')."<br/>message :- ".$this->input->post('message');   

				$mail= mail($to,$subject,$message,$headers);   
			echo	'<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong>Request sent successfully</strong></div>';	
					}												
	       
	}
	public function feedback()	{  
	$data['page_keywords'] = '';    
	$data['page_description'] = ''; 
	$data['page_slug'] = 'feedback'; 
	$data['page_title'] = 'feedback'; 
	$data['category_list'] = $this->customer_model->get_category_list();
	$data['feedback'] = '';	
	if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact')=='Submit') {
		$to = "shoppersearning@gmail.com";
		$subject =$this->input->post('subject'); 
		$txt = "email :- ".$this->input->post('email')."<br/>site speed :- ".$this->input->post('speed')."<br/>feedback :- ".$this->input->post('message'); 
		$headers = "From: http://shoppersearning.33demo.com/" . "\r\n";	
		$headers = "MIME-Version: 1.0" . "\r\n"; 
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
		$headers .= 'From: <http://shoppersearning.33demo.com/>' . "\r\n";   
		mail($to,$subject,$txt,$headers);	
		$data['feedback'] = 'mail sent successfully';		}
		$data['main_content'] = 'feedback'; 
		$this->load->view('includes/front/front_template', $data); 	}
		
		public function complaint()	{  
		$data['page_keywords'] = '';    
		$data['page_description'] = '';  
		$data['page_slug'] = 'complaint'; 
		$data['page_title'] = 'complaint';  
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['complaint'] = '';
		
		if ($this->input->server('REQUEST_METHOD') && $this->input->post('contact')=='Submit') {
			$to = "shoppersearning@gmail.com";   
			$subject ="complaint :- ".$this->input->post('subject');  
			$txt = "name :- ".$this->input->post('name')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>complaint :- ".$this->input->post('message'); 
			$headers = "From: http://shoppersearning.33demo.com/" . "\r\n";	
			$headers = "MIME-Version: 1.0" . "\r\n";    
			$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
			$headers .= 'From: <http://shoppersearning.33demo.com/>' . "\r\n";    
			mail($to,$subject,$txt,$headers);	
			$data['complaint'] = 'mail sent successfully';	}													  
			$data['main_content'] = 'complaint';    
			$this->load->view('includes/front/front_template', $data); 	}	

			
	public function faq()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'faq';
                $data['page_title'] = 'FAQ';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'faq';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function how_do_i_shop()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'how_do_i_shop';
                $data['page_title'] = 'How do I shop';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'how_do_i_shop';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function terms_of_use()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'terms_of_use';
                $data['page_title'] = 'Terms of Use';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'terms_of_use';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function how_do_i_pay()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'how_do_i_pay';
                $data['page_title'] = 'How do I pay';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'how_do_i_pay';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function privacy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'privacy';
                $data['page_title'] = 'Privacy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'privacy';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function cancellation()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'cancellation';
                $data['page_title'] = 'cancellation';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'cancellation';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function return_policy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'return_policy';
                $data['page_title'] = 'return_policy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'return_policy';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function stories()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'stories';
                $data['page_title'] = 'stories';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'stories';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function desclaimer()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'desclaimer';
                $data['page_title'] = 'desclaimer';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'desclaimer';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function shipping_policy()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'shipping_policy';
                $data['page_title'] = 'Shipping Policy';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'shipping_policy';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function exchanges_return()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'exchanges_return';
                $data['page_title'] = 'Exchanges & Return';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'exchanges_return';
            $this->load->view('includes/front/front_template', $data); 
	}
	public function happy_hours()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'happy_hours';
                $data['page_title'] = 'Happy Hours';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'happy_hours';
            $this->load->view('includes/front/front_template', $data); 
	} 
		public function ways_to_earn()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'ways_to_earn';
                $data['page_title'] = 'Ways to earn';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'ways_to_earn';
            $this->load->view('includes/front/front_template', $data); 
	} 
	
	
	
	public function track_order()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'track_order';
                $data['page_title'] = 'Track Order';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'track_order';
            $this->load->view('includes/front/front_template', $data); 
	} 
	
	
	public function corporate()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'corporate';
                $data['page_title'] = 'Corporate';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'corporate';
            $this->load->view('includes/front/front_template', $data); 
	}
	
	public function send_a_query()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'send_a_query';
                $data['page_title'] = 'Send a query';  

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'send_a_query';
            $this->load->view('includes/front/front_template', $data); 
	}
	
		public function career()	{  
		$data['page_keywords'] = '';    
		$data['page_description'] = '';  
		$data['page_slug'] = 'career'; 
		$data['page_title'] = 'career';  
		$data['category_list'] = $this->customer_model->get_category_list();
		$data['career'] = '';
		$data['imgerror'] = '';
         if($this->input->post('contact') == 'Submit'){
			 
		  $this->form_validation->set_rules('fname', 'first name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('email', 'email', 'required|trim');
           $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[10]');
		   
              $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {
				
             $this->load->library('email');
             
              $config['upload_path'] = 'images/career-cv/';
              $config['allowed_types'] = 'jpg|png|jpeg|pdf|doc|docx';
              $config['max_size'] = '100000';
             $this->load->library('upload', $config);
             //$this->upload->do_upload('image');
			 if ($this->upload->do_upload('image')) { 
			     $upload_data = $this->upload->data();
					   
		    }  else {
                         $data['imgerror'] = $this->upload->display_errors();
						
			        }
             //$upload_data = $this->upload->data();
			 if($data['imgerror']=='') {
			 $subject ="Career request from :- ".$this->input->post('fname');
			$message= "name :- ".$this->input->post('fname')."<br/>email :- ".$this->input->post('email')."<br/>phone :- ".$this->input->post('phone')."<br/>City :- ".$this->input->post('city')."<br/>state :- ".$this->input->post('state')."<br/>pin :- ".$this->input->post('pin')."<br/>Dob :- ".$this->input->post('Dob')."<br/>age :- ".$this->input->post('age')."<br/>gender :- ".$this->input->post('gender')."<br/>Highest Qualification :- ".$this->input->post('hq')."<br/>Total work experience :- ".$this->input->post('workexp')."<br/>Current Employer :- ".$this->input->post('currentemp')."<br/>Reason for job change :- ".$this->input->post('reason')."<br/>Interested in :- ".$this->input->post('intrest')."<br/>Expected Salary :- ".$this->input->post('expected');
             
             $this->email->attach($upload_data['full_path']);
			  $this->email->set_mailtype("html");
             $this->email->set_newline("\r\n");
             $this->email->set_crlf("\r\n");
             $this->email->from('info@blisszon.com'); // change it to yours
             $this->email->to('info@lamlordventures.com'); // change it to yours
             $this->email->subject($subject);
             $this->email->message($message);
             if ($this->email->send()) {
             $data['career'] = 'mail sent successfully';
             } 
			 else{
				$this->session->set_flashdata('flash_message', 'career'); 
			 }
			 
			 }
			 
    }
    }
		$data['main_content'] = 'career'; 
      $this->load->view('includes/front/front_template', $data); 
    
 }
 
 
 public function offers()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'offers';
                $data['page_title'] = 'offers'; 
		

		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'offers';
            $this->load->view('includes/front/front_template', $data); 

	}
	
		public function business_plan()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'business_plan';
                $data['page_title'] = 'Business Plan'; 
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'business_plan';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function login(){
		
		       $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'business_plan';
                $data['page_title'] = 'Business Plan'; 
    if($this->session->userdata('is_customer_logged_in')){
			redirect(base_url().'admin');
        }
               // print_r($this->session->userdata()); die();
		      if ($this->input->server('REQUEST_METHOD') === 'POST')
                 {
		
			$this->form_validation->set_rules('user_name', 'user_name', 'required');
			$this->form_validation->set_rules('password', 'password', 'required');
			 $user_name = $this->input->post('user_name');
			 $password = md5($this->input->post('password'));
	         $valid = $this->customer_model->validate($user_name,$password);
	         
	         if(empty($valid)) {
	         	$this->form_validation->set_rules('fwrg', 'password', 'required');
	         	$this->form_validation->set_message('required', 'Username or password is incorrect.');
	         }

	         $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            
		   
		    
		  
				if($this->form_validation->run()===TRUE)
				{


					$data = array('full_name'=>$valid[0]['f_name'], 'email'=>$valid[0]['email'], 'bliss_id'=>$valid[0]['customer_id'],  'cust_id'=>$valid[0]['id'], 'rdate'=>$valid[0]['rdate'], 'cust_img'=>$valid[0]['image'], 'is_customer_logged_in' => true);
            		$this->session->set_userdata($data);
					redirect('admin');


				}

		  
		
			
		
				 }
				 
		 $data['main_content'] = 'signin'; 
        $this->load->view('includes/front/front_template', $data); 
	
		
	
	}
	
	
	
			public function quiz()
	{
	    
	    	if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url());	  }
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'quiz';
                $data['page_title'] = 'quiz'; 
                 $user_id= $this->session->userdata('cust_id');
                
		    $data['quiz'] = $this->customer_model->quiz();
		    $re = array();
		    foreach($data['quiz'] as $rest) {
		       $re[]= $rest['eid'];
		    }
		    
		    $data['quiz_his'] = $this->customer_model->get_u_q_history($re,$user_id);
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'quiz';
            $this->load->view('includes/front/front_template', $data); 

	}
	
			public function quiz_start()
	{
	    
	    	if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url());	  }
	    	 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'quiz';
                $data['page_title'] = 'quiz'; 
	    	
            $eid=$this->uri->segment(2); 
            $sn=$this->uri->segment(3); 
            $total=$this->uri->segment(4); 
            
           
            
          	if ($this->input->server('REQUEST_METHOD') === 'POST')
  {
    
    $ans=$this->input->post('ans');
    $qid=$this->input->post('qid');
  
    $user_id= $this->session->userdata('cust_id');
      $q = $this->customer_model->get_answer($qid);
      $ansid=$q[0]['ansid']; 
    
    if($ans == $ansid)
    {
         $q = $this->customer_model->get_quiz_ans($eid);
      
        $sahi=$q[0]['sahi'];
      
     
      if($sn == 1)
      {
        $qd= $this->customer_model->store_menual('quiz_history',array('email' => $user_id,'eid' => $eid));
      }
      
      
      $q_h = $this->customer_model->get_history($eid,$user_id);
     
       $s=$q_h[0]['score'];
       $r=$q_h[0]['sahi']+1;
      
       $s=$s+$sahi;
       $qd= $this->customer_model->update_history($eid,$user_id,array('score' => $s,'level' => $sn,'sahi' => $r));
       
    } 
    else
    {
        
        $q = $this->customer_model->get_quiz_ans($eid);
        $wrong=$q[0]['wrong'];
      
      if($sn == 1)
      {
        $qd= $this->customer_model->store_menual('quiz_history',array('email' => $user_id,'eid' => $eid));
      }
       $q_h = $this->customer_model->get_history($eid,$user_id);
      
        $s=$q_h[0]['score'];
        $w=$q_h[0]['wrong']+1;
      $s=$s-$wrong;
      $qd= $this->customer_model->update_history($eid,$user_id,array('score' => $s,'level' => $sn,'wrong' => $w));
    }
    
    if($sn != $total)
    {
      $sn++;
      redirect('start-quiz/'.$eid.'/'.$sn.'/'.$total);
    }
    else
    {
    $q_h = $this->customer_model->get_history($eid,$user_id);
    $this->customer_model->update_profile($user_id,$q_h[0]['score']);
        //header("location:welcome.php?q=result&eid=$eid");
     redirect('quiz-result/'.$eid);
    }
  }

            
            
		   
           
		    $data['category_list'] = $this->customer_model->get_category_list();
			$data['quiz_ques'] = $this->customer_model->quiz_question($eid,$sn);
			if(!empty($data['quiz_ques'])){
		    $data['q_ans'] = $this->customer_model->questionans($data['quiz_ques'][0]['qid']);
		    
		    $data['qans'] = $this->customer_model->get_answer($data['quiz_ques'][0]['qid']); 
		    
			}else{
			 $data['q_ans']=''; 
			 $data['qans']='';
			}
			
			
	        $data['main_content'] = 'quiz_start';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
			public function quiz_result()
	{
	    
	    	if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url());	  }
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'result';
                $data['page_title'] = 'quiz'; 
                
              $eid=$this->uri->segment(2);  
              $user_id= $this->session->userdata('cust_id');  
                
		    $data['result'] = $this->customer_model->get_history($eid,$user_id);
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'quiz_result';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	
	
}