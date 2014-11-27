
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tes Kemampuan Bahasa
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">
                        <form role="form" action="<?php echo base_url();?>test/doTambahTest">                                                             
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                                   &nbsp; Buat Kriteria
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kriteria</th>   
                                                <th>Tipe Penilaian</th>
                                                <th>Bobot</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tes Kemampuan Bahasa Indonesia</td> 
                                                <td>Penilaian Angka</td>
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
                                                <td>Tes Kemampuan Bahasa Inggris</td>  
                                                <td>Penilaian Angka</td>
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
        <h4 class="modal-title" id="myModalLabel">Buat Kriteria</h4>
      </div>
      <div class="modal-body">
        

            <div class="form-group">
                <label>Jenis Kriteria</label>
                <input name="jenis" class="form-control" style="width:50%;">                                
            </div>
            <div class="form-group">
                <label>Jenis Penilaian</label>
                <select class="form-control" name="status" style="width: 50%;">
                    <option value="1">Penilaian Angka</option>
                    <option value="1">Penilaian Huruf</option>                                        
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


