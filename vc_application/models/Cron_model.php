<?php 
class Cron_model extends CI_Model {
 
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
   function get_salary($date){
       $this->db->select('*');
		$this->db->from('salary');
		$this->db->like('pay_date',$date);
		$this->db->where('tday >','0');  
		$query = $this->db->get();
		return $query->result_array(); 
   }
   function get_user_info($id){
       $this->db->select('id,active_child,child_lbv');
		$this->db->from('customer');
		//$this->db->like('pay_date',$date);
		$this->db->where('id',$id);  
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function get_total_income($sdate, $edate)
    {
		$this->db->select('SUM(d.amount) as amt,d.user_id,c.customer_id,p.customer_id as pcustomer_id,p.grade as pgrade, p.active_child as pactive_child, p.id as pid');
		$this->db->from('income as d');
		$this->db->join('customer as c','c.id=d.user_id','left');
		$this->db->join('customer as p','p.customer_id=c.parent_customer_id','left');
		$this->db->where('d.r_date >=',$sdate);
		$this->db->where('d.r_date <=',$edate);  
		$this->db->group_by('d.user_id');
		$this->db->order_by('d.id','asc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_user_total_income($userid)
    {
		$this->db->select('SUM(amount) as amount');
		$this->db->from('income');
		$this->db->where('user_id',$userid);
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
	public function get_weekly_total_income_da($sdate, $edate,$userid)
    {
		$this->db->select('SUM(amount) as amount');
		$this->db->from('distribution_amount');
		$this->db->where('pay_date >=',$sdate);
		$this->db->where('pay_date <=',$edate);  
		$this->db->where('user_id',$userid);
		$query = $this->db->get();
		return $query->result_array(); 
    }
   public function get_total_income_da($sdate, $edate)
    {
		$this->db->select('SUM(d.amount) as amt,d.user_id,c.customer_id,p.customer_id as pcustomer_id, p.grade as pgrade, p.active_child as pactive_child,p.id as pid');
		$this->db->from('distribution_amount as d');
		$this->db->join('customer as c','c.id=d.user_id','left');
		$this->db->join('customer as p','p.customer_id=c.parent_customer_id','left');
		$this->db->where('d.pay_date >=',$sdate);
		$this->db->where('d.pay_date <=',$edate);  
		$this->db->group_by('d.user_id');
		$this->db->order_by('d.id','asc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
    
   	public function get_total_sale($sdate, $edate)
    {
		$this->db->select('SUM(comm_dis) as tot_lbv_amt');
		$this->db->from('orders');
		$this->db->where('o_date >=',$sdate);
		$this->db->where('o_date <=',$edate);
		$this->db->where('repurchase','1');  
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
  public function profile_for_update_rank($customer_id){
	  $this->db->select('id,customer_id,parent_customer_id,bsacode,grade,active_child,child_lbv');
		$this->db->from('customer');
		$this->db->where('customer_id',$customer_id);
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array();
  }
  public function get_cron_update_rank_users(){
	   $this->db->select('id,fund,distribure_date');
		$this->db->from('fund_log');
		$this->db->where('d_end','No');
		$this->db->where('type','Rank');
		$this->db->limit(2);
		$query = $this->db->get();
		return $query->result_array(); 
  }
  public function get_healthcarefund_users(){
	   $this->db->select('id,grade,active_child,child_lbv,bsacode');
		$this->db->from('customer');
		$this->db->where_in('bsacode',array('Marketing Executive','Assistant Manager','Manager','Team Leader'));
		//$this->db->where('active_child >','1');
		//$this->db->where('child_lbv >','49');
		//$this->db->or_where('bsacode','Team Leader');
		//$this->db->where('o_date >=',$sdate);
		$query = $this->db->get();
		return $query->result_array(); 
   } 
   public function get_educationfund_users(){
	   $this->db->select('id,grade,active_child,child_lbv,bsacode');
		$this->db->from('customer');
		$this->db->where_in('bsacode',array('Assistant Manager','Manager','Team Leader'));
		//$this->db->where('active_child >','3');
		//$this->db->where('child_lbv >','99');
		//$this->db->or_where('bsacode','Team Leader');
		$query = $this->db->get();
		return $query->result_array(); 
   } 
   public function get_entertainmentfund_users(){
	   $this->db->select('id,grade');
		$this->db->from('customer');
		$this->db->where('bsacode','Team Leader');
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
   public function get_travelfund_users(){
	   $this->db->select('id,grade');
		$this->db->from('customer');
		$this->db->where_in('bsacode',array('Manager','Team Leader'));
		$query = $this->db->get();
		return $query->result_array(); 
   }
   /*
    public function get_all_assistant_managers(){
	   $this->db->select('c.id, count(p.id) as child'); 
		$this->db->from('customer as c');
		$this->db->join('customer as p','c.customer_id=p.parent_customer_id','left');
		$this->db->where_in('c.bsacode',array('Assistant Managers','Manager','Team Leader'));
		$this->db->where_in('p.grade',array('Representative','Associate','Distributor','Stockist'));
		$this->db->group_by('c.id');
		$this->db->having('child > 3');
		$query = $this->db->get();
		return $query->result_array(); 
   }*/  
   
   public function get_fund_log_by_type($type,$date){
	   $this->db->select('id');
		$this->db->from('fund_log');
		$this->db->where('type',$type);
		$this->db->where('distribure_date',$date);
		$query = $this->db->get();
		return $query->result_array(); 
   }
public function get_pending_payment(){
    $this->db->select('i.*,c.active_child,c.child_lbv,c.bsacode,c.grade');
    //$this->db->select('i.*');
		$this->db->from('income_pending as i');
		$this->db->join('customer as c','i.user_id=c.id','left');
		$this->db->where('i.status','Active');
		$this->db->limit(100);
		$query = $this->db->get();
		return $query->result_array(); 
}

   public function insert_data_in_table($data,$table='income'){
		$this->db->insert($table, $data); 
	}
        function update_data_in_table($id,$data,$table){ 
		$this->db->where('id', $id);
	    $this->db->update($table, $data);	
        return TRUE;
	}

	function update_fund_log_by_id($id){ 
		$this->db->where('id', $id);
	    $this->db->update('fund_log', array('d_start'=>'Yes','d_end'=>'Yes'));	
        return TRUE;
	}
	function update_fund_log($type, $date){ 
        $this->db->where('type', $type);
        $this->db->where('distribure_date', $date);
	    $this->db->update('fund_log', array('d_end'=>'Yes'));	
        return TRUE;
    }
	
	public function parent_bliss_result($parent_customer_id){
		$this->db->select('id')->from('customer')->where('parent_customer_id',$parent_customer_id);
		$subQuery =  $this->db->get_compiled_select();

	   $this->db->select('user_id,SUM(comm_dis) as lbv');
		$this->db->from('orders');
		$this->db->where("user_id IN ($subQuery)", NULL, FALSE);
		//$this->db->where('c.customer_id',$parent_customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   function get_child_users($customer_id) {
		$this->db->select('id,bsacode,grade');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   
	    function get_incentive(){
	    $this->db->select('id,child_lbv,rep_club');
		$this->db->from('customer');
		$this->db->where("child_lbv >",499);
		$this->db->where('rep_club',0);
		$query = $this->db->get();
		return $query->result_array(); 
   } 
   
   function update_repurchase($id, $data_to_store){ 
        $this->db->where('id', $id);
	    $this->db->update('customer', $data_to_store);	
        return TRUE;
    }
	   

   }
?>