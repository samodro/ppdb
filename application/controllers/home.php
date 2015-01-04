<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('peserta_model');
        $this->load->model('periode_model');
        $this->load->model('artikel_model');
        $this->load->library('ckeditor');
        $this->load->library('ckfinder');
        
        session_start();
            
        
    }

    public function index()
    {
        if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('home');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('home');
        
        $this->load->view('header_view');
        $this->load->view('home_view',$data);
        $this->load->view('footer_view');
    }
    
   /* public function login(){
        $username = $this->input->post('inputEmail');
        $password = $this->input->post('inputPassword');
        
        $this->load->model('login');
        $success = $this->login->login($username, $password);
        
        if ($success) {
            $username = $this->session->userdata('username');
            $this->load->view('home_admin_view');
        }
        else {
            
            $this->load->view('home_view');
        }
    }*/

     public function login()
    {
        $this->load->view('login_view');
        
        $username = $this->input->post('inputEmail');
        $password = $this->input->post('inputPassword');
        
        $this->load->model('login');
        $success = $this->login->login($username, $password);
        
        if ($success) {
            $username = $this->session->userdata('username');
            $this->load->view('home_admin_view');
        }
        else {
            
            $this->load->view('home_view');
        }
    }
    
    public function peraturan()
    {
        if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('peraturan');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('peraturan');
        
        $this->load->view('header_view');
        $this->load->view('peraturan_view',$data);
        $this->load->view('footer_view');
    }
    
    public function peraturanadmin()
	{
            
	    $this->load->view('peraturan_view_admin');
	}
        
    public function persyaratan()
    {
        
        if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('persyaratan');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('persyaratan');
        
        $this->load->view('header_view');
        $this->load->view('persyaratan_view',$data);
        $this->load->view('footer_view');
        
        
		
    }
    
    public function persyaratanadmin()
	{
		$this->load->view('persyaratan_view_admin');
	}
        
    public function tatacarapendaftaran()
    {		
        if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('tata cara pendaftaran');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('tata cara pendaftaran');
        
        $this->load->view('header_view');
        $this->load->view('tatacarapendaftaran_view',$data);
        $this->load->view('footer_view');
    }
        
   public function tatacarapendaftaranadmin()
	{
		$this->load->view('tatacarapendaftaran_view_admin');
	}
        
   public function jadwalkegiatan()
   {		
        if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('jadwal kegiatan');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('jadwal kegiatan');
        
        $this->load->view('header_view');
        $this->load->view('jadwalkegiatan_view',$data);
        $this->load->view('footer_view');
   }
   
   public function jadwalkegiatanadmin()
	{
		$this->load->view('jadwalkegiatan_view_admin');
	}
        
   public function seleksiadmin()
	{
		$this->load->view('seleksi_view');
	}
        
    public function hasilseleksi()
    {
        if($this->input->get('tahun')!='')
        {
            $tahun =  $this->input->get('tahun');
        }
        else
        {
            $tahun = date("Y");
        }

        $data['tahun'] = $tahun;

        $data['periode'] = $this->periode_model->select_periode();

        $kuota = 0;


        foreach($data['periode'] as $row)
        {
            if($row->tahun == $tahun) 
            {
                $kuota = $row->kuota;
                $status = $row->status_periode;
                $data['periodenow'] = $row;

            }
        }
        $data['peserta'] = $this->peserta_model->select_peserta_periode_total($tahun);

        $data['kuota'] = @$kuota;
        $data['status'] = @$status;
        $this->load->view('header_view');
        $this->load->view('hasilseleksi_view',$data);
        $this->load->view('footer_view');
    }
   
    public function ppdb()
	{
		$this->load->view('ppdb_view');
	}
   
    public function ppdbadmin()
	{
		$this->load->view('ppdb_view_admin');
	}
        
    public function visimisi()
	{
		$this->load->view('visimisi_view');
	}
        
    public function visimisiadmin()
	{
		$this->load->view('visimisi_view_admin');
	}
        
    public function tatatertib()
	{
		$this->load->view('tatatertib_view');
	}
    
    public function tatatertibadmin()
	{
		$this->load->view('tatatertib_view_admin');
	}    
        
    public function fasilitas()
	{
		$this->load->view('fasilitas_view');
	}

    public function fasilitasadmin()
	{
		$this->load->view('fasilitas_view_admin');
	}
        
    public function dataguru()
	{
		$this->load->view('dataguru_view');
	}
     
    public function dataguruadmin()
	{
		$this->load->view('dataguru_view_admin');
	}
       
   public function hubungikami()
   {
       if($this->input->post('judul_artikel') && $this->input->post('isi_artikel'))
        {
            $artikel = $this->artikel_model->get_artikelbyJenis('hubungi kami');
            
            $artikel->isi_artikel = $this->input->post('isi_artikel');
            $artikel->judul_artikel = $this->input->post('judul_artikel');
            
            $this->artikel_model->update_artikel($artikel->id_artikel, $artikel);
        }
        
        $this->ckeditor->basePath = base_url().'ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
                                                            );
         * 
         */
        $this->ckeditor->config['language'] = 'indonesia';
        $this->ckeditor->config['width'] = '730px';
        $this->ckeditor->config['height'] = '300px';            

        //Add Ckfinder to Ckeditor
        $this->ckfinder->SetupCKEditor($this->ckeditor,'../../ckfinder/'); 
        
        $data['edit'] = $this->input->post('edit');
        $data['user'] = $this->session->userdata('id_user');
        $data['artikel'] = $this->artikel_model->get_artikelbyJenis('hubungi kami');
        
        $this->load->view('header_view');
        $this->load->view('hubungikami_view',$data);
        $this->load->view('footer_view');
   }
      
   public function hubungikamiadmin()
	{
		$this->load->view('hubungikami_view_admin');
	}
        
 
        
}

?>
