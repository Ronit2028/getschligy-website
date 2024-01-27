<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style-quiz.css">
<style>
.table td {
	font-weight: 500;
	text-align: center;
}
</style>
 <!--Page Title-->
  
				 <div class="breadcrumbs-img">
                    <img src="<?php echo base_url(); ?>campus/assets/images/breadcrumbs/quiz_bg.png" alt="Breadcrumbs Image">
                
				<div class="bread">
						<h1 class="title"><u>Scholarship Exam Result</u></h1>
				</div>
			</div>
			
    <!--End Page Title--> 
	
	<div class="container">
  <div class="page-content">

<div class="wizard-v10-content">
<div class="wizard-form">
<div class="wizard-header">
					<h3>Scholarship Exam Result</h3>
				</div>
<div id="form-total">

<?php
   echo  '<div class="panel">
                        <br /><table class="table table-striped title11" style="font-size:20px;font-weight:1000;">';

                         foreach ($result as $row) {
                            $s=$row['score'];
                            $w=$row['wrong'];
                            $r=$row['sahi'];
                            $qa=$row['level'];
                            echo '<tr style="color:#2785B5"><td>Total Questions</td><td class="no_right">'.$qa.'</td></tr>
                                <tr style="color:#99cc32"><td>Right Answer&nbsp;<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span></td><td class="no_right">'.$r.'</td></tr> 
                                <tr style="color:red"><td>Wrong Answer&nbsp;<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></td><td class="no_right">'.$w.'</td></tr>
                                <tr style="color:#000"><td>Scholarship Marks&nbsp;<span class="glyphicon glyphicon-star" aria-hidden="true"></span></td><td class="no_right">'.$s.'</td></tr>';
                        }
                        
                        echo '</table></div>';
                    
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


