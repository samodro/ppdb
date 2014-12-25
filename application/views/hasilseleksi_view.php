     <div class="jumbotron">
          <?php if($status==2): ?>
          <h2>Hasil Seleksi Penerimaan Calon Siswa Baru <?php echo $tahun."/".($tahun+1); ?></h2>
             <br/>
    <div class="table-responsive">
        <?php if(isset($peserta) && $peserta!=null): ?>
        <table class="table table-bordered table-hover table-striped">
            <thead style="background: #2fa4e7; color: white;">
                <tr>
                    <th>Nama Peserta</th>                                                   
                    <th>Asal Sekolah</th>                 
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

                  <?php  foreach ($peserta as $row): ?>
                <tr>

                    <td><?php echo $row->nama; ?> </td>                                                
                    <td><?php echo $row->asal_sekolah; ?></td>                                        
                    <td>
                         <?php if($row->status_peserta==2) echo "Lulus"; else "Tidak Lulus";?> 
                                                                  
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <?php endif;?>
        </table>
        
      
    </div>  
            <?php else: echo "<h2>Maaf, hasil seleksi penerimaan calon siswa baru belum keluar</h2>";?>
        <?php endif;?>
         </div>
    </div>
    
   

    
</body>