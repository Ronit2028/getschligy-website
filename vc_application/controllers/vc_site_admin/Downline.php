<?php																																										
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Downline extends CI_Controller {
	
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
	        $bliss_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);

	
	 $data['myfriends'] = array();
	$data['show_inner'] = 'false';
	$data['current_user'] = $bliss_id;
	$inner_users = $this->uri->segment(3);
	if($inner_users!='') {
		$bliss_id = $inner_users;
		$data['show_inner'] = 'true';
		$data['current_user'] = $inner_users;
	} 
	
	$data['friends'] = $this->order_model->get_first_cercle($bliss_id);
	
	//load the view
      $data['main_content'] = 'admin/downline';
      $this->load->view('includes/admin/template', $data);   
  }  

  public function scholarship() {
	  $id = $this->session->userdata('cust_id');
		$bliss_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		$data['scholarship'] = $this->order_model->get_scholarship($id);
		
		
	//load the view
      $data['main_content'] = 'admin/scholarship';
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
        $data['main_content'] = 'admin/downline'; 
        $this->load->view('includes/admin/template', $data); 
  }  
}