
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $tes->jenis_tes; ?>
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">                 
                    
                    <div class="col-lg-6">   
                       <?php if($CR!=null && $CR>0.1):?>
                        <div class="alert alert-danger alert-dismissable" role="alert"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><strong>Perhatian!</strong> Preferensi pembobotan tidak konsisten dengan nilai CR = <?php echo sprintf("%.2f", $CR);?></div>
                        <?php endif;?>
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                                   &nbsp; Buat Kriteria
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                    <?php if(isset($kriteria) && $kriteria!=null): ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Kriteria</th>   
                                                
                                            <?php if($tes->status==1 || $tes->status==5): ?>    <th>Bobot</th> <?php endif; ?>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach($kriteria as $row): ?>
                                            <tr>
                                                <td><?php echo $row->jenis_kriteria; ?></td> 
                                                
                                                 <?php if($tes->status==1 || $tes->status==5): ?><td><?php echo $row->bobot; ?></td><?php endif; ?>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $row->id_kriteria; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete<?php echo $row->id_kriteria; ?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>                                              
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                            </div>                    

                                                    

                        

                    </div>
                <a href="<?php echo base_url().'tes/lihatTes';?>"> <button class="btn btn-primary btn-lg" type="button">Kembali</button></a>
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
        <form role="form" action="<?php echo base_url();?>tes/tambahKriteria" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Kriteria</h4>
      </div>
      <div class="modal-body">
        
            <input name="tahun" value="<?php echo $tes->tahun; ?>" class="form-control" style="display:none;" >
            <input name="id_tes" value="<?php echo $tes->id_tes; ?>" class="form-control" style="display:none;" >
            <input name="status" value="<?php echo $tes->status; ?>" class="form-control" style="display:none;" >
            <div class="form-group">
                <label>Jenis Kriteria</label>
                <input name="jenis" class="form-control" style="width:50%;">                                
            </div>
            
            <?php if($tes->status==1||$tes->status==5): ?>
            <div class="form-group">
                <label>Bobot Kriteria</label>
                <input name="bobot" class="form-control" style="width:50%;">                                
            </div>
            <?php endif; ?>
            
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php if(isset($kriteria) && $kriteria!=null):?>
<?php foreach ($kriteria as $row): ?> 
<div class="modal fade" id="myModalEdit<?php echo $row->id_kriteria;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>tes/editKriteria" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Pengaturan Kriteria</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">        
           <input name="tahun" value="<?php echo $tes->tahun; ?>" class="form-control" style="display:none;" >
           <input name="id_tes" value="<?php echo $tes->id_tes; ?>" class="form-control" style="display:none;" >
           <input name="status" value="<?php echo $tes->status; ?>" class="form-control" style="display:none;" >
           <input name="id_kriteria" value="<?php echo $row->id_kriteria; ?>" class="form-control" style="display:none;" >
            <div class="form-group">
                <label>Jenis Kriteria</label>
                <input name="jenis" class="form-control" style="width: 50%;" value="<?php echo $row->jenis_kriteria; ?>">                                
            </div>
           <?php if($tes->status==1||$tes->status==5): ?>
            <div class="form-group">
                <label>Bobot</label>
                <input name="bobot" class="form-control" style="width: 50%;" value="<?php echo $row->bobot; ?>">                                
            </div>
           <?php endif;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary" >Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
    
<?php endforeach; endif;?>

<?php if(isset($kriteria) && $kriteria!=null):?>
<?php foreach ($kriteria as $row): ?> 
<div class="modal fade" id="myModalDelete<?php echo $row->id_kriteria;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>tes/deleteKriteria" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
          <input name="id_tes" value="<?php echo $tes->id_tes; ?>" class="form-control" style="display:none;" >
        <input name="id_kriteria" value="<?php echo $row->id_kriteria; ?>" class="form-control" style="display:none;" >
            Anda yakin menghapus data ini ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-danger" >Yakin</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; endif;?>
