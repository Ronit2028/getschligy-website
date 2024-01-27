<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
	    $this->load->library('form_validation');
		$this->load->library('cart');
        $this->load->model('customer_model');	
        $this->load->model('checkout_model');	
		$cart = $this->cart->contents();
        if(empty($cart)) { redirect(base_url().'cart'); }
    }
	
	public function index()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'checkout';
                $data['page_title'] = 'Checkout';  
				
				$cust_id = $this->session->userdata('cust_id');
 /* $cust_id = $this->session->userdata('cust_id');
$limit_amount = $this->get_user_limit($cust_id);
		print_r($limit_amount);*/
		/*
		$bliss_code =  $this->session->userdata('bliss_id');
		        $cust_id = $this->session->userdata('cust_id'); 
				$parent_bliss = $this->checkout_model->parent_bliss($cust_id);
				$distribute_level = 0;$distribution_amount = 555;
				$distribute_user_id_array = array();
				if(!empty($parent_bliss) && $parent_bliss[0]['parent_customer_id']!='' && $distribution_amount > 1) {
				   $distribute_level = $distribute_level + 1;
				   $distribute_user_id_array[] = $parent_bliss[0]['pid'];
					echo $distribute_level.' '.$parent_bliss[0]['pid'].' '.$parent_bliss[0]['parent_customer_id'].'<br>';
				   $parent_bliss_2 = $this->checkout_model->parent_bliss_result($parent_bliss[0]['parent_customer_id']);
				   if(!empty($parent_bliss_2) && $parent_bliss_2[0]['parent_customer_id']!='') {
					 $distribute_level = $distribute_level + 1;
				     $distribute_user_id_array[] = $parent_bliss_2[0]['pid'];
					 echo $distribute_level.' '.$parent_bliss_2[0]['pid'].' '.$parent_bliss_2[0]['parent_customer_id'].'<br>';
					 $parent_bliss_3 = $this->checkout_model->parent_bliss_result($parent_bliss_2[0]['parent_customer_id']);
				     if(!empty($parent_bliss_3) && $parent_bliss_3[0]['parent_customer_id']!='') {
				        $distribute_level = $distribute_level + 1;
				        $distribute_user_id_array[] = $parent_bliss_3[0]['pid'];
					    echo $distribute_level.' '.$parent_bliss_3[0]['pid'].' '.$parent_bliss_3[0]['parent_customer_id'].'<br>';
						$parent_bliss_4 = $this->checkout_model->parent_bliss_result($parent_bliss_3[0]['parent_customer_id']);
						if(!empty($parent_bliss_4) && $parent_bliss_4[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_4[0]['pid'];
					      echo $distribute_level.' '.$parent_bliss_4[0]['pid'].' '.$parent_bliss_4[0]['parent_customer_id'].'<br>';
						  $parent_bliss_5 = $this->checkout_model->parent_bliss_result($parent_bliss_4[0]['parent_customer_id']);
						  if(!empty($parent_bliss_5) && $parent_bliss_5[0]['parent_customer_id']!='') {
				          $distribute_level = $distribute_level + 1;
						  $distribute_user_id_array[] = $parent_bliss_5[0]['pid'];
					      echo $distribute_level.' '.$parent_bliss_5[0]['pid'].' '.$parent_bliss_5[0]['parent_customer_id'].'<br>';
						  }
						 }
					   }
				   }
				}
				print_r($distribute_user_id_array);echo $distribute_level;*/
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('city', 'city', 'required|trim');
            $this->form_validation->set_rules('state', 'state', 'required|trim');
            $this->form_validation->set_rules('zip', 'zip', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$this->session->set_userdata('p_name',$this->input->post('name'));
				$this->session->set_userdata('p_email',$this->input->post('email'));
				$this->session->set_userdata('p_phone',$this->input->post('phone'));
				$this->session->set_userdata('p_address',$this->input->post('address'));
				$this->session->set_userdata('p_address2',$this->input->post('address2'));
				$this->session->set_userdata('p_city',$this->input->post('city'));
				$this->session->set_userdata('p_state',$this->input->post('state'));
				$this->session->set_userdata('p_zip',$this->input->post('zip'));
				redirect(base_url().'payment');
			}
			
		}
		    $data['category_list'] = $this->customer_model->get_category_list();
		    $data['customer_add'] = $this->customer_model->get_customer_address($cust_id);
	        $data['main_content'] = 'checkout';
            $this->load->view('includes/front/front_template', $data); 

	}
	
	public function payment()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'payment';
                $data['page_title'] = 'Payment';  
        $data['coupon_error'] = '';
		$cust_id = $this->session->userdata('cust_id');

		//echo '<pre>'; print_r($this->session->userdata()); die();
		if($cust_id!='') { 
			$data['profile'] = $this->checkout_model->profile($cust_id);
			$user = $data['profile'][0];
			//redirect(base_url().'checkout'); 
		} else {
                   $this->session->set_flashdata('flash_message', 'need_login');
	           redirect(base_url().'checkout');
                }
		
	
					
					
		$data['veryfied_msg']="false"; $data['veryfied_msg_otp'] = ''; $data['veryfied_no_expire'] = '';
		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
			
            //form validation
            $this->form_validation->set_rules('p_name', 'name', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('p_email', 'email', 'required|trim|valid_email');
			$this->form_validation->set_rules('p_phone', 'phone', 'required|numeric');
            $this->form_validation->set_rules('p_address', 'address', 'required|trim'); 
            $this->form_validation->set_rules('p_city', 'city', 'required|trim');
            $this->form_validation->set_rules('p_state', 'state', 'required|trim');
            $this->form_validation->set_rules('p_zip', 'zip', 'required|trim|numeric');

			if($data['profile'][0]['bliss_amount'] < $this->session->userdata('order_total')) {
				$this->form_validation->set_rules('bliss_perk_error', 'bliss_perk_error', 'required|trim');
				$this->form_validation->set_message('required', 'Your Wallet amount is less then your order.');
              }
		   
		   
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {  
				$cart = $this->cart->contents();
                $items = json_encode($cart);
				$coupon = $this->session->userdata('coupon_code');
				$coupon_val = $this->session->userdata('coupon_val');
				$distribution_amount = $this->session->userdata('comm_dis') + 0;
				$order_total = $this->session->userdata('order_total');
				$percentage = $shop_percentage = $limit = $caping = 0;
				$shopping_dis_amount = 0;
				

				//echo '<pre>'; print_r($this->session->userdata()); die();
					
				
				//$distribution_amount = $this->session->userdata('order_sub_total') + 0;
				if($cust_id =='' || $cust_id ==' ') { $cust_id = 0; }

		        $data_to_store = array(
					'user_id' => $cust_id,
                     'p_name' => $this->input->post('p_name'),
					 'p_email' => $this->input->post('p_email'), 
					 'p_phone' => $this->input->post('p_phone'),
					 'p_address' => $this->input->post('p_address'),
					 'p_address2' => $this->input->post('p_address2'),
					 'p_city' => $this->input->post('p_city'),
					 'p_state' => $this->input->post('p_state'),
					 'p_zip' => $this->input->post('p_zip'),
					 'spl_note' => $this->input->post('message'),
					 'how_to_pay' => $this->input->post('how_to_pay'),
                     'shipping' => $this->session->userdata('order_shipping'),
                     'tax' => round($this->session->userdata('order_tax'),2),
                     'total_cost' => $this->session->userdata('total_cost'),
                     'total_amount' => $this->session->userdata('order_total'),
                     'package' => $this->session->userdata('package'),
					 'comm_dis' => $distribution_amount,
					 'bv' => $this->session->userdata('bv'),
					 'items' => $items,
					 'coupon_val' => $coupon_val,
					 'coupon' => $coupon
					 ); 
			  $order_id = $this->checkout_model->add_order($data_to_store);
			  
				/**************** payment distribution *******************/
					if(!empty($cart)) {
						foreach($cart as $car) {
							$this->checkout_model->update_stock($car['id'],1,'p_qty');
						}
					}
				

						
						$p = 0;
						$level = 1;
						$bv = $this->session->userdata('bv');
						$distribution_amount = $distribution_amount*10;
						$direct_customer_id = $user['direct_customer_id'];
						$this->checkout_model->substract_wallet($cust_id,$bv,'business');
						$this->update_reward($cust_id,$user['customer_id'], $user['business']+$bv,$user['reward']);

						$add_business = array('order_id'=>$order_id,'amount'=>$bv,'user_id_send_by'=>$cust_id,'pay_level'=>0,'user_id'=>$cust_id,'status'=>'Active');
					  	$this->checkout_model->insert_data_in_table('team_bussiness',$add_business);


					  	if($this->session->userdata('package')==1) { 
					  		$add_income = array('order_id'=>$order_id,'amount'=>(2/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>$cust_id,'type'=>'Self Income','status'=>'Active');
					  		$this->checkout_model->insert_data_in_table('income',$add_income);
					  		$dis_amount = array(35,20,10,7.5,7.5,6,5,4,3);

					  	} else {
					  		$add_income = array('order_id'=>$order_id,'amount'=>(18/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>$cust_id,'type'=>'Self Income','status'=>'Active');
					  		$this->checkout_model->insert_data_in_table('income',$add_income);
					  		$dis_amount = array(30,10,9,8,7,6,5,4,3);
					  	}

						
						while ($p < 9) {
							$parent_data = $this->checkout_model->parent_profile($direct_customer_id);
							if($level==1) { $type = 'Direct Sales Incentive'; } else { $type = 'Team Sales Incentive'; }
							if(!empty($parent_data)) {
								
								if(date('Y-m-d H:i:s',strtotime('+37 days',strtotime($parent_data[0]['repurchase_date']))))  {
								$add_income = array('order_id'=>$order_id,'amount'=>($dis_amount[$p]/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>$parent_data[0]['id'],'type'=>$type,'status'=>'Active');
					  		$this->checkout_model->insert_data_in_table('income',$add_income);
					  	//	$this->Users_model->substract_wallet($parent_data[0]['id'],round(($dis_amount[$p]/100)*$distribution_amount,2),'income_wallet');
					  	}
					  	$add_business = array('order_id'=>$order_id,'amount'=>$bv,'user_id_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>$parent_data[0]['id'],'status'=>'Active');
					  	$this->checkout_model->insert_data_in_table('team_bussiness',$add_business);
					  	$this->update_reward($parent_data[0]['id'],$parent_data[0]['customer_id'],$parent_data[0]['business']+$bv,$parent_data[0]['reward']);
					  	$this->checkout_model->substract_wallet($parent_data[0]['id'],$bv,'business');
					  		$direct_customer_id = $parent_data[0]['direct_customer_id'];
					  		$level = $level + 1;
					  		$p++;
							} else { 
							$add_income = array('order_id'=>$order_id,'amount'=>($dis_amount[$p]/100)*$distribution_amount,'user_send_by'=>$cust_id,'pay_level'=>$level,'user_id'=>1,'type'=>$type,'status'=>'Active');
					  		$this->checkout_model->insert_data_in_table('income',$add_income);
					  		$level = $level + 1;
					  		$p++;
							 } 
							
						}

				
			  /**************** end payment distribution *******************/
				

				//if($this->input->post('how_to_pay')=='blissperks') { 
				
				   

				    
				    $updated_amount = $data['profile'][0]['bliss_amount'] - $order_total + 0;
				    $data_profile_array = array('bliss_amount'=>$updated_amount);
				    if($this->session->userdata('package')==1) { 
				    	$data_profile_array['consume'] =1;
				    	$data_profile_array['repurchase_date'] = date('Y-m-d H:i:s');
				    }
				    
				    $this->checkout_model->update_profile($cust_id,$data_profile_array);
				    
				 //   $this->checkout_model->load_wallet_by_repurchase($cust_id,$distribution_amount,'sbv');
					$this->session->set_userdata('how_to_payment','blissperks');
					$this->session->set_userdata('last_order_id',$order_id);
					$phone = $this->input->post('p_phone');
					$this->session->set_userdata('phone_msg',$phone);
					// echo '<pre>'; print_r($this->session->userdata()); die();
					redirect(base_url().'thankyou');
			//	}
				
				
			}
			
		}
		
		$data['category_list'] = $this->customer_model->get_category_list();
		    $data['main_content'] = 'payment';
            $this->load->view('includes/front/front_template', $data); 

	}

	public function update_reward($cid,$customer_id,$team,$reward) {


		$m_reward = '';
		$direct_business = $this->checkout_model->get_team_business($cid,1)[0]['amount']+0;
		$team_business = $this->checkout_model->get_team_business($cid)[0]['amount']+0;

		if($direct_business >= 2400/2  && $team_business >= 2400/2  && $reward==0) {
			$data_to_store = array('reward'=>1);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Led';
		}
		if($direct_business >= 6000/2 && $team_business >= 6000/2 && $reward==1) {
			$data_to_store = array('reward'=>2);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Mobile';
		}
		if($direct_business >= 12000/2 && $team_business >= 12000/2 && $reward==2) {
			$data_to_store = array('reward'=>3);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Fridge';
		}
		if($direct_business >= 22500/2 && $team_business >= 22500/2 && $reward==3) {
			$data_to_store = array('reward'=>4);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Bike';
		}
		if($direct_business >= 40500/2 && $team_business >= 40500/2 && $reward==4) {
			$data_to_store = array('reward'=>5);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Goa';
		}
		if($direct_business >= 85500/2 && $team_business >= 85500/2 && $reward==5) {
			$data_to_store = array('reward'=>6);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Dubai';
		}
		if($direct_business >= 145500/2 && $team_business >= 145500/2 && $reward==6) {
			$data_to_store = array('reward'=>7);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Enfield';
		}
		if($direct_business >= 250500/2 && $team_business >= 250500/2 && $reward==7) {
			$data_to_store = array('reward'=>8);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Alto';
		}
		if($direct_business >= 460500/2 && $team_business >= 460500/2 && $reward==8) {
			$data_to_store = array('reward'=>9);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Swift/Baleno/SuperBike';
		}
		if($direct_business >= 880500/2 && $team_business >= 880500/2 && $reward==9) {
			$data_to_store = array('reward'=>10);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Thar / Creta';
		}
		if($direct_business >= 1480500/2 && $team_business >= 1480500/2 && $reward==10) {
			$data_to_store = array('reward'=>11);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = '2BHK Flat';
		}
		if($direct_business >= 2380500/2 && $team_business >= 2380500/2 && $reward==11) {
			$data_to_store = array('reward'=>12);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = '3BHK Flat';
		}
		if($direct_business >= 3430500/2 && $team_business >= 3430500/2 && $reward==12) {
			$data_to_store = array('reward'=>13);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Endeavour';
		}
		if($direct_business >= 4930500/2 && $team_business >= 4930500/2 && $reward==13) {
			$data_to_store = array('reward'=>14);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'BMW';
		}
		if($direct_business >= 7330500/2 && $team_business >= 7330500/2 && $reward==14) {
			$data_to_store = array('reward'=>15);
			$this->checkout_model->update_profile($cid,$data_to_store);
			$m_reward = 'Villa';
		}
		
		

				if (!empty($m_reward)) {
					
					$add_income = array( 'reward' => $m_reward, 'user_id' => $cid );
					$this->checkout_model->add_data_in_table( $add_income,'reward'  );
				}
				return 0;

	}
	public function thankyou()
	{
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'thankyou';
                $data['page_title'] = 'Thank you';  
				
				$data['message'] = 'Thank you for shopping with us.<br> We will be shipping your order to you soon.';
				
         if(isset($_POST['encResp']) && $_POST['encResp']!='') {
			 $working_key = 'F534EEE73E7A9AC7ED35376A2AFDD378';//Shared by CCAVENUES
			$encResponse = $_POST["encResp"];	//This is the response sent by the CCAvenue Server
			$rcvdString = $this->decrypt($encResponse,$working_key);//Crypto Decryption used as per the specified working key.
			$order_status = $order_id = "";
			$decryptValues = explode('&', $rcvdString);
			$dataSize = sizeof($decryptValues);
			for($i = 0; $i < $dataSize; $i++) {
				$information = explode('=',$decryptValues[$i]);
				if($i==0) {	$order_id = $information[1]; }
				if($i==3) {	$order_status=$information[1]; }
			}

			if($order_status==="Success") {
				$data['message'] = "Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
				$this->checkout_model->update_distribution_status($order_id);
				
			}
			else if($order_status==="Aborted") {
				$data['message'] = "Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
			}
			else if($order_status==="Failure") {
				$data['message'] = "Thank you for shopping with us.However,the transaction has been declined.";
			}
			else {
				$data['message'] = "Security Error. Illegal access detected"; 
			} 
		 }
			$this->cart->destroy();
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'thankyou';
            $this->load->view('includes/front/front_template', $data); 
	}
	 

	public function get_user_limit($userid) {
		$bliss_code =  $this->session->userdata('bliss_id');
		$cust_id = $this->session->userdata('cust_id');
		$distributor_amount = $this->checkout_model->get_distributer_amount_by_userid($userid);
		$dist_amount = 0;
		if(!empty($distributor_amount)) {
			foreach($distributor_amount as $val) {
				if($val['status']!='Pending') { $dist_amount = $dist_amount + $val['amount']; }
			}
		}
		
		$orderId = '';
		$child_id_array = array();
		$ciruserlimit = 0;
		$child_ids = $this->checkout_model->get_child_id($bliss_code);
		foreach($child_ids as $childid) {
			$child_id_array[] = $childid['id']; 
		}
		if(!empty($child_id_array)){
        $circle_order = $this->checkout_model->my_first_circle_order($child_id_array);
		$cirorder = array(); 
		if(!empty($circle_order)) {
			foreach($circle_order as $cir_oder) {
			  if($cir_oder['status']!='Pending') {
				if(in_array($cir_oder['user_id'],$cirorder)){ $ciruserlimit = $ciruserlimit + 2000; } 
				else {	$cirorder[] = $cir_oder['user_id'];
				$ciruserlimit = $ciruserlimit + 4000; } 
				$orderId .= $cir_oder['id'].'('.$cir_oder['user_id'].') '; 
			  }
			}
		} 
		}
		
		return array('limit'=>$ciruserlimit,'amount'=>$dist_amount,'order'=>$orderId);
	}
	

	function hextobin($hexString) 
   	 { 
        	$length = strlen($hexString); 
        	$binString="";   
        	$count=0; 
        	while($count<$length) 
        	{       
        	    $subString =substr($hexString,$count,2);           
        	    $packedString = pack("H*",$subString); 
        	    if ($count==0) { $binString = $packedString; } 
        	    else { $binString .= $packedString; }  
		    $count+=2; 
        	} 
  	        return $binString; 
    	  } 
	 function pkcs5_pad ($plainText, $blockSize)
	{
	    $pad = $blockSize - (strlen($plainText) % $blockSize);
	    return $plainText . str_repeat(chr($pad), $pad);
	}
	function decrypt($encryptedText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
		$encryptedText=$this->hextobin($encryptedText);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
		mcrypt_generic_init($openMode, $secretKey, $initVector);
		$decryptedText = mdecrypt_generic($openMode, $encryptedText);
		$decryptedText = rtrim($decryptedText, "\0");
	 	mcrypt_generic_deinit($openMode);
		return $decryptedText;
		
	}
	function encrypt($plainText,$key)
	{
		$secretKey = $this->hextobin(md5($key));
		$initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
	  	$openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '','cbc', '');
	  	$blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
		$plainPad = $this->pkcs5_pad($plainText, $blockSize);
	  	if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1) 
		{
		      $encryptedText = mcrypt_generic($openMode, $plainPad);
	      	      mcrypt_generic_deinit($openMode);
		      			
		} 
		return bin2hex($encryptedText);
	}
}