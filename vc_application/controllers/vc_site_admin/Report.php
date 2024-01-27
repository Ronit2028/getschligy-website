<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Report extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
         $this->load->model('Users_model');
         $this->load->model('Report_model');

       if(!$this->session->userdata('is_customer_logged_in')){  redirect(base_url().'');	  }
       
    }
	
  public function index() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'grievance';
                $data['page_title'] = 'Grievance Status';  
  
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['feedback'] = $this->Report_model->get_all_feedback($customer_id);
		$data['profile'] = $this->Users_model->profile($id);
		$data['main_content'] = 'admin/report_feedback';
        $this->load->view('includes/admin/template', $data); 
  }
   public function complaint() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'cashback';
                $data['page_title'] = 'cashback';  
  
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['feedback'] = $this->Report_model->get_all_complaint($customer_id);
		$data['profile'] = $this->Users_model->profile($id);
		$data['main_content'] = 'admin/report_complaint';
        $this->load->view('includes/admin/template', $data); 
  }
   public function contact() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'cashback';
                $data['page_title'] = 'cashback';  
  
		$id = $this->session->userdata('cust_id');
	        $customer_id = $this->session->userdata('bliss_id');
		$data['feedback'] = $this->Report_model->get_all_contact($customer_id);
		$data['profile'] = $this->Users_model->profile($id);
		$data['main_content'] = 'admin/report_contact';
        $this->load->view('includes/admin/template', $data); 
  }
   public function bank_withdrawal() {
		 $data['page_keywords'] = '';
                $data['page_description'] = '';
                $data['page_slug'] = 'bank_withdrawal';
                $data['page_title'] = 'bank_withdrawal';  
  
		$id = $this->session->userdata('cust_id');
	   $customer_id = $this->session->userdata('bliss_id');
	        
		$data['profile'] = $this->Users_model->profile($id);
		
		if ($this->input->server('REQUEST_METHOD') === 'POST') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
		$data['payouts'] = $this->Users_model->get_payout_by_date($id,$sdate, $edate); 
		
		$data['main_content'] = 'admin/bank_withdrawal';
        $this->load->view('includes/admin/template', $data); 
  }

  
    
  public function generatecsv(){
      //https://www.adwinhouse.com/main-admin/index.php/vc_site_admin/pin/generatecsv
       if ($this->input->server('REQUEST_METHOD') === 'POST' && $this->input->post('sdate')!='' && $this->input->post('edate')!='') {
		       $sdate = date('Y-m-d 00:00:01',strtotime($this->input->post('sdate')));
		       $edate = date('Y-m-d 23:59:59',strtotime($this->input->post('edate'))); 
        } else {
            $sdate = date('Y-m-01 00:00:01');
		    $edate = date('Y-m-t 23:59:59'); 
        }
	 
	$id = $this->session->userdata('cust_id');
	 $filename = 'users_'.date('YmdHis').'.csv'; 
   header("Content-Description: File Transfer"); 
   header("Content-Disposition: attachment; filename=$filename"); 
   header("Content-Type: application/csv; ");
   
   // file creation 
   $file = fopen('php://output', 'w');
 
   $header = array("S. No.User","Amount","Bank","Bank A/c No","IFSC","PAN No.","Date"); 
   fputcsv($file, $header);
   	$payouts = $this->Users_model->get_payout_by_date($id,$sdate, $edate);
   	if(!empty($payouts)) {
		$i = 1; 
       foreach ($payouts as $key=>$line){ 
	   $tax = ($line['amount']*10)/100;
	$tdss = $tax/2;
	   $payble = $line['amount'] - $tax;
	     $csv_val = array($line['f_name'].' '.$line['l_name'].' ('.$line['customer_id'].')',$payble,$line['bank_name'].'A/C '.$line['branch'],' '.$line['account_no'],$line['ifsc'],$line['pancard'],date('d F Y',strtotime($line['rdate'])));
         fputcsv($file,$csv_val); 
		 $i++;
       }
       fclose($file); 
       exit; 
   	}
	
  }
  	 
  
  
  }


  