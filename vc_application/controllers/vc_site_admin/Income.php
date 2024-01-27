<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Income extends CI_Controller {
	private $current_cust_id; private $all_indirect_user = 0;
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->model('checkout_model');	

    }
	
  public function index() {
       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
	  
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'income';
                $data['page_title'] = 'Income';  
  
         $data['myfriends'] = array();
         $data['showlevel'] = 'false';
		 $id = $this->session->userdata('cust_id');
		 $income = '';
	     $customer_id = $this->session->userdata('bliss_id');
			
			
			//$data['customer'] = $this->Users_model->get_by_date($sdate,$edate);
			$data['profile'] = $this->Users_model->profile($id);
		if($this->input->server('REQUEST_METHOD') === 'POST'){
    	     $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		     $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate')));
    	}  
		else {
    	     $sdate = date('Y-m-1 00:00:01');
		     $edate = date('Y-m-t 23:59:59');
    	} 
			$url = $this->uri->segment(3);
		if($url=='Direct-Sales-Incentive') {
			$where_query['a.type'] = 'Direct Sales Incentive'; $data['page_title'] = 'Direct Sales Incentive'; 
			
			$data['income'] = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate); 
		}
		elseif($url=='Team-Sales-Incentive') {
			$where_query['a.type'] = 'Team Sales Incentive'; $data['page_title'] = 'Team Sales Incentive'; 
			
			$data['income'] = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate); 
		}
		elseif($url=='Team-Performance-Share') {
			$where_query['a.type'] = 'Team Performance Share'; $data['page_title'] = 'Team Performance Share'; 
			
			$data['income'] = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate); 
		}  
		elseif($url=='Self-Sales-Incentive') {
			$where_query['a.type'] = 'Self Income'; $data['page_title'] = 'Self Sales Incentive'; 
			
			$data['income'] = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate); 
		}  
		
		elseif($url=='Repurchase-Income') {
			$where_query['a.type'] = 'Repurchase Incentive'; $data['page_title'] = 'Repurchase Incentive';  $data['showlevel'] = 'true';
			
			$data['income'] = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate); 
		} 
		elseif($url=='Health-Care-Allowance') {
			//$income = array();
			$where_query['a.type'] = 'Health Care Fund'; $data['page_title'] = 'Health Care Allowance';  $data['showlevel'] = 'true';
			$where_as['type'] = 'Health Care Fund';
			$income_fund = $this->Users_model->get_active_incomes($id,$where_query,$sdate,$edate);
			
			if(!empty($income_fund)){
				foreach($income_fund as $incomes) {
					$last_thirsday_fund = date('Y-m-d',strtotime("last thursday",strtotime($incomes['r_date'])));
					$weekly_lbv_sold = $this->Users_model->get_fund_log_by_date($last_thirsday_fund,$where_as);
					$weekly_lbv = $weekly_lbv_sold[0]['fund']/100;
				$description = explode('-~-',$weekly_lbv_sold[0]['description']);
					$income[] = array(
					'id' => $incomes['id'],
					'user_id' => $incomes['user_id'],
					'customer_id' => $incomes['customer_id'],
					'f_name' => $incomes['f_name'],
					'l_name' => $incomes['l_name'],
					'amount' => $incomes['amount'],
					'user_send_by' => $incomes['user_send_by'],
					'r_date' => $incomes['r_date'],
					'fund' => $weekly_lbv,
					'total_user' => $description[1]
					
					);
					
				}
				}
			
			//$dte['weekly_lbv_sold'] = $this->Users_model->get_fund_log_by_date($date);
			$data['income'] = $income; 
		} 
		elseif($url=='Education-Allowance') {
			$where_query['a.type'] = 'Education Fund'; $data['page_title'] = 'Education Allowance'; 
			
			$where_as['type'] = 'Education Fund';
			$income_fund = $this->Users_model->get_active_incomes($id,$where_query);
			
			if(!empty($income_fund)){
				foreach($income_fund as $incomes) {
					$last_thirsday_fund = date('Y-m-d',strtotime("last thursday",strtotime($incomes['r_date'])));
					$weekly_lbv_sold = $this->Users_model->get_fund_log_by_date($last_thirsday_fund,$where_as);
					$weekly_lbv = $weekly_lbv_sold[0]['fund']/100;
				$description = explode('-~-',$weekly_lbv_sold[0]['description']);
					$income[] = array(
					'id' => $incomes['id'],
					'user_id' => $incomes['user_id'],
					'customer_id' => $incomes['customer_id'],
					'f_name' => $incomes['f_name'],
					'l_name' => $incomes['l_name'],
					'amount' => $incomes['amount'],
					'user_send_by' => $incomes['user_send_by'],
					'r_date' => $incomes['r_date'],
					'fund' => $weekly_lbv,
					'total_user' => $description[1]
					
					);
					
						
				
				}
				
			} $data['income'] = $income;
		} 
		elseif($url=='Travel-Allowance') {
			$where_query['a.type'] = 'Travel Fund'; $data['page_title'] = 'Travel Allowance'; 
			
				$where_as['type'] = 'Travel Fund';
			$income_fund = $this->Users_model->get_active_incomes($id,$where_query);
			
			if(!empty($income_fund)){
				foreach($income_fund as $incomes) {
					$last_thirsday_fund = date('Y-m-d',strtotime("last thursday",strtotime($incomes['r_date'])));
					$weekly_lbv_sold = $this->Users_model->get_fund_log_by_date($last_thirsday_fund,$where_as);
					$weekly_lbv = $weekly_lbv_sold[0]['fund']/100;
				$description = explode('-~-',$weekly_lbv_sold[0]['description']);
					$income[] = array(
					'id' => $incomes['id'],
					'user_id' => $incomes['user_id'],
					'customer_id' => $incomes['customer_id'],
					'f_name' => $incomes['f_name'],
					'l_name' => $incomes['l_name'],
					'amount' => $incomes['amount'],
					'user_send_by' => $incomes['user_send_by'],
					'r_date' => $incomes['r_date'],
					'fund' => $weekly_lbv,
					'total_user' => $description[1]
					
					);
					
					}	
				
				
				
			} 
			$data['income'] = $income;
		}  
		
		
		
		elseif($url=='Entertainment-Allowance') {
			$where_query['a.type'] = 'Entertainment Fund'; $data['page_title'] = 'Entertainment Allowance'; 
			
			$where_as['type'] = 'Entertainment Fund';
			$income_fund = $this->Users_model->get_active_incomes($id,$where_query);
			
			if(!empty($income_fund)){
				foreach($income_fund as $incomes) {
					$last_thirsday_fund = date('Y-m-d',strtotime("last thursday",strtotime($incomes['r_date'])));
					$weekly_lbv_sold = $this->Users_model->get_fund_log_by_date($last_thirsday_fund,$where_as);
					$weekly_lbv = $weekly_lbv_sold[0]['fund']/100;
				$description = explode('-~-',$weekly_lbv_sold[0]['description']);
					$income[] = array(
					'id' => $incomes['id'],
					'user_id' => $incomes['user_id'],
					'customer_id' => $incomes['customer_id'],
					'f_name' => $incomes['f_name'],
					'l_name' => $incomes['l_name'],
					'amount' => $incomes['amount'],
					'user_send_by' => $incomes['user_send_by'],
					'r_date' => $incomes['r_date'],
					'fund' => $weekly_lbv,
					'total_user' => $description[1]
					
					);
					
						
				
				}
				
			} 
			$data['income'] = $income;
		}  
		else { $data['income'] = ''; }
		
	   
		//$data['bliss_amount'] = $this->Users_model->my_bliss_amount($id);
		//$data['redeem_amount'] = $this->Users_model->bliss_perk_redeem_amount($id);
		//$data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);

		$data['redeem_error'] = '';
	 
		 
		$data['main_content'] = 'admin/income';
        $this->load->view('includes/admin/template', $data); 
  }
  
  function goDownALevelDirect($customerid){ 
	 $return = array();
	 $children = $this->Users_model->my_friends($customerid); //underlying SQL function
	 if(!empty($children)){ 
	  foreach($children as $child){
		if($this->current_cust_id!=$child['direct_customer_id']) {
		   $this->all_indirect_user = $this->all_indirect_user + 1;
		 } 
		$this->goDownALevelDirect($child['customer_id']);
	  } 
	 } 
		 return $return;
	}
	
 
 
 
 public function transfer_fund() {
	 

       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
	  
		$data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'income';
        $data['page_title'] = 'Working Wallet';  
  
		$id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
	     if ($this->input->server('REQUEST_METHOD') === 'POST') {
		  
		   $this->form_validation->set_rules('amount', 'amount', 'required');
		   $this->form_validation->set_rules('member_id', 'member_id', 'required');		 
		  // $this->form_validation->set_rules('transaction', 'Transaction Code', 'required');
		
		  if($this->input->post('amount') > $data['profile'][0]['bliss_amount']) {
			   $this->form_validation->set_rules('hsfdgsd', 'Your Wallet have less Amount', 'required');
			    $this->form_validation->set_message('required', 'Your Wallet have less Amount');  
		   } /*elseif($data['profile'][0]['tr_pin'] != md5($this->input->post('transaction'))) {		
		   $this->form_validation->set_rules('hsfdgsd', 'Wrong Transaction code', 'required');	
		   $this->form_validation->set_message('required', 'Wrong Transaction code'); 	
		   }*/
		    $send_to = $this->Users_model->parent_profile($this->input->post('member_id'));
			if(empty($send_to)) {  
				
				$this->form_validation->set_rules('hsfdgsd', 'Incorrect Member ID.', 'required');
				 $this->form_validation->set_message('required', 'User Not Exist'); 
				
			} elseif($send_to[0]['id']== $id) {
				$this->form_validation->set_rules('hsfdgsd', 'Incorrect Member ID.', 'required');
				 $this->form_validation->set_message('required', 'You can not Transfer Fund to Own'); 
			}
		  $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
		   if ($this->form_validation->run())
            { 
			
			$amount =	$this->input->post('amount');
			$member_id = $this->input->post('member_id');
			$password =	$this->input->post('password');
			

		$data_to_store = array(
		'userid' => $customer_id,
		'send_to' => $send_to[0]['customer_id'],
		'send_by' => $customer_id,
		'type' => 'Transfered',
		'amount' => $amount,
		'status' => 'Debit' 
		);
		$this->Users_model->add_transactional_wallet($data_to_store);
		$data_to = array(
		'userid' => $send_to[0]['customer_id'],
		'send_to' => $send_to[0]['customer_id'],
		'send_by' => $customer_id,
		'type' => 'Transfered',
		'amount' => $amount,
		'status' => 'Credit'
		);
		$this->Users_model->add_transactional_wallet($data_to);
		$this->Users_model->update_wallet($id,$amount,'bliss_amount');
		$this->Users_model->substract_wallet($send_to[0]['id'],$amount,'bliss_amount');
		 $this->session->set_flashdata('flash_message', 'updated'); 
					redirect(base_url().'admin/transfer_fund');
			}
		  
	  }
		 
		$data['main_content'] = 'admin/transfer_fund';
        $this->load->view('includes/admin/template', $data); 
  }
  	
 
 
 
 public function transfer_history() {
       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
	  // $this->distribute_monthly_income();
		$data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Transfer History';
        $data['page_title'] = 'Transfer History';  
  
        $id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		$data['transaction_wallet'] = $this->Users_model->transaction_wallet($customer_id);
		
		$data['main_content'] = 'admin/transfer_history';
        $this->load->view('includes/admin/template', $data); 
  }
  
 
 public function Payment_request() {
       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
	  // $this->distribute_monthly_income();
		$data['page_keywords'] = '';
        $data['page_description'] = '';
        $data['page_slug'] = 'Payment request';
        $data['page_title'] = 'Payment request';  
  
        $id = $this->session->userdata('cust_id');
	    $customer_id = $this->session->userdata('bliss_id');
		$data['profile'] = $this->Users_model->profile($id);
		$data['bliss_perk_history'] = $this->Users_model->bliss_perk_history($id);
		$data['bliss_perk'] = $this->Users_model->bliss_request($id);
		

    	    $type = 'income_wallet';
    	    $data['wallet_amount'] = $data['profile'][0]['income_wallet'];
    		if ($this->input->server('REQUEST_METHOD') == TRUE && $this->input->post('type')!='') {
    		   echo  $type = $this->input->post('type'); 
    		    $data['wallet_amount'] = $data['profile'][0][$type]; 
    		   
    		}
    	
    	
    			if ($this->input->server('REQUEST_METHOD') && $this->input->post('redeem_bliss')!='') {
            /*form validation*/
			
			$profile = $this->Users_model->profile($id);
			
           $this->form_validation->set_rules('balance', 'balance', 'required|trim');
           $this->form_validation->set_rules('redeem', 'redeem', 'required|trim');
           

           if($data['profile'][0]['income_wallet'] < $this->input->post('redeem')) {
              $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required', 'Your redeem maximum Amount is '.$data['profile'][0]['income_wallet']);
           }
          
           elseif($this->input->post('redeem') <=0 ) {
              $this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required','Your redeem minimum Amount is 0.');
           }/*
           elseif(!empty($data['bliss_perk'])) {
           		$this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required','You Already Redeem Your Amount for today.');
           }*/
           elseif($data['profile'][0]['consume']==0)  {
           		$this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required','Please Activate your id first.');
           }
           elseif($data['profile'][0]['var_status']!='yes')  {
           		$this->form_validation->set_rules('balance_limit', 'redeem', 'required|trim');
              $this->form_validation->set_message('required','Please update your KYC.');
           }
          
		   
		
		   
		   /*if($data['profile'][0]['var_status']=='no') { 
               $this->form_validation->set_rules('profile_com','profile_com','required|trim');
              $this->form_validation->set_message('required', 'Your profile is under review please wait 2 working days');
          }*/

			$data['redeem_error'] = 'show';
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run()) {  
               $balance = $data['profile'][0]['income_wallet'] - $this->input->post('redeem');
               $redeem = $this->input->post('redeem');
               $after_tds = (90/100)*$redeem;
                $data_to_store = array(
                    'balance' => $balance,
                    'redeem' => $redeem,
                    'after_tds' => $after_tds,
					'my_bliss_req' => 'Wallet',
                    'user_id' => $id,
                    'rdate'=>date('Y-m-d H:i:s')
				); 
             $return = $this->Users_model->redeem_bliss_request($data_to_store);
             
            
			
		
                if($return == TRUE){
                     $this->Users_model->update_wallet($id,$this->input->post('redeem'),$type);
                    $this->session->set_flashdata('flash_message', 'updated');
		    redirect(base_url().'admin/Payment_request');
                } else {
                    $this->session->set_flashdata('flash_message', 'redeem_error');
                } 
            }  

        }
		
		 
		$data['main_content'] = 'admin/Payment_request';
        $this->load->view('includes/admin/template', $data); 
  }
 
  
 
 
 
 
  
}
/*
SELECT d.user_id as duser,r.user_id as ruser,sum(d.amount) as amount, sum(r.dpv) as dpv 
FROM  distribution_amount as d   
FULL OUTER JOIN  rpv_dpv as r 
ON d.user_id=r.user_id GROUP BY r.user_id

SELECT d.user_id as duser,r.user_id as ruser,sum(d.amount) as amount, sum(r.dpv) as dpv FROM  distribution_amount as d  
LEFT JOIN rpv_dpv as r  ON d.user_id=r.user_id
UNION
SELECT * FROM t1
RIGHT JOIN t2 ON t1.id = t2.id
*/