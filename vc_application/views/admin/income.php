 
 <?php $this->load->view('includes/admin/sidebar'); ?>
 <!-- /.mainbar -->
 <?php $url = $this->uri->segment(3); ?>
 <div class="container"> 
 <div class="content">    
 <div class="content-container"> 
 <div class="col-sm-12">
	
      
 <div class="page-heading"> 
<a class="btn btn-primary flr" href="<?php echo base_url('admin');?>">Back</a>
        <h2><?php echo $page_title;?></h2>
      </div>
	  
	  
      
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> order updated with success.';
          echo '</div>';       
        }else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	 
	  //print_r($restaurants);
	$ms = array();	
	 ?>
	   
	   <form class="form form-inline" method="post" action="">
     
		<div class="form-group col-sm-3">
		<label>From :</label>
	  <input type="date" class="form-control" id="datepicker" required value="<?php if($this->input->post('s_name')!='') { echo $this->input->post('s_name'); }?>" name="sdate">
	  </div>
	  
	<div class="form-group col-sm-3">
	<label>To :</label>
		    <input type="date" class="form-control" id="datepicker1" required value="<?php if($this->input->post('e_name')!='') { echo $this->input->post('e_name'); }?>" name="edate"> 
		  </div>
		  
		  <div class="form-group col-sm-3">
		  <input type="submit" name="submit" class="btn btn-primary" value="Search"> 
		  </div>

  </form>
  <div class="clearfix">
  </div> 
  <div class="col-sm-12 incomme">
	 
<?php if($url == 'Direct-Sales-Incentive') { 

				$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Customer ID</th><th class="text-center">Name</th><th class="text-center">Order ID</th>
				<th class="text-center">DSI</th></tr>';

				$i = 1; 
				//echo "<pre>"; print_r($income); echo "</pre>";
				if(!empty($income)) {
					$tamount=0;
					
					foreach($income as $val){ //print_r($val);
						$amount = $val['amount'];
						$tamount = $tamount + $val['amount'];
						$date = $val['r_date'];
						if($amount > 0) {
							$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['customer_id'].'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$val['order_id'].'</td><td>'.$amount.'</td>
							
							</tr>';
							$i++;
						}
					}
				}
		else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }

} elseif($url == 'Team-Sales-Incentive') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Name</th><th class="text-center">User ID</th>
					<th class="text-center">Level</th><th class="text-center">TSI</th></tr>';

					$i = 1; 
					//echo "<pre>"; print_r($income); echo "</pre>";
					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$val['customer_id'].'</td><td>'.$val['pay_level'].'</td><td>'.$amount.'</td>
								
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}
 elseif($url == 'Self-Sales-Incentive') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Name</th><th class="text-center">User ID</th>
					<th class="text-center">Level</th><th class="text-center">TSI</th></tr>';

					$i = 1; 
					//echo "<pre>"; print_r($income); echo "</pre>";
					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$val['customer_id'].'</td><td>'.$val['pay_level'].'</td><td>'.$amount.'</td>
								
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}	
	elseif($url == 'Team-Performance-Share') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th>
				<th class="text-center">TPS</th></tr>';

					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
						$amount = $val['amount'];
						$tamount = $tamount + $val['amount'];
						$date = $val['r_date'];
						if($amount > 0) {
							$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$amount.'</td>
							
							</tr>';
							$i++;
						}
					}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}	

		elseif($url == 'Health-Care-Allowance') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Total LBV Sold Last Week</th><th class="text-center">Total Executive</th><th class="text-center">HCA</th>
					</tr>';
					//echo "<pre>"; print_r($income); echo "</pre>";
					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['fund'].'</td><td>'.$val['total_user'].'</td><td>'.$amount.'</td>
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}		elseif($url == 'Education-Allowance') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Total LBV Sold Last Week</th><th class="text-center">Total Assistant Manager</th><th class="text-center">EA</th>
					</tr>';

					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['fund'].'</td><td>'.$val['total_user'].'</td><td>'.$amount.'</td>
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}		elseif($url == 'Travel-Allowance') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Total LBV Sold Last Week</th><th class="text-center">Total Manager</th><th class="text-center">TA</th>
					</tr>';

					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['fund'].'</td><td>'.$val['total_user'].'</td><td>'.$amount.'</td>
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


}  

		elseif($url == 'Entertainment-Allowance') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Total LBV Sold Last Week</th><th class="text-center">Total Team Leader</th><th class="text-center">EA</th></tr>';

					$i = 1; 
					
					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.date('d F Y',strtotime($date)).'</td><td>'.$val['fund'].'</td><td>'.$val['total_user'].'</td><td>'.$amount.'</td>
								</tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }


} 

	elseif($url == 'Repurchase-Income') { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Name</th><th class="text-center">LRC</th><th class="text-center">LBV</th>
					<th class="text-center">Level</th><th class="text-center">RI</th></tr>';

					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.$val['order_id'].'</td><td>'.$val['customer_id'].'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$amount.'</td>
								
								<td>'.date('d F Y',strtotime($date)).'</td></tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }
					
					


}
		else { 

					$thead = '<tr> <th class="text-center">Sr.</th><th class="text-center">Date</th><th class="text-center">Name</th><th class="text-center">BV</th>
					<th class="text-center">Level</th><th class="text-center">RI</th></tr>';

					$i = 1; 

					if(!empty($income)) {
						$tamount=0;
						foreach($income as $val){ //print_r($val);
							$amount = $val['amount'];
							$tamount = $tamount + $val['amount'];
							$date = $val['r_date'];
							if($amount > 0) {
								$ms[] = '<tr><td>'.$i.'</td><td>'.$val['order_id'].'</td><td>'.$val['customer_id'].'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$amount.'</td>
								
								<td>'.date('d F Y',strtotime($date)).'</td></tr>';
								$i++;
							}
						}
					}
					else { $ms[] =  '<tr><td colspan="5">No records found.</td></tr>'; }
					
					


}
			
			?>

 <?php
      //form data
      $attributes = array('class' => 'form form-inline', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
     //echo form_open('admin/category/', $attributes);
      ?>
	  
	  <div class="table-responsive">
<table class="table table-bordered table-hover category-table"> 
<thead> <?php echo $thead; ?>  </thead> 
<tbody> 

<?php 
/* $i = 1; 
$url = $this->uri->segment(3);
if(!empty($income)) {
	$tamount=0;
	foreach($income as $val){ //print_r($val);
		$amount = $val['amount'];
		$tamount = $tamount + $val['amount'];
		$date = $val['r_date'];
		if($amount > 0) {
			$ms = '<tr><td>'.$i.'</td><td>#'.$val['order_id'].'</td><td>'.$val['customer_id'].'</td><td>'.$val['f_name'].' '.$val['l_name'].'</td><td>'.$amount.'</td>
			
			<td>'.date('d F Y',strtotime($date)).'</td></tr>';
			$i++;
		}
	}
}
else { echo '<tr><td colspan="5">No records found.</td></tr>'; } */

 foreach($ms as $td) {
	 
	 echo $td;
 }
	
?>
</tbody> 
<!-- 
 <tfoot>
    <tr>
	 <td colspan="3" ></td>
	 <td class="text-center"><b>TOTAL INCOME</b></td>
      <td class="text-center"><b><?php if(!empty($income)) { echo $tamount; } else {echo "0";}?> Rs</b></td>
	  <td></td>
    </tr>
  </tfoot> -->
</table>
</div>
</div>

	

</div></div></div></div>
 <?php //echo form_close(); ?>