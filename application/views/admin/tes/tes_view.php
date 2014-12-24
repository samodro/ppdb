<?php $CI = &get_instance(); 
        $CI->load->model('kriteria_model');
?>
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
                    <div class="col-lg-8">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">
                            <div class="form-group">
                                <label>Periode Seleksi</label>
                                <select class="form-control" id="periode" name="status" style="width: 35%;">
                                    <?php if(isset($periode) && $periode!=null):?>
                                    <?php foreach ($periode as $row): ?>
                                        <option value="<?php echo $row->tahun;?>" <?php if($row->tahun==$tahun) echo "selected"; ?>><?php echo $row->tahun;?>/<?php echo $row->tahun+1;?></option>
                                    <?php endforeach;?>
                                    <?php else:?>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?>/<?php echo date('Y')+1;?></option>                                    
                                    <?php endif; ?>                  
                                </select>
                            </div>
                        </form>  
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                                   &nbsp; Tambah Pengaturan Seleksi
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                     <?php if(isset($tes) && $tes!=null): ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tes</th>
                                                <th>Tipe Tes</th>
                                                <th>Bobot</th>
                                                <th>Validasi Kriteria</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           
                                            <?php $i = 0; foreach($tes as $row): ?>
                                            <tr>
                                                <td><?php echo $row->jenis_tes?></td>
                                                <td><?php if($row->status==1 || $row->status==5) echo "Penilaian Huruf"; elseif ($row->status==2) echo "Pengumpulan"; elseif ($row->status==3) echo "Penilaian Angka"; ?></td>
                                                <td><?php echo $row->bobot ?></td>
                                                <td><?php if($row->status==5 || $CI->kriteria_model->select_kriteria_tes($row->id_tes)==null ) echo "<font color='red'>Tidak Valid</font>"; else echo "Valid";?></td>
                                                <td>
                                                    <?php if($i++!=0):?>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $row->id_tes; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete<?php echo $row->id_tes; ?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                     <?php endif; ?>
                                                    <a href="<?php echo base_url(); ?>tes/kriteria?id_tes=<?php echo $row->id_tes; ?>" > <button class="btn btn-warning btn-xs" type="button">Lihat Kriteria</button></a>
                                                   
                                                </td>
                                            </tr>
                                            <?php endforeach;?>                                            
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
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
        <form role="form" action="<?php echo base_url();?>tes/tambahTes" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Pengaturan Seleksi</h4>
      </div>
      <div class="modal-body">        
            <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
            <div class="form-group">
                <label>Jenis Test</label>
                <input name="jenis" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Jenis Penilaian</label>
                <select class="form-control" name="status" style="width: 50%;">
                    <option value="1">Penilaian Huruf</option>
                    <option value="3">Penilaian Angka</option>  
                    <option value="2">Pengumpulan</option>  
                </select>
            </div>
            <div class="form-group">
                <label>Bobot</label>
                <input name="bobot" class="form-control" style="width: 50%;" >                                
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>

    
<?php if(isset($tes) && $tes!=null):?>
<?php foreach ($tes as $row): ?> 
<div class="modal fade" id="myModalEdit<?php echo $row->id_tes;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>tes/editTes" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Pengaturan Seleksi</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">        
           <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
           <input name="id_tes" value="<?php echo $row->id_tes; ?>" class="form-control" style="display:none;" >
            <div class="form-group">
                <label>Jenis Test</label>
                <input name="jenis" class="form-control" style="width: 50%;" value="<?php echo $row->jenis_tes; ?>">                                
            </div>
            <div class="form-group">
                <label>Jenis Penilaian</label>
                <select class="form-control" name="status" style="width: 50%;" >
                    <option value="1" <?php if ($row->status ==1) echo "Selected"; ?>>Penilaian Huruf</option>
                    <option value="3" <?php if ($row->status ==3) echo "Selected"; ?>>Penilaian Angka</option>  
                    <option value="2" <?php if ($row->status ==2) echo "Selected"; ?>>Pengumpulan</option>                                                          
                </select>
            </div>
            <div class="form-group">
                <label>Bobot</label>
                <input name="bobot" class="form-control" style="width: 50%;" value="<?php echo $row->bobot; ?>">                                
            </div>
        
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

<?php if(isset($tes) && $tes!=null):?>
<?php foreach ($tes as $row): ?> 
<div class="modal fade" id="myModalDelete<?php echo $row->id_tes;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>tes/deleteTes" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        <input name="id_tes" value="<?php echo $row->id_tes; ?>" class="form-control" style="display:none;" >
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
<script>
    $(function() {
        $('#periode').change(function() {
            this.form.submit();
        });
    });
</script>    