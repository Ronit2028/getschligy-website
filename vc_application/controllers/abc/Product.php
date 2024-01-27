<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url'); 
        $this->load->helper('form');
        $this->load->library('form_validation'); 
        $this->load->model('product_model');	
        $this->load->model('customer_model');	
         $this->load->library('cart');
    }
	
	public function index()
	{
        redirect(base_url());
	}
	public function bliss_product_list(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'bliss_products';
                $data['page_title'] = 'Bliss products'; 
		$data['products'] = $this->product_model->get_bliss_product_list();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'lam_products';
        $this->load->view('includes/front/front_template', $data); 
	}

	public function stores(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'stores';
                $data['page_title'] = 'Stores'; 
		$data['products'] = $this->product_model->get_stores_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'stores';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function deals_king(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'deals_king';
                $data['page_title'] = 'Deals King'; 
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'deals_king';
        $this->load->view('includes/front/front_template', $data); 
	}
	
	public function new_arrivals(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'new-arrivals';
                $data['page_title'] = 'New Aarrivals'; 
		$data['products'] = $this->product_model->get_new_arrivals_product();
		    $data['category_list'] = $this->customer_model->get_category_list();
		$data['main_content'] = 'new_arrivals';
        $this->load->view('includes/front/front_template', $data); 
	}
	public function search(){
		        $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'search';
                $data['page_title'] = 'Search'; 

       $keyword = '';
       if ($this->input->server('REQUEST_METHOD') === 'POST'){ $keyword = $this->input->post('key'); }
        $cat = $this->input->post('cat'); 
        //echo '<pre>'; print_r($this->input->post('cat')); die();
		$data['products'] = $this->product_model->get_new_arrivals_product($keyword,$cat);
		    $data['category_list'] = $this->customer_model->get_category_list();
			//echo '<pre>'; print_r($data['category_list']);die();
			//echo '<pre>'; print_r($data['products']);die();
		$data['main_content'] = 'search';
        $this->load->view('includes/front/front_template', $data); 
	}
	

	public function add_to_cart()
	{
		$productURL = $this->uri->segment(2);
		$data['products'] = '';
        $product = $this->product_model->get_product_by_url($productURL);
        		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('id', 'id', 'required|trim');
            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');
            $this->form_validation->set_rules('name', 'name', 'required|trim');
		//$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {    

           // if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'signin');	  }
            
            $id = $this->session->userdata('cust_id');
            $customer_id = $this->session->userdata('bliss_id');
			
			
			$profile = $this->product_model->profile($id);
			$price = $this->input->post('qty') * $product[0]['p_d_price'];
			$image = $this->input->post('image');
			$desc = $product[0]['s_discription'];
			$category = $product[0]['category'];
            $product_name = str_replace('/','',substr($this->input->post('name'),0,5));
			$tax_class=$product[0]['p_d_price']*$product[0]['t_class']/100;
			
			if($product[0]['category']==1){$package=1;}else{$package=0;}
			
			$mid=false;
			$cart = $this->cart->contents();
	if(!empty($cart)) { 
	foreach ($cart as $items){	
	if($items['package']==1 && $mid==false){
		$mid=true;
	}
	}
	}
	
	if(!$this->session->userdata('is_customer_logged_in')) {
		$this->session->set_flashdata('flash_message', 'Please Login or Register First.<br> <a href="'.base_url().'signin">Click here</a>');
	}
	elseif($profile[0]['consume'] == 0 && $package==0 && $profile[0]['direct_customer_id']!='GL5555') {
		$this->session->set_flashdata('flash_message', 'Please activate your id first from any combo package.');
	}
	elseif($profile[0]['consume'] == 0 && $mid==true && $profile[0]['direct_customer_id']!='GL5555') {
		$this->session->set_flashdata('flash_message', 'Please activate your id first from any combo package.');
	}
	elseif(empty($cart) && $product[0]['category']==1 && $this->input->post('qty') > 1) {
		$this->session->set_flashdata('flash_message', 'You can buy only one package at one time.Please checkout first.');
	}
	elseif($mid==true){
		$this->session->set_flashdata('flash_message', 'You can buy only one package at one time.Please checkout first.');
	}
	elseif(!empty($cart) && $package==1) {
		$this->session->set_flashdata('flash_message', 'You need to activate your account first from any package.');
	}
	elseif($package==1 && $profile[0]['consume'] > 0) {
		$this->session->set_flashdata('flash_message', 'Oops !! You are already a member. <br>In order to buy a new combo create a new id.');
	}


	else{
			
			$cart = $this->cart->contents();
			$ids = array_column($cart, 'id');


			if(in_array($this->input->post('id'), $ids)) {


				foreach ($cart as $value) {
					if($value['id']==$this->input->post('id')) {
						$data_cart = array(
	                     'rowid' => $value['rowid'],
	                     'qty' => $this->input->post('qty')
                  );
					}
				}
				
         $this->cart->update($data_cart);
			} else {
				$insert_data = array(
               'id' => $this->input->post('id'),
			   'tax' => $tax_class,
               'name' => $product_name,
               'p_name' => $this->input->post('name'),
               'cost' => $product[0]['cost'],
               'price' => $product[0]['p_d_price'],
               'qty' => $this->input->post('qty'), 
	           'comm_dis' => $product[0]['comm_dis'],
	           'package' => $package,
               'bv' => $product[0]['bv'], 
               'i_total' => $price, 
	           'options' => array('image' => $image, 'desc' => $desc)
             );
			  // This function add items into cart.
              $this->cart->insert($insert_data);
			}
			//echo '<pre>'; print_r($cart);
               

               //echo "<strong>Product Added to cart</strong> ";
                //redirect(base_url().'cart');
			  
	}

	echo $this->session->flashdata('flash_message');
			 
			}  
		 }
 		 		 		 
		

	}

	public function bliss_product()
	{
		$productURL = $this->uri->segment(2);
		$data['products'] = '';
        $product = $this->product_model->get_product_by_url($productURL);
        if(!empty($product)) {  
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = $product[0]['p_id'];
                $data['page_title'] = $product[0]['pname']; 
                $data['products'] = $product;
         } else { 
                $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'not-found';
                $data['page_title'] = 'Not Found'; 
		 }		
		if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
            $this->form_validation->set_rules('id', 'id', 'required|trim');
            $this->form_validation->set_rules('qty', 'qty', 'required|trim|numeric');
            $this->form_validation->set_rules('name', 'name', 'required|trim');
		//$this->form_validation->set_rules('price', 'price', 'required|trim|numeric');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            {    

           // if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'signin');	  }
            
            $id = $this->session->userdata('cust_id');
            $customer_id = $this->session->userdata('bliss_id');
			
			
			$profile = $this->product_model->profile($id);
			$price = $this->input->post('qty') * $product[0]['p_d_price'];
			$image = $this->input->post('image');
			$desc = $product[0]['s_discription'];
			$category = $product[0]['category'];
            $product_name = str_replace('/','',substr($this->input->post('name'),0,5));
			$tax_class=$product[0]['p_d_price']*$product[0]['t_class']/100;
			
			if($product[0]['category']==1){$package=1;}else{$package=0;}
			
			$mid=false;
			$cart = $this->cart->contents();
	if(!empty($cart)) { 
	foreach ($cart as $items){	
	if($items['package']==1 && $mid==false){
		$mid=true;
	}
	}
	}
	
	if(!$this->session->userdata('is_customer_logged_in')) {
		$this->session->set_flashdata('flash_message', 'Please Login or Register First.<br> <a href="'.base_url().'signin">Click here</a>');
	}
	elseif($profile[0]['consume'] == 0 && $package==0 && $profile[0]['direct_customer_id']!='GL5555') {
		$this->session->set_flashdata('flash_message', 'Please activate your id first from any combo package.');
	}
	elseif($profile[0]['consume'] == 0 && $mid==true && $profile[0]['direct_customer_id']!='GL5555') {
		$this->session->set_flashdata('flash_message', 'Please activate your id first from any combo package.');
	}
	elseif(empty($cart) && $product[0]['category']==1 && $this->input->post('qty') > 1) {
		$this->session->set_flashdata('flash_message', 'You can buy only one package at one time.Please checkout first.');
	}
	elseif($mid==true){
		$this->session->set_flashdata('flash_message', 'You can buy only one package at one time.Please checkout first.');
	}
	elseif(!empty($cart) && $package==1) {
		$this->session->set_flashdata('flash_message', 'You need to activate your account first from any package.');
	}
	elseif($package==1 && $profile[0]['consume'] > 0) {
		$this->session->set_flashdata('flash_message', 'Oops !! You are already a member. <br>In order to buy a new combo create a new id.');
	}


	else{
			
			
               $insert_data = array(
               'id' => $this->input->post('id'),
			   'tax' => $tax_class,
               'name' => $product_name,
               'p_name' => $this->input->post('name'),
               'cost' => $product[0]['cost'],
               'price' => $product[0]['p_d_price'],
               'qty' => $this->input->post('qty'), 
	           'comm_dis' => $product[0]['comm_dis'],
	           'package' => $package,
               'bv' => $product[0]['bv'], 
               'i_total' => $price, 
	           'options' => array('image' => $image, 'desc' => $desc)
             );
			  // This function add items into cart.
              $this->cart->insert($insert_data);
               //echo "<strong>Product Added to cart</strong> ";
                //redirect(base_url().'cart');
			  redirect(current_url());
	}
			 
			}  
		 }
 		 		 		 
		 
		   $id=explode("-",$product[0]['p_id']);
            $data['review'] = $this->product_model->get_product_review(end($id));
		    $data['category_list'] = $this->customer_model->get_category_list();
	        $data['main_content'] = 'product';
            $this->load->view('includes/front/front_template', $data); 

	}
}
