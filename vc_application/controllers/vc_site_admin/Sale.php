<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sale extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('string');	
        $this->load->model('sale_model');		

     if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
    }
	
  public function index() {
   
    $id = $this->session->userdata('cust_id');
	    $data['profile'] = $this->sale_model->profile($id);
 
        
        $data['sale'] = $this->sale_model->get_all_merchant_sale($id);
  
	
	//load the view
      $data['main_content'] = 'admin/sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
    public function wallet_history() {
  
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
     $data['profile'] = $this->sale_model->profile($id);
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
	$data['wallet_history'] = $this->sale_model->get_all_wallet_history($customer_id,$sdate,$edate);
	//load the view
      $data['main_content'] = 'admin/wallet_history';
      $this->load->view('includes/admin/template', $data);   
  }

   public function repurchase_wallet_history() {
   
    $id = $this->session->userdata('cust_id');
    $customer_id = $this->session->userdata('bliss_id');
     $data['profile'] = $this->sale_model->profile($id);
	 if ($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	} else {
    	    $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	}
	$data['wallet_history'] = $this->sale_model->get_all_repurchase_wallet_history($customer_id,$sdate,$edate);
	//load the view
      $data['main_content'] = 'admin/wallet_history';
      $this->load->view('includes/admin/template', $data);   
  }

public function pininsale() {
    	 
		  $id = $this->session->userdata('cust_id');
		  $customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($id);
	$data['sale'] = $this->sale_model->get_all_pin_sale($customer_id);
	
	//load the view
      $data['main_content'] = 'admin/pin_sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function pininvoice() {
      $id = $this->uri->segment(3);
	  $cid = $this->session->userdata('cust_id');
	  $customer_id = $this->session->userdata('bliss_id');
	   $data['profile'] = $this->sale_model->profile($id);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id,$customer_id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
	//load the view
      $data['main_content'] = 'admin/pin_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function invoice() {
	  $cid = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($cid);
      $id = $this->uri->segment(4);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id,$cid); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { 
                $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
		  $data['center'] = $this->sale_model->get_center_detail($data['invoice'][0]['center_id']);
		  
	//load the view
      $data['main_content'] = 'admin/sale_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function add(){
	  $id = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($id);
	   
  
	$data['products'] = $this->sale_model->get_all_product($id);
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
                
                if ($this->form_validation->run() == FALSE) {}
                else {
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$total_gst = $this->input->post('total_gst');
					$tprice = $this->input->post('tprice');
					$bv = $this->input->post('bv');
					$gst_percentage = $this->input->post('gst_percentage');
					$total_bv = $this->input->post('total_bv');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$bv[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_stock_qty($id,$pid[$i],$qty[$i]);
						}
					$products = json_encode($products_array);
					}
					$data_store = array( 
                    'gtotal' => $this->input->post('gtotal'),
                    'bv' => $this->input->post('total_bv'),
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 					               
                    'coupon_amount' => $this->input->post('coupon'), 					               
					'wallet_credit' => $this->input->post('wallet_credit'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'slip_no' => $this->input->post('slip_no'), 
                    'total_gst' => $this->input->post('total_gst'), 
                    'customer' => $this->input->post('customer'),
                    'center_id' => $id
					);
					
					 $own_profile = $this->sale_model->profile_by_id($id);
					$franchise_amt = ($own_profile[0]['franchise']/100)*$total_bv;
					$add_income = array('amount'=>round($franchise_amt,0),'user_id'=>$id,'type'=>'Franchise Income','status'=>'Active');
					$this->sale_model->add_income($add_income);
					$franchise_amt = $total_bv/100;
					$add_income1 = array('amount'=>round($franchise_amt,0),'user_id'=>$own_profile[0]['did'],'type'=>'Franchise Referal','status'=>'Active');
					$this->sale_model->add_income($add_income1);
                //if the insert has returned true then we show the flash message
				if($this->sale_model->store_sale($data_store) == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/sale_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  public function update(){
	  	
	 $cid = $this->session->userdata('cust_id');$customer_id = $this->session->userdata('bliss_id');
	    $data['profile'] = $this->sale_model->profile($cid);
	  //sale id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">�</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                $data_to_store = array(
				    'user_id' => $this->input->post('user_id'),
				    'amount' => $this->input->post('amount'),
					'gst_val' => $this->input->post('gst_val'),
					'msd_val' => $this->input->post('msd_val'),
					'how_to_pay' => $this->input->post('how_to_pay'),
					'gst_amt' => $this->input->post('gst_amt'),
					'msd_amt' => $this->input->post('msd_amt'),
					'total_amount' => $this->input->post('total_amount'),
					); 
             $return = $this->Sale_model->update_sale($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

       
        $data['sale'] = $this->sale_model->get_all_sale_id($id,$cid); 
        //load the view
        $data['main_content'] = 'admin/sale_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->sale_model->delete_sale($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/sale');
 }  
}