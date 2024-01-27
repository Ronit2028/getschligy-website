<?php 
class Lamlord_model extends CI_Model {
 
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
    public function get_all_customer()
    {
		$this->db->select('*');
		$this->db->from('lamlord_income');
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
  public function get_all_income_by_id($id)
    {
		$this->db->select('lamlord_income.*,customer.bliss_amount');
		$this->db->from('lamlord_income');
		$this->db->join('customer','customer.id = lamlord_income.user_id','left');
		$this->db->where('lamlord_income.id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_income($data)
    {
		$insert = $this->db->insert('lamlord_income', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_income($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('lamlord_income', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 function update_customer($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
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
}
?>