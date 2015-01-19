     <div class="jumbotron">
          <?php if(isset($status) && $status==2): ?>
          <h2>Hasil Seleksi Penerimaan Calon Peserta Didik Baru <?php echo $tahun."/".($tahun+1); ?></h2>
             <br/>
    <div class="table-responsive">
        <?php if(isset($peserta) && $peserta!=null): ?>
        <table class="table table-bordered table-hover table-striped">
            <thead style="background: #2fa4e7; color: white;">
                <tr>
                    <th>No Tes</th>
                    <th>Nama Peserta</th>                                                   
                    <th>Asal Sekolah</th>                 
                    <th>Nilai Total</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>

                  <?php  foreach ($peserta as $row): ?>
                <tr>
                    <td><?php echo $row->no_test; ?></td>
                    <td><?php echo $row->nama; ?> </td>                                                
                    <td><?php echo $row->asal_sekolah; ?></td>
                    <td><?php echo number_format((float)$row->total, 2, '.', '');?></td>
                    <td>
                         <?php if($row->status_peserta==2) echo "Diterima"; else echo "Tidak Diterima";?> 
                                                                  
                    </td>
                </tr>
                <?php endforeach;?>
            </tbody>
            <?php endif;?>
        </table>
        
      
    </div>  
            <?php else: echo "<h2>Maaf, hasil seleksi penerimaan calon peserta didik baru belum keluar</h2>";?>
        <?php endif;?>
         </div>
    </div>
    
   

    
</body>