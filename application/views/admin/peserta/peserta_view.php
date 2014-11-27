
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Daftar Calon Siswa Baru
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">
                            <div class="form-group">
                                <label>Periode Seleksi</label>
                                <select class="form-control" name="status" style="width: 50%;">
                                    <option value="2014">2014/2015</option>
                                    <option value="2013">2013/2014</option>                    
                                </select>
                            </div>
                                 
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                                   &nbsp; Tambah Calon Siswa Baru
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Alamat</th>                                                
                                                <th>Asal Sekolah</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Surabaya</td>
                                                <td>SD Sawahan</td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Surabaya</td>
                                                <td>SD Sawahan</td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Surabaya</td>
                                                <td>SD Sawahan</td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Surabaya</td>
                                                <td>SD Sawahan</td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>                                            
                                        </tbody>
                                    </table>
                                </div>                                                                      
                            </form>
                        </div>
                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
    <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>test/tambahTest" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Calon Siswa Baru</h4>
      </div>
      <div class="modal-body">
        

            <div class="form-group">
                <label>Nama</label>
                <input name="jenis" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="jenis" class="form-control" style="width: 50%;" >                                
            </div>           
            <div class="form-group">
                <label>Asal Sekolah</label>
                <input name="jenis" class="form-control" style="width: 50%;" >                                
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="button" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
