
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Pengaturan Seleksi Siswa Baru
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
                                   &nbsp; Buat Tes
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tes</th>
                                                <th>Tipe Tes</th>
                                                <th>Bobot</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tes Administratif</td>
                                                <td>Pengumpulan</td>
                                                <td>2</td>
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
                                                <td>Tes Kemampuan Dasar</td>
                                                <td>Penilaian</td>
                                                <td>3</td>
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
                                                <td>Tes Kemampuan Agama</td>
                                                <td>Penilaian</td>
                                                <td>1</td>
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
                                                <td><a href="<?php echo base_url()?>tes/kriteria">Tes Kemampuan Bahasa</a></td>
                                                <td>Penilaian</td>
                                                <td>1</td>
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
                                                <td>Tes Psikologi</td>
                                                <td>Penilaian</td>
                                                <td>3</td>
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
                                                <td>Tes Wawancara</td>
                                                <td>Penilaian</td>
                                                <td>1</td>
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
                            </div>                    

                            
                        </form>

                        

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
        <h4 class="modal-title" id="myModalLabel">Buat Test</h4>
      </div>
      <div class="modal-body">
        

            <div class="form-group">
                <label>Jenis Test</label>
                <input name="jenis" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Jenis Penilaian</label>
                <select class="form-control" name="status" style="width: 50%;">
                    <option value="1">Penilaian</option>
                    <option value="2">Pengumpulan</option>                    
                </select>
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
