<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style-quiz.css">
<!--Page Title-->
  
				 <div class="breadcrumbs-img">
                    <img src="<?php echo base_url(); ?>campus/assets/images/breadcrumbs/quiz_bg.png" alt="Breadcrumbs Image">
                
				<div class="bread"> 
						<h1 class="title"><u>Scholarship List</u></h1>
				</div>
			</div>
			
    <!--End Page Title-->
<div class="container">
  <div class="page-content">

<div class="wizard-v10-content">
<div class="wizard-form">
<div class="wizard-header">
					<h3>Scholarship List</h3>
				</div>
<div id="form-total">

          <div class="panel">
		  <div class="table-responsive">
		  <table class="table table-striped title1">
          <tr><td><center><b>S.No.</b></center></td><td><center><b>Topic</b></center></td><td><center><b>Total question</b></center></td><td><center><b>Points</center></b></td><td><center><b>Action</b></center></td></tr>

	<?php 
	
	if(!empty($quiz)) { 
	    
$items = array();
foreach($quiz_his as $qh) {
 $items[] = $qh['eid'];
}	    
$c=1;
						foreach ($quiz as $res) {
							
						$title = $res['title'];
                        $total = $res['total'];
                        $sahi = $res['sahi'];
                        $eid = $res['eid'];
							
		echo '<tr><td><center>'.$c++.'</center></td><td><center>'.$title.'</center></td><td><center>'.$total.'</center></td>
		<td>';
		if (in_array($eid, $items))
  {
   echo '<center>'.$sahi*$total.'</center></td><td><center><b><a href="quiz-result/'.$eid.'" class="btn sub1" style="color:black;margin:0px;background:#c93"><span class="title1"><b>Result</b></span></a></b></center>';
  }
else
  {
  echo '<center>'.$sahi*$total.'</center></td><td><center><b><a href="start-quiz/'.$eid.'/1/'.$total.'" class="btn sub1" style="color:black;margin:0px;background:#1de9b6"><span class="title1"><b>Start</b></span></a></b></center>';
  }
	echo '</td>
		</tr>';					
							
							
							?>


	<?php 
	} 
	}


 echo '</table></div></div>';	
	?>
	
	
</div>
</div>
</div>
</section>
</div>
</div>

</div>
</div>
</div>
	