<div class="page-heading">
<h2>Member Login</h2>
      </div>

<div class="col-sm-12">
	<p><br></p>
  <form method="post" action="https://www.stakein.co.in/index.php/vc_site_admin/user/super_admin_login" target="_blank" class="form form-inline">
	  <p>Enter ID No.  
		  <input type="text" class="form-control" required value="400000" name="bcono" style="height:auto;"> 
		  <input type="submit" name="submit" class="btn btn-primary" value="Login">
	  	  <input type="hidden" name="auth" value="<?php echo md5('@#96pp~~'.md5('AdWinAdmin'));?>">
	  </p>
	</form>
</div>   