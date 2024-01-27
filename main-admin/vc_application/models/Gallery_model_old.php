<?php 
class Gallery_model extends CI_Model {
 
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
    public function get_all_product()
    {
		$this->db->select('*');
		$this->db->from('gallery');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	  public function get_all_ytb_gallery()
    {
		$this->db->select('*');
		$this->db->from('yt_gallery');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	    public function get_all_product1($id)
    {
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
  public function get_all_product_id($id)
    {
		$this->db->select('*');
		$this->db->from('gallery');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	 public function get_all_ytb_id($id)
    {
		$this->db->select('*');
		$this->db->from('yt_gallery');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	
	public function get_all_category()
    {
		$this->db->select('id,c_name');
		$this->db->from('categorys');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
	public function get_all_tax()
    {
		$this->db->select('id,amount,title,type');
		$this->db->from('tax');
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

    /**
    * Store the new item into the database
    * @param array $data - associative array with data to store
    * @return boolean 
    */
    function store_gallery($data)
    {
		$insert = $this->db->insert('gallery', $data);
		return true;
		
		
	   
	}
	
	 function store_yt($data)
    {
		$insert = $this->db->insert('yt_gallery', $data);
		return true;
		
		
	   
	}

    /**
    * Update product
    * @param array $data - associative array with data to store
    * @return boolean
    */
    function update_product($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('gallery', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	
	 function update_ytb($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('yt_gallery', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}

    /**
    * Delete product
    * @param int $id - product id
    * @return boolean
    */
	
	
	function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('gallery'); 
	}
	function delete_ytb($id){
		$this->db->where('id', $id);
		$this->db->delete('yt_gallery'); 
	}
}
?>