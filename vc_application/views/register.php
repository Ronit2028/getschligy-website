<?php 
      //flash messages
      if($this->session->flashdata('register')){
        if($this->session->flashdata('register') == 'true')
        {
          echo '<div class="alert alert-success">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Register successfully please login now. Your user id is <b>'.$userregisterid.'</b>';
          echo '</div>';      
        } 
        if($this->session->flashdata('register') == 'already')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Email id is already register.';
          echo '</div>';       
        } 
        if($this->session->flashdata('register') == 'bliss_code')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'LA code is not exist. Please check your LA code.';
          echo '</div>';       
        }
	if($this->session->flashdata('register') == 'bliss_code_over')
        {
          echo '<div class="alert alert-danger">';
            echo '<a class="close" data-dismiss="alert">×</a>';
            echo 'Only 3 Direct Sales Permitted.';
          echo '</div>';       
        }
      }
	  
      //form validation
      echo validation_errors();