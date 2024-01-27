<?php 
class Sale_model extends CI_Model {
 
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
    * Get sale by his is
    * @param int $sale_id 
    * @return array
    */
	
	public function get_all_pin_sale($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('customer',$id);
		$this->db->where('pin_bill',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    	public function get_all_wallet_history($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('credit_debit');
		$this->db->where('user_id',$id);
	    $this->db->where('receive_date >=',$sdate);
		$this->db->where('receive_date <=',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    	public function get_all_repurchase_wallet_history($id,$sdate,$edate)
    {
		$this->db->select('*');
		$this->db->from('repurchase_wallet');
		$this->db->where('user_id',$id);
	    $this->db->where('receive_date >=',$sdate);
		$this->db->where('receive_date <=',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
    public function add_income($data){ 
		$this->db->insert('incomes', $data); 
	}
	
	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	

	
		function profile_by_id($id){
		$this->db->select('c.*,m.id as did');
		$this->db->from('customer as c');
		$this->db->join('customer as m', 'c.direct_customer_id = m.customer_id');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
    public function get_all_sale($id)
    {
		$this->db->select('t.*,m.city');
		$this->db->from('total_sale as t');
		$this->db->join('customer as m', 'm.id = t.center_id');				$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    public function get_all_merchant_sale($id)
    {
		$this->db->select('t.*,m.city');
		$this->db->from('total_sale as t');
		$this->db->join('customer as m', 'm.id = t.center_id');
		$this->db->where('t.center_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
    
    
    
    
	    public function get_center_detail($id)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 

	public function get_all_sale1($id)
    {
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_sale_id($id,$uid)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('customer',$uid);
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	 
public function get_customer_info($id)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    public function get_all_product($id)
    {
		$this->db->select('s.*,p.*');
		$this->db->from('stock_detail as s');
		$this->db->join('product as p','p.id=s.p_id','left');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_sale($data)
    {
		$insert = $this->db->insert('total_sale', $data);
	    return $insert;
	}

    /**
    * Update sale
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_sale($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete sale
    * @param int $id - sale id
    * @return boolean
    */
	
	
	function delete_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('orders'); 
	}
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	   public function update_product_qty($id,$qty) {
       $this->db->query("update product set qty = qty - ".$qty." where id='".$id."'");
	   
	   }
	    public function update_stock_qty($id,$p_id,$qty) {
       $this->db->query("update stock_detail set qty = qty - ".$qty." where p_id='".$p_id."' AND user_id='".$id."'");
  }

}
?>