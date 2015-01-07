
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <?php echo $tes->jenis_tes; ?> Calon Siswa/Siswi <?php echo $tes->tahun."/".($tes->tahun+1); ?> 
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-12">         
                        
                                <div class="panel panel-default">
                                    <!-- /.panel-heading -->
                                    
                                    <div class="panel-body">
                                        
                                        <div class="table-responsive">
                                            
                                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                                <thead>
                                                    
                                                        <tr>
                                                            <th>No Tes</th>
                                                            <th>Nama Peserta</th>
                                                            <th>Asal Sekolah</th>                                                            
                                                            <th><?php if($tes->status==2) echo "Berkas"; else echo "Jumlah Nilai"; ?></th>
                                                            <th>Status</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php if(isset($seleksi) && $seleksi!=null): ?>
                                                        <?php foreach($seleksi as $row): ?>
                                                        
                                                        <tr>
                                                            <td><?php echo $row->no_test; ?></td>
                                                            <td><?php echo $row->nama; ?></td>
                                                            <td><?php echo $row->asal_sekolah; ?></td>                                                            
                                                            <td><?php if($tes->status==2) 
                                                            {
                                                                
                                                                if($row->status==0) echo "Belum Lengkap";
                                                                else echo "Lengkap";
                                                            }
                                                            else
                                                            {
                                                                echo $row->totalnilai; 
                                                            }
                                                            ?></td>
                                                            <td>
                                                                <?php if($row->status==0) echo '<i class="fa fa-times">'; else echo '<i class="fa fa-check">'; ?></i>                                                              
                                                            </td>
                                                            <td>
                                                                <a href="<?php echo base_url()?>seleksi/kriteriaSeleksi?id=<?php echo $row->id_seleksi;?>"> <button class="btn btn-success btn-xs" type="button">Pilih</button></a>
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?> 
                                                        <?php endif; ?>
                                                    </tbody>
                                            </table>
                                           
                                        </div>      
                                        
                                    </div>
                                    
                                    <!-- /.panel-body -->
                                </div>
                         <a href="<?php echo base_url().'seleksi/lihatSeleksi';?>"> <button class="btn btn-primary btn-lg" type="button">Kembali</button></a>
                            </div>                    
                                                    

                        

                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    
