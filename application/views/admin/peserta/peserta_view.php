
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
                    <div class="col-lg-12">
                        
                        <form role="form" action="<?php echo base_url();?>peserta/lihatPeserta">
                            <div class="form-group">
                                <label>Periode Seleksi</label>
                                <select class="form-control" name="tahun" id="periode" style="width: 20%;">
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
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModalTambah">
                                   &nbsp; Tambah Calon Siswa Baru
                                </button>
                                <button type="button" id="generate" class="btn btn-success btn-lg fa fa-refresh">
                                   &nbsp; Tentukan No Tes
                                </button>                                
                                <br/>
                                <br/>                                
                                <div class="table-responsive">
                                    <?php if(isset($peserta) && $peserta!=null):?>
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>No Tes</th>
                                                <th>Nama Peserta</th>                                                   
                                                <th>Asal Sekolah</th>                                                                                          
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                             <?php   foreach ($peserta as $row): ?>
                                            <tr>
                                                <td><?php if($row->no_test=='') echo "-"; else echo $row->no_test; ?> </td>                                                
                                                <td><?php echo $row->nama; ?> </td>                                                
                                                <td><?php echo $row->asal_sekolah; ?></td>                                                                                               
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $row->id_peserta;?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete<?php echo $row->id_peserta;?>">
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
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
    <!-- Modal -->
<div class="modal fade" id="myModalTambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>peserta/tambahPeserta" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Calon Siswa Baru</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        
            <input name="tahun" value="<?php echo $tahun ?>" class="form-control" style="display:none;" >
                   
            <div class="form-group">
                <label>Nama</label>
                <input name="nama" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input name="tempat" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="text" name="tanggal" value="01/01/2000" id="datepicker" class="form-control">                              
            </div>                
            <div class="form-group">
                <label>Asal Sekolah</label>
                <input name="asal" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Nilai UN</label>
                <input name="nilai" class="form-control" style="width: 20%;" >                                
            </div>           
            <div class="form-group">
                <label>Nama Orang Tua</label>
                <input name="ortu" class="form-control" style="width: 50%;" >                                
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

<?php if(isset($peserta) && $peserta!=null):?>
<?php foreach ($peserta as $row): ?> 
<div class="modal fade" id="myModalEdit<?php echo $row->id_peserta;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>peserta/editPeserta" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Calon Siswa Baru</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        
            <input name="tahun" value="<?php echo $tahun; ?>" class="form-control" style="display:none;" >
            <input name="id_peserta" value="<?php echo $row->id_peserta; ?>" class="form-control" style="display:none;" >
                   
            <div class="form-group">
                <label>Nama</label>
                <input name="nama" value="<?php echo $row->nama; ?>" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <input name="alamat" value="<?php echo $row->alamat; ?>" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input name="tempat" class="form-control" value="<?php echo $row->tempat; ?>" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="text" name="tanggal" value="<?php echo date("d/m/Y", strtotime($row->ttl)); ?>" id="datepicker<?php echo $row->id_peserta;?>" class="form-control">                              
            </div>                
            <div class="form-group">
                <label>Asal Sekolah</label>
                <input name="asal" class="form-control" value="<?php echo $row->asal_sekolah; ?>" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Nilai UN</label>
                <input name="nilai" class="form-control" style="width: 20%;" value="<?php echo $row->nilaiUN; ?>">                                
            </div>
         
            <div class="form-group">
                <label>Nama Orang Tua</label>
                <input name="ortu" class="form-control" style="width: 50%;" value="<?php echo $row->nama_orang_tua; ?>">                                
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

    <?php if(isset($peserta) && $peserta!=null):?>
<?php foreach ($peserta as $row): ?> 
<div class="modal fade" id="myModalDelete<?php echo $row->id_peserta;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>peserta/deletePeserta" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        <input name="id_peserta" value="<?php echo $row->id_peserta; ?>" class="form-control" style="display:none;" >
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
        $('#generate').click(function() {
            window.location = "<?php echo base_url();?>peserta/generateNoTes?tahun=<?php echo $tahun;?>";
        });
    </script>