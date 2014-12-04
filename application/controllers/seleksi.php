<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seleksi extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
    
        public function __construct() 
        {
            parent::__construct();            
           
            $this->load->model('tes_model');
            $this->load->model('periode_model');
            $this->load->model('seleksi_model');
            
            session_start();
            
        }  
        
	public function index()
	{
		$this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
	}
        
        public function lihatSeleksi()
	{
                if($this->input->get('tahun')!="")
                {
                    $tahun =  $this->input->get('tahun');
                }
                else
                {
                    $tahun = date("Y");
                }
                
                $data['tahun'] = $tahun;
                
                $data['periode'] = $this->periode_model->select_periode();
                
                $data['tes'] = $this->tes_model->select_tes_periode($tahun);
		$this->load->view('admin/header_view');
                $this->load->view('admin/seleksi/seleksi_view',$data);
                $this->load->view('admin/footer_view');
	}
        
        public function detailSeleksi()
        {
                if($this->input->get('id_tes')!='')
                {
                    $data['seleksi'] = $this->seleksi_model->select_seleksi_peserta($this->input->get('id_tes'));
                    $data['tes'] = $this->tes_model->get_tes($this->input->get('id_tes'));
                    
                    $this->load->view('admin/header_view');
                    $this->load->view('admin/seleksi/detail_seleksi_view',$data);
                    $this->load->view('admin/footer_view');
                }
                else
                {
                    redirect(base_url().'seleksi/lihatSeleksi');
                }
        }
        
        public function kriteriaSeleksi()
        {
                $this->load->view('admin/header_view');
                $this->load->view('admin/seleksi/kriteria_seleksi_view');
                $this->load->view('admin/footer_view');
        }
                
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */