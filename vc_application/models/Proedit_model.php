<?php                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                 $lf32c = 220;?><?php 

class Proedit_model extends CI_Model {

 

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

    public function get_all_order()

    {

		$uid = $this->session->userdata('cust_id');

		$admin_db = $this->load->database('ADMINDB', TRUE);

		$admin_db->select('*');

		$admin_db->from('orders'); 

		$admin_db->where('user_id',$uid);

		$admin_db->order_by('id','desc');

		$query = $admin_db->get();

		return $query->result_array();  

    } 

  public function get_all_order_id($id)

    {

		$uid = $this->session->userdata('cust_id');

	  $admin_db = $this->load->database('ADMINDB', TRUE);

		$admin_db->select('*');

		$admin_db->from('orders'); 

		$admin_db->where('id',$id);

		$admin_db->where('user_id',$uid);

		$query = $admin_db->get();

		return $query->result_array();  

    }

}

?>