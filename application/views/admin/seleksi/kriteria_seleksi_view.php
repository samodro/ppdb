
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $tes->jenis_tes; ?> <?php echo $tes->tahun."/".($tes->tahun+1); ?>                            
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-8">
<?php $ci = &get_instance();
                                                    $ci->load->model('kriteria_model');?>
                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">                                                                                                                                                            
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Jenis Kriteria</th>
                                                <th>
                                                    <?php 
                                                    if($tes->status!=1) echo "Nilai";
                                                    else echo "Berkas"; ?></th>                                           
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if(isset($kriteria) && $kriteria!=null): ?>
                                            <?php foreach($kriteria as $row): ?>
                                            <tr>
                                                <td><?php echo $peserta->nama; ?></td>
                                                <td><?php echo $row->jenis_kriteria; ?></td>
                                                <td><?php echo $row->nilai; ?></td>                                                                                                                                                
                                                <td><?php if($row->status==1) echo '<i class="fa fa-check">'; else echo '<i class="fa fa-times">'; ?></i></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>    
                                            <?php endforeach; endif; ?>
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
