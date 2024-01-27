<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gallery extends CI_Controller {
	
	 public function __construct()
    {
        parent::__construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('gallery_model');
        $this->load->helper('string');		

        if(!$this->session->userdata('is_admin_logged_in')){ redirect('admin'); } 
    }
	
  public function index() {
    	
	$data['product'] = $this->gallery_model->get_all_product();
	
	//load the view
      $data['main_content'] = 'admin/gallery_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  
  public function yt_gallery() {
    	
	$data['product'] = $this->gallery_model->get_all_ytb_gallery();
	
	//load the view
      $data['main_content'] = 'admin/ytb_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('title', 'titlt', 'required|trim|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
				// file upload start here
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                       $image_data = $this->upload->data();
					   $image = $image_data['file_name'];
					}
            else
                    {
                         $errors = $this->upload->display_errors();
						$image = '';
			        }
					
		
			        //----- end file upload -----------
				
			
				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
					 'type' => $this->input->post('slider_image'),
					'image' => $image
				); 
                //if the insert has returned true then we show the flash message
				
				$true = $this->gallery_model->store_gallery($data_to_store);
				
				if($true == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					//redirect('admin/gallery/add');
					

                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/gallery_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
  
    
  public function ytb_add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('title', 'titlt', 'required|trim|min_length[4]');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
		
			        //----- end file upload -----------
				
			
				$data_to_store = array(
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'description' => $this->input->post('description'),
                    //'type' => $this->input->post('type'),
                    'status' => $this->input->post('status')
					
				); 
                //if the insert has returned true then we show the flash message
				
				$true = $this->gallery_model->store_yt($data_to_store);
				
				if($true == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/ytb/add');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/ytb_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
  
  
  
  public function update(){
	  	
	 
	  //product id 
       $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
		  // file upload start here
            	$image = 'noimg.jpg';
			$config['upload_path'] ='images/product/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
            //$config['max_width']  = '1600';
            //$config['max_height']  = '1600';
   		    $this->load->library('upload', $config);
		   if ($this->upload->do_upload('image'))
                    { 
                    if($this->input->post('image_old')!='') unlink('images/product/'.$this->input->post('image_old'));
                         $image_data = $this->upload->data();
					    $image = $image_data['file_name'];
					}
            else {
                        $errors = $this->upload->display_errors();
						$image = $this->input->post('image_old');
			        }
					
				
			     
			        //----- end file upload -----------
					
					
		
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'status' => $this->input->post('status'),
					 'type' => $this->input->post('slider_image'),
					'image' => $image
				); 
             $return = $this->gallery_model->update_product($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/gallery/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_product_id($id); 
        //load the view
        $data['main_content'] = 'admin/gallery_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  
    public function ytb_update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('title', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
				
			     
			        //----- end file upload -----------
					
					
		
                $data_to_store = array(
                    'title' => $this->input->post('title'),
                    'url' => $this->input->post('url'),
                    'description' => $this->input->post('description'),
                    //'type' => $this->input->post('type'),
                    'status' => $this->input->post('status')
				); 
             $return = $this->gallery_model->update_ytb($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/ytb/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_ytb_id($id); 
        //load the view
        $data['main_content'] = 'admin/ytb_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  
  public function quiz() {
    	
	$data['product'] = $this->gallery_model->get_all_quiz_questions();
	
	//load the view
      $data['main_content'] = 'admin/quiz_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function scholarship_results() {
    	
	$data['product'] = $this->gallery_model->get_all_quiz_result();
	
	//load the view
      $data['main_content'] = 'admin/quiz_result';
      $this->load->view('includes/admin/template', $data);   
  }
  
public function scholarship() {
        
    $data['scholarship'] = $this->gallery_model->get_all_scholarship();
    
    //load the view
      $data['main_content'] = 'admin/scholarship_list';
      $this->load->view('includes/admin/template', $data);   
  }
  
  public function quiz_add(){
	  
	  
            //form validation
            $this->form_validation->set_rules('name', 'name', 'required|trim|min_length[4]');
             $this->form_validation->set_rules('total', 'total', 'required|trim');
              $this->form_validation->set_rules('right', 'right', 'required|trim');
               $this->form_validation->set_rules('status', 'status', 'required|trim');
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
		
			        //----- end file upload -----------
				
			
				$data_to_store = array(
                    'title' => $this->input->post('name'),
                    'total' => $this->input->post('total'),
                    'sahi' => $this->input->post('right'),
                    'status' => $this->input->post('status')
				); 
                //if the insert has returned true then we show the flash message
				
				$true = $this->gallery_model->store_quiz($data_to_store);
				
				if($true >0 ){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/quiz/que/'.$true);
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
				
            }//validation run
        $data['main_content'] = 'admin/quiz_addnew'; 
        $this->load->view('includes/admin/template', $data); 
	  
  }
 
  public function quiz_question(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
        
      $data['quiz'] = $this->gallery_model->get_quiz_detail($id);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('cid', 'cid', 'required|trim');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
				
			     
			        //----- end file upload -----------
			        
      $ch=4;
			        
			      for($i=1;$i<=$data['quiz'][0]['total'];$i++)
      {
        $qid=uniqid();
        $qns=$this->input->post('qns'.$i);
        
        $this->gallery_model->store_menual('quiz_questions',array('eid' => $id,'qid' => $qid,'qns' => $qns,'choice' => $ch,'sn' => $i));
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        
        $a=$this->input->post($i.'1');
        $b=$this->input->post($i.'2');
        $c=$this->input->post($i.'3');
        $d=$this->input->post($i.'4');
        $qa=$this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $a,'optionid' => $oaid));
        $qb= $this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $b,'optionid' => $obid));
        $qc=$this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $c,'optionid' => $ocid));
        $qd= $this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $d,'optionid' => $odid));
        $e=$this->input->post('ans'.$i);
        switch($e)
        {
          case 'a': $ansid=$oaid; break;
          case 'b': $ansid=$obid; break;
          case 'c': $ansid=$ocid; break;
          case 'd': $ansid=$odid; break;
          default: $ansid=$oaid;
        }
    
     // $qans = array('title' => $qid,'url' => $ansid); 
      $this->gallery_model->store_menual('quiz_answer',array('qid' => $qid,'ansid' => $ansid));
      }
         
           $return =  'TRUE';
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/quiz/que/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
        $data['quiz'] = $this->gallery_model->get_quiz_detail($id);
        //load the view
        $data['main_content'] = 'admin/quiz_question'; 
        $this->load->view('includes/admin/template', $data); 
  }
  

  public function quiz_question_update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
        
      $data['quiz'] = $this->gallery_model->get_quiz_detail($id);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('cid', 'cid', 'required|trim');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
		
					
				
			     
			        //----- end file upload -----------
			        
      $ch=4;
			        
			      for($i=1;$i<=$data['quiz'][0]['total'];$i++)
      {
        $qid=uniqid();
        $qns=$this->input->post('qns'.$i);
        
        $this->gallery_model->store_menual('quiz_questions',array('eid' => $id,'qid' => $qid,'qns' => $qns,'choice' => $ch,'sn' => $i));
        $oaid=uniqid();
        $obid=uniqid();
        $ocid=uniqid();
        $odid=uniqid();
        
        $a=$this->input->post($i.'1');
        $b=$this->input->post($i.'2');
        $c=$this->input->post($i.'3');
        $d=$this->input->post($i.'4');
        $qa=$this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $a,'optionid' => $oaid));
        $qb= $this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $b,'optionid' => $obid));
        $qc=$this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $c,'optionid' => $ocid));
        $qd= $this->gallery_model->store_menual('quiz_options',array('qid' => $qid,'option' => $d,'optionid' => $odid));
        $e=$this->input->post('ans'.$i);
        switch($e)
        {
          case 'a': $ansid=$oaid; break;
          case 'b': $ansid=$obid; break;
          case 'c': $ansid=$ocid; break;
          case 'd': $ansid=$odid; break;
          default: $ansid=$oaid;
        }
    
     // $qans = array('title' => $qid,'url' => $ansid); 
      $this->gallery_model->store_menual('quiz_answer',array('qid' => $qid,'ansid' => $ansid));
      }
         
           $return =  'TRUE';
             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/quiz/que/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
        $data['quiz'] = $this->gallery_model->get_quiz_detail($id);
        $data['quiz_question'] = $this->gallery_model->get_quiz_question($id);
        //load the view
        $data['main_content'] = 'admin/quiz_question_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
 
 
  
  public function quiz_update(){
	  	
	 
	  //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST' && $id==$this->input->post('cid'))
        {
            /*form validation*/
           $this->form_validation->set_rules('name', 'title', 'required|trim|min_length[4]');

			
			
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
			        //----- end file upload -----------
					
              	$data_to_store = array(
                    'title' => $this->input->post('name'),
                    'total' => $this->input->post('question'),
                    'sahi' => $this->input->post('sahi'),
                    'status' => $this->input->post('status')
				); 
             $return = $this->gallery_model->update_quiz($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
					redirect('admin/quiz/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_quiz_question_ids($id); 
        //load the view
        $data['main_content'] = 'admin/quiz_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
  public function scholarship_update(){
        
     
      //product id 
        $id = $this->uri->segment(4);
  
        /*if save button was clicked, get the data sent via post*/
        if ($this->input->server('REQUEST_METHOD') === 'POST')
        {
            /*form validation*/
           $this->form_validation->set_rules('status', 'status', 'required');

            
            
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a><strong>', '</strong></div>');
            //if the form has passed through the validation
            if ($this->form_validation->run())
            { 
                    //----- end file upload -----------
                    
                $data_to_store = array(
                    'status' => $this->input->post('status')
                ); 
             $return = $this->gallery_model->update_scholarship($id, $data_to_store);

             if($return == TRUE){
                    $this->session->set_flashdata('flash_message', 'updated');
                    redirect('admin/scholarship/edit/'.$id.'');
                }else{
                    $this->session->set_flashdata('flash_message', 'not_updated');
                }
                

            }/*validation run*/

        }
       

        //if we are updating, and the data did not pass trough the validation
        //the code below wel reload the current data

      
       
        $data['product'] = $this->gallery_model->get_all_scholarship_ids($id); 
        //load the view
        $data['main_content'] = 'admin/scholarship_update'; 
        $this->load->view('includes/admin/template', $data); 
  }
  
    public function remove_img (){
	  $img = $_POST['img'];
	  if($img !=''){
		  unlink('images/product/'.$img);
	  }
  }
  public function del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_product($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/gallery');
 }  
 
 public function ytb_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_ytb($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/ytb');
 } 
 public function quiz_del(){
  
  $id = $this->uri->segment(4); 
		 $return = $this->gallery_model->delete_quiz($id); 
          $this->session->set_flashdata('delete', 'true'); 
	  redirect(base_url().'admin/quiz');
 }  
}