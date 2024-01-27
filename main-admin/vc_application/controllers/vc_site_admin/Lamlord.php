<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lamlord extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('lamlord_model');	

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['coupon'] = $this->lamlord_model->get_all_customer();
	
	//load the view
      $data['main_content'] = 'admin/lamlord_list';
      $this->load->view('includes/admin/template', $data);   
  }
  public function add(){

	  $data['image_error'] = 'false';
	  
	  $cimage = '';
	  if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            //form validation
			$this->form_validation->set_rules('customer_id', 'customer_id', 'required|trim');
            $this->form_validation->set_rules('rank', 'rank', 'required|trim');
			/* $this->form_validation->set_rules('amount', 'amount', 'required|trim');
			$this->form_validation->set_rules('type', 'Type', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'start date', 'trim');
		  $this->form_validation->set_rules('end_date', 'end date', 'trim'); */
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				$data_to_store = array(
				     'customer_id' => $this->input->post('customer_id'),
                    'rank' => $this->input->post('rank'),
                    'package' => $this->input->post('package'),
					'direct_sale' => $this->input->post('direct_sale'),
					'team_performance' => $this->input->post('team_performance'),
					'education' => $this->input->post('education'),
					'team_sale_incentive' => $this->input->post('team_sale_incentive'),
					'travel' => $this->input->post('travel'),
					'entertainment' => $this->input->post('entertainment'),
					'repurchase' => $this->input->post('repurchase'),
					'reward' => $this->input->post('reward'),
					'status' => $this->input->post('status')
				); 
                //if the insert has returned true then we show the flash message
				if($this->lamlord_model->store_income($data_to_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/lamlord/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
                

            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view

        $data['main_content'] = 'admin/lamlord_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 
	  //coupon id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
			$this->form_validation->set_rules('customer_id', 'customer_id', 'required|trim');
             /*  $this->form_validation->set_rules('code', 'code', 'required|trim');
			$this->form_validation->set_rules('amount', 'Amount', 'required|trim');
			$this->form_validation->set_rules('type', 'Type', 'required|trim');
		  $this->form_validation->set_rules('start_date', 'start date', 'trim');
		  $this->form_validation->set_rules('end_date', 'end date', 'trim'); */
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		  
               	$data_to_store = array(
				     'customer_id' => $this->input->post('customer_id'),
                    'rank' => $this->input->post('rank'),
                    'package' => $this->input->post('package'),
					'direct_sale' => $this->input->post('direct_sale'),
					'team_performance' => $this->input->post('team_performance'),
					'education' => $this->input->post('education'),
					'team_sale_incentive' => $this->input->post('team_sale_incentive'),
					'travel' => $this->input->post('travel'),
					'entertainment' => $this->input->post('entertainment'),
					'repurchase' => $this->input->post('repurchase'),
					'reward' => $this->input->post('reward'),
					'status' => $this->input->post('status')
				); 
             $return = $this->lamlord_model->update_income($id, $data_to_store);
			
				$data_to = array(
				    
					'bliss_amount' => $this->input->post('wallet')
				); 
				
				$this->lamlord_model->update_customer($id, $data_to);
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/lamlord/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['incomes'] = $this->lamlord_model->get_all_income_by_id($id); 
        //load the view
        $data['main_content'] = 'admin/lamlord_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->lamlord_model->delete_coupon($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/lamlord');
 }  
}