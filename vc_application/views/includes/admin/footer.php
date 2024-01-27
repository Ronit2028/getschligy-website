<footer class="footer no-print">

  <div class="container">

    <div class="row">
<p align="center">Copyrights 2021 Getscholify| All rights reserved.</p>
    </div> <!-- /.row -->      

  </div> <!-- /.container -->
  
</footer>

                     

      
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/target-admin.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 	
        <!-- END PLUGINS -->
   <script>
jQuery(document).ready(function() { 	
(function() {'use strict';
  document.body.addEventListener('click', copy, true);
    function copy(e) {
	var 
      t = e.target,
      c = t.dataset.copytarget,
      inp = (c ? document.querySelector(c) : null);
    if (inp && inp.select) {
      inp.select();
	try {document.execCommand('copy');
        inp.blur();
		t.classList.add('copied');
        setTimeout(function() { t.classList.remove('copied'); }, 1500);
      }
      catch (err) {
        alert('please press Ctrl/Cmd+C to copy');
      }
    }
    }
})();
});
</script>

<script type="text/javascript">
jQuery(document).ready(function () {
   
    jQuery('.bbh-btn').click(function(){   
            var cid = jQuery(this).attr('data-id');
            jQuery('.bbh-ajax-info').html('');
            jQuery.ajax({
                type:"POST",
                url: '<?php echo base_url();?>index.php/vc_site_admin/child_info/bbh_popup_info',
                data: "cid="+cid,
                success:function(data) {
                    jQuery('.bbh-ajax-info').html(data);
                }
            });
        }); 
        
  jQuery('.eml').click(function(){
	    jQuery("#envelopeTab").toggle();
	    
  });
  
  
  jQuery(".gvc-list").click(function(){
    jQuery(".gvc-info").toggle();
});

  
  
  jQuery('#mySelect select').on('change', function() {
  var value = jQuery(this).val();
  var cls = '.input-group-text.number-'+value;
  jQuery('.btn-number .input-group-text').hide();
  jQuery(cls).show();
  jQuery('#phone_code').val(jQuery(cls).html());
});

	jQuery( "#datepicker" ).datepicker();
	jQuery( "#datepicker1" ).datepicker();
	jQuery( "#datepicker2" ).datepicker();

});
 </script>	






    </body>
</html>
