
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Seleksi                       
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">
                            <div class="form-group">
                                <label>Periode Seleksi</label>
                                <select class="form-control" name="status" style="width: 50%;">
                                    <?php if(isset($periode) && $periode!=null):?>
                                    <?php foreach ($periode as $row): ?>
                                        <option value="<?php echo $row->tahun;?>" <?php if($row->tahun==$tahun) echo "selected"; ?>><?php echo $row->tahun;?>/<?php echo $row->tahun+1;?></option>
                                    <?php endforeach;?>
                                    <?php else:?>
                                        <option value="<?php echo date('Y');?>"><?php echo date('Y');?>/<?php echo date('Y')+1;?></option>                                    
                                    <?php endif; ?>                      
                                </select>
                            </div>                                 
                                <div class="table-responsive">
                                    <?php if(isset($tes) && $tes!=null): ?>
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tes</th>
                                                <th>Tipe Tes</th>
                                                <th></th>
                                               <!-- <th>Bobot</th>-->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                            <?php foreach($tes as $row): ?>
                                            <tr>
                                                <td><?php echo $row->jenis_tes?></td>
                                                <td><?php if($row->status==1) echo "Penilaian Huruf"; elseif ($row->status==2) echo "Pengumpulan"; else echo "Penilaian Angka"; ?></td>
                                                <td><a href="<?php echo base_url(); ?>seleksi/detailSeleksi?id_tes=<?php echo $row->id_tes; ?>" > <button class="btn btn-success btn-xs" type="button">Pilih</button></a></td>
                                                <!--<td><?php echo $row->bobot ?></td>-->
                                            </tr>
                                            <?php endforeach;?>                                            
                                        </tbody>
                                    </table>
                                    <?php endif; ?>
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
