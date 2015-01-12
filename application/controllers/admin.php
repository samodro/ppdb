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
            $this->load->model('petugas_model');
            
            session_start();
            
        }
        
	public function index()
	{		
            if($this->session->userdata('id_user')!=null)
            {
                redirect(base_url().'admin/dashboard');
            }
            else
            {
                $this->load->view('admin/login_view');  
            }
	}
        
        public function dashboard()
        {
                $periode = $this->periode_model->select_periode();
                
                
                
                
                if($periode==null || ($periode!=null && $periode[0]->tahun!=date("Y")))
                {
                    $status = false;
                    foreach($periode as $row)
                    {
                        if($row->tahun==date("Y")) $status = true;
                    }
                    
                    if($status==false)
                    {
                        $data = array(
                            'id_periode' => '',
                            'tahun'  => date("Y"),
                            'status_periode' => 0,
                            'kuota' => 100,
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
                }
                
                $this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
        }
        
        public function login()
        {
            if($this->input->post('username') && $this->input->post('password'))
            {
                  $petugas = $this->petugas_model->login($this->input->post('username'), $this->input->post('password'));
                  if($petugas)
                  {
                      $this->session->set_userdata(array(
                            'id_user'       => $petugas->id_user,
                            'nama'          => $petugas->nama,
                            'username'      => $petugas->username,
                            'pass'       => $petugas->pass,
                            'type'          => $petugas->type,                            
                      ));
                      redirect(base_url().'admin/dashboard');
                  }
                  else
                  {
                      redirect(base_url().'admin');
                  }
            }
            else
            {
                redirect(base_url().'admin');
            }
        }
        
        public function logout()
        {
            $this->session->unset_userdata(array(
                            'id_user'       => '',
                            'nama'          => '',
                            'username'      => '',
                            'pass'          => '',
                            'type'          => '',                            
                      ));
            redirect(base_url().'admin');
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
?>