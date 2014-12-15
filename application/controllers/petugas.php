<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Petugas extends CI_Controller {

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
            
            if($this->session->userdata('id_user') && $this->session->userdata('type')!='admin')
            {
                redirect(base_url.'admin');
            }
            
            $this->load->model('petugas_model');           
        }
        
	public function index()
	{
            $this->load->view('admin/header_view');
            $this->load->view('admin/dashboard_view');
            $this->load->view('admin/footer_view');
	}
        public function lihatPetugas()
        {
            $data['petugas'] = $this->petugas_model->select_petugas();                
            $this->load->view('admin/header_view');
            $this->load->view('admin/petugas/petugas_view',$data);
            $this->load->view('admin/footer_view');
        }
        
        public function tambahPetugas()
        {
            $this->form_validation->set_rules('username', 'username', 'required|is_unique[petugas.username]');
            $this->form_validation->set_rules('pass', 'pass', 'required');
            $this->form_validation->set_rules('nama', 'nama', 'required');
            
            if( $this->form_validation->run() == TRUE )
            {              

                $petugas = array(
                        'id_user' => '',                                                                        
                        'nama' => $this->input->post('nama'),                        
                        'username' => $this->input->post('username'), 
                        'pass' => $this->input->post('pass'),  
                        'type' => 'petugas',  
                        'trash' => 'n',
                );
                
                //echo  $this->input->post('tahun');
                $this->petugas_model->add_petugas($petugas);
                
                redirect(base_url().'petugas/lihatPetugas');
            }
            else
            {
                redirect(base_url().'petugas/lihatPetugas');
            }
        }
        
        public function deletepetugas()
        {
            if($this->input->post('id_user'))
            {
                $petugas = $this->petugas_model->get_petugas($this->input->post('id_user'));                                                                                
                $petugas->trash  = 'y';
                $this->petugas_model->update_petugas($petugas->id_user,$petugas);
                redirect(base_url().'petugas/lihatpetugas');
            }
            else
            {
                redirect(base_url().'admin');
            }                        
        }
        
        
        public function editpetugas()
        {
            if($this->input->post('username') && $this->input->post('pass'))
            {                

                $petugas = $this->petugas_model->get_petugas($this->input->post('id_user'));                
                
                                                
                $petugas->nama  = $this->input->post('nama');                
                $petugas->username = $this->input->post('username');
                $petugas->pass = $this->input->post('pass');                                                                                                                               
                
                //echo  $this->input->post('tahun');
                $this->petugas_model->update_petugas($petugas->id_user,$petugas);
                
                redirect(base_url().'petugas/lihatpetugas');
            }
            else
            {
                redirect(base_url().'admin');
            }
        }
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */