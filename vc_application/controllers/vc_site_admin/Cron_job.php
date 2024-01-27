<?php																																										
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cron_job extends CI_Controller {

	 public function __construct(){

        parent::__construct();

        //$this->load->library('session');
        $this->load->helper('url');
        //$this->load->helper('form');
        //$this->load->library('form_validation');
         $this->load->model('Cron_model');	
    }

  public function index() {
 
	  ///index.php/vc_site_admin/cron_job

	  // curl -s "http://domain.com/index.php/vc_site_admin/cron_job/index"

	//$date = date('Y-m-',strtotime("-1 month",strtotime(date('Y-m-d'))));

	   $date = date('Y-m-d');

	 $nextdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime(date('Y-m-d'))));

	 $currentdate = date('Y-m-d H:i:s');
/*
	$allsalary = $this->Users_model->get_salary($currentdate);

	//print_r($allsalary); die('sdf');

	if(!empty($allsalary)) {
foreach($allsalary as $salary) {
	
	if($salary['user_id']!='' && $salary['amount']!='' && $salary['tmonth'] > 0) {
		$month = $salary['tmonth'] - 1; 
		$description = $salary['description'].'~-~'.$currentdate;
		$update_salary = array('tmonth'=>$month,'description'=>$description,'pay_date'=>$nextdate);
		$this->Users_model->update_salary($salary['id'],$update_salary);
		//print_r($update_salary);
		$add_income = array('amount'=>$salary['amount'],'user_id'=>$salary['user_id'],'type'=>'Salary','status'=>'Active');
		$this->Users_model->add_income($add_income);
		//print_r($add_income);
	}
}

	}
*/
  }
  
  
 //http://shoppersearning.33demo.com/index.php/vc_site_admin/cron_job/repurchase_income
 
 
 public function repurchase_income() {
	 $incentive = $this->Cron_model->get_incentive();
	 if(!empty($incentive)) {
		//echo '<prE>';print_r($incentive);die();
	  foreach($incentive as $salary) {
		if($salary['child_lbv'] >= 500) {
			$update_royalti = array('rep_club'=>'1');
			$this->Cron_model->update_repurchase($salary['id'],$update_royalti);
		}
	   }
	  }
 } 
 
 public function health_care() {
//vc_site_admin/cron_job/health_care
//'2018-11-08 00:00:01'; //
    $sdate = date('Y-m-d 00:00:01',strtotime("last thursday"));
    $date = date('Y-m-d',strtotime("last thursday"));
    $edate = date('Y-m-d 23:59:59',strtotime("+6 days",strtotime($sdate))); 
	
$get_fund_log = $this->Cron_model->get_fund_log_by_type('Health Care Fund', $date);
if(!empty($get_fund_log)) { die(); }
 
$saleid = $this->Cron_model->get_total_sale($sdate, $edate);
 
$distribution_amount = $saleid[0]['tot_lbv_amt'] * 100;

 if($saleid!='' && $distribution_amount > 0) { 
  $assistant_managers = $this->Cron_model->get_healthcarefund_users();
 //echo '<pre>'; print_r($assistant_managers);
	if(!empty($assistant_managers) && count($assistant_managers) > 0) { 
		$dis_amount = (5 / 100) * $distribution_amount;
		$final_dis_amount = $dis_amount / count($assistant_managers);
		$final_dis_amount = round($final_dis_amount,2);


		//////////// insert fund log //////
		$description = 'Percentage: 5-~-Users: '.count($assistant_managers).'-~-Amount: '.$distribution_amount.'-~-Distribute: '.$dis_amount.'-~-Distribute Each: '.$final_dis_amount.'';
		$add_fund_log = array('fund'=>$distribution_amount,'distribure_date'=>$date,'d_start'=>'Yes','d_end'=>'No','type'=>'Health Care Fund','description'=>$description);
	    $this->Cron_model->insert_data_in_table($add_fund_log,'fund_log'); 
		foreach($assistant_managers as $uid) { 
			$caping = 0;
			if($uid['grade']=='Representative') { $caping = 10000; }
			elseif($uid['grade']=='Associate') { $caping = 25000;}
			elseif($uid['grade']=='Distributor') { $caping = 50000;  }
			elseif($uid['grade']=='Stockist') { $caping = 9999999999;  }
			
			$final_income = $final_dis_amount + 0;
			
			  //if(($uid['active_child'] > 1 && $uid['child_lbv'] > 49) || $uid['bsacode'] =='Team Leader') {
			  if($final_income > 0) {
			    $add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$uid['id'],'type'=>'Health Care Fund','status'=>'Active','r_date'=>$edate);
	            $this->Cron_model->insert_data_in_table($add_income);  
			  }
		}
		//////////// update fund log //////
		$this->Cron_model->update_fund_log('Health Care Fund', $date);
		
		}  
	}
	
 }

   public function education_fund() {
	//vc_site_admin/cron_job/education_fund
	//'2018-11-08 00:00:01'; //
    $sdate = date('Y-m-d 00:00:01',strtotime("last thursday"));
    $date = date('Y-m-d',strtotime("last thursday"));
    $edate = date('Y-m-d 23:59:59',strtotime("+6 days",strtotime($sdate))); 
	
$get_fund_log = $this->Cron_model->get_fund_log_by_type('Education Fund', $date);
if(!empty($get_fund_log)) { die(); }

$saleid = $this->Cron_model->get_total_sale($sdate, $edate);

$distribution_amount = $saleid[0]['tot_lbv_amt'] * 100;

 if($saleid!='' && $distribution_amount > 1) {
  $assistant_managers = $this->Cron_model->get_educationfund_users();
  //print_r($assistant_managers);die();
	if(!empty($assistant_managers) && count($assistant_managers) > 0) {
		$dis_amount = (10 / 100) * $distribution_amount;
		$final_dis_amount = $dis_amount / count($assistant_managers);
		$final_dis_amount = round($final_dis_amount,2);


		//////////// insert fund log //////
		$description = 'Percentage: 10-~-Users: '.count($assistant_managers).'-~-Amount: '.$distribution_amount.'-~-Distribute: '.$dis_amount.'-~-Distribute Each: '.$final_dis_amount.'';
		$add_fund_log = array('fund'=>$distribution_amount,'distribure_date'=>$date,'d_start'=>'Yes','d_end'=>'No','type'=>'Education Fund','description'=>$description);
	    $this->Cron_model->insert_data_in_table($add_fund_log,'fund_log'); 
		
		foreach($assistant_managers as $uid) {
			$caping = 0;
			if($uid['grade']=='Representative') { $caping = 10000; }
			elseif($uid['grade']=='Associate') { $caping = 25000;}
			elseif($uid['grade']=='Distributor') { $caping = 50000;  }
			elseif($uid['grade']=='Stockist') { $caping = 9999999999;  }
			
			//$total_incomes =  $this->weekly_income_by_user($sdate,$edate,$uid['id']);
			//if($total_incomes < $caping) {
			  $final_income = $final_dis_amount;
			  
			  if(($uid['active_child'] > 3 && $uid['child_lbv'] > 99) || $uid['bsacode'] =='Team Leader') {
			    $add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$uid['id'],'type'=>'Education Fund','status'=>'Active','r_date'=>$edate);
	            $this->Cron_model->insert_data_in_table($add_income); 
			  } else {
				$add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$uid['id'],'type'=>'Education Fund','status'=>'Active','r_date'=>$edate);
	            $this->Cron_model->insert_data_in_table($add_income,'income_pending');  
			  }
			//}
		} 
		//////////// update fund log //////
		$this->Cron_model->update_fund_log('Education Fund', $date);
		}
	}
	
 }

   public function travel_fund() {
	//vc_site_admin/cron_job/travel_fund
   $sdate = date('Y-m-d 00:00:01',strtotime("last thursday"));
    $date = date('Y-m-d',strtotime("last thursday"));
    $edate = date('Y-m-d 23:59:59',strtotime("+6 days",strtotime($sdate))); 

$get_fund_log = $this->Cron_model->get_fund_log_by_type('Travel Fund', $date);
if(!empty($get_fund_log)) { die(); }

$saleid = $this->Cron_model->get_total_sale($sdate, $edate);

$distribution_amount = $saleid[0]['tot_lbv_amt'] * 100;

 if($saleid!='' && $distribution_amount!='' && $distribution_amount > 1) {
  $manager = $this->Cron_model->get_travelfund_users();
  
	if(!empty($manager) && count($manager) > 0) {
		$dis_amount = (5 / 100) * $distribution_amount;
		$final_dis_amount = $dis_amount / count($manager);
		$final_dis_amount = round($final_dis_amount,2);

		//////////// insert fund log //////
		$description = 'Percentage: 5-~-Users: '.count($manager).'-~-Amount: '.$distribution_amount.'-~-Distribute: '.$dis_amount.'-~-Distribute Each: '.$final_dis_amount.'';
		$add_fund_log = array('fund'=>$distribution_amount,'distribure_date'=>$date,'d_start'=>'Yes','d_end'=>'No','type'=>'Travel Fund','description'=>$description);
	    $this->Cron_model->insert_data_in_table($add_fund_log,'fund_log'); 
		
		foreach($manager as $uid) {
			$caping = 0;
			if($uid['grade']=='Representative') { $caping = 10000; }
			elseif($uid['grade']=='Associate') { $caping = 25000;}
			elseif($uid['grade']=='Distributor') { $caping = 50000;  }
			elseif($uid['grade']=='Stockist') { $caping = 9999999999;  }
			
			//$total_incomes =  $this->weekly_income_by_user($sdate,$edate,$uid['id']);
			//if($total_incomes < $caping) {
			  $final_income = $final_dis_amount; 
			  if($final_income > 0) {
			    $add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$uid['id'],'type'=>'Travel Fund','status'=>'Active','r_date'=>$edate);
	            $this->Cron_model->insert_data_in_table($add_income); 
			  }
			//}
		}
		//////////// update fund log //////
		$this->Cron_model->update_fund_log('Travel Fund', $date);
		 
		}
	}
	
 }

 public function entertainment_fund() {
		//vc_site_admin/cron_job/entertainment_fund
   $sdate = date('Y-m-d 00:00:01',strtotime("last thursday"));
    $date = date('Y-m-d',strtotime("last thursday"));
    $edate = date('Y-m-d 23:59:59',strtotime("+6 days",strtotime($sdate))); 

$get_fund_log = $this->Cron_model->get_fund_log_by_type('Entertainment Fund', $date);
if(!empty($get_fund_log)) { die(); }

$saleid = $this->Cron_model->get_total_sale($sdate, $edate);

$distribution_amount = $saleid[0]['tot_lbv_amt'] * 100;

 if($saleid!='' && $distribution_amount!='' && $distribution_amount > 1) {
  $manager = $this->Cron_model->get_entertainmentfund_users();
  //print_r($assistant_managers);die();
	if(!empty($manager) && count($manager) > 0) {
		$dis_amount = (10 / 100) * $distribution_amount;
		$final_dis_amount = $dis_amount / count($manager);
		$final_dis_amount = round($final_dis_amount,2);

		//////////// insert fund log //////
		$description = 'Percentage: 10-~-Users: '.count($manager).'-~-Amount: '.$distribution_amount.'-~-Distribute: '.$dis_amount.'-~-Distribute Each: '.$final_dis_amount.'';
		$add_fund_log = array('fund'=>$distribution_amount,'distribure_date'=>$date,'d_start'=>'Yes','d_end'=>'No','type'=>'Entertainment Fund','description'=>$description);
	    $this->Cron_model->insert_data_in_table($add_fund_log,'fund_log'); 
		
		foreach($manager as $uid) {
			$caping = 0;
			if($uid['grade']=='Representative') { $caping = 10000; }
			elseif($uid['grade']=='Associate') { $caping = 25000;}
			elseif($uid['grade']=='Distributor') { $caping = 50000;  }
			elseif($uid['grade']=='Stockist') { $caping = 9999999999;  }
			
			//$total_incomes =  $this->weekly_income_by_user($sdate,$edate,$uid['id']);
			//if($total_incomes < $caping) {
			  $final_income = $final_dis_amount; 
			  $add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$uid['id'],'type'=>'Entertainment Fund','status'=>'Active','r_date'=>$edate);
	          $this->Cron_model->insert_data_in_table($add_income); 
			//}
		}
		//////////// update fund log //////
		$this->Cron_model->update_fund_log('Entertainment Fund', $date);
		}
	}
 }

 public function team_performance_share() {
//vc_site_admin/cron_job/team_performance_share

     $sdate = date('Y-m-d 00:00:01',strtotime("last thursday"));
    $date = date('Y-m-d',strtotime("last thursday"));
     $edate = date('Y-m-d 23:59:59',strtotime("+6 days",strtotime($sdate))); 
		
	$get_fund_log = $this->Cron_model->get_fund_log_by_type('Team Performance Share', $date);
	if(!empty($get_fund_log)) { die(); }
	 
	$users = $users_ids = array(); 

	$total_income = $this->Cron_model->get_total_income($sdate, $edate);
	//echo count($total_income).' ';//echo '<pre>';print_r($total_income);echo '</prE>';
	if(!empty($total_income)) {
		foreach($total_income as $incomess) {
			if($incomess['pid']=='') { }
			elseif(!in_array($incomess['pid'],$users_ids)) {
				$users[$incomess['pid']] = $incomess;
				$users_ids[] = $incomess['pid'];
			} else {
				$users[$incomess['pid']]['amt'] = $users[$incomess['pid']]['amt'] + $incomess['amt'];
			}
		}
	}
	// echo '<pre>';echo count($users).' ';print_r($users);echo '</prE>';die(); 

	//////////// insert fund log //////
	$description = 'Percentage: 10-~-Users: '.count($users).'';
	$add_fund_log = array('fund'=>'0','distribure_date'=>$date,'d_start'=>'Yes','d_end'=>'No','type'=>'Team Performance Share','description'=>$description);
	$this->Cron_model->insert_data_in_table($add_fund_log,'fund_log'); 
	//	echo '<pre>';print_r($users);die();
  if(!empty($users) && count($users) > 0) { 
	foreach($users as $user){
	  $caping = 0;
	  if($user['pgrade']=='Representative') { $caping = 10000; }
	  elseif($user['pgrade']=='Associate') { $caping = 25000;}
	  elseif($user['pgrade']=='Distributor') { $caping = 50000;  }
	  elseif($user['pgrade']=='Stockist') { $caping = 9999999999;  }
	  //$total_incomes =  $this->weekly_income_by_user($sdate,$edate,$user['pid']);
	  
	  //if($user['amt'] > 0 && $user['pid'] > 0 && $user['user_id'] > 0 && $total_incomes < $caping){
	  if($user['amt'] > 0 && $user['pid'] > 0 && $user['user_id'] > 0){
		$dis_amount = (10 / 100) * $user['amt']; 
		$final_dis_amount = round($dis_amount,2);
		
		$final_income = $final_dis_amount;
		
		if($final_income > 0) {
		  if($user['pactive_child'] > 1) {
			$add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$user['pid'],'type'=>'Team Performance Share','status'=>'Active','r_date'=>$edate);
	        $this->Cron_model->insert_data_in_table($add_income);  
		  } else {
			$add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$user['pid'],'type'=>'Team Performance Share','status'=>'Active','r_date'=>$edate);
	        $this->Cron_model->insert_data_in_table($add_income,'income_pending');  
		  }
		   
		}		
	  }
	}
  }	
//////////// update fund log //////
$this->Cron_model->update_fund_log('Team Performance Share', $date);
	
 }

 function add_pending_payment(){
		//vc_site_admin/cron_job/add_pending_payment
		$health_fund_rank = array('Marketing Executive','Assistant Managers','Manager','Team Leader');
		$health_fund_grade = array('Distributor','Stockist');
		$education_fund_rank = array('Assistant Managers','Manager','Team Leader');
		$users = $this->Cron_model->get_pending_payment();
		if(!empty($users)) {
			$r_date = date('Y-m-d H:i:s');
		   foreach($users as $user) {
			   
			  
			if($user['type']=='Team Sales Incentive' && $user['active_child'] > 3) {
				$add_income= array('order_id'=>$user['order_id'],'amount'=>$user['amount'],'user_send_by'=>$user['user_send_by'],'pay_level'=>$user['pay_level'],'user_id'=>$user['user_id'],'type'=>'Team Sales Incentive','status'=>'Active','r_date'=>$r_date);
				$this->Cron_model->insert_data_in_table($add_income); 
				$update_data = array('status'=>'Clear');
				$this->Cron_model->update_data_in_table($user['id'],$update_data,'income_pending'); 
			}
			if($user['type']=='Repurchase Incentive' && $user['active_child'] > 3) {
				$add_income= array('order_id'=>$user['order_id'],'amount'=>$user['amount'],'user_send_by'=>$user['user_send_by'],'pay_level'=>$user['pay_level'],'user_id'=>$user['user_id'],'type'=>'Repurchase Incentive','status'=>'Active','r_date'=>$r_date);
				$this->Cron_model->insert_data_in_table($add_income); 
				$update_data = array('status'=>'Clear');
				$this->Cron_model->update_data_in_table($user['id'],$update_data,'income_pending'); 
			}
			if($user['type']=='Team Performance Share' && $user['active_child'] > 1) {
				$add_income= array('order_id'=>$user['order_id'],'amount'=>$user['amount'],'user_send_by'=>$user['user_send_by'],'pay_level'=>$user['pay_level'],'user_id'=>$user['user_id'],'type'=>'Team Performance Share','status'=>'Active','r_date'=>$r_date);
				$this->Cron_model->insert_data_in_table($add_income); 
				$update_data = array('status'=>'Clear');
				$this->Cron_model->update_data_in_table($user['id'],$update_data,'income_pending'); 
			}
			
			if($user['type']=='Health Care Fund' && $user['active_child'] > 1 && $user['child_lbv'] > 49 && (in_array($user['bsacode'],$health_fund_rank))) { $add_health_care='yes'; }
			elseif($user['type']=='Health Care Fund' && ($user['bsacode']=='Team Leader' || in_array($user['bsacode'],$health_fund_grade))) { $add_health_care='yes'; }
			else { $add_health_care='no'; }
			if($add_health_care=='yes') {
				$add_income= array('order_id'=>'0','amount'=>$user['amount'],'user_send_by'=>'0','user_id'=>$user['user_id'],'type'=>'Health Care Fund','status'=>'Active','r_date'=>$r_date);
				$this->Cron_model->insert_data_in_table($add_income); 
				$update_data = array('status'=>'Clear');
				$this->Cron_model->update_data_in_table($user['id'],$update_data,'income_pending'); 
			}
			
			if($user['type']=='Education Fund' && $user['active_child'] > 3 && $user['child_lbv'] > 99 && (in_array($user['bsacode'],$education_fund_rank))) { $add_eduction_fund='yes'; }
			elseif($user['type']=='Education Fund' && $user['bsacode']=='Team Leader') { $add_eduction_fund='yes'; }
			else { $add_eduction_fund='no'; }
			
			if($add_eduction_fund=='yes') {
				$add_income= array('order_id'=>'0','amount'=>$user['amount'],'user_send_by'=>'0','user_id'=>$user['user_id'],'type'=>'Health Care Fund','status'=>'Active','r_date'=>$r_date);
				$this->Cron_model->insert_data_in_table($add_income); 
				$update_data = array('status'=>'Clear');
				$this->Cron_model->update_data_in_table($user['id'],$update_data,'income_pending'); 
			}
		   }
		}
 }
 public function weekly_income_by_user($sdate,$edate,$userid){
		//$total_income_da = $this->Cron_model->get_weekly_total_income_da($sdate,$edate, $userid);
		$total_income = $this->Cron_model->get_weekly_total_income($sdate,$edate, $userid);
		//$total_incomes =  $total_income_da[0]['amount'] + $total_income[0]['amount'] + 0;
		$total_incomes =  $total_income[0]['amount'] + 0;
		return $total_incomes;
	}
	
	function cron_rank(){
		//vc_site_admin/cron_job/cron_rank
		$users = $this->Cron_model->get_cron_update_rank_users();
		if(!empty($users)) {
		   foreach($users as $user) {
				$parent_customer_id = $user['distribure_date'];
					$p = 0;
					while($p < 1) {
						$parent_user = $this->Cron_model->profile_for_update_rank($parent_customer_id);
						//if(!empty($parent_user) && $parent_user[0]['bsacode']==$p_c_position) {
						if(!empty($parent_user)) {
						  $this->update_rank($parent_user[0]['id'],$parent_user[0]['customer_id'],$parent_user[0]['bsacode'],$parent_user[0]['active_child'],$parent_user[0]['child_lbv']);

						  $parent_customer_id = $parent_user[0]['parent_customer_id'];
						  $p = 0;
						} else { $p++; }
					}
				$this->Cron_model->update_fund_log_by_id($user['id']);
			}		
		}
	}
	function update_rank($id,$customer_id,$rank,$active_child,$child_lbv){ 
	     $rank_grade = array('norank'=>0,'Marketing Executive'=>1,'Assitant Manager'=>2,'Manager'=>3,'Team Leader'=>4);
	     $count_rank = 0;
		 if($rank=='') { $rank = 'norank'; }
		$child_users = $this->Cron_model->get_child_users($customer_id);
		if(!empty($child_users)) {
			foreach($child_users as $child) {
				if($child['bsacode']=='Assistant Manager') { $count_rank = $count_rank  + 1; }
				if($child['bsacode']=='Manager') { $count_rank = $count_rank  + 1; }
				if($child['bsacode']=='Team Leader') { $count_rank = $count_rank  + 1; }
			}
		}
		if($count_rank > 1) { $current_rank = 'Team Leader'; }
		elseif($count_rank > 0) { $current_rank = 'Manager'; }
		elseif($active_child > 3 && $child_lbv > 99) { $current_rank = 'Assitant Manager'; }
		elseif($active_child > 1 && $child_lbv > 49) { $current_rank = 'Marketing Executive'; }
		else { $current_rank = 'norank'; }
		 
		if($rank_grade[$rank] < $rank_grade[$current_rank] && $current_rank != 'norank') {
			$data_to_store = array('bsacode'=>$current_rank);
			$this->Cron_model->update_profile($id, $data_to_store);
		}
	 
	 }

public function marketing_expense() { 
   ///vc_site_admin/cron_job/marketing_expense 
 $date = date('Y-m-');
 
 $nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime(date('Y-m-d'))));
 $currentdate = date('Y-m-d H:i:s');
 
 
 $allsalary = $this->Cron_model->get_salary($date);
 
 //print_r($allsalary);
  
 if(!empty($allsalary)) { 
  foreach($allsalary as $salary) {
    
   if($salary['user_id'] > 0 && $salary['amount'] > 0 && $salary['tday'] > 0) {
    $tday = $salary['tday'] - 1;   
	//$currentdate = $salary['pay_date']; 
	
	$sdate = date('Y-m-01 00:00:01',strtotime("- 1 month",strtotime(date('Y-m-d'))));
	$edate = date('Y-m-t 23:59:59',strtotime("- 1 month",strtotime(date('Y-m-d'))));
	$total_incomes = $this->Cron_model->get_weekly_total_income($sdate, $edate,$salary['user_id']); 
	$total_income = $total_incomes[0]['amount'] + 0;
	$total_income = round($total_income,2);
	
	
	$user_total_incomes = $this->Cron_model->get_user_total_income($salary['user_id']); 
	$user_total_income = $user_total_incomes[0]['amount'] + 0;
	$user_total_income = round($user_total_income,2);
	$total_12_month_amt = $salary['amount'] * 12;
	if($user_total_income >= $total_12_month_amt) {
		$nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime($salary['pay_date'])));
		$description = $salary['description'].'~-~no-last-'.$total_income.'-'.$currentdate;
		$update_salary = array('tday'=>'0','description'=>$description,'pay_date'=>$nexttdate);
		$this->Users_model->update_salary($salary['id'],$update_salary);
	}
	elseif($total_income < $salary['amount']) {
	   $add_income_tf = 'true';
		if($tday <= 5) {
			$add_income_tf = 'false';
			$tday = 0;
			$userinfo = $this->Cron_model->get_user_info($salary['user_id']);
			if(!empty($userinfo)) {
				if($userinfo[0]['active_child'] > 1 && $userinfo[0]['child_lbv'] >= 50) { $add_income_tf = 'true'; $tday = $salary['tday'] - 1;  }
			}
		}
		$nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime($salary['pay_date'])));
		$description = $salary['description'].'~-~yes-'.$total_income.'-'.$currentdate;
		$update_salary = array('tday'=>$tday,'description'=>$description,'pay_date'=>$nexttdate);
		$this->Users_model->update_salary($salary['id'],$update_salary);
		$final_income = $salary['amount'] - $total_income;
		
		if($final_income > 0 && $add_income_tf == 'true') {
		  $add_income= array('order_id'=>'0','amount'=>$final_income,'user_send_by'=>'0','user_id'=>$salary['user_id'],'type'=>'Marketing Expense','status'=>'Active','r_date'=>$edate);
	      $this->Cron_model->insert_data_in_table($add_income); 
		}
	} 
	else {
		$nexttdate = date('Y-m-d H:i:s',strtotime("+ 1 month",strtotime($salary['pay_date'])));
		$description = $salary['description'].'~-~no-'.$total_income.'-'.$currentdate;
		$update_salary = array('tday'=>$tday,'description'=>$description,'pay_date'=>$nexttdate);
		$this->Users_model->update_salary($salary['id'],$update_salary);
	}
   }
  }
 }
  
  }	 
}
?>