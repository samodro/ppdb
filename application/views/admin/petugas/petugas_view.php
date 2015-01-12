
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Data Petugas
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">                            
                                <button type="button" class="btn btn-primary btn-lg fa fa-plus-circle" data-toggle="modal" data-target="#myModal">
                                   &nbsp; Tambah Petugas
                                </button>
                                
                                <br/>
                                <br/>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Nama Petugas</th>
                                                <th>Username</th>                                                
                                                <th>Password</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                             <?php if(isset($petugas) && $petugas!=null):
                                                foreach ($petugas as $row): ?>
                                            <tr>
                                                
                                                <td><?php echo $row->nama; ?> </td>                                                
                                                <td><?php echo $row->username; ?></td>
                                                <td>*****</td>                                                
                                                <td>
                                                    <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModalEdit<?php echo $row->id_user;?>">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#myModalDelete<?php echo $row->id_user;?>">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php endforeach; endif;?>                                                                          
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
        <form role="form" action="<?php echo base_url();?>petugas/tambahPetugas" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Tambah Petugas</h4>
      </div>
      <div class="modal-body">
        

            <div class="form-group">
                <label>Nama Petugas</label>
                <input name="nama" class="form-control" style="width: 50%;" >                                
            </div>
            <div class="form-group">
                <label>Username</label>
                <input name="username" class="form-control" style="width: 50%;" >                                
            </div>           
            <div class="form-group">
                <label>Password</label>
                <input name="pass" class="form-control" type="password" style="width: 50%;" >                                
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


<?php if(isset($petugas) && $petugas!=null):?>
<?php foreach ($petugas as $row): ?> 
<div class="modal fade" id="myModalEdit<?php echo $row->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>petugas/editPetugas" method="post"> 
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Petugas</h4>
      </div>
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        
            
            <input name="id_user" value="<?php echo $row->id_user; ?>" class="form-control" style="display:none;" >
                   
            <div class="form-group">
                <label>Nama Petugas</label>
                <input name="nama" class="form-control" style="width: 50%;" value="<?php echo $row->nama; ?>">                                
            </div>
            <div class="form-group">
                <label>Username</label>
                <input name="username" class="form-control" style="width: 50%;" value="<?php echo $row->username;?>" >                                
            </div>           
            <div class="form-group">
                <label>Password</label>
                <input name="pass" class="form-control"  type="password" style="width: 50%;" value="<?php echo $row->pass;?>">                                
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

    <?php if(isset($petugas) && $petugas!=null):?>
<?php foreach ($petugas as $row): ?> 
<div class="modal fade" id="myModalDelete<?php echo $row->id_user;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
  <div class="modal-dialog">
    <div class="modal-content">
        <form role="form" action="<?php echo base_url();?>petugas/deletePetugas" method="post"> 
      
      <div class="modal-body" style="overflow-y:auto;max-height: 420px;">
        <input name="id_user" value="<?php echo $row->id_user; ?>" class="form-control" style="display:none;" >
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
