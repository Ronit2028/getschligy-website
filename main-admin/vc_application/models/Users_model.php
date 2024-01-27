<?php 
class Users_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    /**
    * Validate the login's data with the database
    * @param string $user_name
    * @param string $password
    * @return void
    */
	function validate($user_name, $password)
	{  
                $this->db->select('*');
		$this->db->from('membership');
		$this->db->where('user_name', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
		/*return $query->result_array(); */
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['user_id'] = $row->id;
    			$return['full_name'] = $row->first_name;
    			$return['email'] = $row->email_addres;
    			$return['user_level'] = $row->user_level;
                        $return['permission'] = $row->permission; 
			 }
			return $return;
                }
                else { return false ; }
	}

    /**
    * Serialize the session data stored in the database, 
    * store it in a new array and return it to the controller 
    * @return array
    */
	function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); /* array to store the user data we fetch */
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    /* put data in array using username as key */
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	function create_member()
	{

		$this->db->where('user_name', $this->input->post('username'));
		$query = $this->db->get('membership');

        if($query->num_rows > 0){
        	echo '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><strong>';
			  echo "Username already taken";	
			echo '</strong></div>';
		}else{

			$new_member_insert_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name' => $this->input->post('last_name'),
				'email_addres' => $this->input->post('email_address'),			
				'user_name' => $this->input->post('username'),
				'pass_word' => md5($this->input->post('password'))						
			);
			$insert = $this->db->insert('membership', $new_member_insert_data);
		    return $insert;
		}
	      
	}//create_member
	
	
	function get_bliss_code_by_phone($cstid){
	   $this->db->select('f_name,l_name');
		$this->db->from('customer');
		$this->db->where('phone',$cstid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('membership');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
public function update_changePassword($data_to_store)
{
	
	 $this->db->where('id', '1');
	     $this->db->update('membership', $data_to_store);	
            return TRUE;
 }   
	
	function profile(){
		$this->db->select('*');
		$this->db->from('membership');
		$this->db->where('id','1');
		$query = $this->db->get();
		return $query->result_array(); 
	}
}

