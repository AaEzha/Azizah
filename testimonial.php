<?php
if(!isset($_GET['i'])){
	eksyen('','home.php');
	die;
}

if(isset($_POST['testi'])){
	$testi = mysql_real_escape_string($_POST['testi']);
	$id = $_GET['i'];
	mysql_query("insert into testimonial values(uuid(),'$id','$testi',now(),'".$_SESSION['firstname']."')");
	eksyen('Thank you','?p=intern_detail&i='.$id);
}
?>
<h1>Testimonial</h1>
<script type='text/javascript' src='js/tinymce/tinymce.min.js'></script><script>tinymce.init({selector:'#inputTesti'});</script>
<div class="col-md-8">
	<form action="" method="POST" role="form">

		<div class="form-group">
			<textarea name="testi" id="inputTesti" class="form-control" rows="6"></textarea>
		</div>	

		<button type="submit" class="btn btn-primary">Submit</button>
	</form>
</div>