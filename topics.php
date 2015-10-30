<br><h1>Select Topic</h1>
<?php
$unit = ambildata($_SESSION['iddetail'],'user_detail','UNIT_ID');

$q = mysql_query("select * from selected_topic where UNIT_ID='$unit'");
$e = mysql_fetch_array($q);
$c = mysql_num_rows($q);

if(isset($_POST['topik'])){
	if($c >=1 ) mysql_query("delete from selected_topic where UNIT_ID='$unit'");
	$user = $_SESSION['username'];
	$array = $_POST['topik'];
	$sql = "insert into selected_topic (GUID,UNIT_ID,MASTER_TOPIC_ID,DTMCRT,USRCRT) values ";
    $it = new ArrayIterator( $array );
    $cit = new CachingIterator( $it );
    foreach ( $cit as $value )
    {
        $sql .= "(uuid(),'$unit','" .$cit->current()."',now(),'$user')";
        if( $cit->hasNext() )
        {
            $sql .= ",";
        }
    }
    $a=mysql_query($sql);
    if($a){
    	eksyen('Sukses','?p=topics');
    }else{
    	eksyen('Gagal','inside.php#mastersetting');
    }
}
?>
<form action="" method="post">
	<div class="row">
		<div class="col-md-12">
	<?php
	$q = mysql_query("select GUID,TOPIC_NAME from master_topic order by TOPIC_NAME asc");
	while($d = mysql_fetch_array($q)){ 
		$idtopik = $d['GUID'];
		$query = mysql_query("select MASTER_TOPIC_ID from selected_topic where MASTER_TOPIC_ID='$idtopik' and UNIT_ID='$unit'");
		$data = mysql_fetch_array($query);
		?>
			<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<input type="checkbox" name="topik[]" value="<?=$d['GUID'];?>" <?=cekbok($d['GUID'],$data['MASTER_TOPIC_ID']);?>> <?=$d['TOPIC_NAME'];?>
			</div>
	<?php } ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-5">
				&nbsp;
			</div>
			<div class="col-md-2">
				<button type="submit" class="btn btn-info btn-block">Save</button>
			</div>
			<div class="col-md-5">
				&nbsp;
			</div>
		</div>
	</div>
</form>