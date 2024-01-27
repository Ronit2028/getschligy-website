<link rel="stylesheet" href="<?php echo base_url(); ?>assets/front/css/style-quiz.css">
<style>
	.Time {
	position: absolute;
	top: 22%;
	right: 15%;
	font-size: 19px;
}
</style>
<!--Page Title-->
  
				 <div class="breadcrumbs-img">
                    <img src="<?php echo base_url(); ?>campus/assets/images/breadcrumbs/quiz_bg.png" alt="Breadcrumbs Image">
                
				<div class="bread">
						<h1 class="title"><u>Scholarship Exam Question</u></h1>
				</div>
			</div> 
			
    <!--End Page Title-->
	
	<div class="container">
  <div class="page-content">

<div class="wizard-v10-content">
<div class="wizard-form">
<div class="wizard-header">
					<h3>Scholarship Exam Question</h3>
				</div>
				
<?php  if(!empty($quiz_ques)){ ?>				
<div id="form-total">
<?php 
 echo '<div class="panel" style="margin:5%">';
 echo '<b>Question &nbsp;'.$quiz_ques[0]['sn'].'&nbsp;:: '.$quiz_ques[0]['qns'].'</b>
 <h2 class="Time">Time Left</h2>
 <h1 class="remains"><br class="mar_kissan">
 <img src="'.base_url().'campus/assets/images/breadcrumbs/timmer.png">
 <span id="countdown" class="timer timer_kisaan"></span></h1><br />';
echo '<form action="" method="POST" id="myForm" class="form-horizontal">
<input type="hidden" name="qid" value="'.$quiz_ques[0]['qid'].'">
                        <br />'; 
						
			foreach ($q_ans as $res) {
                    $option=$res['option'];
                    $optionid=$res['optionid'];
 echo'<p class="'.$optionid.' red" ><label><input type="radio" name="ans" value="'.$optionid.'">&nbsp;'.$option.'</label></p>';
                        }
  echo'<br /><button id="submitBtn" type="submit" class="btn btn-primary pro-btn1"><span class="glyphicon glyphicon-lock" aria-hidden="true"></span>&nbsp;Submit</button></form>
  
  </div>';
	
?>	



</div>
<?php  }else{
    
 echo "<div class='not-found'> Question not Found  </div>";   

}

?>

</div>
</div>
</section>
</div>
</div>

</div>
</div>
</div>

 <script type="text/javascript"> 
        function preventBack() { 
            window.history.forward();  
        } 
        setTimeout("preventBack()", 0); 
        window.onunload = function () { null }; 

var timeleft = 99;
var downloadTimer = setInterval(function(){
  if(timeleft <= 0){
    clearInterval(downloadTimer);
    document.forms["myForm"].submit();
  } else {
    document.getElementById("countdown").innerHTML = timeleft;
  }
  timeleft -= 1;
}, 1000);

	
var fewSeconds = 3;
$('#submitBtn').click(function(){
	$('input[name = "ans"]:not(:checked)').attr('disabled', true);
    // Ajax request
    var btn = $(this);
    btn.prop('disabled', true);
    setTimeout(function(){
		document.forms["myForm"].submit();
        btn.prop('disabled', false);
    }, fewSeconds*1000);
});	
	



$(document).ready(function() {
  $('.pro-btn1').click(function() {
	  
	  var value = $("input:radio[name=ans]:checked").val();
	  
	  if(value != "<?php echo $qans[0]['ansid'];?>")
	 {
	  $(".<?php echo $qans[0]['ansid'];?>").removeClass("red"); 
	  $(".red").css({"background": "#aeaeae", "padding" :"5px 10px", "color": "white", "width": "fit-content"});
      }else{
		  
		$(".red").css({"background": "#aeaeae", "color": "white", "padding" :"5px 10px", "width": "fit-content"});  
		  
	  }
	 
      $(".<?php echo $qans[0]['ansid'];?>").css({"background": "#5cb85c", "padding" :"5px 10px", "color": "white", "width": "fit-content"});
	  
  })
});
 
    </script>

	