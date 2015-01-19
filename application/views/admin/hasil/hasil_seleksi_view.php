<?php $ci = & get_instance();
      $ci->load->model('seleksi_model');  
?>
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Daftar Calon Peserta Didik Baru
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">
                    
                        <form role="form" action="<?php echo base_url();?>hasil/hasilSeleksi">
                            <div class="form-group">
                                <label>Periode Seleksi</label>
                                <select class="form-control" name="tahun" id="periode" style="width:25%;">
                                    <?php if(isset($periode) && $periode!=null):?>
                                    <?php foreach ($periode as $row): ?>
                                        <option value="<?php echo $row->tahun;?>"  <?php if($row->tahun==$tahun) echo "selected"; ?>><?php echo $row->tahun;?>/<?php echo $row->tahun+1;?></option>
                                    <?php endforeach;?>
                                    <?php else:?>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?>/<?php echo date('Y')+1;?></option>                                    
                                    <?php endif; ?>
                                      
                                </select>
                            </div>    
                            
                            
                        </form>                           
                        
                        
                        <button type="button" class="btn btn-primary btn-lg fa fa-refresh" data-toggle="modal" data-target="#myModalUpdate">
                                   &nbsp; Perbarui
                        </button>
                        
                        <button type="button" class="btn btn-success btn-lg fa fa-upload" data-toggle="modal" data-target="#myModalPublish">
                                   &nbsp; <?php if($periodenow->status_periode<=1) echo "Publish"; else echo "Unpublish"; ?>
                        </button>
                                
                                <br/>
                                <br/>
                        <div class="table-responsive">
                                    <?php if(isset($peserta) && $peserta!=null): ?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No Tes </th>
                                                <th>Nama Peserta</th>                                                   
                                                <th>Asal Sekolah</th>                                                
                                                <th>Total Nilai</th>
                                                <th>Hasil</th>    
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                              <?php  foreach ($peserta as $row): ?>
                                            <tr>
                                                <td><?php echo $row->no_test; ?></td>
                                                <td><?php echo $row->nama; ?> </td>                                                
                                                <td><?php echo $row->asal_sekolah; ?></td>                                                 
                                                <td><?php echo $row->total; ?></td>      
                                                <td>
                                                     <?php if($row->status_peserta==2) {?> 
                                                     <button class="btn btn-success btn-xs" type="button" data-toggle="modal" data-target="#myModal<?php echo $row->id_peserta;?>">Diterima</button>
                                                     <?php } else {?>
                                                     <button class="btn btn-danger btn-xs" type="button" data-toggle="modal" data-target="#myModal<?php echo $row->id_peserta;?>">Tidak Diterima</button>
                                                     <?php }?>                                                   
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $row->id_peserta;?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach;?>
                                        </tbody>
                                    </table>
                                    <?php  endif; ?>
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
    
 <div class="modal fade" id="myModalUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>hasil/updateHasil" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Hasil Seleksi Penerimaan Siswa Baru</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        
            <input name="tahun" class="form-control" style="width: 50%; display:none;" value="<?php echo $tahun;?>">                                            
            <div class="form-group">
                <label>Kuota</label>
                <input name="kuota" class="form-control" style="width: 50%;" value="<?php echo $kuota; ?>">                                
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary" >Perbarui</button>
      </div>
      </form>
    </div>
  </div>
</div>
    
    
<div class="modal fade" id="myModalPublish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-vertical-centered">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>hasil/publish" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto; max-height: 420px;">
        
        <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
            Anda yakin ingin <?php if($periodenow->status_periode==0) echo "publish"; else echo "unpublish"; ?> hasil seleksi periode ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-success" >Yakin</button>
      </div>
      </form>
    </div>
  </div>
</div>
    
<?php if(isset($peserta) && $peserta!=null):?>
<?php foreach ($peserta as $row): ?> 
<div class="modal fade" id="myModal<?php echo $row->id_peserta;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-vertical-centered">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>hasil/updatePeserta" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto; max-height: 420px;">
        <input name="id_peserta" value="<?php echo $row->id_peserta; ?>" class="form-control" style="display:none;" >
        <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
            Anda yakin ingin mengganti hasil seleksi calon siswa ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
        <button type="submit" class="btn btn-success" >Yakin</button>
      </div>
      </form>
    </div>
  </div>
</div>

<?php endforeach; endif;?>

<?php if(isset($peserta) && $peserta!=null):?>
<?php foreach ($peserta as $row): ?> 
<div class="modal fade" id="myModalEdit<?php echo $row->id_peserta;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>peserta/editPeserta" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Detail Nilai Calon Siswa Baru</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        
            <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
            <input name="id_peserta" value="<?php echo $row->id_peserta; ?>" class="form-control" style="display:none;" >
                   
            <?php $listSeleksi = $ci->seleksi_model->select_seleksi_byPesertaNew($row->id_peserta);?>
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>Jenis Tes</th>
                        <th>Nilai</th>
                        <th>Pengali</th>                        
                    </tr>
                </thead>

            <?php foreach($listSeleksi as $seleksi): if($seleksi->status_tes!=2):?>
                
                <tr>
                    <td><?php echo $seleksi->jenis_tes; ?></td>
                    <td><?php echo $seleksi->totalnilai; ?></td>
                    <td><?php echo $seleksi->bobot; ?></td>
                </tr>
            <?php endif; endforeach; ?>
            </table>
        
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
    