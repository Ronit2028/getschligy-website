<?php 
class Coupon_model extends CI_Model {
 
    /**
    * Responsable for auto load the database
    * @return void
    */
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('url');
    }

    /**
    * Get product by his is
    * @param int $product_id 
    * @return array
    */

    function substract_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }

    public function get_all_coupon()
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_coupon1($id)
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_coupon_id($id)
    {
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
	public function get_weekly_total_income($sdate, $edate,$userid)
    {
		$this->db->select('SUM(amount) as amount');
		$this->db->from('income');
		$this->db->where('r_date >=',$sdate);
		$this->db->where('r_date <=',$edate);  
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_monthly_bill($sdate,$userid)
    {
		$this->db->select('SUM(total_amount) as total_order');
		$this->db->from('orders');
		$this->db->where('o_date >=',$sdate);  
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

     public function get_monthly_pinbill($sdate,$userid)
    {
		$this->db->select('SUM(gtotal) as total_order');
		$this->db->from('total_sale');
		$this->db->where('tdate >=',$sdate);  
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	function get_payout_by_date($sdate='',$edate='',$status='') {	 	
		$date = date('Y-m-d',strtotime('first day of previous month')); 
	    $this->db->select('r.id,r.user_id,SUM(r.amount) as total_amount,c.grade,c.id as cid,c.l_name,c.f_name,c.l_name,c.customer_id,c.email,c.phone,c.bank_name,c.account_no,c.ifsc,c.pancard');		
	    $this->db->from('income as r');        
	    $this->db->join('customer as c', 'c.id = r.user_id','left');
	    //$this->db->join('orders as o', '(o.user_id = r.user_id AND o.o_date >= '.$date.') ' ,'left');
	    if($sdate!='') { $this->db->where('r.r_date >=',$sdate); }		
	    if($edate!='') { $this->db->where('r.r_date <=',$edate); }		
	    if($status!='') { $this->db->where('r.status',$status); }	
	    $this->db->group_by('r.user_id');
	    $this->db->order_by('r.id','desc'); 		
	    $query = $this->db->get();		
	    return $query->result_array(); 	
	    
	}

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_coupon($data)
    {
		$insert = $this->db->insert('site_coupon', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_coupon($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('site_coupon', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_coupon($id){
		$this->db->where('id', $id);
		$this->db->delete('site_coupon'); 
	}	


	public function get_all_payout($status='',$sdate='',$edate=''){	    
	    $this->db->select('t.*,c.f_name, c.l_name, c.email, c.customer_id,c.grade, c.phone, c.pancard, c.bank_name, c.account_no, c.ifsc, c.repurchase_date');	
	    $this->db->from('transaction_log as t');        
	    $this->db->join('customer as c', 't.user_id = c.id', 'left'); 		
	    if($status!='') { $this->db->where('t.status',$status); }		
	    if($sdate!='') { $this->db->where('t.tdate >=',$sdate); }		
	    if($edate!='') { $this->db->where('t.tdate <=',$edate); }		
	    $query = $this->db->get();		return $query->result_array(); 	
	}	
	function get_total_income($id) {
         $this->db->select('SUM(amount) as total_amount');		
	$this->db->from('income');      	
	$this->db->where('user_id',$id);		 		
	$query = $this->db->get();		
	return $query->result_array(); 	
        }
	public function add_transactional_log($data){	    
	    $this->db->insert('transaction_log', $data);  	
	    
	} 	
	public function update_transactional_log($user,$data){        
	    $this->db->where('userid', $user);	   
	    $this->db->update('transaction_log', $data);	
	    
	}	
	    public function update_transactional_log_byid($id,$data){        
	        $this->db->where('id', $id);	    
	        $this->db->update('transaction_log', $data);	
	        
	    }	
	    public function add_transfer_pin($data){	    
	        $this->db->insert('pins_transfer', $data); 	
	        
	    }	 
	    function update_income_status($id){     
	        $data = array('status'=>'Process');     
	        $this->db->where('user_id', $id);		
	        $this->db->update('income', $data); 
	        
	    } 
	    function update_income_status_clear($id){     
	        $data = array('status'=>'Clear');     
	        $this->db->where('status', 'Process');     
	        $this->db->where('user_id', $id);		
	        $this->db->update('income', $data); 
	        
	    }  
	    function update_income_status_all_user($users,$week_end){           
	        $data = array('status'=>'Process');             
	        $this->db->where('status', 'Active');             
	        $this->db->where('r_date <=',$week_end);             
	        $this->db->where_in('user_id', $users);	     
	        $this->db->update('income', $data); 
	    }
		
	    function get_all_used_pin($sdate,$edate) {
	 	$this->db->select('orders.*,c.f_name,c.customer_id');
		$this->db->from('orders');
		$this->db->join('customer as c', 'c.id = orders.user_id', 'left'); 
		$this->db->where('orders.o_date >=',$sdate);
		$this->db->where('orders.o_date <=',$edate); 
		$this->db->where('orders.status', 'Delivered'); 
		$this->db->order_by('orders.id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
}
?>