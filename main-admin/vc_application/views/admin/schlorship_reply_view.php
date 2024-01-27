	
     <style>
	 label.checkbox { padding-left: 20px;}
	 .add-more-d-area-div-parent input {margin-bottom: 6px;}
	 label.checkbox{font-weight:normal;}
	 </style>
      <div class="page-heading"><a class="btn btn-primary flr" href="<?php echo base_url().'admin/schlorship_reply'; ?>">Back</a>
        <h2> View Reply</h2>
      </div>
 
      <?php
      //flash messages
      if($this->session->flashdata('flash_message')){
        if($this->session->flashdata('flash_message') == 'updated')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Well done!</strong> Rooms updated successfully.';
          echo '</div>';       
        } elseif($image_error == 'true'){
			echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Image !</strong> should not be empty please upload image.';
            echo '</div>';  
		} else{
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo '<strong>Oh snap!</strong> change a few things up and try submitting again.';
          echo '</div>';          
        }
      }
	  //print_r($restaurants);
      ?>
      
      <?php
      //form data
      $attributes = array('class' => 'form', 'id' => '');

      //form validation
      echo validation_errors();
	  //print_r($editor);
      
      echo form_open_multipart('admin/schlorship_reply/view/'.$this->uri->segment(4).'', $attributes);
	 $prod = $reply_view[0];
	
      ?>
        <fieldset>
		
		
		  
		    <div class="form-group col-sm-6">
            <label  class="control-label ">Message</label>
               <textarea class="form-control"  readonly name="message"><?php if($this->input->post('message')!='') { echo $this->input->post('message'); } else { echo $prod['message']; } ?></textarea>
          </div>
		  
		  
		  
		 
		  
		  
		  
		  
          <div class="form-group  col-lg-12">
            <button class="btn btn-primary" type="submit">Updates</button> &nbsp; 
			 <a class="btn btn-primary" href="<?php echo base_url().'admin/webstores'; ?>">Cancel </a>
          </div>
        </fieldset>
      <?php echo form_close(); ?>
	  
	  <script src="http://cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'.textarea-editor',browser_spellcheck: true });</script>
  
  
  <script>
  
  
  $(document).ready(function() {
  $("#parent").click(function() {
    $(".child").prop("checked", this.checked);
  });

  $('.child').click(function() {
    if ($('.child:checked').length == $('.child').length) {
      $('#parent').prop('checked', true);
    } else {
      $('#parent').prop('checked', false); 
    }
  });
});
  
  jQuery('#loc').on('change',function(){
	 // alert();
        var locID = jQuery(this).val();
		
        if(locID){
           jQuery.ajax({
               type:'POST',
               url:'<?php echo base_url(); ?>index.php/vc_site_admin/pg/location',
                data:{l_id:locID},
                success:function(html){
                jQuery('#p_name').html(html);                   
                }
            }); 
        }else{
            jQuery('#p_name').html('<option value="">Select LOcation first</option>');
        } 

    }); 
  
  
  
  
  
  
  
  
  
  </script>
  
  
  
  
  
  
  
  