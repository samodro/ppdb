      <div class="jumbotron">
          <?php if($edit==null): ?>
          <h2><?php echo $artikel->judul_artikel; ?></h2>
          <p>
              <?php echo $artikel->isi_artikel; ?>
          </p>
                      
          <?php elseif($user!=null && $edit!=null): ?>
           <form role="form" action="<?php echo base_url();?>home" method="post"> 
          <?php echo '<div class="form-group">
                <h3>Judul</h3>
                <input name="judul_artikel" value="'. $artikel->judul_artikel .'" class="form-control" style="width: 50%;" >                                
            </div>'; ?>    
          <?php echo '<h3>Isi Konten</h3>'; ?>
          <?php echo $this->ckeditor->editor("isi_artikel",$artikel->isi_artikel); ?>
               
          <?php endif; ?>
          <?php if($user!=null && $edit==null): ?>
          <form role="form" action="<?php echo base_url();?>home" method="post"> 
              
              <input name="edit" value="edit" class="form-control" style="display:none;" >
              
              <button type="submit" class="btn btn-success btn-lg pull-right" >
                Edit Konten
              </button>
          </form>
          <?php elseif ($user!=null && $edit!=null): ?>
           
              
              <input name="simpan" value="simpan" class="form-control" style="display:none;" >
              
              <button type="submit" class="btn btn-warning btn-lg pull-right" >
                Simpan
              </button>
          </form>
          <?php endif; ?>
          <br/>
         </div>


    </div>


    
</body>


