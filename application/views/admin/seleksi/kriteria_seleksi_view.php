
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
                    <div class="col-lg-8">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">                                                                                                                                                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Jenis Kriteria</th>
                                                <th>Nilai</th>
                                                <th>Bobot</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Tes Kemampuan Bahasa Inggris</td>
                                                <td>A</td>
                                                <td>2</td>
                                                <td><i class="fa fa-check"></i></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Bejo Sugiantoro</td>
                                                <td>Tes Kemampuan Bahasa Indonesia</td>
                                                <td>B</td>
                                                <td>1</td>
                                                <td><i class="fa fa-check"></i></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
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
        <h4 class="modal-title" id="myModalLabel">Edit Nilai</h4>
      </div>
      <div class="modal-body">                    
           <div class="form-group">
                <label>Nilai</label>
                <select class="form-control" name="status" style="width: 15%;">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
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
