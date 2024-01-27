<script type="text/javascript"> 
function deleteConfirm(url)
 {
    if(confirm('Do you want to Delete this record ?'))
    {
        window.location.href=url;
    }
 }
</script>
<div class="page-heading">

        <h2>Schlorship Result</h2>
      </div>
 
 
	  <div class="table-responsive tabb1">
<table id="example" class="table table-striped table-bordered" width="100%" cellspacing="0">
<thead> <tr><th>S No.</th> <th>Student name</th><th> Phone No.</th><th>Schollership</th><th>score</th></tr> </thead> 
<tbody> 
<?php 

$i = 1;
foreach($product as $con){ 
	echo '<tr><td>'.$i.'</td><td>'.$con['f_name'].' '.$con['l_name'].'</td><td>'.$con['phone'].'</td><td>'.$con['title'].'</td><td>'.$con['score'].'</td>';
?>
		<?php echo '</tr>';
$i++;
}
?>
</tbody> 
</table>
</div>