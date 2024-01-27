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
    	public function add_data_in_table($data,$table){
	   $insert = $this->db->insert($table, $data);
   }
   function get_child_id($cust_id){
	   $this->db->select('id,f_name,l_name,customer_id,business');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function add_reply($data) 
    {
		$insert = $this->db->insert('form_reply', $data);
		return $insert;
	}

	
	
	
	
	
	
	
	
	 public function get_category_list()
    {
		$this->db->select('id,c_name');
		$this->db->from('categorys'); 
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	 public function get_preview($ids)
    {
		$this->db->select('*');
		$this->db->from('scholarship'); 
		$this->db->where('id',$ids);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
	
	
	
	
	
     public function get_team_business($userid,$pay_level=''){
		$this->db->select('SUM(amount) as amount');
		$this->db->from('team_bussiness');
		$this->db->where('user_id',$userid);
		if($pay_level!='') { $this->db->where('pay_level <=',$pay_level); }
		else { $this->db->where('pay_level >',1); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function update_wallet($id,$amount,$type){
        $sql = "update `customer` set $type = $type - $amount where id='$id'";
        $this->db->query($sql); 
    }
    function update_stock($id,$amount,$type){
        $sql = "update `product` set $type = $type - $amount where id='$id'";
        $this->db->query($sql); 
    }
	function substract_wallet($id,$amount,$column){
        $sql = "update `customer` set $column = $column + $amount where id='$id'";
        $this->db->query($sql); 
    }
	function add_transactional_wallet($data)
    {
		$insert = $this->db->insert('transaction_wallet', $data);
	    $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	
	function my_friends_auto_pool($table,$cust_id){

	    $this->db->select('d.customer_id as dcustomer_id,p.*,c.f_name,c.l_name,c.customer_id,c.status,c.consume');
		$this->db->from($table.' as p');
		$this->db->join('customer as c', 'c.id = p.user_id OR c.id = p.original_id','left');
		$this->db->join('customer as d', 'd.id = p.parent_id','left');
		$this->db->where('p.parent_id',$cust_id);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_empty_shell()
    {
		$this->db->select('*');
		$this->db->from('auto_pool');
	//	$this->db->where('package',$package);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    function select_products(){
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status', 'active');
		$this->db->where('p_qty >', 0);
		$this->db->where('combo',1);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function get_customer_by_id($id)
    {
		$this->db->select('c.*, d.id as did,d.customer_id as dcustomer_id, d.f_name as df_name, d.l_name as dl_name');
		$this->db->from('customer as c');
		$this->db->join('customer as d','c.direct_customer_id=d.customer_id','left');
		$this->db->where('c.customer_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    }
	public function insert_data_in_table($table,$data){
		$this->db->insert($table, $data); 
	}
	public	function store_sale_dta($data)
    {
		$insert = $this->db->insert('total_sale', $data);
               $insert_id = $this->db->insert_id();
	    return $insert_id;
	}
	public function count_last_level_customer($tree_level,$level_consume) 
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('level', $tree_level); 
		 $this->db->where('level_consume', $level_consume); 
	//	$this->db->where('status','Active');
		//$this->db->where('auto_pool','1');
		$query = $this->db->get();
		return $query->num_rows(); 
    } 
	
	function update_auto_pool($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('auto_pool', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	
	public function get_select_max()
    {
		$this->db->select_max('level');
$this->db->from('customer');
//$this->db->where('package',$package);
$query=$this->db->get();
return $query->result_array(); 
    } 
	
	public function get_last_level_customer($tree_level,$level_consume)
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('level', $tree_level); 
		$this->db->where('level_consume', $level_consume);
		//$this->db->where('status','Active');
		//$this->db->where('package',$package);
		$this->db->order_by('rdate','asc');
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function count_myfrnds_customer($customer_id,$consume='')
    {
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('parent_customer_id', $customer_id); 
		if(!empty($consume)) { $this->db->where('consume', $consume); }
		$query = $this->db->get();
		return $query->num_rows(); 
    } 
	function update_customer_array_data($id, $data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
                $error = $this->db->error();
                if(empty($error['message'])) { return true; }
                else { return false; }
	} 
	function friends_by_position($cust_id,$position=''){
	   $this->db->select('id,f_name,l_name,customer_id,bsacode,status,parent_customer_id,rdate');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$this->db->where('grade !=','Customer');
		if($position!='') { $this->db->where('position',$position); }
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function super_admin_validate($user_name){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $user_name); 
		$query = $this->db->get();
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['cust_id'] = $row->id;
    			$return['full_name'] = $row->f_name.' '.$row->l_name;
    			$return['email'] = $row->email;
    			$return['rdate'] = $row->rdate;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
    			$return['rank'] = $row->bsacode;
    			$return['active_child'] = $row->active_child;
    			$return['child_lbv'] = $row->child_lbv;
                       if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
                       else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
			 }
			return $return;
                }
                else { return false ; }
	}
	
	
	
	function get_child_users($customer_id) {
		$this->db->select('id,bsacode,grade');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$customer_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function validate($user_name, $password)
	{  
         $this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id', $user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
                if(count($query->result_array())==1) { 
                 $return['login'] = 'true';
			foreach ($query->result() as $row)
			 {
    			$return['cust_id'] = $row->id;
				$return['full_name'] = $row->f_name.' '.$row->l_name;
    			$return['email'] = $row->email;
				$return['rdate'] = $row->rdate;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
    			$return['rank'] = $row->bsacode;
    			$return['active_child'] = $row->active_child;
    			$return['child_lbv'] = $row->child_lbv;
                if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
                else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
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
	/*function get_db_session_data()
	{
		$query = $this->db->select('user_data')->get('ci_sessions');
		$user = array(); 
		foreach ($query->result() as $row)
		{
		    $udata = unserialize($row->user_data);
		    $user['user_name'] = $udata['user_name']; 
		    $user['is_logged_in'] = $udata['is_logged_in']; 
		}
		return $user;
	}*/
	
    /**
    * Store the new user's data into the database
    * @return boolean - check the insert
    */	
	
	
	    function get_active_incomes($id,$where,$sdate,$edate){
	    $this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('income as a');
		$this->db->join('customer as c', 'c.id = a.user_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->where('a.r_date >=',$sdate);
		$this->db->where('a.r_date <=',$edate); 
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	    function get_active_incomes_amount($id,$where){
	    $this->db->select('SUM(amount) as amount');
		$this->db->from('income');
		$this->db->where('user_id',$id);
		$this->db->where('type',$where);
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	function get_fund_log_by_date($date,$where){
	   $this->db->select('*');
		$this->db->from('fund_log');
		//$this->db->join('orders as o', 'o.id = a.order_id','left');
		//$this->db->join('customer as c', 'c.id = o.user_id','left');
		$this->db->where('distribure_date',$date);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	} 

	function news_feed(){
	   $this->db->select('*');
		$this->db->from('gnd_news');
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	function get_active_incomes_da($id,$where){
	   $this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('distribution_amount as a');
		$this->db->join('customer as c', 'c.id = a.user_id_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	} 
	
	/* function get_active_incomes_da_amount($id){
	   $this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('distribution_amount as a');
		$this->db->join('customer as c', 'c.id = a.user_id_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->where('a.status','Active');
		$query = $this->db->get();
		return $query->result_array(); 
	}  */
	
/* 	function get_active_direct_sale($id,$where){
	   $this->db->select('a.*,c.customer_id,c.f_name, c.l_name');
		$this->db->from('income as a');
		//$this->db->join('orders as o', 'o.id = a.order_id','left');
		$this->db->join('customer as c', 'c.id = a.user_send_by','left');
		$this->db->where('a.user_id',$id);
		$this->db->where($where);
		$query = $this->db->get();
		return $query->result_array(); 
	} */ 
	
	
	
	function create_member_o()
	{
		 //  $this->db->where('email', $this->input->post('email'));
		 //  $query = $this->db->get('customer');

		   $this->db->where('customer_id', $this->input->post('bliss_code'));
		   $bliss_code_query = $this->db->get('customer');
		   $direct_sponcer = $bliss_code_query->result_array();
		   
		//   $this->db->where('parent_customer_id', $this->input->post('bliss_code'));
		//   $p_code_query = $this->db->get('customer');
		//   $direct_child = $p_code_query->result_array();
		   
        //if($query->num_rows > 0){
       /**  if(count($query->result_array()) > 0) { 
        	return 'false';
		}
     else **/
     
     
		if($this->input->post('bliss_code')!='' && (count($direct_sponcer) == 0)) { 
		   return 'false bliss_code';
		} 
		else { 
		    
		    if($direct_sponcer[0]['active_child'] < 3) { 
        	$parent_customer_id = $this->input->post('bliss_code');
        	 $pid = $direct_sponcer[0]['id'];
		} else {
		    $dis_level = 1;
		    $k = 0;
		    while($k<1) {
		        $this->db->select('d.*,c.id as pid,c.customer_id');
		        $this->db->from('distribution_level as d');
		        $this->db->join('customer as c', 'd.user_id_send_by = c.id','left'); 
		        $this->db->where('d.user_id',$direct_sponcer[0]['id']);
		         $this->db->where('d.pay_level',$dis_level);
		         $this->db->where('c.active_child <',4);
		        $query = $this->db->get();
		      $parent_sponcer_user = $query->result_array();
		      if(!empty($parent_sponcer_user)) {
		          $parent_customer_id = $parent_sponcer_user[0]['customer_id'];
		          $pid = $parent_sponcer_user[0]['pid'];
		          $k++;
		      } elseif($dis_level > 50) { $k++; }
 		      $dis_level = $dis_level + 1;
		    }
		    
		}
		    if($parent_customer_id != '') {
			$new_member_insert_data = array(
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'direct_customer_id' => $this->input->post('bliss_code'),
				'status' => 'active',
				'pass_word' => md5($this->input->post('password'))						
			);
			

			  $this->db->insert('customer', $new_member_insert_data); 
              $insert_id = $this->db->insert_id();
			  $f_name = $this->input->post('f_name');
				$phone = $this->input->post('phone');
				$customer_n = substr($f_name,0,2).''.substr($phone,-4).''.$insert_id;
                $customer_id = strtoupper($customer_n);
       
        $this->db->where('id', $insert_id);
		$this->db->update('customer', array('customer_id'=>$customer_id,'parent_customer_id'=>$parent_customer_id));

		
		$sql = "update `customer` set active_child = active_child + 1 where id='$pid'";
        $this->db->query($sql);

                    $add_pv = array();
					$parent_customer_id = $parent_customer_id; 
					$dis_level = 1;
					$p = 0;
				
					if($parent_customer_id != '') {
					while($p < 1) {
					     $this->db->where('customer_id',$parent_customer_id);
		                $query = $this->db->get('customer');
		                $parent_user = $query->result_array();
						if(!empty($parent_user)) { 
						  $add_pv[] = array('user_id'=>$parent_user[0]['id'],'user_id_send_by'=>$insert_id,'status'=>'Active','pay_level'=>$dis_level);
						  
						  $parent_customer_id = $parent_user[0]['parent_customer_id'];
						  
						  $dis_level = $dis_level + 1;
						  $p = 0;
						} else { $p++; }
					}
				  }
				  
				  if(!empty($add_pv)) {
					  $this->db->insert_batch('distribution_level',$add_pv);
				  }
        

		
		/***************** SMS ******************/
		$sms_msg = urlencode("Thank you for joining us today! Below is your login information:
Username: ".$customer_id."
Password: ".$this->input->post('password')."
LA Code: ".$customer_id."\n
Team Divinoindia. ");
$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=LMLORD&message=".$sms_msg;
// file_get_contents($smstext);
/***************** SMS ******************/

		    return $customer_id;
		    } else { return 'false bliss_code'; }
		}
	      
	}//create_member
	
	
	function create_member()
	{
		 //  $this->db->where('email', $this->input->post('email'));
		 //  $query = $this->db->get('customer');

		   $this->db->where('customer_id', $this->input->post('bliss_code'));
		   $this->db->where('consume >',0);
		   $bliss_code_query = $this->db->get('customer');
		   $direct_sponcer = $bliss_code_query->result_array();

		if($this->input->post('bliss_code')!='' && (count($direct_sponcer) == 0)) { 
		   return 'false bliss_code';
		} 
		else { 

			$new_member_insert_data = array(
				'f_name' => $this->input->post('f_name'),
				'l_name' => $this->input->post('l_name'),
				'phone' => $this->input->post('phone'),
				'email' => $this->input->post('email'),
				'direct_customer_id' => $this->input->post('bliss_code'),
				'parent_customer_id' => $this->input->post('bliss_code'),
				'status' => 'active',
				'pass_word' => md5($this->input->post('password'))						
			);
			

			  $this->db->insert('customer', $new_member_insert_data); 
              $insert_id = $this->db->insert_id();
			  $f_name = $this->input->post('f_name');
				$phone = $this->input->post('phone');
				$customer_n = substr($f_name,0,2).''.substr($phone,-4).''.$insert_id;
                $customer_id = strtoupper($customer_n);
       
        $this->db->where('id', $insert_id);
		$this->db->update('customer', array('customer_id'=>$customer_id));

		
		


		
		/***************** SMS ******************/
		$sms_msg = urlencode("Thank you for joining us today! Below is your login information:
Username: ".$customer_id."
Password: ".$this->input->post('password')."
LA Code: ".$customer_id."\n
Team Divinoindia. ");
$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=LMLORD&message=".$sms_msg;
// file_get_contents($smstext);
/***************** SMS ******************/

		    return $customer_id;
		    
		}
	      
	}//create_member
	
	function get_bliss_code_by_phone($cstid){
	   $this->db->select('f_name,l_name');
		$this->db->from('customer');
		$this->db->where('customer_id',$cstid);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	function bliss_perk_history($id){
	   $this->db->select('*');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function bliss_request($id){
	   $this->db->select('*');
		$this->db->from('redeem_bliss');
		$this->db->where('user_id',$id);
		$this->db->like('rdate',date("Y-m-d")); 
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function parent_profile($blissid){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$blissid);
		$query = $this->db->get();
		return $query->result_array(); 
	}

	
	
	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	
	function sale_data($id){
		$this->db->select('SUM(comm_dis) as amount,SUM(bv) as bv');  
		$this->db->from('orders');
		$this->db->where('user_id',$id);
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function total_sale_data($id){
		$this->db->select('SUM(pv) as amount,SUM(bv) as bv');  
		$this->db->from('total_sale');
		$this->db->where('user_id',$id);
		$this->db->group_by('user_id');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	
	function select_member(){
		$this->db->select('*');
		$this->db->from('customer');
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
	function my_friends($cust_id){
	    $this->db->select('id,f_name,l_name,parent_customer_id,customer_id,rdate,status,consume');
		$this->db->from('customer');
		$this->db->where('parent_customer_id',$cust_id);
		$this->db->order_by('customer_id','ASC');
		$query = $this->db->get();
		return $query->result_array();
	}
	
	
	function my_orders($uid){
	  // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	function total_company_lpv(){
	  
		$this->db->select('SUM(comm_dis) as total_company_lpv');
		$this->db->from('orders'); 
		//$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	
	function total_member_lpv($uid,$rdate){
	  
		$this->db->select('SUM(comm_dis) as total_company_lpv');
		$this->db->from('orders'); 
		$this->db->where('o_date >=',$rdate);
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function total_associate_member(){
	  
		$this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('grade','Associate');
		$query = $this->db->get();
		

   return $query->num_rows();
		
	}
	
	function get_order_by_id($id){
	  // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('orders'); 
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function total_income($uid){
	  
		$this->db->select('SUM(amount) as total_income_fund');
		$this->db->from('income'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function total_transaction($uid,$status){
	  
		$this->db->select('SUM(amount) as total_income_fund');
		$this->db->from('transaction_log'); 
		$this->db->where('user_id',$uid);
		$this->db->where('status',$status);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}

	function total_income_monthly($uid,$sdate,$edate){
	  
		$this->db->select('SUM(amount) as total_income_fund');
		$this->db->from('income'); 
		$this->db->where('user_id',$uid);
		$this->db->where('r_date >=',$sdate);
		$this->db->where('r_date',$edate);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	
	function get_income($id){
	  
		$this->db->select('SUM(amount) as total_income');
		$this->db->from('income'); 
		$this->db->where('user_id',$id);
		$this->db->where('status','Active');
		$query = $this->db->get();
		return $query->result_array();   
	}

	function get_monthly_bill($id,$sdate,$edate){
	  
		$this->db->select('SUM(total_amount) as total_amount');
		$this->db->from('orders'); 
		$this->db->where('user_id',$id);
		$this->db->where('o_date >=',$sdate);
		$this->db->where('o_date <=',$edate);
		$query = $this->db->get();
		return $query->result_array();   
	}
	

	
	
	function get_monthly_salebill($id,$sdate,$edate){
	  
		$this->db->select('SUM(gtotal) as total_amount');
		$this->db->from('total_sale'); 
		$this->db->where('user_id',$id);
		$this->db->where('tdate >=',$sdate);
		$this->db->where('tdate <=',$edate);
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	
	
	
	
	
	
	

	function total_income_level($uid){
	  
		$this->db->select('SUM(amount) as total_income_level');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$uid);
		$this->db->where('status','Active');
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function total_income_da($uid){
	  
		$this->db->select('*');
		$this->db->from('income'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function total_affiliate($cust_id=''){
	  
		$this->db->select('*');
		$this->db->from('customer'); 
		//$this->db->where('grade !=','Customer');
		if(!empty($cust_id)) {
			$this->db->where('parent_customer_id',$cust_id);
		}
		$this->db->order_by('id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function my_first_circle_order($myfriendid){
		
	// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('id,user_id,status');
		$this->db->from('orders'); 
		$this->db->where_in('user_id',$myfriendid);
		$this->db->where('status','Delivered');
		$query = $this->db->get();
		return $query->result_array();  
	}
	
	

function my_bliss_amount($uid){
	  // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('distribution_amount'); 
		$this->db->where('user_id',$uid);
		$this->db->order_by('order_id','desc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	
	function bliss_perk_redeem_amount($id){ 
  $this->db->select('SUM(redeem) as total');
  $this->db->from('redeem_bliss');
  $this->db->where('user_id',$id);
  $this->db->where('redeem_status','approved');
  $query=$this->db->get();
  return $query->row()->total;
 }
	
	function update_profile($id, $data_to_store){ 
             $this->db->where('id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   
	   function update_profile_by_customer($id, $data_to_store){ 
             $this->db->where('customer_id', $id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
       }
	   
function update_order($id, $data_to_store){ 
             // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->where('id', $id);
		$this->db->update('orders', $data_to_store);	
            return TRUE;
       }

	  function validate_upl_credentials($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}

	function validate_review($data)
    {
		$insert = $this->db->insert('reviews', $data);
		return $insert;
	}  
	   
	 function redeem_bliss_request($data)
    {
		$insert = $this->db->insert('redeem_bliss', $data);
		return $insert;
	} 


//funtion to get email of user to send password
 function forgotPassword($customer_id)
 {
         $this->db->select('customer_id,email');
        $this->db->from('customer'); 
        $this->db->where('customer_id', $customer_id); 
        $query=$this->db->get();
        return $query->row_array();
 }
 
 
 public function sendpassword($data)
{
        $customer_id = $data['customer_id'];
        $email = $data['email'];
        $query1=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(99999,999999);
        $newpass = md5($passwordplain);
       /*  $this->db->where('email', $email);
        $this->db->query("update customer set pass_word='".$newpass."' where email = '".$email."' ");  */
		$this->db->query("update customer set pass_word='".$newpass."' where customer_id = '".$customer_id."' "); 
         
        $to = $email;
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
				$headers .= 'From: Divinoindia Ventures <info@divinoindia.com>' . "\r\n"; 
				$subject = 'Forgot password at Divinoindia';
				
				$message='Dear '.$row[0]['f_name'].','. "\r\n";
        $message.='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";
        $message.='<br>Please update your password.';
        $message.='<br><br>Thanks & Regards';
        $message.='<br>Team Divinoindia '; 
				$mail= mail($to,$subject,$message,$headers);
				
				/***************** SMS ******************/
		$sms_msg = urlencode("Reset code : ".$passwordplain."

Thanks for contacting regarding to forgot password,<br> Your temp password is ".$passwordplain."
Team Divinoindia..");

$smstext = "http://sms.digimiles.in/bulksms/bulksms?username=di78-blisszon&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$row[0]['phone']."&source=LMLORD&message=".$sms_msg;

//file_get_contents($smstext);


/***************** SMS ******************/
if ($mail) {
     return 'true';
} else {
   return 'false';
}     
}
else {  return 'error'; }
} 
 
 


public function changePassword($pass)
{
	$customer_id = $this->session->userdata('bliss_id');
        $query=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' and pass_word = '".md5($pass)."' ");
		
		$row=$query->result_array();
        if ($query->num_rows()>0){ 
            return "true";
        }else{
            return "false";
        }
    }
	
	public function update_changePassword($data_to_store)
{
	$customer_id = $this->session->userdata('bliss_id');
	 $this->db->where('customer_id', $customer_id);
	     $this->db->update('customer', $data_to_store);	
            return TRUE;
    }

	public function insert_pin_request($data){
	  $this->db->insert('pin_request',$data);
	  return TRUE;
	}
	

	 function get_all_child_sale($ids,$sdate,$edate){
	  
		$this->db->select('o.*,c.f_name,c.l_name,c.customer_id');
		$this->db->from('orders as o'); 
		$this->db->join('customer as c','c.id=o.user_id','left'); 
		if(!empty($ids)) { $this->db->where_in('o.user_id',$ids); }
		else { $this->db->where('o.user_id',0); }
		$this->db->where('o.o_date >=',$sdate);
		$this->db->where('o.o_date <=',$edate);
		$this->db->order_by('o.o_date','asc');
		$query = $this->db->get();
		return $query->result_array();   
	}
	
	function transaction_wallet($id){
		$this->db->select('*');
		$this->db->from('transaction_wallet');
		$this->db->where('userid',$id);
		$query = $this->db->get();
		return $query->result_array();  
	}
	
	function register($data) 
    {
		$insert = $this->db->insert('register', $data);
		return true;
	
}

 function get_cus_data($pancard){
		$this->db->select('*');
		$this->db->from('customer');
		//$this->db->where('id',$customer_id);
		$this->db->where('pancard',$pancard);
		$query = $this->db->get();
		return $query->result_array(); 
	}

function get_aadhar_data($aadhar){
		$this->db->select('*');
		$this->db->from('customer');
		//$this->db->where('id',$customer_id);
		$this->db->where('aadhar',$aadhar);
		$query = $this->db->get();
		return $query->result_array(); 
	}

function getRows($params = array()){
        $this->db->select('*');
        $this->db->from('customer');
        //fetch data by conditions
        if(array_key_exists("conditions",$params)){
            foreach($params['conditions'] as $key => $value){
                $this->db->where($key,$value);
            }
        }

        $query = $this->db->get();
		return $query->num_rows(); 
	
	
}

 function loginwithemail($user_name)
    {  
    	
    	$this->db->select('id,f_name,email,customer_id,status,image');
		$this->db->from('customer');
    	$this->db->where('email',$user_name);
    	$query = $this->db->get();
    	
    	if(count($query->result_array())==1) { 
    		$return['login'] = 'true';
    		foreach ($query->result() as $row)
    		{
    			$return['cust_id'] = $row->id;
    			$return['d_name'] = $row->f_name;
    			$return['email'] = $row->email;
    			$return['bliss_id'] = $row->customer_id;
    			$return['status'] = $row->status;
    			if($row->image==''){ $return['cust_img'] = base_url().'assets/images/man-person.png'; }
    			else { $return['cust_img'] = base_url().'images/user/'.$row->image; }
    		}
    		return $return;
    	}
    	else { $return['login'] = 'false'; ; }
    }
	function select_user_id($validate){
		$this->db->select('userid');
		$this->db->from('customer'); 
		$this->db->where('userid',$validate);
		$query = $this->db->get();
		return $query->result_array();   
	}

  public function google_insert($data){
	        $password = rand(10000,99999);
	        if(!array_key_exists("pass_word", $data)){
            $data['pass_word'] = md5($password);
        }
	        
		        $insert = $this->db->insert('customer', $data);
		        $insert_id = $this->db->insert_id();
        
        
    		
    			$f_name = $data['f_name'];
    			$phone = $data['phone'];
    			$customer_n = substr($f_name,0,2).$insert_id.substr($phone,-4);
    			$customer_id = strtoupper($customer_n);
    			$this->db->where('id', $insert_id);
    			$this->db->update('customer', array('customer_id'=>$customer_id));
    			/***************** SMS ******************/
				
				if(!empty($phone)){$uid=$phone;}else{$uid=$data['email'];}

    			$sms_msg = urlencode("Hi ".$data['f_name'].",\nYour account details are summarized below : User Name : ".$uid."\n Password : ".$password."\nTeam My Talent Hunt"); 
           $smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg."&entityid=1201159246187474002&tempid=1207161846790881162";
    			//file_get_contents($smstext);
		
				    $to = $data['email'];
    				$subject ="getscolify";
    				$txt = urldecode($sms_msg); 
    				$headers = "From: getscolify.com"."\r\n";
    				$headers = "MIME-Version: 1.0" . "\r\n";     
    				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";  
    				$headers .= 'From: <getscolify.com>' . "\r\n"; 
    			    //mail($to,$subject,$txt,$headers);
        
        return $insert_id;
    }

	}
