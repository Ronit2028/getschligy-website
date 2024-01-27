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
	
	public function get_all_quiz_result(){
		
		$this->db->select('a.*,q.title,c.f_name,c.phone,c.l_name');
		$this->db->from('quiz_history as a');
		$this->db->join('quiz as q','q.eid=a.eid','left');
		$this->db->join('customer as c','c.id=a.email','left');
		//$this->db->where('a.eid',$id);
		//$this->db->group_by('q.qid');
		$query = $this->db->get();
		return $query->result_array(); 
		
		
	}
	
	public function get_all_scholarship()
    {
		$this->db->select('*');
		$this->db->from('scholarship');
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
	
	 public function get_all_quiz_questions()
    {
		$this->db->select('*');
		$this->db->from('quiz');
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
	public function get_all_quiz_question_id_old($id)
    {
		$this->db->select('a.*');
		$this->db->from('quiz_answers as a');
		$this->db->join('quiz_questions as q','q.id=a.ques_id','left');
		$this->db->where('a.ques_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function get_all_quiz_question_id($id)
    {
		$this->db->select('*');
		$this->db->from('quiz_answers');
		$this->db->where('ques_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		public function get_all_quiz_question_ids($id)
    {
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->where('eid',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	
		public function get_all_scholarship_ids($id)
    {
		$this->db->select('*');
		$this->db->from('scholarship');
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
	
	   function store_menual($tavle,$data)
    {
		$insert = $this->db->insert($tavle, $data);
		return true;
	}
	
		public function get_quiz_detail($id)
    {
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->where('eid',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	

	
	public function get_quiz_question($id)
    {
		$this->db->select('a.*,q.option as quizoption,qa.ansid,');
		$this->db->from('quiz_questions as a');
		$this->db->join('quiz_options as q','q.qid=a.qid','left');
		$this->db->join('quiz_answer as qa','qa.qid=q.qid','left');
		$this->db->where('a.eid',$id);
		//$this->db->group_by('q.qid');
		$query = $this->db->get();
		return $query->result_array(); 
    }

	
	function store_quiz($data)
    {
		$insert = $this->db->insert('quiz', $data);
		 $insert_id = $this->db->insert_id();
		return $insert_id;
		
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
 function update_quiz($id, $data)
    {
		$this->db->where('eid', $id);
		$this->db->update('quiz', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	}
	 function update_scholarship($id, $data)
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
	
	
	function delete_product($id){
		$this->db->where('id', $id);
		$this->db->delete('gallery'); 
	}
	function delete_ytb($id){
		$this->db->where('id', $id);
		$this->db->delete('yt_gallery'); 
	}
	
	function delete_quiz($id){
		$this->db->where('eid', $id);
		$this->db->delete('quiz'); 
	}
	
}
?>