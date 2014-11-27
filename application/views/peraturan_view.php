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

    <div >
        <p>ini halaman peraturan</p>
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
      <li><a href="#">PPDB</a></li> -->
    
         <li><a href="<?php echo base_url();?>home/peraturan">Peraturan</a></li>
      <li><a href="<?php echo base_url();?>home/persyaratan">Persyaratan</a></li>
      
      <li><a href="<?php echo base_url();?>home/tatacarapendaftaran">Tata Cara Pendaftaran</a></li>
      <li><a href="<?php echo base_url();?>home/jadwalkegiatan">Jadwal Kegiatan</a></li>
      <li><a href="<?php echo base_url();?>home/hasilseleksi">Hasil Seleksi</a></li>
      <li><a href="<?php echo base_url();?>home/hubungikami">Hubungi Kami</a></li>
      <li><a href="<?php echo base_url();?>home/login">Login</a></li>
      
    </ul>
    
   
  </div>
</div>
          

        </div>
            
            <!-- <?php 
                foreach ($listAgenda as $agenda)
                {
                    echo $agenda['nama_agenda'];
                 ?>
            <!-- tempat membuat view  -->
            <br>
            <!-- end -->
       <?php 
                }
            ?>
            
            <br>
            <tr>
            <?php 
                foreach ($listAgenda as $agenda)
                {?>
            <!-- tempat membuat view  -->
            <td>    
                <?php
                    
                    echo $agenda['nama_agenda'];
                ?>
            </td>
            <!-- end -->
       <?php 
                }
            ?>
            </tr> -->
    
</body>
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="<?php echo base_url();?>js/bootswatch.js"></script>
 <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
</html>
