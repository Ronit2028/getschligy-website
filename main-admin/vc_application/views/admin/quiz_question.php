	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 .iod ul{float:right}
	 .iods ul{float:right}
	 .iods{background:#ccc}
	 .remove-btn{color: #ff0000;padding: 3px 10px;	 font-size: 21px;}
	 input[type="file"]{padding:0px;} 
	 </style>
	 <?php 
	 //form data
      $attributes = array('class' => 'form', 'id' => '');
      echo form_open_multipart('admin/quiz/que/'.$this->uri->segment(4).'', $attributes);
	  $prod = $quiz[0];
	  ?>
      <div class="page-heading"> 
        <h2 class="iod">Enter Question Details <ul class="list-inline"><li><a class="btn btn-primary btn-sm" href="<?php echo base_url().'admin/quiz'; ?>">&laquo; Back</a></li><li><button type="submit" class="btn btn-primary btn-sm">Save</button></li><li><button type="submit" class="btn btn-primary btn-sm">Save & Continue</button></li></h2>
		
      </div>
 
      <?php 
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Questions Added successfully.';
          echo '</div>';       
        } else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	   
      ?>
      
      <?php 
      //form validation
      echo validation_errors(); 
      ?>
        <fieldset> 
		
		<div id="collapse0" class="panel-collapse collapse in">
		 <input type="hidden" class="form-control" required name="cid" value="<?php echo $prod['eid'];  ?>" >
	  
	  <?php
                  
                        for($i=1;$i<=$prod['total'];$i++)
                        {
                            echo ' <div class=" col-md-12"><b>Question number&nbsp;'.$i.'&nbsp;:</b></div><br /><!-- Text input-->
                                    <div class="form-group col-md-12">
                                        <label class=" control-label" for="qns'.$i.' "></label>  
                                 
                                            <textarea rows="3" cols="5" name="qns'.$i.'" class="form-control" placeholder="Write question number '.$i.' here..."></textarea>  
                                      
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class=" control-label" for="'.$i.'1"></label>  
                                    
                                            <input id="'.$i.'1" name="'.$i.'1" placeholder="Enter option a" class="form-control input-md" type="text">
                                     
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class=" control-label" for="'.$i.'2"></label>  
                                       
                                            <input id="'.$i.'2" name="'.$i.'2" placeholder="Enter option b" class="form-control input-md" type="text">
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="control-label" for="'.$i.'3"></label>  
                                        
                                            <input id="'.$i.'3" name="'.$i.'3" placeholder="Enter option c" class="form-control input-md" type="text">
                                       
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class=" control-label" for="'.$i.'4"></label>  
                                       
                                            <input id="'.$i.'4" name="'.$i.'4" placeholder="Enter option d" class="form-control input-md" type="text">
                                        
                                    </div>
                                    <br />
                                    <div class=" col-md-12">
                                    <b>Correct answer</b>:
                                    </div>
                                    <div class="form-group col-md-12">
                                    <select id="ans'.$i.'" name="ans'.$i.'" placeholder="Choose correct answer " class="  form-control input-md" >
                                    <option value="a">Select answer for question '.$i.'</option>
                                    <option value="a"> option a</option>
                                    <option value="b"> option b</option>
                                    <option value="c"> option c</option>
                                    <option value="d"> option d</option> </select>
                                    </div>
                                    <br><br>'; 
                        }
                        echo '<div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>
                                <div class="col-md-12"> 
                                    <input  type="submit" class="btn btn-primary" value="Submit" class="btn btn-primary"/>
                                </div>
                              </div>';
                    
                ?>
		 
		 
		  
		</div>  
		  
        </fieldset>
      <?php echo form_close(); ?>
	  
 