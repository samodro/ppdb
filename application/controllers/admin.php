<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

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
            
            $this->load->model('periode_model');
            $this->load->model('tes_model');
        }
        
	public function index()
	{		
                $this->load->view('admin/login_view');                
	}
        
        public function dashboard()
        {
                $periode = $this->periode_model->select_periode();
                
                if($periode==null || ($periode!=null && $periode[0]->tahun!=date("Y")))
                {
                    $data = array(
                        'id_periode' => '',
                        'tahun'  => date("Y"),
                        'trash' => 'n'
                    );
                    $this->periode_model->add_periode($data);
                    
                    $tes = array(
                        'id_tes' => '',
                        'tahun' => date("Y"),
                        'trash' => 'n',
                        'jenis_tes' => 'Tes Administratif',
                        'bobot' => '1',
                        'status' => '2'
                        
                    );
                    $this->tes_model->add_tes($tes);
                }
                
                $this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
        }
        
        public function coba()
        {
            $this->load->view('admin/coba');
        }
        
        public function periode()
        {
        
            $this->load->view('admin/header_view');
            $this->load->view('admin/periode_view');
            $this->load->view('admin/footer_view');
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */