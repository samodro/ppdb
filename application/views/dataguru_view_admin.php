<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PPDB</title>
      <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
     <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
    
</head>
<body>
    
    
    
<div class="container">
    <h1>Rancang Bangun Aplikasi Sistem Pendukung Keputusan Penerimaan Peserta Didik Baru di SMP Islam</h1>

    <div >
        <p>ini halaman data guru buat admin.</p>
    </div>

    <div class="navbar navbar-default">
        <div class="container">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="<?php echo base_url();?>home/index">Beranda</a>
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">
<!--      <li><a href="#">Agenda</a></li>
      <li><a href="#">Galeri</a></li>
      <li><a href="#">PPDB</a></li>-->
      <li class="dropdown">
        <a href="#" class="dropdown-toggle dropdown" data-toggle="dropdown">Profil <b class="caret"></b></a>
        <ul class="dropdown-menu">

         <li><a href="<?php echo base_url();?>home/visimisiadmin">Visi Misi</a></li>
          <li><a href="<?php echo base_url();?>home/tatatertibadmin">Tata Tertib</a></li>
          <li><a href="<?php echo base_url();?>home/fasilitasadmin">Fasilitas</a></li>
            <li><a href="<?php echo base_url();?>home/dataguruadmin">Data Guru</a></li>
            
            <!--          <li class="divider"></li>
          <li class="dropdown-header">Dropdown header</li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>-->
        </ul>
         <li><a href="<?php echo base_url();?>home/agendaadmin">Agenda</a></li>
      <li><a href="<?php echo base_url();?>home/galeriadmin">Galeri</a></li>
         <li><a href="<?php echo base_url();?>home/ppdbadmin">PPDB</a></li>
      </li>
    </ul>
      <div/>
   


      </li>
    </ul>
  </div>
</div>
          

        </div>
    </div>
 </div>
    
  
    
     <div class="row">
    <div class="col-md-4 col-md-offset-4">
      <form class="form-horizontal" role="form">
        <fieldset>

          <!-- Form Name -->
          <legend>Data Guru</legend>

          <!-- Text input-->
          
  
            <div class="form-group">
  <label class="control-label" for="inputDefault">Nama</label>
  <input class="form-control" id="inputDefault" type="text">
</div>
                <div class="form-group">
  <label class="control-label" for="inputDefault">NIP</label>
  <input class="form-control" id="inputDefault" type="text">
</div>
          
         <div class="form-group">
  <label class="control-label" for="inputDefault">Bidang Studi</label>
  <input class="form-control" id="inputDefault" type="text">
</div>
            <div class="form-group">
  <label class="control-label" for="inputDefault">Tempat Tgl. Lahir</label>
  <input class="form-control" id="inputDefault" type="text">
</div>
          
            <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Alamat</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
          
       <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Riwayat Pendidikan</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea"></textarea>
        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
      </div>
    </div>
          
          

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="pull-right">
                <button type="submit" class="btn btn-default">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
            </div>
          </div>

        </fieldset>
      </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->
 
</body>

<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>js/bootswatch.js"></script>
 <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
</html>
