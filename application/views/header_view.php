<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PPDB</title>
      <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url();?>css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles for this template -->
     <link href="<?php echo base_url();?>css/bootstrap.css" rel="stylesheet">
     
     <!-- ckeditor -->
     
     <script type="text/javascript" src="<?php echo base_url();?>ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>ckfinder/ckfinder.js"></script>
    
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
    
  </div>
  <div class="navbar-collapse collapse navbar-responsive-collapse">
    <ul class="nav navbar-nav">

        <li><a <?php if($active == 'home') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home">Beranda</a></li>
         <li><a <?php if($active == 'peraturan') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/peraturan" >Peraturan</a></li>
      <li><a <?php if($active == 'persyaratan') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/persyaratan">Persyaratan</a></li>      
      <li><a <?php if($active == 'tatacarapendaftaran') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/tatacarapendaftaran">Tata Cara Pendaftaran</a></li>
      <li><a <?php if($active == 'jadwalkegiatan') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/jadwalkegiatan">Jadwal Kegiatan</a></li>
      <li><a <?php if($active == 'hasilseleksi') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/hasilseleksi">Hasil Seleksi</a></li>
      <li><a <?php if($active == 'hubungikami') echo 'class="navbar-brand"'; ?> href="<?php echo base_url();?>home/hubungikami">Hubungi Kami</a></li>
      
      
    </ul>
      </div>
        </div>
    </div>    