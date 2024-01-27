
		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="assets/images/scholarship.jpg" alt="Breadcrumbs Image">
                </div>
    <!--            <div class="breadcrumbs-text white-color">-->
				<!--<a href="#">-->
    <!--                <h1 class="page-title">Scholarship</h1>-->
				<!--	</a>-->
    <!--                <ul>-->
    <!--                    <li>The best way to predict the future is to create it </li>-->
    <!--                </ul>-->
    <!--            </div>-->
            </div>


		<div class="rs-cta learning">
                <div class="cta-img">
                    <img src="assets/images/cta/cta-bg.jpg" alt="">
                </div>
                <div class="cta-content text-center">
                    <div class="sec-title mb-40 md-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                        <a href="https://www.getscholify.com/ApplyNow/"><img src="campus/assets/images/breadcrumbs/get_upto.jpg" alt="Breadcrumbs Image"></a>   
                    </div>
                 
                </div>
            </div>
			
			<div class="rs-cta learning">
                <div class="cta-img">
                    <img src="campus/assets/images/breadcrumbs/flowchart.jpg" alt="">
                </div>
                <div class="cta-content text-center">
                    <div class="sec-title mb-40 md-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                         
                    </div>
                 
                </div>
            </div>


					<div class="rs-inner-blog orange-color Intellectual pt-70 pb-70 md-pt-70 md-pb-70">
						  <div class="">
							<h2 class="title mb-16 md-mb-10">Getscholify  <span>Intellectual Empowerment with financing</span></h2>
						  <div class="row">
							<div class="col-lg-4 col-md-12 order-last">
								<div class="widget-area">
								
                            <div class="recent-posts-widget mb-50">
								<h3 class="widget-title">Other Govt. Scholarship Schemes</h3>
								<marquee behavior="scroll" direction="up" onmouseover="stop()" onmouseout="start()" height="600px" scrollamount="5">
								
								<div class="scrll">
								<?php if(!empty($govt_schloships)){
									foreach($govt_schloships as $gov){?>
                                <div class="blog-item">
                                        <div class="blog-img">
                                           <?php if($gov['image'] !='') { echo '<img src="'.base_url().'main-admin/images/'.$gov['image'].'">'; }else{echo '<img src="'.base_url().'main-admin/images/1.jpg">';} ?>
                                        </div>
                                        <div class="blog-content">
                                            <h3 class="blog-title"><a href="<?php echo base_url(); ?>scholar_more"><?php echo $gov['title'];?></a></h3>
                                             
                                            <div class="blog-desc"> <?php echo substr($gov['discription'],0, 400);?>  </div>
                                            <div class="blog-button">
                                                <a class="Enroll" href="<?php echo base_url(); ?>scholar_more/<?php echo $gov['id']; ?>">Read More</a>
                                            </div>
											<div class="blog-button">
                                                <a class="Enroll" href="https://www.getscholify.com/ApplyNow/">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>
									<?php }
								}
								?>
								<!--<div class="blog-item">
                                        <div class="blog-img">
                                            <a href="#"><img src="campus/assets/images/blog/inner/1.jpg" alt=""></a>
                                        </div>
                                        <div class="blog-content">
                                            <h3 class="blog-title"><a href="#">Fully Funded Scholarship</a></h3>
                                            
                                            <div class="blog-desc"> Under our fully funded scholarship scheme we grant 100% scholarship to meritorious students. Under this program we take an online interview to test the ability of the student and them based on his/her ability we grant them the scholarship.</div>
                                            <div class="blog-button">
                                                <a class="Enroll" href="<?php echo base_url(); ?>scholarship_form5">Enroll Now</a>
                                            </div>
                                        </div>
                                    </div>-->
                                    </div>
									
									</marquee>
								</div>
							
                        </div>
                    </div>
                      <div class="col-lg-8 pr-30 pl-50 md-pr-15">
                          <div class="row">
								<h3>Latest Scholarship</h3>
                              <div class="col-lg-12 mb-70">
                                 <!-- <div class="row align-items-center no-gutter white-bg blog-item mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                    <div class="col-md-5">
                                        <div class="image-part">
                                            <a href="#"><img src="campus/assets/images/breadcrumbs/Edifying.png" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="col-md-7"> 
                                        <div class="blog-content">
                                            <h3 class="title"><a href="#">Getscholify - Edifying Scholarship</a></h3>
                                            <ul class="blog-meta">
                                                <li> Diploma scholarship is for those students who have passed their 10th or 12th and are looking to pursue a diploma certificate course including skill training. Getscholify offers scholarships for students interested in diploma certificate program in all states and cities of India.</li>
                                                
                                            </ul>
											<div class="btn-part">
                                                <a class="Enroll" href="<?php echo base_url(); ?>scholarship_form5">Enroll Now</a>
                                                <a class="Learn" href="#">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
								<?php 
								if($get_schloships){
									foreach($get_schloships as $schloships){
										
									
								
								
								?>
								 <div class="row align-items-center no-gutter white-bg blog-item mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                    <div class="col-md-5">
                                        <div class="image-part"> 
                                           <?php if($schloships['image'] !='') { echo '<img src="'.base_url().'main-admin/images/'.$schloships['image'].'">'; }else{echo '<img src="'.base_url().'main-admin/images/Eligibility.png">';} ?>
                                        </div>
                                    </div> 
                                    <div class="col-md-7">
                                        <div class="blog-content">
                                            <h3 class="title"><a href="#"><?php echo $schloships['title']; ?></a></h3>
                                            <ul class="blog-meta">
                                                <li> <?php echo  substr($schloships['discription'],0, 400); ?></li>
                                            </ul>
											<div class="btn-part">
                                                <a class="Enroll" href="https://www.getscholify.com/ApplyNow/">Enroll Now</a>
                                                <a class="Learn" href="<?php echo base_url();?>learn/<?php echo $schloships['id'];?>">Learn More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<?php }
								}?>
								
								<div class="row align-items-center no-gutter white-bg blog-item mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                                    
                                    <div class="col-md-12">
                                        <div class="blog-content much">
                                            <h3 class="title">Its now how much we give but how much<span> love we put into giving.</span></h3>
                                        </div>
                                    </div>
                                </div>
							
								
                              </div>
                              
                              </div>
                            
                              
                          </div>
                      </div>
                  </div> 
              </div>
            </div>



			