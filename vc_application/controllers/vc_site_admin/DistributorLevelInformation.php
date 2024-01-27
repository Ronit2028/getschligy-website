<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class DistributorLevelInformation extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('order_model');	
         $this->load->model('Users_model');

        if(!$this->session->userdata('is_customer_logged_in')){ redirect(base_url()); } 
    }
	
  public function index() {
    			$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		$data['parent_profile'] = $this->Users_model->parent_profile($data['profile'][0]['parent_customer_id']);

	//$data['friends'] = $this->order_model->get_first_cercle($customer_id);

	 $data['myfriends'] = array();
	$data['show_inner'] = 'false';
	$data['current_user'] = $customer_id;
	$inner_users = $this->uri->segment(3);
	if($inner_users!='') {
		$inner_friends_array = $this->Users_model->my_friends($inner_users);
		$data['myfriends'][] = array('friends'=>$inner_friends_array,'level'=>0); 
		$data['show_inner'] = 'true';
		$data['current_user'] = $inner_users;
	} else {
	$level = 1;
	if($this->input->post('level')!='') { $level = $this->input->post('level'); }
	 
	$myfriends = $this->Users_model->my_friends($customer_id);
		$myfriendid = array($id);  
		if(!empty($myfriends) && $level >= 2) {
            foreach($myfriends as $friend) {
				$inner_friends_array1 = $this->Users_model->my_friends($friend['customer_id']);
				$inner_friends1 = $inner_friends_array1;
				/**************  friend level 2 *******************/
				if(!empty($inner_friends_array1) && $level >= 3) {
					foreach($inner_friends_array1 as $friend2) {
						$inner_friends_array2 = $this->Users_model->my_friends($friend2['customer_id']);
				        $inner_friends2 = $inner_friends_array2;
						/**************  friend level 3 *******************/
						if(!empty($inner_friends_array2) && $level >= 4) {
							foreach($inner_friends_array2 as $friend3) {
								$inner_friends_array3 = $this->Users_model->my_friends($friend3['customer_id']);
								$inner_friends3 = $inner_friends_array3;
								/**************  friend level 4 *******************/
								if(!empty($inner_friends_array3) && $level >= 5) {
									foreach($inner_friends_array3 as $friend4) {
										$inner_friends_array4 = $this->Users_model->my_friends($friend4['customer_id']);
										$inner_friends4 = $inner_friends_array4;
										/**************  friend level 5 *******************/
										if(!empty($inner_friends_array4) && $level >= 6) {
											foreach($inner_friends_array4 as $friend5) {
												$inner_friends_array5 = $this->Users_model->my_friends($friend5['customer_id']);
												$inner_friends5 = $inner_friends_array5;
												
												/**************  friend level 6 *******************/
										if(!empty($inner_friends_array5) && $level >= 7) {
											foreach($inner_friends_array5 as $friend6) {
												$inner_friends_array6 = $this->Users_model->my_friends($friend6['customer_id']);
												$inner_friends6 = $inner_friends_array6;
												
												/**************  friend level 7 *******************/
										if(!empty($inner_friends_array6) && $level >= 8) {
											foreach($inner_friends_array6 as $friend7) {
												$inner_friends_array7 = $this->Users_model->my_friends($friend7['customer_id']);
												$inner_friends7 = $inner_friends_array7;
												
												/**************  friend level 8 *******************/
										if(!empty($inner_friends_array7) && $level >= 9) {
											foreach($inner_friends_array7 as $friend8) {
												$inner_friends_array8 = $this->Users_model->my_friends($friend8['customer_id']);
												$inner_friends8 = $inner_friends_array8;
												
													/**************  friend level 9 *******************/
										if(!empty($inner_friends_array8) && $level >= 10) {
											foreach($inner_friends_array8 as $friend9) {
												$inner_friends_array9 = $this->Users_model->my_friends($friend9['customer_id']);
												$inner_friends9 = $inner_friends_array9;
												
													/**************  friend level 10 *******************/
										if(!empty($inner_friends_array9) && $level >= 11) {
											foreach($inner_friends_array9 as $friend10) {
												$inner_friends_array10 = $this->Users_model->my_friends($friend10['customer_id']);
												$inner_friends10 = $inner_friends_array10;
												
												if($level == 11) { $data['myfriends'][] = array('friends'=>$inner_friends10,'level'=>11); }
											}
										}
												
												if($level == 10) { $data['myfriends'][] = array('friends'=>$inner_friends9,'level'=>10); }
											}
										}
												
												if($level == 9) { $data['myfriends'][] = array('friends'=>$inner_friends8,'level'=>9); }
											}
										}
												
												if($level == 8) { $data['myfriends'][] = array('friends'=>$inner_friends7,'level'=>8); }
											}
										}
												
												
												
												if($level == 7) { $data['myfriends'][] = array('friends'=>$inner_friends6,'level'=>7); }
											}
										}
												
												
												if($level == 6) { $data['myfriends'][] = array('friends'=>$inner_friends5,'level'=>6); }
											}
										}
								        if($level == 5) { $data['myfriends'][] = array('friends'=>$inner_friends4,'level'=>5); }
									}
								}
								if($level == 4) { $data['myfriends'][] = array('friends'=>$inner_friends3,'level'=>4); }
							}
						}
						if($level == 3) { $data['myfriends'][] = array('friends'=>$inner_friends2,'level'=>3); }
					}
				}
				
				if($level == 2) { $data['myfriends'][] = array('friends'=>$inner_friends1,'level'=>2); }
			}
		}
		if($level == 1) { $data['myfriends'][] = array('friends'=>$myfriends,'level'=>1); }
	//$data['order'] = $this->order_model->get_all_order();
	}
	//load the view
      $data['main_content'] = 'admin/DistributorLevelInformation';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function order_view(){ 
	 $id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	  //order id 
        $id = $this->uri->segment(3);
     
        $data['order'] = $this->order_model->get_all_order_id($id); 
        //load the view
        $data['main_content'] = 'admin/DistributorLevelInformation'; 
        $this->load->view('includes/admin/template', $data); 
  }  
}