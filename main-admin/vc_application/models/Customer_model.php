<?php 
class Customer_model extends CI_Model {
 
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
    function transaction_wallet($sdate,$edate){		
	$this->db->select('w.*,c.f_name');		
	$this->db->from('transaction_wallet as w');
	$this->db->join('customer as c','c.customer_id = w.send_to','left');	
	$this->db->where('w.send_by','Admin');		
	$this->db->where('w.rdate >=',$sdate);		
	$this->db->where('w.rdate <=',$edate); 		
	$this->db->order_by('w.id','desc'); 		
	$query = $this->db->get();		
	return $query->result_array();  
	}
    public function get_all_customer($sdate,$edate)
    {
		$this->db->select('c.*,SUM(i.amount) as shelf');
		$this->db->from('customer as c'); 
		$this->db->join('income as i','i.user_id = c.id AND i.status="Active"','left');
		$this->db->where('c.rdate >=',$sdate);
		$this->db->where('c.rdate <=',$edate);
		$this->db->group_by('c.id');
		$query = $this->db->get();
		return $query->result_array();  
    }
  function store_myschlorship($data)
    {
		$insert = $this->db->insert('myschlorship', $data);
	    return $insert;
	}
        
        function update_manual($table,$where,$data){
		$this->db->where($where);
		$this->db->update($table, $data); 
		return TRUE; 
		
	}
   /* public function get_all_wallet_history($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('credit_debit');
		$this->db->where('user_id',$id);
	    $this->db->where('receive_date >=',$sdate);
		$this->db->where('receive_date <=',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }*/
    function add_transactional_wallet($data)    {		
	$insert = $this->db->insert('transaction_wallet', $data);	    
	$insert_id = $this->db->insert_id();	    
	return $insert_id;	
	}
	function get_sale_by_date() {
	 	 $this->db->select('SUM(gtotal) as amount,SUM(total_cost) as total_cost');
		$this->db->from('total_sale');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function get_oder_by_date() {
	 	 $this->db->select('SUM(total_amount) as amount');
		$this->db->from('orders');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function individaul_list() {
	 	 $this->db->select('*');
		$this->db->from(' individual');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	
	function corporation_list() {
	 	 $this->db->select('*');
		$this->db->from('corporation');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function team_list() {
	 	 $this->db->select('*');
		$this->db->from('contact');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function contact_list() {
	 	 $this->db->select('*');
		$this->db->from('contact_us');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_all_wallet_history() {
	 	 $this->db->select('SUM(amount) as amount');
		$this->db->from('transaction_wallet');
		$this->db->where('send_by','Admin');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	 public function get_order_data() {
    	$this->db->select('COUNT(id) as count,status,new,SUM(total_amount) as total_amount,SUM(total_cost) as total_cost');
    	$this->db->from('orders');
    	$this->db->group_by('status');
    	$query=$this->db->get();
    	//return $query->num_rows();
    	return $query->result_array(); 
    }
    
    	public function get_new_order_data() {
    	$this->db->select('new');
    	$this->db->from('orders');
        $this->db->where('new','1');
    	$query=$this->db->get();
    	return $query->num_rows();
    }
    
    	public function get_new_walletadd_data() {
    	$this->db->select('noti');
    	$this->db->from('pin_request');
        $this->db->where('noti','1');
    	$query=$this->db->get();
    	return $query->num_rows();
    }
    
	 public function get_amount_data() {
    	$this->db->select('SUM(total_amount)as amount');
    	$this->db->from('orders');
    	
    	$query=$this->db->get();
    	return $query->result_array();
    }
	
	
	 public function get_bliss_data() {
    	$this->db->select('SUM(bliss_amount) as amount');
    	$this->db->from('customer');
    	$query=$this->db->get();
    	return $query->result_array();
    }
	
	public function get_business_order() {
    	$this->db->select('SUM(bv) as amount,SUM(comm_dis) as pv');
    	$this->db->from('orders');
    	$query=$this->db->get();
    	return $query->result_array();
    }
    public function get_business_sale() {
    	$this->db->select('SUM(bv) as amount,SUM(pv) as pv');
    	$this->db->from('total_sale');
    	
    	$query=$this->db->get();
    	return $query->result_array();
    }
    public function get_shelf_income() {
    	$this->db->select('SUM(amount) as amount');
    	$this->db->from('income');
    	$this->db->where('status','Active');
    	$query=$this->db->get();
    	return $query->result_array();
    }
	
	 public function get_redeem_data() {
    	$this->db->select('SUM(redeem) as amount');
    	$this->db->from('redeem_bliss');
    	$this->db->where('redeem_status','approved');
    	$query=$this->db->get();
    	return $query->result_array();
    }
	
	 public function get_o_data() {
    	$this->db->select('SUM(total_amount) as amount');
    	$this->db->from('orders');
    	$query=$this->db->get();
    	return $query->result_array();
    }
	
	
	 public function get_customer_data() {
    	$this->db->select('*');
    	$this->db->from('customer');
    	$query=$this->db->get();
    	return $query->num_rows();
    }
    
     public function get_customer_docveri() {
    	$this->db->select('var_status');
    	$this->db->from('customer');
    	$this->db->where('var_status','no');
    	$query=$this->db->get();
    	return $query->num_rows();
    }
    
    	 public function get_new_customer_data() {
    	$this->db->select('new');
    	$this->db->from('customer');
    	$this->db->where('new','1');
    	$query=$this->db->get();
    	return $query->num_rows();
    }
	    public function get_all_customer1($id)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_customer_id($id)
    {
		// $this->db = $this->load->database('CUSTDB', TRUE);
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_customer($data)
    {
		$insert = $this->db->insert('customer', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_customer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	 function update_reply($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('scholarship', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	
	
	
	

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	 public function get_all_pin_request_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('pin_request');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 function update_pin_request($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('pin_request', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	function get_pin_request_by_date($sdate,$edate) {
	 	 $this->db->select('*');
		//$this->db->select('*');
		$this->db->from('pin_request');
	//	$this->db->join('pins','pins.used_by = c.customer_id','left');
		$this->db->where('date >=',$sdate);
		$this->db->where('date <=',$edate); 
		//$this->db->order_by('c.id','desc'); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
		function get_feedback_by_date($sdate,$edate) {
	 	 $this->db->select('*');
		$this->db->from('grievance');
		$this->db->where('date >=',$sdate);
		$this->db->where('date <=',$edate); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	 function update_grievance($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('grievance', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 public function get_all_feedback_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('grievance');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	
	function delete_customer($id){
		$this->db->where('id', $id);
		$this->db->delete('customer'); 
	}
	
		function delete_individual($id){
		$this->db->where('id', $id);
		$this->db->delete('individual'); 
	}
	function corporation_del($id){
		$this->db->where('id', $id);
		$this->db->delete('corporation'); 
	}
	
	
	function team_del($id){
		$this->db->where('id', $id);
		$this->db->delete('contact'); 
	}
	function contact_del($id){
		$this->db->where('id', $id);
		$this->db->delete('contact_us'); 
	}
	
	
	
	
	
	
	
	function checkuserid($data)
    {
		$this->db->select('customer_id,bliss_amount');
		$this->db->from('customer');
		$this->db->where('phone', $data);
		$query = $this->db->get();
        return $query->result_array(); 
	
	}
	
	function checkuserids($data)
    {
		$this->db->select('customer_id');
		$this->db->from('customer');
		$this->db->where('customer_id', $data);
		$query = $this->db->get();
        return $query->result_array(); 
	
	}
	
	
	
	function wallet_update_customer($id, $data)
    {
		$this->db->where('phone', $id);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	function add_combo($data)
    {
		$insert = $this->db->insert('combo', $data);
		return true;
	
}


function add_college($data)
    {
		$insert = $this->db->insert('college_update', $data);
		return true;
	
}

	function get_reward_by_date($sdate,$edate) {
	  $this->db->select('r.*,c.customer_id,c.f_name,c.l_name,c.phone,c.email,c.direct_customer_id,c.rdate');
	  $this->db->from('reward as r');
	  $this->db->join('customer as c', 'c.id = r.user_id', 'left'); 
	  $this->db->where('r.c_date >=',$sdate);
	  $this->db->where('r.c_date <=',$edate); 
	  $this->db->order_by('r.id','desc'); 
	  $query = $this->db->get();
	  return $query->result_array(); 
	}
	
	
	
	function update_reward($id, $data)
    {
	$this->db->where('id', $id);
	$this->db->update('reward', $data);		
                
	}
	
	
	
	function get_myschlorship_list()
    {
		$this->db->select('*');
		$this->db->from('myschlorship');
		//$this->db->where('type', $data);
		$query = $this->db->get();
        return $query->result_array(); 
	
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function update_myschlorship($id, $data)
    {
		
		$this->db->where('id', $id);
		$this->db->update('myschlorship', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
	
	public function get_all_schlorship_id($id)
    {
		
		$this->db->select('*');
		$this->db->from('myschlorship'); 
		$this->db->where('id',$id);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	
	function delete_myschlorship($id){
		$this->db->where('id', $id);
		$this->db->delete('myschlorship'); 
	}
	
	function get_s_reply() {
	  $this->db->select('f.*,s.f_name,s.l_name,s.phone,s.email,s.pin_code,s.state,s.city,s.occupation,s.income,s.category,s.abled,s.orphan,s.status');
	  $this->db->from('form_reply as f');
	  $this->db->join('scholarship as s', 's.id = f.s_id', 'left'); 
	   
	  $query = $this->db->get();
	  return $query->result_array(); 
	}
	
	
	function get_s_view($id) {
	  $this->db->select('f.*,s.f_name');
	  $this->db->from('form_reply as f');
	  $this->db->join('scholarship as s','s.id = f.s_id', 'left'); 
	   $this->db->where('s.id', $id);
	  $query = $this->db->get();
	  return $query->result_array(); 
	}
	function get_all_reply_id($id) {
	  $this->db->select('s.*,f.message');
	  $this->db->from('scholarship as s');
	  $this->db->join('form_reply as f','s.id = f.s_id', 'left'); 
	   $this->db->where('f.s_id', $id);
	  $query = $this->db->get();
	  return $query->result_array(); 
	}
	
	}
?>