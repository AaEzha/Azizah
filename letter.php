<?php
if(isset($_GET['type'])){
	$type = $_GET['type'];
	switch ($type) {
		case 'confirm':
			$title = "Confirm Clearance Letter";
			break;

		case 'reject':
			$title = "Reject Clearance Letter";
			break;

		case 'assessment':
			$title = "Assessment Letter";
			break;

		case 'finish':
			$title = "End of Internship Letter";
			break;
		
		default:
			# code...
			break;
	}

	echo "<h1>$title <small>Configuration</small></h1>";
}else{
?>
<h1>Letter <small>Configuration</small></h1>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Confirm Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=confirm" class="btn btn-primary btn-block">Edit</a>
		  </div>
		  <div class="panel-footer">
		  		<a href="#" class="btn btn-info btn-block">Preview</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Reject Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=reject" class="btn btn-primary btn-block">Edit</a>
		  </div>
		  <div class="panel-footer">
		  		<a href="#" class="btn btn-info btn-block">Preview</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Assessment Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=assessment" class="btn btn-primary btn-block">Edit</a>
		  </div>
		  <div class="panel-footer">
		  		<a href="#" class="btn btn-info btn-block">Preview</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">End of Internship Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=finish" class="btn btn-primary btn-block">Edit</a>
		  </div>
		  <div class="panel-footer">
		  		<a href="#" class="btn btn-info btn-block">Preview</a>
		  </div>
	</div>
</div>	
<?php
}
?>