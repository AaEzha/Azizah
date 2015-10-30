<h1 class="title">Pengajuan Internship</h1>
<div class="container">
	<p>
		Sebagai perusahaan yang senantiasa peduli dengan dunia pendidikan kami memberikan kesempatan bagi siswa/i tingkat SMA/SMK/SMEA/ST dan mahasiswa/i yang ingin mengikuti PKL/KP/Penelitian Skripsi/Thesis dan Magang Industri.
	</p>
	<p>
		Silahkan dilengkapi:
	</p>

<form class="form-horizontal" action="" method="post" id="myform" enctype="multipart/form-data">
  <div class="form-group">
    <label class="col-sm-2 control-label">Program Internship</label>
    <div class="col-sm-4">
      <select name="program" id="inputProgram" class="form-control input-sm" required="required">
      <?php
      $prog = array('PKL','KP','Penelitian','Magang Industri');
      foreach($prog as $prog){
      ?>
      	<option value="<?=$prog;?>"><?=$prog;?></option>
      <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Topik</label>
    <div class="col-sm-4">
      <select name="topik" id="inputTopik" class="form-control input-sm" required="required">
      <?php
      $qt = mysql_query("select * from master_topic");
      while($dt = mysql_fetch_array($qt)){
      ?>
      	<option value="<?=$dt['GUID'];?>"><?=$dt['TOPIC_NAME'];?></option>
      <?php } ?>
      </select>
    </div>
    <label class="col-sm-2 control-label">Kuota</label>
    <div class="col-sm-1">
      <input type="text" id="kuota" class="form-control input-sm" value="5" disabled>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Program</label>
    <div class="col-sm-4">
      <select name="topik" id="inputTopik" class="form-control input-sm" required="required">
      <?php
      $qt = mysql_query("select * from program");
      while($dt = mysql_fetch_array($qt)){
      ?>
      	<option value="<?=$dt['GUID'];?>"><?=$dt['PROGRAM_NAME'];?></option>
      <?php } ?>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Tanggal Mulai</label>
    <div class="col-sm-2">
      <input type="text" name="tempatlahir" id="tgls" class="form-control input-sm" required="required" maxlength="50">
    </div>
    <label class="col-sm-offset-2 col-sm-2 control-label">Tanggal Selesai</label>
    <div class="col-sm-2">
      <input type="date" name="tanggallahir" id="tglf" class="form-control input-sm" required="required" aria-describedby="helpBlock">
      <span id="helpBlock" class="help-block">Format: year-month-day</span>
    </div>
  </div>
  <div class="form-group">
    <label class="col-sm-2 control-label">Proposal</label>
    <div class="col-sm-4">
      <input type="file" name="foto" required>
    </div>
    <label class="col-sm-2 control-label">Surat Pengantar</label>
    <div class="col-sm-4">
      <input type="file" name="foto" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      Sebelum mensubmit, cek dan teliti data yang Anda isikan.<br>
      Semua data dan informasi Anda adalah benar dan dapat dipertanggungjawabkan.
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-12 text-center">
      <button type="submit" id="submit" class="btn btn-primary btn-lg">Submit</button>
      <button type="reset" class="btn btn-primary btn-lg">Reset</button>
    </div>
  </div>
</form>  
</div>