<?php 
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
	    $this->load->library('form_validation');
		$this->load->model('Users_model');
		 require_once APPPATH.'third_party/src/Google_Client.php';
	require_once APPPATH.'third_party/src/contrib/Google_Oauth2Service.php';
    }

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		if($this->session->userdata('is_customer_logged_in')){
			redirect(base_url().'admin/welcome');
        }else{
        	$this->load->view('admin/login');	
        }
	}
	
	function super_admin_login() {	 
		$this->load->model('Users_model');

		$user_name = $this->input->post('bcono');
		$auth = $this->input->post('auth');
        $pass = md5('@#96pp~~'.md5('AdWinAdmin'));
		
		
		if($auth != $pass) { 
			echo '<div style="color:#ff0000;font-weight:bold;">Your auth key has been expired.</div>';
			return; 
		}
		 
		$is_valid = $this->Users_model->super_admin_validate($user_name);
		
		if($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'rdate'=>$is_valid['rdate'], 'is_customer_logged_in' => true);
			
			 $this->session->set_userdata($data);
			
			//////////// update his rank /////////////////
			$this->update_rank($is_valid['cust_id'],$is_valid['bliss_id'],$is_valid['rank'],$is_valid['active_child'],$is_valid['child_lbv']);
			
			redirect(base_url().'admin');
		}
		else // incorrect username or password
		{
			echo '<div style="color:#ff0000;font-weight:bold;">User does not exist please check your ID No.</div>';	
		}
		
	}	
	
	
	
	  public function shortcut_loop() {
		
		
		$tree_data = $this->Users_model->get_empty_shell();
		//print_r($tree_data);
		$tree_data_id = $tree_data[0]['id'];
		$complete_level = $tree_data[0]['complete_level'];
		$pending_level = $tree_data[0]['pending_level'];

			/*** Check Level Complete OR Not ***/
		$last_level_consume_list = $this->Users_model->count_last_level_customer($complete_level,'1');
		
		$customer_count =  pow(3,$complete_level);

		if($last_level_consume_list == $customer_count) {
			
			$data = array('complete_level' => $complete_level + 1,
						'pending_level' => $pending_level + 1
				);
			$this->Users_model->update_auto_pool($tree_data_id,$data);
			
		$complete_level =	$complete_level + 1;
		$pending_level =	$pending_level + 1;
			
		}
		
		/*** Check Level Complete OR Not END ***/

		$max = $this->Users_model->get_select_max();
		$p =0;
		while($p < 1) {
			
		$last_level = $this->Users_model->get_last_level_customer($complete_level,'0');
		
		if(!empty($last_level)) {
		$my_frnds = $this->Users_model->count_myfrnds_customer($last_level[0]['customer_id']);
		
		if($my_frnds > 1) {
			$data = array('level_consume' => 1);
			$this->Users_model->update_customer_array_data($last_level[0]['id'],$data);
		}
		$p = 1;
		
		} elseif($complete_level <= $max[0]['level'] ) { $complete_level = $complete_level+ 1; $p = 0; } else { $p = 1; }
		
	}
		
		if(!empty($last_level) ) {
		return array('customer_id' => $last_level[0]['customer_id'],'level' => $last_level[0]['level']);
		
		} else { return FALSE; }
		
	
	}
	
	
	
	function get_bliss_code_by_phone(){
		$this->load->model('Users_model');
		$phone = $this->input->post('phone');
		if($phone=='') {
			echo 'Please enter proper Sponser ID.';
		} else {
	   $customerid = $this->Users_model->get_bliss_code_by_phone($phone);
	   if(empty($customerid)) { echo 'No record found.'; }
	   else {  
	     foreach($customerid as $val){
		    echo $val['f_name'].' '.$val['l_name'] ;	 
		 }
	   }
	 }
	}
  
	function profile()
	{
		$this->load->model('Users_model');
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'profile';
                $data['page_title'] = 'Profile';  
 
		if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
			redirect(base_url().'admin');
         
	}
    /**
    * encript the password 
    * @return mixed
    */	
    function __encrip_password($password) {
        return md5($password);
    }	

    /**
    * check the username and the password with the database
    * @return void
    */
	function validate_credentials()
	{	

		$this->load->model('Users_model');

		$user_name = $this->input->post('user_name');
		$password = $this->__encrip_password($this->input->post('password'));

		$is_valid = $this->Users_model->validate($user_name, $password);
		
		if($is_valid['login']=='true' && $is_valid['status']=='deactive')
		{ 
			echo '<div class="alert alert-danger">Your account suspended please contact to administrator.</div>';	
			//$this->load->view('admin/login', $data);	
                }
		elseif($is_valid['login']=='true')
		{
			$data = array('full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'rdate'=>$is_valid['rdate'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
            $this->session->set_userdata($data);
			
			//////////// update his rank /////////////////
			$this->update_rank($is_valid['cust_id'],$is_valid['bliss_id'],$is_valid['rank'],$is_valid['active_child'],$is_valid['child_lbv']);
			
			echo '<div class="alert alert-success"></div>';
			//redirect(base_url().'admin');
		}
		else // incorrect username or password
		{
			echo '<div class="alert alert-danger">Username or password is wrong.</div>';	
		}
		
	}	

	 function update_rank($id,$customer_id,$rank,$active_child,$child_lbv){ 
	     //echo $id.' - '.$customer_id.' - '.$rank.' - '.$active_child.' - '.$child_lbv.'<br>';
	     $rank_grade = array('norank'=>0,'Marketing Executive'=>1,'Assistant Manager'=>2,'Manager'=>3,'Team Leader'=>4);
	     $count_rank = 0;
		 if($rank=='') { $rank = 'norank'; }
		$child_users = $this->Users_model->get_child_users($customer_id);
		//print_r($child_users);
		if(!empty($child_users)) {
			foreach($child_users as $child) {
				if($child['bsacode']=='Assistant Manager') { $count_rank = $count_rank  + 1; }
				if($child['bsacode']=='Manager') { $count_rank = $count_rank  + 1; }
				if($child['bsacode']=='Team Leader') { $count_rank = $count_rank  + 1; }
			}
		}
		if($count_rank > 1) { $current_rank = 'Team Leader'; }
		elseif($count_rank > 0) { $current_rank = 'Manager'; }
		elseif($active_child > 3 && $child_lbv > 99) { $current_rank = 'Assistant Manager'; }
		elseif($active_child > 1 && $child_lbv > 49) { $current_rank = 'Marketing Executive'; }
		else { $current_rank = 'norank'; }
		 
		 //echo 'current_rank '.$current_rank.' count_rank '.$count_rank;die();
		if($rank_grade[$rank] < $rank_grade[$current_rank] && $current_rank != 'norank') {
			$data_to_store = array('bsacode'=>$current_rank);
			$this->Users_model->update_profile($id, $data_to_store);
		}
	 
	 }
	 function admin_welcome(){ 
        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url().'admin');  }
		$data['main_content'] = 'profile'; 
        $this->load->view('includes/admin/template', $data); 
	 }
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		$this->load->view('admin/register');	
	}



	function validate_upl_credentials()
	{	
//print_r($_POST); 
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('fname', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
			
					
					// file upload start here
			$config['upload_path'] ='images/customproduct/';
	        //$config['allowed_types'] = 'dwg|dxf';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = '';
			        }
			        //----- end file upload -----------
					
		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		$data = array(
				'name' => $this->input->post('fname'),
				'email' => $this->input->post('email'),
				'phone' => $this->input->post('phone'),
				'doc' => $image,
				'status' => 'pending',						
				'frm_req' => $this->input->post('frm_req')						
			);
		
		
		   $this->load->model('Users_model');
			$query = $this->Users_model->validate_upl_credentials($data);
		
	}	
	

	
	function validate_review()
	{	

		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('comment', 'comment', 'trim');
			
				
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		$data = array(
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'comment' => $this->input->post('comment'),
				'pro_id' => $this->input->post('pro_id'),
				'rating' => $this->input->post('rating'),
				'status' => 'pending'					
			);
		
		
		   $this->load->model('Users_model');
			$query = $this->Users_model->validate_review($data);
		
	}	
	
	
	
	
	
    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('f_name', 'first name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('l_name', 'last name', 'trim|required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('cpassword', 'confirm password', 'trim|required|min_length[6]|matches[password]');
		$this->form_validation->set_rules('phone', 'phone', 'trim|required|numeric|min_length[10]|max_length[10]');
		
		
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('register');
		}
		
		else
		{			
			$this->load->model('Users_model');
			$query = $this->Users_model->create_member();

			if($query == 'false bliss_code')
			{  
				$this->session->set_flashdata('register', 'bliss_code'); 
				$this->load->view('register');			
			}
			elseif($query == 'false bliss_code_over')
			{  
				$this->session->set_flashdata('register', 'bliss_code_over'); 
				$this->load->view('register');			
			}
			elseif($query != 'false' && $query != '')
			{
				$data['userregisterid'] = $query;
				
				$return_value = $this->shortcut_loop(); 
				
				if($return_value != '') {
					
					$data_to = array('parent_customer_id' =>$return_value['customer_id'],'level'=>$return_value['level']+1);
					$this->Users_model->update_profile_by_customer($query,$data_to);
					
				}
				
				$this->session->set_flashdata('register', 'true'); 
				$this->load->view('register',$data);
			}
			else
			{  
				$this->session->set_flashdata('register', 'already'); 
				$this->load->view('register');			
			}
		}
		
	}
	
	
	
	     public function forgotPassword()
   {
	   $this->load->model('Users_model');
         $email = $this->input->post('user_name');      
         $findemail = $this->Users_model->forgotPassword($email);  
         if($findemail){
          $return = $this->Users_model->sendpassword($findemail);     
          if($return=='true') { echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Please check your email OR phone.';
          echo '</div>';   
           } else { 
             echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email not send.';
          echo '</div>';  
             }   
           }else{ 
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email not exist please check your email.';
          echo '</div>';  
          }
   }
   
   
 function forgot_password(){
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('user_email', 'email', 'required|trim|valid_email');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$data_to_store = array(
                    'pname' => $this->input->post('p_name'),
					'description' => $this->input->post('p_discription'),
					'image' => $image,
					'price' => $this->input->post('p_price')
				); 
                //if the insert has returned true then we show the flash message
				/*if($this->product_model->store_product($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/product/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }*/
				 
            }//validation run

        }
		$this->load->view('admin/forgot_password');
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	/**
    * Destroy the session, and logout the user.
    * @return void
    */		
	function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url().'');
	}
	
	public function google_login()
	{
	
		$clientId = '1037778827560-8821mtqtn6qt8vq0vfpdllbdtnr7rj6b.apps.googleusercontent.com'; //Google client ID
		$clientSecret = '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'; //Google client secret
		$redirectURL = base_url() .'google_login';
		
		//https://curl.haxx.se/docs/caextract.html

		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);
		$google_oauthV2 = new Google_Oauth2Service($gClient);
		
		if(isset($_GET['code']))
		{
			$gClient->authenticate($_GET['code']);
			$_SESSION['token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['token'])) 
		{
			$gClient->setAccessToken($_SESSION['token']);
		}
		
		if ($gClient->getAccessToken()) {
            $userProfile = $google_oauthV2->userinfo->get();
			$email = $userProfile['email'];
			if(!empty($email)){
            $con1['conditions'] = array(
                'email' => $email,
            );
             $userCount = $this->Users_model->getRows($con1);

			 if($userCount > 0){

              $is_valid = $this->Users_model->loginwithemail($email);

             /* echo '<pre>'; print_r($is_valid);
             die();
              */
			  if($is_valid['login']=='true')
    	{
    		$data = array('full_name'=>$is_valid['f_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'], 'cust_img'=>$is_valid['cust_img'], 'is_customer_logged_in' => true);
    		$this->session->set_userdata($data);
    		$this->session->set_userdata('time',time());
			redirect(base_url().'admin');
    	}

			 }else{
				  $userData = array(
                //'d_name' => $userProfile['name'],
                'f_name' => $userProfile['given_name'],
                'email' => $email,
                'phone' => '',
                'status' => 'active',
                );
                $insert = $this->Users_model->google_insert($userData);
				if($insert){
                   $is_valid = $this->Users_model->loginwithemail($email);
				     if($is_valid['login']=='true')
    	{
    		$data = array('full_name'=>$is_valid['d_name'], 'email'=>$is_valid['email'], 'bliss_id'=>$is_valid['bliss_id'],  'cust_id'=>$is_valid['cust_id'],'userid'=>$is_valid['userid'], 'cust_img'=>$is_valid['cust_img'], 'prime'=>$is_valid['prime'], 'is_customer_logged_in' => true);
    		$this->session->set_userdata($data);
    		$this->session->set_userdata('time',time());
			redirect(base_url().'my-profile');
    	}
				   
				}
				 
			 }
			 
			 
			}
			 
        } 
		else 
		{
            $url = $gClient->createAuthUrl();
		    header("Location: $url");
            exit;
        }
	}	
  	
}
  
