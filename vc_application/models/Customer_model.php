<?php 
class Customer_model extends CI_Model {
 
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

    function select_city($p_id){
		$this->db->select('*');
		$this->db->from('cities');
		$this->db->where('state_id',$p_id);
		$query = $this->db->get();
		 return $query->result_array(); 
		
	}
	
	
	function add_corporation($data) 
    {
		$insert = $this->db->insert('corporation', $data);
		return $insert;
	}
	
	
	function add_individual($data) 
    {
		$insert = $this->db->insert('individual', $data);
		return $insert;
	}
	
	
	
	
	
	
	
	function contact_us($data) {
		$insert = $this->db->insert('contact', $data);
		return $insert;
	}
    
	
	
	function insert_contact_us($data) {
		$insert = $this->db->insert('contact_us', $data);
		return $insert;
	}
	
	
	
	
	
	
	
	
	
	
     public function get_state_list()
    {
       
		$this->db->select('*');
		$this->db->from('states'); 
		$this->db->where('country_id','101'); 
		$query = $this->db->get();
		return $query->result_array(); 
    } 
     function forgotPassword($phone) {
        $this->db->select('phone,customer_id,email');
        $this->db->from('customer'); 
        $this->db->where('customer_id', $phone); 
        $query=$this->db->get();
        return $query->row_array();
 }

    function check_phone($phone) {
        $this->db->select('phone,customer_id,email');
        $this->db->from('customer'); 
        $this->db->where('phone', $phone); 
        $query=$this->db->get();
        return $query->row_array();
 }
 function check_email($email) {
        $this->db->select('phone,customer_id,email');
        $this->db->from('customer'); 
        $this->db->where('email', $email); 
        $query=$this->db->get();
        return $query->row_array();
 }
  public function sendpassword($data){
        $phone = $data['phone'];
        $email = $data['email'];
        $customer_id = $data['customer_id'];
        $query1=$this->db->query("SELECT * from customer where customer_id = '".$customer_id."' ");
        $row=$query1->result_array();
        if ($query1->num_rows()>0)
      
{
        $passwordplain = "";
        $passwordplain  = rand(999999999,9999999999);
        $newpass = md5($passwordplain);
      
        $this->db->query("update customer set pass_word='".$newpass."' where customer_id = '".$customer_id."' ");       
                 $message='<br><br>Thanks for contacting regarding to forgot password,<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";

			    $to = $email;
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
						$headers .= 'From: Stakein <info@stakein.co.in>' . "\r\n"; 
						$subject = 'Forgot password at Stakein';
						
						$message='Dear '.$row[0]['f_name'].','. "\r\n";
				$message.='<br><br>Thanks for contacting Stake In.<br> Your temp password is <b>'.$passwordplain.'</b>'."\r\n";
				$message.='<br>Please update your password.';
				$message.='<br><br>Thanks & Regards';
				$message.='<br>Stakein'; 
						$mail= mail($to,$subject,$message,$headers);
				if ($mail) {
					 return 'true';
				} else {
				   return 'false';
				}    
				
		
		$sms_msg = urlencode('Dear '.$row[0]['f_name'].", Your New Password : ".$passwordplain."\r\nThanks for contacting regarding to forgot password! Team Stakein");
        
           
            $smstext = "http://103.16.101.52/sendsms/bulksms?username=bsz-talenthunt&password=".$this->config->item('sms_pass')."&type=0&dlr=1&destination=".$phone."&source=".$this->config->item('sms_sndrid')."&message=".$sms_msg;
					file_get_contents($smstext);
					
					  return 'true';
}
else {  return 'error'; }
} 
    public function get_all_product($uid)
    {
		$this->db->select('*');
		$this->db->from('product');
		$this->db->where('mid',$uid);
		$query = $this->db->get();
		return $query->result_array(); 
    }

