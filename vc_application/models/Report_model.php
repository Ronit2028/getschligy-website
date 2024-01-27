<?php 
class Report_model extends CI_Model {
 
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
    public function get_all_feedback($id)
    {
		$uid = $this->session->userdata('cust_id');
	
		$this->db->select('*');
		$this->db->from('grievance'); 
		$this->db->where('name',$id);
		$this->db->where('type','feedback');
		$query = $this->db->get();
		return $query->result_array();  
    } 
	
  public function get_all_complaint($id)
    {
		$uid = $this->session->userdata('cust_id');
		$this->db->select('*');
		$this->db->from('grievance'); 
		$this->db->where('name',$id);
		$this->db->where('type','complaint');
		$query = $this->db->get();
		return $query->result_array();  
    } 

	 public function get_all_contact($id)
    {
		$uid = $this->session->userdata('cust_id');
		$this->db->select('*');
		$this->db->from('grievance'); 
		$this->db->where('name',$id);
		$this->db->where('type','contact');
		$query = $this->db->get();
		return $query->result_array();  
    } 
	
  public function get_first_cercle($bliss_id) {
    $this->db->select('*');
    $this->db->from('customer');
	$this->db->where('parent_customer_id',$bliss_id);
	$query = $this->db->get();
	return $query->result_array(); 
  }
}
?>