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
     
    public function get_all_sale()
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('pin_bill',0);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	public function get_all_pin_sale()
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('pin_bill',1);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_prodcut_sale($id='')
    {
		$this->db->select('*');
		$this->db->from('product_sale');
		if($id!='') { $this->db->where('id',$id); }
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_sale_id($id)
    {
		$this->db->select('*');
		$this->db->from('total_sale');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 public function get_all_franchise_stock_id($id,$p_id)
    {
		$this->db->select('*');
		$this->db->from('stock_detail');
		$this->db->where('user_id',$id);
		$this->db->where('p_id',$p_id);
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

    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('product');
		$query = $this->db->get();
		return $query->result_array(); 
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
      function store_product_sale($data)
    {
		$insert = $this->db->insert('product_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	
	  function store_franchise_stock($data)
    {
		$insert = $this->db->insert('stock_detail', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
    function store_sale($data)
    {
		$insert = $this->db->insert('total_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
    function store_distribution_amount($data)
    {
		$insert = $this->db->insert('distribution_amount', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
   function update_customer_distribution_amount($amount,$customer){
    $this->db->query("update customer set bliss_amount = bliss_amount + ".$amount." where customer_id='".$customer."'");
   }

    /**
    * Update sale
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_table($id, $data,$table)
    {
		$this->db->where('id', $id);
		$this->db->update($table, $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	
    function update_sale($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('orders', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	public function update_prodcut_qty($id,$qty){
	$sql = "UPDATE `product` SET `p_qty`= p_qty - $qty WHERE id ='$id'";
	 //$this->db->where('id', $id);
	     $this->db->query($sql);	
            return TRUE;
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
	function delete_prodcut_sale($id){
		$this->db->where('id', $id);
		$this->db->delete('product_sale'); 
	}
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
  
 
	
	public function update_product_qty($id,$qty) {
       $this->db->query("update product set p_qty = p_qty - ".$qty." where id='".$id."'");
  }
  
  
  public function update_franchise_stock_qty($id,$qty) { 
       $this->db->query("update stock_detail set qty = qty + ".$qty." where id='".$id."'");
  }

	public function add_distribution_amount($amount,$userid,$level,$order_id){
         $admin_db = $this->load->database('ADMINDB', TRUE);
		$cust_id = $this->session->userdata('cust_id');
		$insert_data = array(
				'user_id' => $userid,
				'amount' => $amount,
				'user_id_send_by' => $cust_id,
				'pay_level' => $level,
				'order_id' => $order_id,
				'status' => 'Pending'
			); 
		$admin_db->insert('distribution_amount', $insert_data); 
	}

   public function parent_bliss($id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
                //$this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
	public function parent_bliss_result($parent_customer_id){
	   $this->db->select('c.id,c.parent_customer_id,c.rank,cj.id as pid');
		$this->db->from('customer as c');
                $this->db->join('customer as cj', 'c.parent_customer_id = cj.customer_id', 'left'); 
		$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }

	function my_friends($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_parent($cust_id){
	   $this->db->select('c1.id,c1.f_name,c1.l_name,c1.customer_id,c1.rank, c2.rank as p_rank, c2.id as p_id,c2.customer_id as p_customer_id');
		$this->db->from('customer c1');
                $this->db->join('customer c2', 'c1.parent_customer_id = c2.customer_id','left');
		$this->db->where('c1.customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function get_customer_package($cust_id){
	   $this->db->select('id,parent_customer_id,customer_id,package');
		$this->db->from('customer'); 
		$this->db->where('customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	function distribution_by_rank($cust_id,$rank){
	   $this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$cust_id);
		$this->db->where('rank',$rank);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function all_daily_weakly_in($sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.rdate >=',$sdate);
	$this->db->where('i.rdate <=',$edate);  
	//$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
 function daily_weakly_in_by_table($table,$sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from($table.' as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.c_date >=',$sdate);
	$this->db->where('i.c_date <=',$edate);  
	//$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
	function daily_weakly_in($sdate,$edate){
	$this->db->select('i.*,c.f_name,c.l_name,c.customer_id,c1.f_name as df_name,c1.l_name as dl_name,c1.customer_id as dcustomer_id');
	$this->db->from('incomes as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->join('customer as c1','c1.customer_id=c.direct_customer_id','left');
	$this->db->where('i.rdate >=',$sdate);
	$this->db->where('i.rdate <=',$edate);  
	$this->db->where('i.status','Active');
	$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
 }
 
  public function cut_off_report($sdate,$edate){ 
    $this->db->select('i.*,c.f_name,c.l_name,c.customer_id');
	$this->db->from('distribution_amount as i');
	$this->db->join('customer as c','c.id=i.user_id','left');
	$this->db->where('i.pay_date >=',$sdate);
	$this->db->where('i.pay_date <=',$edate);  
	$this->db->where('i.status','Cutoff');
	//$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
  }
  public function daily_weakly_pin($sdate,$edate,$pin=''){
      $this->db->select('i.*,c.f_name,c.l_name,c.customer_id');
	$this->db->from('pins as i');
	$this->db->join('customer as c','c.customer_id=i.used_by','left');
	$this->db->where('i.used_on >=',$sdate);
	$this->db->where('i.used_on <=',$edate);  
	$this->db->where('i.status','Used'); 
	//if($pin=='pin') { $this->db->where('i.p_amount <',29999); }
	if($pin=='pin') { $this->db->where_in('i.p_amount',array(1500,3000)); $this->db->where('i.re_purchase','0'); }
	if($pin=='repin') { $this->db->where_in('i.p_amount',array(750,1500,2250,3750,7500)); $this->db->where('i.re_purchase','1'); }
	if($pin=='franchise') { $this->db->where('i.p_amount >',29999); }
	
	//$this->db->order_by('i.user_id','asc');
	$query=$this->db->get();
	return $query->result_array(); 
      
  }
}
?>