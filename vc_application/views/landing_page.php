<!DOCTYPE html> 
<html lang="zxx">  
    
    <body class="defult-home">
	
        <!--Full width header Start-->
        <div class="full-width-header header-style1 home1-modifiy landing_header">
            <!--Header Start-->
            <header id="rs-header" class="rs-header"> 

                <!-- Menu Start -->
                <div class="menu-area menu-sticky">
                    <div class="container">
                        <div class="row y-middle">
                            <div class="col-lg-2">
                              <div class="logo-cat-wrap">
                                  <div class="logo-part">
                                      <a href="<?php echo base_url(); ?>">
                                          <img class="" src="<?php echo base_url(); ?>campus/assets/images/about/logo.png" alt="logo">
                                      </a>
                                  </div>
                              </div>
                            </div>
                            <div class="col-lg-10 text-right">
                                <div class="rs-menu-area">
                                    <div class="main-menu">
                                      <div class="mobile-menu">
                                          <a class="rs-menu-toggle">
                                              <i class="fa fa-bars"></i>
                                          </a> 
                                      </div> 
                                      <nav class="rs-menu">
                                         <ul class="nav-menu">
                                            <!--<li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="http://campus4success.blissinfosys.com/">Home</a>
											</li>-->
                                     <!--       <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>about">About</a> 
											</li> 
                                            <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>why_us">Why us</a>
											</li>   -->
                                            <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>scholarship">Scholarships</a>
											</li>
                                     <!---       <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>Contribute_with_us">Contribute With Us</a>
											</li>
                                            <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>join_our_team">Join Our Team</a>
											</li>   --->
                                            <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>contact_us">Contact</a>
											</li>
                                        <!---    <div class="loginnn">
											<li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>signin">Log In </a>
											</li>
											
                                            <li class="rs-mega-menu mega-rs menu-item-has-children current-menu-item"> <a href="<?php echo base_url(); ?>signup">Register</a>
                                            </li>
											</div>   -->
                                      
											
										
						<!----	<div class="loginnn">
							<?php if($this->session->userdata('is_customer_logged_in')){ ?>
								
								<li class="dropdown"><a href="JavaScript:Void(0);" class="dropdown-toggle" data-toggle="dropdown"><span><i class="fa fa-user"></i>  <?php echo ucfirst($this->session->userdata('full_name'));?><i class="fa fa-angle-down"></i></span></a>
								 <ul role="menu" class="dropdown-menu">
                                        <li><a href="<?php echo base_url();?>admin">Account</a></li>
										<li><a href="<?php echo base_url();?>admin/profile">Profile</a></li> 
										<li><a href="<?php echo base_url();?>logout">Logout</a></li>
                                    </ul>
								
								</li>
								

								<?php }?>
								
								<?php if($this->session->userdata('is_customer_logged_in')){ ?>
								
									    		 				
								<?php } else { ?>
								<li><li class="dropdown"><a class="rs-mega-menu mega-rs menu-item-has-children current-menu-item" href="<?php echo base_url();?>signup">Register</a></li>
								<li class="Loggg"> <a href="Login.php"> | </a>
											</li>
								
								<li class="dropdown"><a class="rs-mega-menu mega-rs menu-item-has-children current-menu-item" href="<?php echo base_url();?>signin">Login</a></li>
								
								<?php } ?>
						</ul>	 
						
						
                                      </nav>                                         
                                    </div> --->  <!-- //.main-menu -->                                
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- Menu End --> 
				
            </header>
            <!--Header End-->
        </div>
        <!--Full width header End-->






	
		<div class="rs-breadcrumbs breadcrumbs-overlay About">
                <div class="breadcrumbs-img">
                    <img src="campus/assets/images/breadcrumbs/landing_banner.jpg" alt="Breadcrumbs Image">
                </div>
				<div class="landingpage">
                <div class="heading">
					<!-- <a href="#">
						<h1 class="page-title">Education is power and makes a person influential.</h1>
						</a>
						<ul>
							<li>Education brings opportunities for limitless learning.</li>
						</ul >    --->
                </div>
				
				 <div class="rs-quick-contact">
                        <div class="inner-part text-center mb-50">
                            <h2 class="title mb-15">Education is power and makes a person influential.</h2>
                            <p>Education brings opportunities for limitless learning.</p>
                        </div>
                            <div id="form-messages"></div>
                        <form id="contact-form" method="post" action="mailer.php">
                            <div class="row">
                                <div class="col-lg-6 mb-15 col-md-12">
                                    <input class="from-control" type="text" id="name" name="name" placeholder="Name" required="">
                                </div> 
                                <div class="col-lg-6 mb-15 col-md-12">
                                    <input class="from-control" type="text" id="email" name="email" placeholder="Email" required="">
                                </div>   
                                <div class="col-lg-6 mb-15 col-md-12">
                                    <input class="from-control" type="text" id="phone" name="phone" placeholder="Phone" required="">
                                </div>   
                                <div class="col-lg-6 mb-15 col-md-12">
                                    <input class="from-control" type="text" id="subject" name="subject" placeholder="City" required="">
                                </div>
                             
                                <div class="col-lg-12 mb-15">
									<select class="from-control" type="text" name="course" required="">
										<option selected="" disabled="">Select Seeking Course</option>
										<option value="Engineering">Engineering</option><option value="Pharmacy">Pharmacy</option><option value="Para-Medical">Para-Medical</option><option value="Business Management">Business Management</option><option value="Computer Application">Computer Application</option><option value="Food Agriculture &amp; forestry">Food Agriculture &amp; forestry</option><option value="Law">Law</option><option value="Hotel &amp; Tourism Management">Hotel &amp; Tourism Management</option><option value="Education and Teaching">Education and Teaching</option><option value="Dental">Dental</option><option value="Mass Communication">Mass Communication</option><option value="Nursing">Nursing</option>
									</select>
                                </div>
                            </div>
                            <div class="form-group mb-20">
                                <input class="btn-send" type="submit" value="Submit Now">
                            </div>       
                        </form>
                   </div> 
                   </div> 
				   
            </div>


			<div id="rs-about" class="rs-about style3 pt-100 md-pt-70">
                <div class="container">
                    <div class="row y-middle">
                        <div class="col-lg-12 lg-pr-0 md-mb-30">
                            <div class="about-intro">
                                <div class="sec-title">
                                    
                                    <div class="desc big">Campus4Success is a bridge between students, educators, and corporates. It is a digital platform designed to help the students of India with scholarships. The students getting scholarships to pursue their dream careers. Campus4Success allows corporates & individuals to contribute to the education of these deserving children, and in doing that we are keeping everything transparent with the contributors. Donors can track their donations and can also get information about the scholarship recipient including the institution where students are studying.</div>
									<div class="desc big">Campus4Success further allows every student who is receiving a scholarship to choose the college he/she wants to study and the city or state he/she wants to live in while studying. This initiative has helped many students to follow their passion. We believe in fulfilling the dreams of students by acting as a bridge between the willing donors and the deserving meritorious students. Our journey started after the COVID-19 pandemic. When millions of Indians lost their job and college dreams of many were shattered. This was the time when we realised, that we should help these college spirants get rightful education and that is when Campus4Success was formed.</div>
                                </div> 
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
			<div id="rs-about" class="rs-about style1 pt-100 pb-100 md-pt-70 md-pb-70">
				<div class="container">
					<div class="row align-items-center">
						<div class="col-lg-5 padding-0 md-pl-15 md-pr-15 md-mb-30">
							<div class="img-part">
								<img class="" src="campus/assets/images/about/logooo2.png" alt="About Image">
							</div>
						</div>
						<div class="col-lg-7 pr-70 md-pr-15">
							<div class="sec-title">
								<h2 class="title mb-17">Our Philosophy</h2>
								<div class="sub-title orange">karma unites us with god</div>
								<div class="bold-text mb-22">We at Campus 4 Success knows the role of education in the development of our country. Approximately, 20% of population in India is of (15 to 24) years of age, but only 27% attends college. We know CAMPUS 4 SUCCESS that for the better growth of a country we should educate our youth first. That is why we have created a platform which offers scholarships to every student of India. Our philosophy while building this platform was to support the dreams of young Indians, so that they can explore their field of interest and build a limitless career.</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="rs-cta about">
                <div class="cta-img">
                    <img src="campus/assets/images/cta/cta-bg2.jpg" alt="">
                </div>
                <div class="cta-content text-center">
                    <div class="sec-title sm-mb-20 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                        <h2 class="title white-color extra-bold mb-16 sm-mb-5">Our vision</h2>
                        <h2 class="sub-title capitalize white-color mb-0">We at Campus 4 Success knows the role of education in the development of our country. Approximately, 20% of population in India is of (15 to 24) years of age, but only 27% attends college. We know that for the better growth of a country we should educate our youth first. That is why we have created a platform that offers scholarships to every student in India. Our Vision is to support the dreams of young Indians so that they can explore their field of interest and build a limitless career.</h2>
                    </div>
                   
                </div>
            </div>
			
			
			<div class="rs-cta style2 about">
				<div class="partition-bg-wrap inner-page">
					<div class="container">
						<div class="row y-bottom">
							<div class="col-lg-6 pb-50 md-pt-50 md-pb-50">
								
							</div>
							<div class="col-lg-6 pl-62 pt-50 pb-50 md-pt-50 md-pb-50 md-pl-15">
								<div class="sec-title mb-40 md-mb-20">
										<h2 class="title mb-16">Our mission</h2>
										<div class="desc">Our Mission is to reinforce the youth of India with quality education. More than 2 million students every year quit their higher education because of a shortage of funds. Our mission is to help those students by providing them scholarships.</div>
										<div class="desc">Our mission is to unite the corporates, Colleges & students in a cooperative network. This network will keep supporting the needy students forever. With this vision, we aim to increase the percentage of students pursuing higher education in India, so that our nation becomes a land of excellence. We believe in  fulfilling the dreams of students by acting as a bridge between the willing donors and the deserving meritorious students.</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div id="rs-about" class="rs-about style1 pt-100 pb-20 md-pt-70 md-pb-70 Why">
				<div class="container">
					<div class="row align-items-center">
						
						<div class="col-lg-8 pr-20 md-pr-15">
							<div class="sec-title">
								<h2 class="title mb-17">For Students</h2>
						<!--		<div class="sub-title orange">karma unites us with god</div> --->
								<div class="bold-text mb-22">Every student have a dream, a dream to become successful and to support his/her family. But these dreams are often challenged by the financial incapacity of the families. But then there is a term scholarship but it is often granted to thestudent who is either meritorious or is from economically weaker family. But Campus 4 Success is  evolutionizing the Indian education system by granting 100% scholarships, now any student can get the scholarship.</div>
								<div class="bold-text mb-22">Any student can apply for scholarship with campus 4 success. Our expert counsellors helps you to find the right course and choose the right college/ university in your preferred city and then grants you the scholarship. Students applying scholarship through campus 4 success have the privilege to select the college and degree of their choice. We understand the dynamic career requirements of today’s world and that is why we are giving away scholarships in every field.</div>
							</div>
						</div>
						<div class="col-lg-4 padding-0 md-pl-15 md-pr-15 md-mb-30 whyus_28">
							<div class="img-part">
								<img class="" src="campus/assets/images/about/whyus_28.png" alt="About Image">
							</div>
						</div>
						
					</div>
				</div>
			</div>
			
			
			
			<div id="rs-categories" class="rs-categories usp gray-bg style1 pt-94 pb-70 md-pt-64 md-pb-40">
                <div class="container">
                  
                    <div class="row">
						 <div class="col-lg-4 col-md-4 mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
							 <div class="sec-title mb-50 text-center">
							<h2 class="title mb-0"> Campus For Success USP </h2>
							<div class="sub-title primary">We understand today’s dynamic world and the aye skills required to compete in it. Today the world is not limited to traditional careers, but now many new career option have evolved along with new. Scholarships Courses Contributors education courses and degrees.</div>
							<div class="sub-title primary">To be able to stay on top of today’s competitive world, a good education is a must. To get high  quality education good funds are required which is very difficult for every student to have. Worry not! Campus 4 success is here to support your education with 100% scholarships.</div>
						</div>

						</div>
						 <div class="col-lg-8 col-md-8 mb-30 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
						 
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp1.png" alt="">
                                </div>
                                
                            </a>
							<div class="content-part">
                                    <h4 class="title">upto 100%</h4>
                                    <span class="courses">Scholarship</span>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 400ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp2.png" alt="">
                                </div>
                               
                            </a>
							 <div class="content-part">
                                    <h4 class="title">200+</h4>
                                    <span class="courses">Courses</span>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="500ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 500ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp3.png" alt="">
                                </div>
                               
                            </a>
							 <div class="content-part">
                                    <h4 class="title">50+</h4>
                                    <span class="courses">Contributors</span>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="300ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 300ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp4.png" alt="">
                                </div>
                                
                            </a>
							<div class="content-part">
                                    <h4 class="title">All Cities &amp; </h4>
                                    <span class="courses">States of India</span>
                                </div>
								
                        </div>
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="400ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 400ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp5.png" alt="">
                                </div>
                                
                            </a>
							<div class="content-part">
                                    <h4 class="title">1000+</h4>
                                    <span class="courses">Scholarship Granted</span>
                                </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-30 wow fadeInUp" data-wow-delay="500ms" data-wow-duration="2000ms" style="visibility: visible; animation-duration: 2000ms; animation-delay: 500ms; animation-name: fadeInUp;">
                            <a class="categories-item" href="#">
                                <div class="icon-part">
                                    <img src="campus/assets/images/categories/icons/usp6.png" alt="">
                                </div>
                                
                            </a>
							<div class="content-part">
                                    <h4 class="title">Easy Apply</h4>
                                    <span class="courses">From Home</span>
                                </div>
                        </div>  
                    </div>
                    </div>
                </div>
            </div>
			
			
			
		
			
			
