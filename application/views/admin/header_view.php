<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>cssb/bootstrap.min.css" rel="stylesheet">
    
    <link href="<?php echo base_url();?>cssb/newBootstrap.css" rel="stylesheet">
    
    <link href="<?php echo base_url();?>css/datepicker.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>cssb/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url();?>cssb/plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>cssb/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

       <script src="<?php echo base_url();?>jsb/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>jsb/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>jsb/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url();?>jsb/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?php echo base_url();?>jsb/plugins/dataTables/dataTables.bootstrap.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>jsb/sb-admin-2.js"></script>
    
    <script src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
 

    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Sistem Penerimaan Siswa Baru</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $this->session->userdata('nama'); ?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>                        
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url().'admin/logout';?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="active">
                        <a href="<?php echo base_url();?>admin/dashboard"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                    </li>
                    <?php if ($this->session->userdata('type')=='admin'): ?>
                    <li>
                        <a href="<?php echo base_url();?>petugas/lihatPetugas"><i class="fa fa-fw fa-empire"></i> Petugas</a>
                    </li> 
                    <?php endif; ?>
                    <li>
                        <a href="<?php echo base_url();?>tes/lihatTes"><i class="fa fa-fw fa-calendar-o"></i> Pengaturan Seleksi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>peserta/lihatPeserta"><i class="fa fa-fw fa-users"></i> Calon Siswa</a>
                    </li>                                         
                    <li>
                        <a href="<?php echo base_url();?>seleksi/lihatSeleksi"><i class="fa fa-fw fa-bar-chart-o"></i> Seleksi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url();?>hasil/hasilSeleksi"><i class="fa fa-fw fa-files-o"></i> Hasil Seleksi</a>
                    </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>