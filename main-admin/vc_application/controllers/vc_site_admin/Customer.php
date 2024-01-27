<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('customer_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
    public function wallet_history() {

    

    if ($this->input->server('REQUEST_METHOD') === 'POST'){

           $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

           $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

      } else {

          $sdate = date('Y-m-1 00:00:01');

         $edate = date('Y-m-t 23:59:59');

      }

      $data['transaction_wallet'] = $this->customer_model->transaction_wallet($sdate,$edate);

  //load the view

      $data['main_content'] = 'admin/wallet_history';

      $this->load->view('includes/admin/template', $data);   

  }
  public function index() {
	  
	  
	  if($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		     $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	}  
		else {
    	     $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	} 
	  
	  
	  $data['customer'] = $this->customer_model->get_all_customer($sdate,$edate);
	  
	   $where['new'] = '1';
       $return = $this->customer_model->update_manual('customer',$where,array('new'=>'0'));
	
	//load the view
      $data['main_content'] = 'admin/customer_list';
      $this->load->view('includes/admin/template', $data);   
  }
/*   public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('c_name', 'titlt', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('c_discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/customer/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
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
			
				$data_to_store = array(
                    'c_name' => $this->input->post('c_name'),
					'c_description' => $this->input->post('c_discription'),
					'image' => $image,
				); 
                //if the insert has returned true then we show the flash message
				if($this->customer_model->store_customer($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/customer/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/customer_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  */ 
  public function update(){
	  	
	 
	  //customer id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
      if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid')){
            /*form validation*/
           $this->form_validation->set_rules('f_name', 'first name', 'required|trim|min_length[2]');
           $this->form_validation->set_rules('status', 'status', 'required|trim');
           $this->form_validation->set_rules('phone', 'phone', 'required|trim|min_length[6]');
           $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[6]');
           $this->form_validation->set_rules('declare', 'terms & condition', 'required');
		   
		   $var_status = 'no';
		   
		    if(!empty($this->input->post('newpassword'))){$password=md5($this->input->post('newpassword'));}
		  else{$password=$this->input->post('oldpassword');}
		  
		  if(!empty($this->input->post('newtrpin'))){$trpin=md5($this->input->post('newtrpin'));}
		  else{$trpin=$this->input->post('oldtrpin');}
		   
		   /* $applied_pan = $this->input->post('applied_pan');
		    if($applied_pan!='yes') {
             //$this->form_validation->set_rules('pancard', 'pan card', 'required|trim|min_length[6]');
			}
			$applied_aadhar = $this->input->post('applied_aadhar');
		    if($applied_aadhar!='yes') {
             $this->form_validation->set_rules('aadhar', 'aadhar card', 'required|trim|min_length[6]');
			} */
			
			
			//$this->form_validation->set_rules('bank_name', 'bank name', 'required|trim');
           //$this->form_validation->set_rules('branch', 'branch', 'required|trim');
           //$this->form_validation->set_rules('account_name', 'account name', 'required');
           //$this->form_validation->set_rules('account_type', 'account type', 'required|trim');
           //$this->form_validation->set_rules('account_no', 'account no', 'required|trim');
           //$this->form_validation->set_rules('ifsc', 'ifsc', 'required'); 
			 
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  // file upload start here
            	$image = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('images/user/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						$var_status = $this->input->post('var_status');
					}
            else { $image = $this->input->post('image_old'); }
			
			 $panimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('panimage')) { 
                    if($this->input->post('panimage_old')!='') unlink('images/user/'.$this->input->post('panimage_old'));
                         $image_data = $this->upload->data();
					    $panimage = $image_data['file_name'];
					}
            else { $panimage = $this->input->post('panimage_old'); }
				  
			$aadharimage = '';
			$config['upload_path'] ='images/user/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['max_width']  = '1024';
            $config['max_height']  = '1024';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('aadharimage')) { 
                    if($this->input->post('aadharimage_old')!='') unlink('images/user/'.$this->input->post('aadharimage_old'));
                         $image_data = $this->upload->data();
					    $aadharimage = $image_data['file_name'];
					}
            else { $aadharimage = $this->input->post('aadharimage_old'); } 
			
                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'email' => $this->input->post('email'),
                    'image' => $image,  
					'pass_word' => $password,
					//'tr_pin' => $trpin,
                    'phone' => $this->input->post('phone'), 
                    'address' => $this->input->post('address'),
					'gender' => $this->input->post('gender'),
                    'city' => $this->input->post('city'),
                    'state' => $this->input->post('state'), 
                    'pincode' => $this->input->post('pincode'),
					//'nominee' => $this->input->post('nominee'),
                   // 'nominee_rel' => $this->input->post('nominee_rel'),
                   // 'nominee_dob' => $this->input->post('nominee_dob'),
                    'pancard' => $this->input->post('pancard'),  
                    //'applied_pan' => $applied_pan,
                    'panimage' => $panimage, 
                    'aadhar' => $this->input->post('aadhar'),
                    //'applied_aadhar' => $applied_aadhar, 
                    'aadharimage' => $aadharimage, 
		            'bank_name' => $this->input->post('bank_name'),  
                    'branch' => $this->input->post('branch'), 
                    'account_name' => $this->input->post('account_name'),
                    'account_type' => $this->input->post('account_type'),  
                    'account_no' => $this->input->post('account_no'),
                    'bank_city' => $this->input->post('bank_city'),
                    'bank_state' => $this->input->post('bank_state'), 
                    'ifsc' => $this->input->post('ifsc'),  
                    'bsacode' => $this->input->post('rank'),  
                    'status' => $this->input->post('status'),
                    'bliss_amount' => $this->input->post('add_amt')+$this->input->post('bliss_amount'),
                    'var_status' => $var_status 
				); 
				
				//print_r($data_to_store);
             $return = $this->customer_model->update_customer($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/customer/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['customer'] = $this->customer_model->get_all_customer_id($id); 
		//$data['parentid'] = $this->customer_model->parent_profile($data['customer'][0]['parent_customer_id']);
        //load the view
        $data['main_content'] = 'admin/customer_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
public function wallet_request_list() {
	  
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
    	
    	 $where['noti'] = '1';
       $return = $this->customer_model->update_manual('pin_request',$where,array('noti'=>'0'));
       
	$data['customer'] = $this->customer_model->get_pin_request_by_date($sdate,$edate);
	//echo '<pre>';print_r($data['customer']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/pin_request_list';
      $this->load->view('includes/admin/template', $data);   
  }






public function individaul_list() 
	  
	 
    	
    	{
       
	$data['individaul_list'] = $this->customer_model->individaul_list();
	//echo '<pre>';print_r($data['individaul_list']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/individaul_list';
      $this->load->view('includes/admin/template', $data);   
  }







public function schlorship_reply() 
	  
	 
    	
    	{
       
	$data['s_reply'] = $this->customer_model->get_s_reply();
	//echo '<pre>';print_r($data['s_reply']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/schlorship_reply';
      $this->load->view('includes/admin/template', $data);   
  }


public function schlorship_reply_view() 
	  
	 
    	
    	{
		 $id=$this->uri->segment(4); 
       
	$data['reply_view'] = $this->customer_model->get_s_view($id);
	//echo '<pre>';print_r($data['reply_view']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/schlorship_reply_view';
      $this->load->view('includes/admin/template', $data);   
  }




public function corporation_list() 
	  
	 
    	
    	{
       
	$data['corporation_list'] = $this->customer_model->corporation_list();
	//echo '<pre>';print_r($data['corporation_list']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/corporation_list';
      $this->load->view('includes/admin/template', $data);   
  }




public function team_list() 
	  
	 
    	
    	{
       
	$data['team_list'] = $this->customer_model->team_list();
	//echo '<pre>';print_r($data['corporation_list']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/team_list';
      $this->load->view('includes/admin/template', $data);   
  }

public function contact_list() 
	  
	 
    	
    	{
       
	$data['contact_list'] = $this->customer_model->contact_list();
	//echo '<pre>';print_r($data['corporation_list']);die();
	
	
	//load the view
      $data['main_content'] = 'admin/contact_list';
      $this->load->view('includes/admin/template', $data);   
  }






  
    public function pin_request_update(){
	  	
	 
	  //category id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             //$this->form_validation->set_rules('c_name', 'name', 'required|trim|min_length[4]');
			//$this->form_validation->set_rules('comment', 'comment', 'required|trim');
			$this->form_validation->set_rules('status', 'status', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
			
			        //----- end file upload -----------
                $data_to_store = array(
                   
					'comment' => $this->input->post('description'), 
					//'reply' => $this->input->post('reply'), 
					
					'status' => $this->input->post('status')
					); 
             $return = $this->customer_model->update_pin_request($id, $data_to_store);
			
			$phone = $this->input->post('phone');
			$status = $this->input->post('status');
			$reply = $this->input->post('reply');
			
      if($return == TRUE){ 

         if($status=='Approved') {
          $chkid = $this->customer_model->checkuserid($this->input->post('bsacode'));
                $data_to_store = array(
                    'bliss_amount' => $chkid[0]['bliss_amount']+$this->input->post('subject')
        ); 
        
            $this->customer_model->wallet_update_customer($this->input->post('bsacode'), $data_to_store);


             $twallet_log = array(

    'userid' => $chkid[0]['customer_id'],

    'send_to' => $chkid[0]['customer_id'],

    'send_by' => 'Admin',

    'type' => 'Transfered',

    'amount' => $this->input->post('subject'),

    'status' => 'Credit' 

    );

    $this->customer_model->add_transactional_wallet($twallet_log);
             
         }
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/pin_request/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['category'] = $this->customer_model->get_all_pin_request_id($id); 
		//echo '<pre>';print_r($data['category']);die();
        //load the view
        $data['main_content'] = 'admin/pin_request_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  

  
    	public function feedback_list() {
	  
	  if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
	$data['customer'] = $this->customer_model->get_feedback_by_date($sdate,$edate);
	
	
	//load the view
      $data['main_content'] = 'admin/feedback_list';
      $this->load->view('includes/admin/template', $data);   
  }

 	public function feedback_update() {
		
		
		$id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
             // $this->form_validation->set_rules('c_name', 'name', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('message', 'Message', 'required|trim');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
			
			        //----- end file upload -----------
                $data_to_store = array(
					'message' => $this->input->post('message'),
					'reply' => $this->input->post('reply'),
					'status' => $this->input->post('status')
					); 
             $return = $this->customer_model->update_grievance($id, $data_to_store);
			
			
			
             if($return == TRUE){
					 $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/feedback/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['feedback'] = $this->customer_model->get_all_feedback_id($id); 
        //load the view
        $data['main_content'] = 'admin/feedback_update'; 
        $this->load->view('includes/admin/template', $data); 
  }

  
  
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->delete_customer($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/customer');
 }  
 
 
 public function individual_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->delete_individual($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/individual');
 }  
 
 public function corporation_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->corporation_del($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/corporation');
 }
 
 
 public function team_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->team_del($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/team');
 }
 
 
 
 public function contact_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->contact_del($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/contact');
 }
 
 
 
 
 
 
 
 
 public function wallet(){
	  	if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
        /*if save button was clicked, get the data sent via post*/
      if ($this->input->server('REQUEST_METHOD') === 'POST'){
            /*form validation*/
			
			
			$this->form_validation->set_rules('bsacode', 'Customer ID', 'required|trim');
			 
		    $chkid = $this->customer_model->checkuserid($this->input->post('bsacode'));
			if(count($chkid)==0) {
              $this->form_validation->set_rules('hghff', 'User Id', 'required|trim');
              $this->form_validation->set_message('required', 'User Id not valid ');
            }
		   
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run()) { 
		          


            // file upload start here
            $config['upload_path'] ='../assets/images/';
            $config['allowed_types'] = 'pdf';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('file'))
                    {
                       
                        $image_data = $this->upload->data();
                        $image = $image_data['file_name'];
                    } 
                    else {
                       $errors = $this->upload->display_errors();
                       //echo '<pre>'; print_r($errors); die();
                    }
                $data_to_store = array(
                    'file' => $image
				); 
				
				//print_r($data_to_store);
             $return = $this->customer_model->wallet_update_customer($this->input->post('bsacode'), $data_to_store);

             

             if($return == TRUE){
				
                    $this->session->set_flashdata('flash_message', 'updated');
					       redirect(base_url().'admin/wallet/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }

        $data['main_content'] = 'admin/gvc_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
   public function generatecsv(){

     

	  $sdate = $edate = '';

		 if ($this->input->post('sdate') != '' && $this->input->post('edate') != '') {

		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 

        } else {

            $sdate = date('Y-m-01 00:00:01');

		    $edate = date('Y-m-t 23:59:59'); 

        }

		

	 $filename = 'users_'.date('YmdHis').'.csv'; 

   header("Content-Description: File Transfer"); 

   header("Content-Disposition: attachment; filename=$filename"); 

   header("Content-Type: application/csv; ");

   

   // file creation 

   $file = fopen('php://output', 'w');

 

   $header = array("S. No.Customer ID","Name","Phone","Amount","PV","Payment Type","Date"); 

   fputcsv($file, $header);

   	 $customer = $this->customer_model->get_all_order($sdate,$edate);

	

   	if(!empty($customer)) { 

		$i = 1;

       foreach ($customer as $key=>$line){ 

		

	

	

	   

	   

	     $csv_val = array($i,$line['id'].' '.$line['customer_id'].'',$line['p_name'],$line['p_phone'],$line['comm_dis'],$line['phone'],$line['how_to_pay'],$line['o_date'],$activate_date,$royality,$repurchase,$status);

         fputcsv($file,$csv_val); 

		 $i++;

       }

       fclose($file); 

       exit; 

   	}

	

  }

  	
	public function reward() {

	  $data['error_msg'] = '';

	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('update_req') == 'Update') {

				

				if($this->input->post('sdate') != '') {

				$sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		        $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));

				} else {

					$sdate = date('Y-m-1 00:00:01');

		             $edate = date('Y-m-t 23:59:59');

				}
               $reward = $this->customer_model->get_reward_by_date($sdate,$edate);

				$user_ids = $this->input->post('userid');

				if(empty($user_ids) ){

					$data['error_msg'] = '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>Please select at least one user.</strong></div>';

				} else {
				

	//foreach($user_ids as $uid) {

					foreach($reward as $userinfo) {

					  if(in_array($userinfo['id'],$user_ids)) { 

					 // die();
				$data_to_store = array(

					'status' => $this->input->post('status')

					); 
				  $return = $this->customer_model->update_reward($userinfo['id'], $data_to_store);

				 }

					}	

					$data['error_msg'] = '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a><strong> Successfully.</strong></div>';
}
					} elseif ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate') != ''){

    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));

		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
			
    	} else {
	
			$sdate = date('Y-m-1 00:00:01');

		     $edate = date('Y-m-t 23:59:59');

		}
				
$data['reward'] = $this->customer_model->get_reward_by_date($sdate,$edate);

	//$data['customer'] = $this->customer_model->get_all_customer();

	

	//load the view

	 $data['main_content'] = 'admin/reward';

      $this->load->view('includes/admin/template', $data);   

  }
  
  public function college_update(){
	  	if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
        /*if save button was clicked, get the data sent via post*/
      if ($this->input->server('REQUEST_METHOD') === 'POST'){
            /*form validation*/
			
			
			$this->form_validation->set_rules('c_name', 'college name', 'required|trim');
			 
		     $chkids = $this->customer_model->checkuserids($this->input->post('bsacode'));
			 
			 
			 
			   if(count($chkids)==0) {
              $this->form_validation->set_rules('hghff', 'Customer Id', 'required|trim');
              $this->form_validation->set_message('required', 'User Id not valid ');
               }
			   
               
		   
		   
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
			
            //if the form has passed through the validation
            if ($this->form_validation->run()) { 
		
                $data_to_store = array(
				
                    'c_name' => $this->input->post('c_name'),
                    'user_id' => $this->input->post('bsacode')
				); 
				
				//print_r($data_to_store);
             $return = $this->customer_model->add_college($data_to_store);

             if($return == true){
				
                    $this->session->set_flashdata('flash_message', 'updated');
					       redirect(base_url().'admin/college/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

                

            }/*validation run*/

        }

        $data['main_content'] = 'admin/college_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  
  public function myschlorship_add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');
			//$this->form_validation->set_rules('discription', 'discription', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		
		$image = '';
			$config['upload_path'] ='images/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
          //  $config['max_width']  = '524';
          //  $config['max_height']  = '524';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
                    if($this->input->post('image_old')!='') unlink('images/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
		   }
		
		
		
			
			
				$data_to_store = array(
                    'title' => $this->input->post('title'),
					'discription' => $this->input->post('discription'),
					'image' => $image,
					 'status' => $this->input->post('status'),	
					'type' => $this->input->post('type'),
				); 
                //if the insert has returned true then we show the flash message
				if($this->customer_model->store_myschlorship($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/myschlorship/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }

        }
       

        $data['main_content'] = 'admin/myschlorship_add'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }

  public function myschlorship_list() {
    	
	$data['myschlorship_list'] = $this->customer_model->get_myschlorship_list();
	
	//load the view
      $data['main_content'] = 'admin/myschlorship_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function myschlorship_update(){
	  	
	 
	  //news id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('rid'))
        {
            /*form validation*/
          //$this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('title', 'title', 'required');
			    
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$image = '';
			$config['upload_path'] ='images/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
          //  $config['max_width']  = '524';
          //  $config['max_height']  = '524';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image')) { 
		  // die();
                    if($this->input->post('image_old')!='') unlink('images/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
						
					}
            else { $image = $this->input->post('image_old'); }
		  $data_to_store = array( 
		             'title' => $this->input->post('title'),
					 'discription' => $this->input->post('discription'),
					 'image' => $image,
					 'type' => $this->input->post('type'),
					 'status' => $this->input->post('status')						   
					); 
					
					 $return = $this->customer_model->update_myschlorship($id, $data_to_store);
					
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/myschlorship/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['schlorship_id'] = $this->customer_model->get_all_schlorship_id($id); 
        //load the view
        $data['main_content'] = 'admin/myschlorship_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  
  
  public function myschlorship_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->customer_model->delete_myschlorship($id); 
		 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/myschlorship');
 }  
  
  
  public function myschlorship_reply_view() {
    	
	$data['myschlorship_list'] = $this->customer_model->get_myschlorship_list();
	
	//load the view
      $data['main_content'] = 'admin/myschlorship_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function schlorship_reply_edit(){
	  	
	 
	  //customer id 
    $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
      if ($this->input->server('REQUEST_METHOD') === 'POST'){
           
			
                $data_to_store = array(
                    'f_name' => $this->input->post('f_name'),
                    'l_name' => $this->input->post('l_name'),
                    'email' => $this->input->post('email'),
                   
                    'phone' => $this->input->post('phone'), 
                    'pin_code' => $this->input->post('pin_code'),
					'state' => $this->input->post('state'),
					'category' => $this->input->post('category'),
                    'city' => $this->input->post('city'),
                   
                    'occupation' => $this->input->post('occupation'),
					'abled' => $this->input->post('abled'),
                    'orphan' => $this->input->post('orphan'),
                    'qualification' => $this->input->post('qualification'),
                    'passing_year' => $this->input->post('passing_year'),  
                    'status' => $this->input->post('status'),  
                   
                   
                    'grade' => $this->input->post('grade'),
                   
		            'percentage' => $this->input->post('percentage'),  
                    'course' => $this->input->post('course') 
                   
                     
				); 
				
				//print_r($data_to_store);
             $return = $this->customer_model->update_reply($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect(base_url().'admin/schlorship_reply/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['reply_id'] = $this->customer_model->get_all_reply_id($id); 
		//echo '<pre>'; print_r($data['reply_id']); die();
		//$data['parentid'] = $this->customer_model->parent_profile($data['customer'][0]['parent_customer_id']);
        //load the view
        $data['main_content'] = 'admin/reply_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  
	 }
					
