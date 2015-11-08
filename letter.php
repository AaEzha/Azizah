<h1>Letter <small>Configuration</small></h1>
<?php
if(isset($_GET['type'])){
	$type = $_GET['type'];
	switch ($type) {
		case 'value':
			# code...
			break;
		
		default:
			# code...
			break;
	}
}else{
?>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Confirm Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=accept" class="btn btn-primary btn-block">Edit</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Reject Clearance Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=accept" class="btn btn-primary btn-block">Edit</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">Assessment Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=accept" class="btn btn-primary btn-block">Edit</a>
		  </div>
	</div>
</div>	

<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-primary">
		  <div class="panel-heading">
				<h3 class="panel-title">End of Internship Letter</h3>
		  </div>
		  <div class="panel-body">
				<a href="?p=letter&type=accept" class="btn btn-primary btn-block">Edit</a>
		  </div>
	</div>
</div>	
<?php
}
?>