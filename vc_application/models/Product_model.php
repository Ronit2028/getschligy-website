<?php 
class Product_model extends CI_Model {
 
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
    function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
    public function get_product_by_url($pid)
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('p_id',$pid);
                $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  
	 public function get_bliss_product_list()
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
                $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	 public function get_new_arrivals_product($keyword,$cat)
    {
		
		$this->db->select('*');
		$this->db->from('admin_product'); 
        $this->db->where('status', 'active');
        if($keyword!='') { $this->db->like('pname', $keyword); }
        if($cat!='') { $this->db->where('category', $cat); }
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function get_stores_product()
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
                $this->db->where('status', 'active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	  public function get_deal_by_url($mid)
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('merchants');
		$this->db->where('merchant_id',$mid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	  
	 public function get_deals_list()
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('merchants.*, merchant_meta.brand_proof');
		$this->db->from('merchants'); 
		$this->db->join('merchant_meta', 'merchant_meta.merchant_id = merchants.id', 'left'); 
		$this->db->where('merchants.status','active');
		$this->db->order_by('merchants.id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
		 public function get_merchant_deal($mid)
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('deals');
		$this->db->where('mid',$mid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	function get_product_review($cust_id){
	   $this->db->select('*');
		$this->db->from('reviews');
		$where = "pro_id='$cust_id' AND status='approved'";
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
}
?>