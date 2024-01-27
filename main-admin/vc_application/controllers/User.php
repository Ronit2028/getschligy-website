<?php 
class User extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
       $this->load->helper('url');
        $this->load->library('session');
        $this->load->helper('form');
        
    }

    /**
    * Check if the user is logged in, if he's not, 
    * send him to the login page
    * @return void
    */	
	function index()
	{
		if($this->session->userdata('is_admin_logged_in')){ redirect(base_url().'welcome');    }
               else{ $this->load->view('login');	     }
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
		
		if($is_valid['login']=='true')
		{
			$data = array('user_name' => $user_name, 'permission' =>$is_valid['permission'] , 'full_name'=>$is_valid['full_name'], 'email'=>$is_valid['email'], 'role'=>$is_valid['user_level'], 'user_id'=>$is_valid['user_id'], 'is_admin_logged_in' => true);
			$this->session->set_userdata($data);
			redirect(base_url().'welcome');
		}
		else // incorrect username or password
		{
			$data['message_error'] = TRUE;
			$this->load->view('login', $data);	
		}
	}	

	 function admin_welcome(){ 
	 $this->load->model('customer_model');
                 if($this->session->userdata('is_admin_logged_in')){  }
               else{ redirect(base_url().'');  }   
			   
		
			   
	$data['sale'] = $this->customer_model->get_sale_by_date();
	$data['order_amount'] = $this->customer_model->get_o_data();
	$data['customer'] = $this->customer_model->get_customer_data();
	$data['docveri'] = $this->customer_model->get_customer_docveri();
	$data['newcustomer'] = $this->customer_model->get_new_customer_data();
	$order = $this->customer_model->get_order_data();
	$data['neworder'] = $this->customer_model->get_new_order_data();
	$data['newwalletadd'] = $this->customer_model->get_new_walletadd_data();
	$data['damount'] = $this->customer_model->get_amount_data();
	$data['bliss_amount'] = $this->customer_model->get_bliss_data();
	$data['redeem_amount'] = $this->customer_model->get_redeem_data();
	$data['business_order'] = $this->customer_model->get_business_order();
	$data['business_sale'] = $this->customer_model->get_business_sale();
	$data['shelf_income'] = $this->customer_model->get_shelf_income();
	
	
	$data['wallet_history'] = $this->customer_model->get_all_wallet_history();
	$data['order_pending'] = $data['order_delivered'] = $data['order_accepted']= $data['order_cancel'] = $data['total_cost'] = $data['order_cost'] = $data['sale_cost'] = 0;
	
	if(!empty($order)) {
		foreach($order as $or) {
			if($or['status']=='Accepted') { $data['order_accepted'] = $or['count'];}
			if($or['status']=='Pending') { $data['order_pending'] = $or['count']; }
			if($or['status']=='Cancel') { $data['order_cancel'] = $or['count']; }
			if($or['status']=='Delivered') { $data['order_delivered'] = $or['count']; }
			$data['total_cost'] = $or['total_cost'];
			$data['order_cost'] = $or['total_cost'];
		}
	}
	if(!empty($data['sale'])) {
		$data['total_cost'] = $data['total_cost'] + $data['sale'][0]['total_cost'];
		$data['sale_cost'] = $data['sale'][0]['total_cost'];
	}
	// echo '<pre>'; print_r($order); die();   
			   
	$data['main_content'] = 'welcome_message'; 
	$this->load->view('includes/admin/template', $data); 
   
	 }
    /**
    * The method just loads the signup view
    * @return void
    */
	function signup()
	{
		//$this->load->view('signup_form');	
	}
	

    /**
    * Create new user and store it in the database
    * @return void
    */	
	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules
		$this->form_validation->set_rules('first_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('email_address', 'Email Address', 'trim|required|valid_email');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('password2', 'Password Confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup_form');
		}
		
		else
		{			
			$this->load->model('Users_model');
			
			if($query = $this->Users_model->create_member())
			{
				$this->load->view('signup_successful');			
			}
			else
			{
				$this->load->view('signup_form');			
			}
		}
		
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

}