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

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	 
	$data['sale'] = $this->sale_model->get_all_sale();
	
	//load the view
      $data['main_content'] = 'admin/sale_list';
      $this->load->view('includes/admin/template', $data);   
  } 
  
  public function invoice() {
      $id = $this->uri->segment(4);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
	//load the view
      $data['main_content'] = 'admin/sale_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
    public function pininsale() {
    	 
	$data['sale'] = $this->sale_model->get_all_pin_sale();
	
	//load the view
      $data['main_content'] = 'admin/pin_sale_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
    public function pininvoice() {
      $id = $this->uri->segment(3);
      $data['customer_info'] = '';
    	$data['invoice'] = $this->sale_model->get_all_sale_id($id); 
	if(!empty($data['invoice'])) {
            $data['customer_info'] = $this->sale_model->get_customer_info($data['invoice'][0]['customer']); 
            if($data['customer_info'][0]['parent_customer_id']!='') { $data['sponser_name'] = $this->sale_model->get_customer_info($data['customer_info'][0]['parent_customer_id']);  }
          }
	//load the view
      $data['main_content'] = 'admin/pin_invoice';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function daily_weekly_income(){
	  $data['daily_weakly_in'] = array();
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
	//	$data['daily_weakly_in'] = $this->sale_model->all_daily_weakly_in($sdate, $edate);
    } else {
	  $sdate = date('Y-m-d 00:00:01');
	  $edate = date('Y-m-d 23:59:59');
     // $data['daily_weakly_in'] = $this->sale_model->all_daily_weakly_in($sdate ,$edate);			 
	}
	
	$binary_income = $this->sale_model->daily_weakly_in_by_table('binary_income',$sdate, $edate); 
			$binary_level_income = $this->sale_model->daily_weakly_in_by_table('binary_level_income',$sdate, $edate); 
			$direct_income = $this->sale_model->daily_weakly_in_by_table('direct_income',$sdate, $edate); 
			$repurchase_income = $this->sale_model->daily_weakly_in_by_table('repurchase_income',$sdate, $edate); 
			$turnover_income = $this->sale_model->daily_weakly_in_by_table('turnover_income',$sdate, $edate);

	
			
			 $data['daily_weakly_in'] = array_merge($binary_income,$binary_level_income,$direct_income,$repurchase_income,$turnover_income);
			
		
	//load the view
    $data['main_content'] = 'admin/daily_weekly_income';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function daily_sale_report(){
	  $pin = '';
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d',strtotime($this->input->post('edate'))); 
		$pin = $this->input->post('pin'); 
		$data['daily_weakly_pin'] = $this->sale_model->daily_weakly_pin($sdate, $edate,$pin);
    } else {
	  $sdate = date('Y-m-d');
	  $edate = date('Y-m-d');
      $data['daily_weakly_pin'] = $this->sale_model->daily_weakly_pin($sdate ,$edate,$pin);			 
	}
	//load the view
    $data['main_content'] = 'admin/daily_sale_report';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function cut_off_report(){
	  
	if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		$edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
		$data['cut_off_report'] = $this->sale_model->cut_off_report($sdate, $edate);
    } else {
	  $sdate = date('Y-m-d 00:00:01');
	  $edate = date('Y-m-d 23:59:59');
      $data['cut_off_report'] = $this->sale_model->cut_off_report($sdate ,$edate);			 
	}
	//load the view
    $data['main_content'] = 'admin/cut_off_report';
    $this->load->view('includes/admin/template', $data); 
  }
  
  public function add(){ 
    /*$myfriendss = $this->sale_model->my_friends('400002'); 
	echo '<pre>';print_r($myfriendss); echo '</pre>';*/
	$data['products'] = $this->sale_model->get_all_product();
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
             //   $this->form_validation->set_rules('idate', 'date', 'required');
                
				$customer = $this->input->post('customer');
				$gtotal = $this->input->post('gtotal');
				$customer_id = $this->sale_model->get_customer_info($customer);
				if(empty($customer_id)) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'This customer id is not exist.');
				}
				/* if($gtotal < 8499) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'Minimum amount must be 8500');
				} */
				
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');	
                if ($this->form_validation->run() == FALSE) {}
                else {
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');				
					$bv = $this->input->post('bv');
					$price = $this->input->post('price');
					$gst = $this->input->post('gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					$total_bv = $this->input->post('total_bv');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$bv[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_product_qty($pid[$i],$qty[$i]);
						}
					//$products_array = array('pname'=>$pname,'qty'=>$qty,'qty_type'=>$qty_type,'qty_box'=>$qty_box,'price'=>$price);
					$products = json_encode($products_array);
					}
					$iidate = $this->input->post('idate');
					$idate = date('Y-m-d H:i:s',strtotime($iidate));
					$data_store = array(
                    'gtotal' => $this->input->post('gtotal'),
                    'bv' => $total_bv,
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'customer' => $this->input->post('customer'),
                    'total_gst' => $this->input->post('total_gst'),
                    'tdate' => $idate
					);
                //if the insert has returned true then we show the flash message
				$sale_id = $this->sale_model->store_sale($data_store);
				
				if(!empty($sale_id)){
				$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
				
				/* if(!empty($sale_id)){
				
				$package=0;
				
                if($gtotal > 8499 && $gtotal < 33999) { $customer_rank = '1'; }
                elseif($gtotal > 33999 && $gtotal < 145000) { $customer_rank = '2'; $package=4; }
				elseif($gtotal > 144999) { $customer_rank = '3'; $package=16;}
				else { $customer_rank = ''; }
				
				if($customer_rank != '' && $customer_id[0]['rank'] < $customer_rank) {
					$rankdata = array('rank'=>$customer_rank);
					if($package>0){$rankdata['package']=$package;}
					$this->sale_model->update_table($customer_id[0]['id'],$rankdata,'customer'); 
				}else{
					$customer_rank = $customer_id[0]['rank'];
					
				}
				
					
              if($customer != '' && $customer_id[0]['parent_customer_id']!='') { 
				$myfriends = $this->sale_model->my_friends($customer_id[0]['parent_customer_id']); 
		if(!empty($myfriends)) {
			$parent_rank = $myfriends[0]['p_rank'];
			$parent_id = $myfriends[0]['p_id'];
			$parent_customer_id = $myfriends[0]['p_customer_id'];
			$star = $super_star = $icon = $marquis = $empire = $leouidas = 0;
            foreach($myfriends as $friend) {
				if($friend['rank']=='1') { $star = $star + 1; }
				if($friend['rank']=='2') { $super_star = $super_star + 1; }
				if($friend['rank']=='3') { $icon = $icon + 1; }
				if($friend['rank']=='4') { $marquis = $marquis + 1; }
				if($friend['rank']=='5') { $empire = $empire + 1; }
				if($friend['rank']=='6') { $leouidas = $leouidas + 1; }
			}
			$distribution_amount = 0;
			$rank = '';
			$grant_total = $this->input->post('before_tax_amount') + 0;

			if($parent_rank=='1' && $customer_rank == '1') { 
				$distribution_amount = ($grant_total * 20) / 100;
				$rank = '1';
				if($star >= 4) {
					$rankdata = array('rank'=>'2');
					$this->sale_model->update_table($parent_id,$rankdata,'customer'); 
				}
			} 
			elseif($parent_rank=='2' && $customer_rank <=2 ) {
			 
			   
				$distribution_by_package = $this->sale_model->get_customer_package($myfriends[0]['p_customer_id']);
				if(empty($distribution_by_package) || $distribution_by_package[0]['package'] > 0 && $customer_rank == '1') {
					$distribution_amount = 0; 
					$package_now = $distribution_by_package[0]['package'] - 1;
					$rankdatapackage = array('package'=>$package_now);
					$this->sale_model->update_table($distribution_by_package[0]['id'],$rankdatapackage,'customer'); 
				}  elseif(empty($distribution_by_package) || $distribution_by_package[0]['package'] > 0 && $customer_rank == '2') {
					$distribution_amount = 8500 + (($grant_total * 10) / 100); 
					$package_now = $distribution_by_package[0]['package'] - 1;
					$rankdatapackage = array('package'=>$package_now);
					$this->sale_model->update_table($distribution_by_package[0]['id'],$rankdatapackage,'customer');
				}  elseif(empty($distribution_by_package) || $distribution_by_package[0]['package'] == 0 && $customer_rank == '2') {
					$distribution_amount = 2520 + (($grant_total * 10) / 100); 
				}  elseif($customer_rank == '1') {
					$distribution_amount = ($grant_total * 30) / 100;
				} else {
					$distribution_amount = 0;
				}  
				if($super_star >= 3) {
					$rankdata = array('rank'=>'3');
					$this->sale_model->update_table($parent_id,$rankdata,'customer'); 
				}
				$rank = '2';
			} 
			elseif($parent_rank == '3' && $customer_rank <=3) { 
				$distribution_by_rank = $this->sale_model->distribution_by_rank($myfriends[0]['p_customer_id'],'3');
				if((empty($distribution_by_rank) || count($distribution_by_rank) < 3) && $customer_rank == '2') {
					$distribution_amount = $grant_total;
				} elseif($customer_rank == '1') {
					$distribution_amount = ($grant_total * 40) / 100;
				} else {
					$distribution_amount = 0;
				}  
				if($icon >= 4) {
					$rankdata = array('rank'=>'4');
					$this->sale_model->update_table($parent_id,$rankdata,'customer'); 
				}
				$rank = '3';
			} 
			else {
			    $distribution_amount = 0;
				$rank = '';
			}
			
			$distribution_amount = round($distribution_amount,2);
			if($distribution_amount != 0 && $rank!=''){
				$distribution_data = array(
				  'user_id'=> $parent_customer_id,
				  'amount'=> $distribution_amount,
				  'user_id_send_by'=> $customer,
				  'pay_level'=> '1',
				  'status'=>'active',
				  'order_id'=> $sale_id,
				  'rank'=> $rank
				);
				$this->sale_model->store_distribution_amount($distribution_data);
				$this->sale_model->update_customer_distribution_amount($distribution_amount,$parent_customer_id);
			}
        } 
    
	
	$this->lavel_distribution($parent_customer_id,$customer,$customer_rank,$sale_id,$grant_total);
	
			  }
			  
			
			  
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				 */
            }

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/sale_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
    public function franchise_stock(){
    /*$myfriendss = $this->sale_model->my_friends('400002'); 
	echo '<pre>';print_r($myfriendss); echo '</pre>';*/
	$data['products'] = $this->sale_model->get_all_product();
	
	  if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('gtotal')!='')
        {
             $this->form_validation->set_rules('customer', 'customer', 'required');
                $this->form_validation->set_rules('pid_array', 'product', 'required');
                $this->form_validation->set_rules('payment_type', 'payment type', 'required');
                $this->form_validation->set_rules('before_tax_amount', 'before tax amount', 'required|numeric');
                $this->form_validation->set_rules('gtotal', 'grand total', 'required|numeric');
                $this->form_validation->set_rules('idate', 'date', 'required');
                
				$customer = $this->input->post('customer');
				$gtotal = $this->input->post('gtotal');
				$customer_id = $this->sale_model->get_customer_info($customer);
				if(empty($customer_id)) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'This customer id is not exist.');
				}
				/* if($gtotal < 8499) { 
					$this->form_validation->set_rules('customerid', 'customer', 'required');
					$this->form_validation->set_message('required', 'Minimum amount must be 8500');
				} */
				
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">x</a><strong>', '</strong></div>');	
                if ($this->form_validation->run() == FALSE) {}
                else {
					$pid = $this->input->post('pid');
					$pname = $this->input->post('pname');
					$code = $this->input->post('code');
					$qty = $this->input->post('qty');
					$size = $this->input->post('size');
					$price = $this->input->post('price');
					$bv = $this->input->post('bv');
					$gst = $this->input->post('gst');
					$tprice = $this->input->post('tprice');
					$gst_percentage = $this->input->post('gst_percentage');
					$total_bv = $this->input->post('total_bv');
					
					$products_array = array();
					if(count($pid) > 0) {
						for($i=0;$i<count($pid);$i++) {
							$products_array[] = $pid[$i].'~~'.$pname[$i].'~~'.$code[$i].'~~'.$qty[$i].'~~'.$size[$i].'~~'.$bv[$i].'~~'.$price[$i].'~~'.$gst[$i].'~~'.$tprice[$i].'~~'.$gst_percentage[$i];
							$this->sale_model->update_product_qty($pid[$i],$qty[$i]);
							
							$stock = $this->sale_model->get_all_franchise_stock_id($customer_id[0]['id'],$pid[$i]);
							if(!empty($stock)) {
								$this->sale_model->update_franchise_stock_qty($stock[0]['id'],$qty[$i]);
							} else {
								$data_to_stock = array('user_id'=>$customer_id[0]['id'],'p_id'=>$pid[$i],'qty'=>$qty[$i],'status'=>'Active');
								$this->sale_model->store_franchise_stock($data_to_stock);
							}
							
						}
					//$products_array = array('pname'=>$pname,'qty'=>$qty,'qty_type'=>$qty_type,'qty_box'=>$qty_box,'price'=>$price);
					$products = json_encode($products_array);
					}
					 $iidate = $this->input->post('idate');
					$idate = date('Y-m-d H:i:s',strtotime($iidate));
					$data_store = array(
                    'gtotal' => $this->input->post('gtotal'),
                    'bv' => $total_bv,
                    'products' => $products,
                    'before_tax_amount' => $this->input->post('before_tax_amount'),
                    'discount' => $this->input->post('discount'), 
                    'payment_type' => $this->input->post('payment_type'), 
                    'customer' => $this->input->post('customer'),
                    'total_gst' => $this->input->post('total_gst'),
                    'tdate' => $idate
					); 
                //if the insert has returned true then we show the flash message
				$sale_id = $this->sale_model->store_sale($data_store);
				
				if(!empty($sale_id)){
				$this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/sale/franchise_stock');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
		 }

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data
 
        //load the view
        $data['tax'] = $this->sale_model->get_all_tax();
        $data['main_content'] = 'admin/franchise_stock'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
   public function lavel_distribution($parent_customer_id,$customer,$customer_rank,$sale_id,$grant_total){
	   
	   	$customer_id = $this->sale_model->my_parent($parent_customer_id);
		
		if($customer_rank=='3' && $customer_id[0]['p_rank']=='3' && $customer_id[0]['rank']=='3' ){ }
else{	
	   if($parent_customer_id != '' && $customer_id[0]['p_customer_id']!='') { 
	   
	    if($customer_id[0]['p_rank'] > $customer_rank) {
			$current_rank = $customer_id[0]['p_rank'] - $customer_id[0]['rank'];
			if($current_rank=='1') {
				$distribution_amount = (10 * $grant_total) / 100;
				$distribution_data = array(
				  'user_id'=> $customer_id[0]['p_customer_id'],
				  'amount'=> $distribution_amount,
				  'user_id_send_by'=> $customer,
				  'pay_level'=> '2',
				  'status'=>'active',
				  'order_id'=> $sale_id,
				  'rank'=> $customer_id[0]['p_rank']
				);
				$this->sale_model->store_distribution_amount($distribution_data);
				$this->sale_model->update_customer_distribution_amount($distribution_amount,$customer_id[0]['p_customer_id']);
			}
		}
	    
			  }
   }
  }
 
  
  
  
  public function update(){  
	  	
	 
	  //sale id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
             $this->form_validation->set_rules('user_id', 'User id', 'required|trim');
			$this->form_validation->set_rules('amount', 'amount', 'required');
			
			$this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
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

       
        $data['sale'] = $this->sale_model->get_all_sale_id($id); 
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