      public function combo_product(){
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('category',1);
		$this->db->where('p_qty >',0);
		$this->db->order_by('id','asc');
		$this->db->limit(3);
		$query = $this->db->get();
		return $query->result_array(); 
   }
     public function get_category_list()
    {
		$this->db->select('id,c_name');
		$this->db->from('categorys'); 
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 		

 public function get_bliss_product_list()
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
                $this->db->where('status', 'active');
                $this->db->where('combo', 0);
                $this->db->where('p_qty >',0);
		//$this->db->order_by('id','desc');
		   $this->db->limit(8);	
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	public function get_category($name)
    {
       // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('categorys');
		$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	public function get_coupon($coupon) {
	 	// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('site_coupon');
		$this->db->where('code',$coupon);
		$query = $this->db->get();
		return $query->result_array(); 
	}
public function get_order_coupon_by_customer($uid,$coupon_code) {
	 	// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('count(id) as total');
		$this->db->from('orders');
		$this->db->where('user_id',$uid);
		$this->db->where('coupon',$coupon_code);
		$query = $this->db->get();
		return $query->result_array(); 
	}

  public function get_product_by_url($pid)
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('status','active');
		$this->db->where('p_id',$pid);
		$query = $this->db->get();
		return $query->result_array(); 
    }  			 
     public function get_category_product($categoryid,$start=0)    {		
               // $this->db = $this->load->database('ADMINDB', TRUE);	
     	       $this->db->select('*');	
	       $this->db->from('admin_product');	
		$this->db->where('status','active');
	       $this->db->where('category',$categoryid);
	       $this->db->where('p_qty >',0);
               $this->db->order_by("product_type", "asc");	
               $this->db->limit(20,$start);		   
	       $query = $this->db->get();	
	       return $query->result_array();  
   }		
public function get_category_all_product($categoryid)    {		
               // $this->db = $this->load->database('ADMINDB', TRUE);	
     	       $this->db->select('id');	
	       $this->db->from('admin_product');	
		$this->db->where('status','active');
	       $this->db->where('category',$categoryid);  
	       $this->db->where('p_qty >',0);
	       $query = $this->db->get();	
	       return $query->result_array();  
   }	
		 public function get_merchant_list()
    {
		// $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('merchants.id,merchants.d_name,merchants.merchant_id,merchant_meta.brand_proof');
		$this->db->from('merchants');
		$this->db->join('merchant_meta', 'merchant_meta.merchant_id = merchants.id', 'left outer');
		$query = $this->db->get();
		return $query->result_array(); 
    }  
	
	public function bliss_product(){
         // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('category','20');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->where('p_qty >',0);
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   public function gold_product(){
         // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('category','19');
		$this->db->where('status','active');
		$this->db->order_by('id','desc');
		$this->db->where('p_qty >',0);
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array(); 
   }  

   public function grocery_product(){
         // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('category','21');
		$this->db->where('status','active');
		$this->db->where('p_qty >',0);
		$this->db->order_by('id','desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array(); 
   }  


   public function electronics_product(){
         // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('admin_product');
		$this->db->where('category','18');
		$this->db->where('status','active');
		$this->db->where('p_qty >',0);
		$this->db->order_by('id','desc');
		$this->db->limit(5);
		$query = $this->db->get();
		return $query->result_array(); 
   }
   
 function upload_user_product_design($data)
    {
		$insert = $this->db->insert('custom_product_req', $data);
		return $insert;
	}
   
   function insert_manual($table,$data)
    {
		$insert = $this->db->insert($table, $data);
		return $insert;
	}
   
   public function bliss_web_stores(){
         // $this->db = $this->load->database('ADMINDB', TRUE);
		$this->db->select('*');
		$this->db->from('webstores');
		$this->db->where('web_status','active');
		//$this->db->where('c_name',$name);
		$query = $this->db->get();
		return $query->result_array(); 
   }        
   public function get_category_id($name)    {  
   // $this->db = $this->load->database('ADMINDB', TRUE);
   $this->db->select('id');	
   $this->db->from('categorys');
   $this->db->where('c_name',$name);
   $query = $this->db->get();	
   return $query->result_array();     }         

   function get_customer_address($cust_id){
	   $this->db->select('*');
		$this->db->from('customer'); 
		$this->db->where('id',$cust_id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
   
    public function fech_news(){
         
		$this->db->select('*');
		$this->db->from('gnd_news');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function fech_video(){
         
		$this->db->select('*');
		$this->db->from('yt_gallery');
		 $this->db->where('type','home');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result_array();
	}
   
    function insert_feedback($data)
    {
		$insert = $this->db->insert('grievance', $data);
		return TRUE;
	}
   function register($data)
    {
		$insert = $this->db->insert('customer', $data);
		$insert_id=$this->db->insert_id();
		$customer_id='SI10'.$insert_id;
		$customer_n=strtoupper($customer_id);
		$this->db->where('id',$insert_id);
		$this->db->update('customer',array('customer_id'=>$customer_n));
		return array('customer_id'=>$customer_n,'id'=>$insert_id);
	}

public function fech_data($customer_id){
         
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('customer_id',$customer_id);
		$query = $this->db->get();
		return $query->result_array();
	}
 

function validate($user_name,$password)
	{  
         $this->db->select('*');
		$this->db->from('customer');
		$this->db->where('phone',$user_name);
		$this->db->where('pass_word', $password);
		$query = $this->db->get();
		return $query->result_array();
               
	}
 public function get_categorys()
    {
		$this->db->select('*');
		$this->db->from('categorys'); 
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	   	public function quiz()
    {
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->where('status','active');
		$query = $this->db->get();
		return $query->result_array(); 
    }  
    
        public function get_u_q_history($eid,$user_id)
    {
		$this->db->select('eid');
		$this->db->from('quiz_history');
		$this->db->where_in('eid',$eid);
		$this->db->where('email',$user_id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    
       	public function quiz_question($qid,$qno)
    {
		
		$this->db->select('*');
		$this->db->from('quiz_questions');
		$this->db->where('eid',$qid);
		$this->db->where('sn',$qno);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
   
          	public function questionans($qid)
    {
		
		$this->db->select('*');
		$this->db->from('quiz_options');
		$this->db->where('qid',$qid);
		$query = $this->db->get();
		return $query->result_array(); 
    }  
    
public function get_answer($qid)
    {
		
		$this->db->select('*');
		$this->db->from('quiz_answer');
		$this->db->where('qid',$qid);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    
    
       	public function get_quiz_ans($eid)
    {
		
		$this->db->select('*');
		$this->db->from('quiz');
		$this->db->where('eid',$eid);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    
    public function get_history($eid,$user_id)
    {
		$this->db->select('*');
		$this->db->from('quiz_history');
		$this->db->where('eid',$eid);
		$this->db->where('email',$user_id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
    
   	   function store_menual($tavle,$data)
    {
		$insert = $this->db->insert($tavle, $data);
		return true;
	} 
	
	    function update_history($eid,$user_id, $data)
    {
		$this->db->where('email', $user_id);
		$this->db->where('eid', $eid);
		$this->db->update('quiz_history', $data);		
         return true; 
	}
	
	    function update_profile_data($id,$data)
    {
		$this->db->where('id', $id);
		$this->db->update('customer', $data);		
        return true; 
	}


	function profile($id){
		$this->db->select('*');
		$this->db->from('customer');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
	}
	
function update_profile($id,$amount)
	{
$this->db->query('UPDATE customer SET wallet = wallet+'.$amount.' where customer_id = "'.$id.'"');	
	}
	
	
	
	public function get_schloships()
    {
		$this->db->select('*');
		$this->db->from('myschlorship'); 
		$this->db->where('status','active');
		$this->db->where('type','Latest');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	
	
	public function get_schloshipssss($id)
    {
		$this->db->select('*');
		$this->db->from('myschlorship'); 
		$this->db->where('status','active');
		$this->db->where('type','Latest');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	
	
	public function get_my_scheme($id)
    {
		$this->db->select('*');
		$this->db->from('myschlorship'); 
		$this->db->where('status','active');
		$this->db->where('type','Others');
		$this->db->where('id',$id);
		$query = $this->db->get();
		return $query->result_array(); 
    } 
	
	
	
	
	
	
	
	
	
	
	public function get_govt_schloships()
    {
		$this->db->select('*');
		$this->db->from('myschlorship'); 
		$this->db->where('status','active');
		$this->db->where('type','Others');
		$query = $this->db->get();
		return $query->result_array(); 
    } 	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	

}
?>