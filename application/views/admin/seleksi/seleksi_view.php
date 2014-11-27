
        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Seleksi Penerimaan Siswa Baru 2014/2015
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

                <div class="row">
                    <div class="col-lg-6">

                        <form role="form" action="<?php echo base_url();?>tes/doTambahTes">
                            <div class="form-group">
                                <label>Periode Tes</label>
                                <select class="form-control" name="status" style="width: 50%;">
                                    <option value="2014">2014/2015</option>
                                    <option value="2013">2013/2014</option>                    
                                </select>
                            </div>                                 
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped">
                                        <thead>
                                            <tr>
                                                <th>Jenis Tes</th>
                                                <th>Tipe Tes</th>
                                                <th>Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Tes Administratif</td>
                                                <td>Pengumpulan</td>
                                                <td>2</td>
                                            </tr>
                                            <tr>
                                                <td>Tes Kemampuan Dasar</td>
                                                <td>Penilaian</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>Tes Kemampuan Agama</td>
                                                <td>Penilaian</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td><a href="<?php echo base_url();?>seleksi/detailSeleksi">Tes Kemampuan Bahasa<a/></td>
                                                <td>Penilaian</td>
                                                <td>1</td>
                                            </tr>
                                            <tr>
                                                <td>Tes Psikologi</td>
                                                <td>Penilaian</td>
                                                <td>3</td>
                                            </tr>
                                            <tr>
                                                <td>Tes Wawancara</td>
                                                <td>Penilaian</td>
                                                <td>1</td>
                                            </tr>
                                        </tbody>
                                    </table>
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
