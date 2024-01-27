<!DOCTYPE html>
<html lang="en">

<head>
  <!-- META SECTION -->
  <title>Getscholify | Dashboard</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <!-- END META SECTION -->

  <!-- CSS INCLUDE -->
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url(); ?>assets/css/theme-default.css" />
  <link rel="stylesheet" type="text/css" id="theme" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
  <link href="<?php echo base_url(); ?>assets/front/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo base_url(); ?>assets/css/global-admin.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>assets/css/admin-style.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/target-admin.css">






  <!-- EOF CSS INCLUDE -->
</head>

<body>
  <div class="navbar">

    <div class="container">

      <div class="col-md-4">
        <a class="navbar-brand navbar-brand-image" href="<?php echo base_url(); ?>admin">
          <!--  <img src="<?php echo base_url(); ?>/assets/front/images/logo.png" class="img-responsive"> -->
          <img src="<?php echo base_url(); ?>assets/images/logo.png" alt="" class="img-responsive true">
        </a>

      </div> <!-- /.navbar-header -->




      <div class="col-md-8 tps">


        <ul class="nav pull-right tpp">

          <li>
            <a href="javascript:void(0);" class="white" style="color:#006d0f"><strong>Registration No: </strong><?php echo $this->session->userdata('bliss_id'); ?></strong></a>
          </li>
          <li>
            <a href="javascript:void(0);" class="white" style="color:#006d0f"><strong><?php echo ucfirst($this->session->userdata('full_name')); ?></strong></a>
          </li>


          <li class="dropdown navbar-profile">
            <a class="dropdown-toggle" data-toggle="dropdown" href="" style="color:#006d0f">
              <strong>Getscholify</strong> <span class="navbar-profile-label">&nbsp;</span>
              <i class="fa fa-caret-down white"></i>
            </a>

            <ul class="dropdown-menu" role="menu">

              <li>
                <a href="<?php echo base_url(); ?>admin/profile">
                  <i class="fa fa-user"></i>
                  &nbsp;&nbsp;My Profile
                </a>
              </li>
              <li>
                <a href="<?php echo base_url(); ?>admin/password">
                  <i class="fa fa-cogs"></i>
                  &nbsp;&nbsp;Change Password
                </a>
              </li>
              <li class="divider"></li>

              <li>
                <a href="<?php echo base_url(); ?>admin/logout">
                  <i class="fa fa-sign-out"></i>
                  &nbsp;&nbsp;Logout
                </a>
              </li>

            </ul>

          </li>

        </ul>
      </div>
      <!--/.navbar-collapse -->

    </div> <!-- /.container -->

  </div> <!-- /.navbar -->