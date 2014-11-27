
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Tes Kemampuan Bahasa Calon Siswa/Siswi 2014/2015
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                        
                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">                                                                  
                                <div class="panel panel-default">
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                        <tr>
                                                            <th>Nama Peserta</th>
                                                            <th>Asal Sekolah</th>
                                                            <th>Nilai UN</th>
                                                            <th>Nilai Tes</th>
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>Bejo Sugiantor</td>
                                                            <td>SD Bojong Sawong 2</td>
                                                            <td>33.56</td>
                                                            <td><a href="<?php echo base_url()?>seleksi/kriteriaSeleksi">40.5</a></td>
                                                            <td>
                                                                <i class="fa fa-check"></i>                                                              
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bejo Sugiantor</td>
                                                            <td>SD Bojong Sawong 2</td>
                                                            <td>33.56</td>
                                                            <td>40.5</td>
                                                            <td>
                                                                <i class="fa fa-check"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bejo Sugiantor</td>
                                                            <td>SD Bojong Sawong 2</td>
                                                            <td>32.56</td>
                                                            <td>28.5</td>
                                                            <td>
                                                                <i class="fa fa-times"></i>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Bejo Sugiantor</td>
                                                            <td>SD Bojong Sawong 2</td>
                                                            <td>33.56</td>
                                                            <td>40.5</td>
                                                            <td>
                                                                <i class="fa fa-times"></i>
                                                            </td>
                                                        </tr>                                            
                                                    </tbody>
                                            </table>
                                        </div>                            
                                    </div>
                                    <!-- /.panel-body -->
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
