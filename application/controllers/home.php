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
    }

    public function index()
    {
        $this->load->view('header_view');
        $this->load->view('home_view');
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
                
                $this->load->view('peraturan_view');
               
	}
    
    public function peraturanadmin()
	{
            
	    $this->load->view('peraturan_view_admin');
	}
        
    public function persyaratan()
    {
        $this->load->view('header_view');
        $this->load->view('persyaratan_view');
        $this->load->view('footer_view');
		
    }
    
    public function persyaratanadmin()
	{
		$this->load->view('persyaratan_view_admin');
	}
        
    public function tatacarapendaftaran()
	{		
                $this->load->view('header_view');
                $this->load->view('tatacarapendaftaran_view');
                $this->load->view('footer_view');
	}
        
   public function tatacarapendaftaranadmin()
	{
		$this->load->view('tatacarapendaftaran_view_admin');
	}
        
   public function jadwalkegiatan()
	{
                $this->load->view('header_view');
                $this->load->view('jadwalkegiatan_view');
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
		$this->load->view('hasilseleksi_view');
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
		$this->load->view('hubungikami_view');
	}
      
   public function hubungikamiadmin()
	{
		$this->load->view('hubungikami_view_admin');
	}
        
 
        
}

?>
