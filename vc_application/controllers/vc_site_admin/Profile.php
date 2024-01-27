<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Profile extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('Users_model');

       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
       
    }

 public function index() {
		$data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'profile';
        $data['page_title'] = 'Profile';  
  
        $data['myfriends'] = array();
		$id = $this->session->userdata('cust_id');
		//print_r($id);die();
	
	    $customer_id = $this->session->userdata('bliss_id');
				
			
		$data['profile'] = $this->Users_model->profile($id);


		if ($this->input->server('REQUEST_METHOD')=='POST') {
			if($data['profile'][0]['consume']==0) {
				redirect(base_url().'scholarship_form5');
			} else {
				$this->session->set_flashdata('flash_message', 'error');
			}

		}
		//echo '<pre>'; print_r($data['profile']);die();
		//$data['disapprove'] = $this->Users_model->get_all_disapprove_data($id);
		
		$data['shelf_income'] = $this->Users_model->get_income($id);
		
		$data['news'] = $this->Users_model->news_feed();
		$data['sale'] = $this->Users_model->sale_data($id);
		$data['sale_data'] = $this->Users_model->total_sale_data($id);
		$data['total_pv'] = $data['total_bv'] = 0;
		if(!empty($data['sale'])) {
			$data['total_pv'] = $data['sale'][0]['amount'];
			$data['total_bv'] = $data['sale'][0]['bv'];
		}
		if(!empty($data['sale_data'])) {
			$data['total_pv'] = $data['total_pv'] + $data['sale_data'][0]['amount']; 
			$data['total_bv'] = $data['total_bv'] + $data['sale_data'][0]['bv']; 
		}
		//$data['total_pv'] = $data['sale'] + $data['sale_data']+0;
		//echo '<pre>'; print_r($data['sale_data']);die();
			
			 
		/************ friend level 1 ******************/
        //$myfriends = $this->Users_model->my_friends($customer_id);
		$myfriendid = array($id);
		
		$ciruserlimit = 0;
		if(!empty($myfriendid)){
        //$circle_order = $this->Users_model->my_first_circle_order($myfriendid);
		$cirorder = array();  
		}
		$data['ciruserlimit'] = $ciruserlimit;
		$user_total_income = $this->Users_model->total_transaction($id,'Weekly Closing');
		
		$data['user_total_income'] = $user_total_income[0]['total_income_fund'] + 0;
		$data['Marketing_Expense'] = $this->Users_model->get_active_incomes_amount($id,'Marketing Expense');


		if(date('d')<=7) {
			$sdate = date('Y-m-d',strtotime('first day of previous month'));
			$edate = date('Y-m-d',strtotime('last day of previous month'));
		} else {
			$sdate = date('Y-m-d',strtotime('first day of this month'));
			$edate = date('Y-m-d',strtotime('last day of this month'));
		}

		$data['monthly_income'] = $this->Users_model->total_income_monthly($id,$sdate,$edate);


		if(date('d') <= 7) {
			$sdate = date('Y-m-d 00:00:00',strtotime('first day of previous month'));
			$edate = date('Y-m-d H:i:s');
		} else {
			$sdate = date('Y-m-d H:i:s',strtotime('first day of this month'));
			$edate = date('Y-m-d H:i:s');
		}
		

		$data['monthly_sale'] = $this->Users_model->get_monthly_bill($id,$sdate,$edate);
		$data['monthly_pinsale'] = $this->Users_model->get_monthly_salebill($id,$sdate,$edate);


		//print_r($data['monthly_sale']); die();

		//$data['products'] = $this->Users_model->my_orders($id);
		//$data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
		//$data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
		//$data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);

		$data['redeem_error'] = '';
		
		 
	 
$data['shopping_voucher_modal'] = '';
	
		
	
	
		
		
		$data['main_content'] = 'admin/admin_welcome';
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function get_friend_by_id($customer_id){
	  $return = array('name'=>'','friends'=>'','return'=>'false');
	  $myfriends = $this->Users_model->my_friends($customer_id);
		if(!empty($myfriends)) { 
            foreach($myfriends as $friend) {
				$inner_friends_array = $this->Users_model->my_friends($friend['customer_id']);
				$inner_friends = count($inner_friends_array);
				$return = array('name'=>$friend['f_name'].' '.$friend['l_name'],'friends'=>$inner_friends,'return'=>'true');
			}
                }
				return $return; 
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
	
  
   public function profile(){ 
	 $id = $this->session->userdata('cust_id');
	     $customer_id = $this->session->userdata('bliss_id');
	     $data['profile'] = $this->Users_model->profile($id);
if ($this->input->server('REQUEST_METHOD')) {
            /*form validation*/
           $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('l_name', 'last name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
           $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');
		   
		   $var_status = 'no';
		   
		   /*$applied_pan = $this->input->post('applied_pan');
		    if($applied_pan!='yes') {
             $this->form_validation->set_rules('pancard', 'pan card', 'required|trim|min_length[10]|max_length[10]');
			}*/
			
			
		    /*if($applied_aadhar!='yes') {
             $this->form_validation->set_rules('aadhar', 'aadhar card', 'required|trim|min_length[12]|max_length[12]');
			}
		   	else*/ 

		   	if($data['profile'][0]['var_status']=='yes') {
             $this->form_validation->set_rules('tfg', 'pan card', 'required|trim|min_length[12]|max_length[12]');
			 $this->form_validation->set_message('required','Already Approved.');
			}
		   	
			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('images/user/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						$var_status = $this->input->post('var_status');
					}
            else { $image = $this->input->post('image_old'); }
			
			/*$panimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('panimage')) { 
                    if($this->input->post('panimage_old')!='') unlink('images/user/'.$this->input->post('panimage_old'));
                         $image_data = $this->upload->data();
					    $panimage = $image_data['file_name'];
					}
            else { $panimage = $this->input->post('panimage_old'); }*/
				  
			$aadharimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1024';
            //$config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('aadharimage')) { 
                    if($this->input->post('aadharimage_old')!='') unlink('images/user/'.$this->input->post('aadharimage_old'));
                         $image_data = $this->upload->data();
					    $aadharimage = $image_data['file_name'];
					}
            else { $aadharimage = $this->input->post('aadharimage_old'); }
			
			
			/*	$b_aadharimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
   		    $this->load->library('upload', $config);		
			if (!$this->upload->do_upload('b_aadharimage')) {		
			$error = array('error' => $this->upload->display_errors());		
			$this->session->set_flashdata('error',$error['error']);		
			}
		   if ($this->upload->do_upload('b_aadharimage')) { 
                    if($this->input->post('b_aadharimage_old')!='') unlink('images/user/'.$this->input->post('b_aadharimage_old'));
                         $image_data = $this->upload->data();
					    $b_aadharimage = $image_data['file_name'];
					}
            else { $b_aadharimage = $this->input->post('b_aadharimage_old'); } */
			
			
			
			
			
			
                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'aadhar' => $this->input->post('aadhar'),
                    'image' => $image,  
                    'gender' => $this->input->post('gender'), 
                    'dob' => $this->input->post('dob'),
                    'phone' => $this->input->post('phone'),  
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'), 
                    'pincode' => $this->input->post('pincode'),
                  //  'pancard' => $this->input->post('pancard'),  
                    'applied_pan' => $applied_pan,
                    'aadharimage' => $aadharimage,
                    'gender' => $this->input->post('gender'),
                    'var_status' => $var_status
				); 
             $return = $this->Users_model->update_profile($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/profile');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }

       
        //load the view
        $data['main_content'] = 'admin/profile'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
   	   public function pin_request() {
		    $id = $this->session->userdata('cust_id');
		  $customer_id = $this->session->userdata('bliss_id');
		  $user_name = $this->session->userdata('full_name');
		  $email = $this->session->userdata('email');
			
			 
			
		  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('subject', 'Amount', 'required');
		//	$this->form_validation->set_rules('bank_branch', 'discription', 'required');
		//	$this->form_validation->set_rules('account_no', 'Account no', 'required');
		//	$this->form_validation->set_rules('description', 'description', 'required');
			$this->form_validation->set_rules('neft', 'UTR', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='assets/images';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload',$config);
		   if ($this->upload->do_upload('uplode'))
                    { 
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = 'fsdgh';
			        }
			        //----- end file upload -----------
			$phone = $this->input->post('phone');
			$tr_pin = str_pad(mt_rand(1,9999),6,'0',STR_PAD_LEFT);
				$data_to_store = array(
                    'name' => $user_name,
                    'customer_id' => $customer_id,
                    'email' => $email,
                    'amount' => $this->input->post('subject'),
                 //   'phone' => $phone,
                 //   'bank_name' => $this->input->post('bank_name'),
                 //   'bank_branch' => $this->input->post('bank_branch'),
                 //   'account_no' => $this->input->post('account_no'),
                 //   'ifsc_code' => $this->input->post('ifsc'),
                    'neft' => $this->input->post('neft'),
                    
                    'comment' => $this->input->post('description'),
                    'status' => 'active',
					'tr_pin' => $tr_pin,
					'image' => $image
				); 
               
			  // $this->Users_model->insert_pin_request($data_to_store);
			   
				if($this->Users_model->insert_pin_request($data_to_store) == TRUE){
					
					
					/***************** SMS ******************/
		$sms_msg = urlencode("Thank you for Requesting ! Below is your Pin Request information:
User ID: ".$customer_id."
Tr. Pin: ".$tr_pin."\n
Thank you 
Team Shiromani");
$smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-shiromani&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=SHIROM&message=".$sms_msg;
//file_get_contents($smstext);
/***************** SMS ******************/
					
					
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/request-wallet');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
		 $data['profile'] = $this->Users_model->profile($id);
		  $data['main_content'] = 'admin/request_for_pin';
		  $this->load->view('includes/admin/template', $data);   
	  }

	 public function totalincome(){  
  $id = $this->session->userdata('cust_id'); 
  $rdate = $this->session->userdata('rdate'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'totalincome'; 
  $data['page_title'] = 'totalincome';
  
  $data['profile'] = $this->Users_model->profile($id);
	
  $data['total_company_lpv'] = $this->Users_model->total_company_lpv(); 
  $data['total_associate_member'] = $this->Users_model->total_associate_member(); 
  $data['total_member_lpv'] = $this->Users_model->total_member_lpv($id,$rdate); 
  $total_income_fund = $this->Users_model->total_income($id); 
  //$total_income_level = $this->Users_model->total_income_level($id);	
	$data['direct_sale_incentive'] = $this->Users_model->get_active_incomes_amount($id,'Direct Sales Incentive');
	$data['team_sale_incentive'] = $this->Users_model->get_active_incomes_amount($id,'Team Sales Incentive');
	$data['self_sale_incentive'] = $this->Users_model->get_active_incomes_amount($id,'Self Income');
$data['total_income'] = $total_income_fund[0]['total_income_fund'] ;
  $data['main_content'] = 'admin/totalincome';
  $this->load->view('includes/admin/template', $data);   } 
   
    public function welcomeletter(){  
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'welcomeletter'; 
  $data['page_title'] = 'welcomeletter';
  $data['profile'] = $this->Users_model->profile($id); 
  $data['main_content'] = 'admin/welcomeletter';
  $this->load->view('includes/admin/template', $data);   
  } 
   
    public function my_Colleges(){  
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'my_Colleges'; 
  $data['page_title'] = 'my_Colleges';
  $data['profile'] = $this->Users_model->profile($id); 
  $data['main_content'] = 'admin/my_Colleges';
  $this->load->view('includes/admin/template', $data);   
  } 
  
  
      public function rewards(){  
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'rewards'; 
  $data['page_title'] = 'rewards';
  $data['profile'] = $this->Users_model->profile($id);
  /*$data['bv_data'] = $this->Users_model->sale_data($id);  


  $data['sale'] = $this->Users_model->sale_data($id);
 $data['sale_data'] = $this->Users_model->total_sale_data($id);
		$data['total_pv'] = $data['total_bv'] = 0;
		if(!empty($data['sale'])) {
			$data['total_pv'] = $data['sale'][0]['amount'];
			$data['total_bv'] = $data['sale'][0]['bv'];
		}
		if(!empty($data['sale_data'])) {
			$data['total_pv'] = $data['total_pv'] + $data['sale_data'][0]['amount']; 
			$data['total_bv'] = $data['total_bv'] + $data['sale_data'][0]['bv']; 
	}*/


  $data['direct_business'] = $this->Users_model->get_team_business($id,1)[0]['amount']+0;
  $data['team_business'] = $this->Users_model->get_team_business($id)[0]['amount']+0;
//echo '<pre>'; print_r($data['bv_data']);die();
  $data['main_content'] = 'admin/rewards';
  $this->load->view('includes/admin/template', $data);   } 
  
  public function total_affiliate(){   
  $id = $this->session->userdata('cust_id'); 
  $data['page_keywords'] = ''; 
  $data['page_description'] = '';
  $data['page_slug'] = 'welcomeletter'; 
  $data['page_title'] = 'welcomeletter';
  $data['profile'] = $this->Users_model->profile($id);
  $url  = $this->uri->segment(3);
  if(!empty($url)) {
	  
	  $data['myfriends'] = $this->Users_model->total_affiliate($url);
	  
  } else {
  
  
  $data['myfriends'] = $this->Users_model->total_affiliate();
  }
  $data['main_content'] = 'admin/total_affiliate';
  $this->load->view('includes/admin/template', $data);   } 




  public function activate_account(){ 
	  
		
	    $id = $this->session->userdata('cust_id');
	    $data['profile'] = $this->Users_model->profile($id);
	    $data['user'] = $data['pin'] = array(); 
		$pin_code = $this->uri->segment(3);
		$amount=$this->input->post('amount');
	    if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('find_customer')!='')
        { 
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim'); 
			$find_user = $this->input->post('assign_to');
			$find_user = trim($find_user);
            $data['user'] = $this->Users_model->get_customer_by_id($find_user);
            if(empty($data['user'])) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user does not exist'); 
            } 
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
			}
			
		}
        elseif ($this->input->server('REQUEST_METHOD') === 'POST')
        { 
            /*form validation*/
			$this->form_validation->set_rules('assign_to', 'assign to', 'required|trim');
			$this->form_validation->set_rules('product', 'Product', 'required');
			$customer_id = $this->input->post('assign_to');
            $user = $this->Users_model->get_customer_by_id($customer_id);
            if(empty($user)) {
		       $this->form_validation->set_rules('start_date', '', 'required'); 
		       $this->form_validation->set_message('required', 'This user does not exist');  
            } else { 
				$data['user'] = $user;
			}
			
			$prddis = explode( '~~', $this->input->post( 'product' ) );
			/*if ( $new[ 1 ] != 1000 ) {
				$this->form_validation->set_rules( 'amt', '', 'required' );
				$this->form_validation->set_message( 'required', 'Your product not match with pin amount' );
			}*/
			
			
			if($user[0]['consume']> 0) {  
				$this->form_validation->set_rules('start_date', '', 'required'); 
				$this->form_validation->set_message('required', 'Already Activated');   
			}
			elseif($this->input->post( 'product' )!= '' && $prddis[ 1 ] > $data['profile'][0]['bliss_amount']) {
			   $this->form_validation->set_rules('hsfdgsd', 'sfg', 'required');
			   $this->form_validation->set_message('required', 'Wallet Amount must be greater than Package Amount'); 
			  
		   }

		  

            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
			 	$return = FALSE;
				$this->income = array();
				$this->matching_amount = array();
		        $cust_id = $user[0]['id'];  
		        $customer_id = $user[0]['customer_id'];  
		        $order_id = 0;
				$distribution_amount = 500; 
				$p_amount = 1000; 
				if ( $customer_id != '' && $cust_id != '' ) {

						/******************* update pin ***********/
						$date = date( 'Y-m-d' );
						
						$package = array(  'consume' => 1 ,'repurchase_date'=>date('Y-m-d H:i:s'));
						$this->Users_model->update_profile( $cust_id, $package );
						
						//add data in order  

						
						$gstvalue = $prddis[ 4 ] / 100 + 1;
						$gst = $prddis[ 1 ] / $gstvalue;
						$totalgst = $prddis[ 1 ] - $gst;
						$products_array = array();
						$products_array[] = $prddis[ 0 ] . '~~' . $prddis[ 3 ] . '~~' . $prddis[ 0 ] . '~~1~~0~~' . $prddis[ 1 ] . '~~' . $gst . '~~' . $prddis[ 1 ] . '~~' . $prddis[ 4 ] . '';
						$products = json_encode( $products_array );
						$idate = date( 'Y-m-d H:i:s' );
						$data_store = array(
							'gtotal' => $prddis[ 1 ],
							'total_cost' => $prddis[ 6 ],
							'bv' => $prddis[ 5 ],
							'pv' => $prddis[ 2 ],
							'products' => $products,
							'before_tax_amount' => $gst,
							'discount' => 0,
							'payment_type' => 'pin',
							'customer' => $this->input->post( 'assign_to' ),
							'total_gst' => $totalgst,
							'user_id' => $cust_id,
							'tdate' => $idate,
							'pin_bill' => 1,
						);
						$insert_id = $this->Users_model->store_sale_dta( $data_store );
						$this->Users_model->update_stock($prddis[ 0 ],1,'p_qty');
						$this->Users_model->update_wallet($id,$prddis[ 1 ],'bliss_amount');
						$p = 0;
						$level = 1;
						$bv = $prddis[ 5 ];
						$distribution_amount = $prddis[ 2 ]*10;
						$direct_customer_id = $user[0]['direct_customer_id'];
						$this->Users_model->substract_wallet($cust_id,$bv,'business');
						$this->update_reward($cust_id,$user[0]['customer_id'], $user[0]['business']+$bv,$user[0]['reward']);

						$add_business = array('order_id'=>$order_id,'amount'=>$bv,'user_id_send_by'=>$cust_id,'pay_level'=>0,'user_id'=>$cust_id,'status'=>'Active');
					  	$this->Users_model->insert_data_in_table('team_bussiness',$add_business);
					  	$add_income = array('order_id'=>$order_id,'amount'=>(2/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'order_id'=>$insert_id,'user_id'=>$cust_id,'type'=>'Self Income','status'=>'Active');
					  		$this->Users_model->insert_data_in_table('income',$add_income);
						$dis_amount = array(35,20,10,7.5,7.5,6,5,4,3,2);
						while ($p < 9) {
							$parent_data = $this->Users_model->parent_profile($direct_customer_id);
							if(!empty($parent_data)) {
								if($level==1) { $type = 'Direct Sales Incentive'; } else { $type = 'Team Sales Incentive'; }
								if(date('Y-m-d H:i:s',strtotime('+37 days',strtotime($parent_data[0]['repurchase_date']))))  {
								$add_income = array('order_id'=>$order_id,'amount'=>($dis_amount[$p]/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'order_id'=>$insert_id,'user_id'=>$parent_data[0]['id'],'type'=>$type,'status'=>'Active');
					  		$this->Users_model->insert_data_in_table('income',$add_income);
					  	//	$this->Users_model->substract_wallet($parent_data[0]['id'],round(($dis_amount[$p]/100)*$distribution_amount,2),'income_wallet');
					  	}
					  	$add_business = array('order_id'=>$order_id,'amount'=>$bv,'user_id_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>$parent_data[0]['id'],'status'=>'Active');
					  	$this->Users_model->insert_data_in_table('team_bussiness',$add_business);
					  	$this->update_reward($parent_data[0]['id'],$parent_data[0]['customer_id'],$parent_data[0]['business']+$bv,$parent_data[0]['reward']);
					  	$this->Users_model->substract_wallet($parent_data[0]['id'],$bv,'business');
					  		$direct_customer_id = $parent_data[0]['direct_customer_id'];
					  		$level = $level + 1;
					  		$p++;
							} else { 

								$add_income = array('order_id'=>$order_id,'amount'=>($dis_amount[$p]/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'order_id'=>$insert_id,'user_id'=>1,'type'=>$type,'status'=>'Active');
					  			$this->Users_model->insert_data_in_table('income',$add_income);
					  			$level = $level + 1;
					  			$p++;
							 } 
							
						}
					
					
					$return = TRUE;
					

				} 
			  /**************** end payment distribution *******************/
			
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'activated');
					redirect('admin/activate_account');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                


            }/*validation run*/

        }
       
        $data[ 'product' ] = $this->Users_model->select_products();
	     
        //load the view
		
        $data['main_content'] = 'admin/activate_account'; 
        $this->load->view('includes/admin/template', $data); 
   }

   public function update_reward($cid,$customer_id,$team,$reward) {

		$direct_business = $this->Users_model->get_team_business($cid,1)[0]['amount']+0;
		$team_business = $this->Users_model->get_team_business($cid)[0]['amount']+0;
		$m_reward = '';
		if($direct_business >= 2400/2  && $team_business >= 2400/2  && $reward==0) {
			$data_to_store = array('reward'=>1);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Led';
		}
		if($direct_business >= 6000/2 && $team_business >= 6000/2 && $reward==1) {
			$data_to_store = array('reward'=>2);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Mobile';
		}
		if($direct_business >= 12000/2 && $team_business >= 12000/2 && $reward==2) {
			$data_to_store = array('reward'=>3);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Fridge';
		}
		if($direct_business >= 22500/2 && $team_business >= 22500/2 && $reward==3) {
			$data_to_store = array('reward'=>4);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Bike';
		}
		if($direct_business >= 40500/2 && $team_business >= 40500/2 && $reward==4) {
			$data_to_store = array('reward'=>5);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Goa';
		}
		if($direct_business >= 85500/2 && $team_business >= 85500/2 && $reward==5) {
			$data_to_store = array('reward'=>6);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Dubai';
		}
		if($direct_business >= 145500/2 && $team_business >= 145500/2 && $reward==6) {
			$data_to_store = array('reward'=>7);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Enfield';
		}
		if($direct_business >= 250500/2 && $team_business >= 250500/2 && $reward==7) {
			$data_to_store = array('reward'=>8);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Alto';
		}
		if($direct_business >= 460500/2 && $team_business >= 460500/2 && $reward==8) {
			$data_to_store = array('reward'=>9);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Swift/Baleno/SuperBike';
		}
		if($direct_business >= 880500/2 && $team_business >= 880500/2 && $reward==9) {
			$data_to_store = array('reward'=>10);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Thar / Creta';
		}
		if($direct_business >= 1480500/2 && $team_business >= 1480500/2 && $reward==10) {
			$data_to_store = array('reward'=>11);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = '2BHK Flat';
		}
		if($direct_business >= 2380500/2 && $team_business >= 2380500/2 && $reward==11) {
			$data_to_store = array('reward'=>12);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = '3BHK Flat';
		}
		if($direct_business >= 3430500/2 && $team_business >= 3430500/2 && $reward==12) {
			$data_to_store = array('reward'=>13);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Endeavour';
		}
		if($direct_business >= 4930500/2 && $team_business >= 4930500/2 && $reward==13) {
			$data_to_store = array('reward'=>14);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'BMW';
		}
		if($direct_business >= 7330500/2 && $team_business >= 7330500/2 && $reward==14) {
			$data_to_store = array('reward'=>15);
			$this->Users_model->update_profile($cid,$data_to_store);
			$m_reward = 'Villa';
		}
		
		

				if (!empty($m_reward)) {
					
					$add_income = array( 'reward' => $m_reward, 'user_id' => $cid );
					$this->Users_model->add_data_in_table( $add_income,'reward'  );
				}
				return 0;

	}
	
	
	
	public function preview() {
		
		$id = $this->session->userdata('cust_id'); 
	    $data['profile'] = $this->Users_model->profile($id);
		$ids=$this->uri->segment(3);  
        
    $data['scholarship'] = $this->Users_model->get_preview($ids);
	 if ($this->input->server('REQUEST_METHOD') === 'POST') {
		  $data_to_store = array(
                    's_id' => $ids ,
                    'message' => $this->input->post('message') 
                );
	if ($this->Users_model->add_reply($data_to_store) == TRUE) {
                    $this->session->set_flashdata('flash_message', 'updated');
                     redirect(base_url() . 'admin/preview/' . $ids . '');
                }
                else {
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
            } 
    
    //load the view
      $data['main_content'] = 'admin/preview';
      $this->load->view('includes/admin/template', $data);   
  }
	
	
	
	
	
	
	
	
	
	
	
	
	
 
}