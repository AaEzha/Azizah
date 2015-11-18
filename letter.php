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
			$title = "Error";
			break;
	}

	echo "<h1>Letter <small>Configuration | <a href='?p=letter'>Back</a></small></h1>";
	$sql = mysql_query("select * from letter where TYPE='$type'");
?>
	<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
		<form action="" method="POST" role="form">
			<legend>Library</legend>
			<dl>
				<dt>$i_name</dt>
				<dfn>Internship name</dfn>
			</dl>
			<dl>
				<dt>$i_name</dt>
				<dfn>Internship name</dfn>
			</dl>
			<dl>
				<dt>$i_name</dt>
				<dfn>Internship name</dfn>
			</dl>
		</form>
	</div>
	<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
		<form action="" method="POST" role="form">
			<legend><?=$title;?></legend>
		
			<div class="form-group">
				<label for="">Subjek</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
		
			<div class="form-group">
				<label for="">label</label>
				<input type="text" class="form-control" id="" placeholder="Input field">
			</div>
		
			
		
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
<?php	
}else{
?>
<h1>Letter <small>Configuration</small></h1>
<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
	<div class="panel panel-info">
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
	<div class="panel panel-info">
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
	<div class="panel panel-info">
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
	<div class="panel panel-info">
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