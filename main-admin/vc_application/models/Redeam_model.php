<?php 
class Redeam_model extends CI_Model {
 
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
   public function get_all_redeam()
    {
		// $this->db = $this->load->database('CUSTDB', TRUE);
		$this->db->select('redeem_bliss.*,customer.*');
		$this->db->from('redeem_bliss');
       $this->db->join('customer', 'redeem_bliss.user_id = customer.id', 'left');		
		$this->db->where('redeem_status','pending');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	
	
	 public function get_all_redeam_apr_withdate($sdate,$edate)
    {
		$this->db->select('redeem_bliss.*,customer.*,redeem_bliss.rdate as releasedate');
		$this->db->from('redeem_bliss');
        $this->db->join('customer', 'redeem_bliss.user_id = customer.id', 'left');	
	    $this->db->where('redeem_bliss.rdate >=',$sdate);
		$this->db->where('redeem_bliss.rdate <=',$edate); 	   
		$this->db->where('redeem_status','approved');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	function update_redeam_in($id, $data)
    { 
		 $this->db->where_in('rd_id', $id);
	     $this->db->update('redeem_bliss', $data);		
         $error = $this->db->error();
         if(empty($error['message'])) { return true; }
         else { return false; }
	}
 
	
	  public function get_all_redeam_id($id)
    {
		// $this->db = $this->load->database('CUSTDB', TRUE);
		$this->db->select('redeem_bliss.*,customer.*');
		$this->db->from('redeem_bliss');
        $this->db->join('customer', 'redeem_bliss.user_id = customer.id', 'left');		
		$this->db->where('rd_id', $id);
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
    }

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_redeam($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
	    return $insert;
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_redeam($id, $data)
    {
		// $this->db = $this->load->database('CUSTDB', TRUE);
		$this->db->where('rd_id', $id);
		$this->db->update('redeem_bliss', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 function update_customer_redeam($id, $data)
    {
		// $this->db = $this->load->database('CUSTDB', TRUE);
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
	
	
	function delete_redeam($id){
		// $this->db = $this->load->database('CUSTDB', TRUE);
		$this->db->where('id', $id);
		$this->db->delete('redeem_bliss'); 
	}
	 public function get_all_redeam_apr()
    {
		$this->db->select('redeem_bliss.*,customer.*,redeem_bliss.rdate as releasedate');
		$this->db->from('redeem_bliss');
       $this->db->join('customer', 'redeem_bliss.user_id = customer.id', 'left');		
		$this->db->where('redeem_status','approved');
		//$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();  
    }
	
	
	
	
	
}






?>