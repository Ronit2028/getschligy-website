<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_front extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
		$this->load->library('cart');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('search_model');	
        $this->load->model('customer_model');
    }
	
	public function index()
	{
               	   $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'scholarship';
                $data['page_title'] = 'Scholarship'; 

	$this->load->model('product_model');

       if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('send_query')=='true')
        {
          $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[3]');
          $this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|min_length[4]');
          $this->form_validation->set_rules('subject', 'subject', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('description', 'description', 'required');
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
$data_to_store = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
					'message' => $this->input->post('description')
				); 
                //if the insert has returned true then we show the flash message
				if($this->search_model->user_query($data_to_store) == 'true'){
                    $this->session->set_flashdata('send_query', 'updated');
					//redirect(base_url().'#send-query');
                }else{
                    $this->session->set_flashdata('send_query', 'not_updated');
                }
				 
            }//validation run 
        } 
			
	
		

		    $data['get_schloships'] = $this->customer_model->get_schloships();
		    $data['govt_schloships'] = $this->customer_model->get_govt_schloships();
		  //  $data['store'] = substr($data['get_schloships'][0]['discription'],0, 800);
		//	echo '<pre>'; print_r($data['store']); die();
	        $data['main_content'] = 'scholarship';
            $this->load->view('includes/front/front_template', $data); 

	}

}
