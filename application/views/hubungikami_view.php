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
    <h1>Sistem Pendukung Keputusan Penerimaan Peserta Didik Baru di SMP Islam</h1>

 

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
      <li><a href="#">PPDB</a></li> -->
    
         <li><a href="<?php echo base_url();?>home/peraturan">Peraturan</a></li>
      <li><a href="<?php echo base_url();?>home/persyaratan">Persyaratan</a></li>      
      <li><a href="<?php echo base_url();?>home/tatacarapendaftaran">Tata Cara Pendaftaran</a></li>
      <li><a href="<?php echo base_url();?>home/jadwalkegiatan">Jadwal Kegiatan</a></li>
      <li><a href="<?php echo base_url();?>home/hasilseleksi">Hasil Seleksi</a></li>
      <li><a href="<?php echo base_url();?>home/hubungikami">Hubungi Kami</a></li>
      
      
    </ul>
      <div/>
    <div class="row">

  <!-- <div class="col-lg-6">
    <div class="input-group">
      <input type="text" class="form-control">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button">Go!</button>
        <button onclick="location.href='<?php echo base_url();?>https://www.google.co.id'">Register</button>
      </span>
    </div><!-- /input-group -->
  </div> <!-- /.col-lg-6 -->
</div> <!-- /.row -->


      </li>
    </ul>
  </div>
</div>
   
        

        </div>
            
<form class="form-horizontal">
  <fieldset>
      <h3>Hubungi Kami</h3>
      
          
<div class="form-group">
    <div class="col-lg-5">
  <label class="control-label" for="inputDefault">Nama</label>  
  <input class="form-control" id="inputDefault" type="text">
  </div>
</div>
      
<div class="form-group">
    <div class="col-lg-5">
  <label class="control-label" for="inputDefault">Email</label>  
  <input class="form-control" id="inputDefault" type="text">
  </div>
</div>
  
   
    <div class="form-group">
      
      <div class="col-lg-5">
           <label class="control-label" for="texArea">Pesan</label> 
        <textarea class="form-control" rows="3" id="textArea"></textarea>
      </div>
    </div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-4">
      <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </div>
</form>
    
</body>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>js/bootswatch.js"></script>
 <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
</html>
