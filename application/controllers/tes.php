<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tes extends CI_Controller {

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
            
            session_start();
            
        }        
        
	public function index()
	{
		$this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
	}
        
        public function kriteria()
        {
                $this->load->view('admin/header_view');
                $this->load->view('admin/tes/kriteria_view');
                $this->load->view('admin/footer_view');
        }
        
        public function coba()
        {
            $this->load->view('admin/seleksi/coba_view');
        }
        public function lihatTes()
        {
                $this->load->view('admin/header_view');
                $this->load->view('admin/tes/tes_view');
                $this->load->view('admin/footer_view');
        }
        

        public function tambahTes()
        {
            if($this->input->post('jenis'))
            {
                $rekening = array(
                                'id_test' => '',
                                'jenis_test' => $this->input->post('jenis'),
                                'status' => 0,
                                'trash' => 'n',
                            );
                $this->test_model->add_test($test);
            }
            else
            {
                redirect('test/lihatTest');
            }
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */