
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
                                    
                                    <?php if(isset($kriteria) && $kriteria!=null): ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Peserta</th>
                                                <th>Jenis Kriteria</th>
                                                <?php 
                                                    if($tes->status!=2):?><th>
                                                    Nilai
                                                    </th>
                                                    <?php endif; ?>
                                                <th>Status</th>
                                               <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach($kriteria as $row): ?>
                                            <tr>
                                                <td><?php echo $peserta->nama; ?></td>
                                                <td><?php echo $row->jenis_kriteria; ?></td>
                                                <?php if($tes->status!=2):?><td><?php echo $row->nilai; ?></td>   <?php endif;?>                                                                                                                                             
                                                <td><?php 
                                                    //if($tes->status!=2) :
                                                if($row->status==1) echo '<i class="fa fa-check">'; else echo '<i class="fa fa-times">'; 
                                                //else:
                                                 //  echo '<a href='.base_url().'seleksi/updateStatus/'.$row->id_kriteria_seleksi.'>'; if($row->status==1) echo '<i class="fa fa-check">'; else echo '<i class="fa fa-times">'; echo '</a>';
                                               // endif;
?></i></td>                                     <td>
                                                <?php if($tes->status!=2):?>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal<?php echo $row->id_kriteria_seleksi; ?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                
                                                <?php else:?>
                                                    <a href=<?php echo base_url().'seleksi/updateStatus/'.$row->id_kriteria_seleksi.'>'; ?> <button class="btn btn-success btn-xs" type="button">Ubah Status</button></a>
                                                    
                                                  <?php  endif;?>
                                                </td>
                                            </tr>    
                                            <?php endforeach;  ?>
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
                                </div>
                                                                            
                            </form>
                        </div>
                        

                    </div>
                <a href="<?php echo base_url().'seleksi/detailSeleksi?id_tes='.$tes->id_tes;?>"> <button class="btn btn-primary btn-lg" type="button">Kembali</button></a>
                </div>
            
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
    <!-- Modal -->
    <?php if(isset($kriteria) && $kriteria!=null):?>
<?php foreach ($kriteria as $row): ?> 
<div class="modal fade" id="myModal<?php echo $row->id_kriteria_seleksi;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>seleksi/editNilai" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Nilai</h4>
      </div>
      <div class="modal-body">
          <input name="id_kriteria_seleksi" value="<?php echo $row->id_kriteria_seleksi; ?>" class="form-control" style="display:none;" >
           <input name="status" value="<?php echo $tes->status; ?>" class="form-control" style="display:none;" >
            <?php if($tes->status==1):?>
            <div class="form-group">
                <label>Nilai</label>
                <select class="form-control" name="nilai" style="width: 15%;">
                    <option value="A" <?php if($row->nilai=="A") echo "selected";?> >A</option>
                    <option value="B" <?php if($row->nilai=="B") echo "selected";?> >B</option>
                    <option value="C" <?php if($row->nilai=="C") echo "selected";?> >C</option>
                    <option value="D" <?php if($row->nilai=="D") echo "selected";?> >D</option>
                    <option value="E" <?php if($row->nilai=="E") echo "selected";?> >E</option>
                </select>
            </div>
        <?php elseif($tes->status==3): ?>
          <div class="form-group">
                <label>Nilai</label>
                <input name="nilai" class="form-control" style="width:50%;" value="<?php echo $row->nilai; ?>">                                
            </div>
          <?php else: ?>
           <div class="form-group">
                <label>Berkas</label>
                <div class="checkbox">
                    <label>
                    <input type="checkbox" value="">
                       <?php echo $row->jenis_kriteria; ?>
                    </label>
                    </div>
            </div>
          <?php endif;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <?php     endforeach; endif;?>
