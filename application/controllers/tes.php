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
            $this->load->model('periode_model');
            $this->load->model('kriteria_model');
            
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
                if($this->input->get('id_tes')!='')
                {
                    $data['kriteria'] = $this->kriteria_model->select_kriteria_tes($this->input->get('id_tes'));
                    $data['tes'] = $this->tes_model->get_tes($this->input->get('id_tes'));
                    $this->load->view('admin/header_view');
                    $this->load->view('admin/tes/kriteria_view',$data);
                    $this->load->view('admin/footer_view');
                }
                else
                {
                    redirect(base_url().'tes/lihatTes');
                }
        }
        
        public function editKriteria()
        {
            if($this->input->post('jenis') && $this->input->post('bobot'))
            {

                $kriteria = $this->kriteria_model->get_kriteria($this->input->post('id_kriteria'));                
                
                                                
                $kriteria->jenis_kriteria  = $this->input->post('jenis');                
                $kriteria->status = $this->input->post('status');
                $kriteria->bobot = $this->input->post('bobot');                                                                                                                
                
                //echo  $this->input->post('tahun');
                $this->kriteria_model->update_kriteria($kriteria->id_kriteria,$kriteria);
                
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }
            else
            {
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }
        }

        public function deleteKriteria()
        {
            if($this->input->post('id_kriteria'))
            {
                $kriteria = $this->kriteria_model->get_kriteria($this->input->post('id_kriteria'));                                                                                
                $kriteria->trash  = 'y';
                $this->kriteria_model->update_kriteria($kriteria->id_kriteria,$kriteria);
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }
            else
            {
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }                        
        }
        
        public function tambahKriteria()
        {
            if($this->input->post('jenis'))
            {
                $kriteria = array(
                                'id_kriteria' => '',
                                'id_tes' => $this->input->post('id_tes'),
                                'jenis_kriteria' => $this->input->post('jenis'),
                                'status' => $this->input->post('status'),
                                'bobot' => $this->input->post('bobot'),
                                'tahun' => $this->input->post('tahun'),
                                'trash' => 'n',
                            );
                $this->kriteria_model->add_kriteria($kriteria);
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }
            else
            {
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'));
            }
        }
        
        public function coba()
        {
            $this->load->view('admin/seleksi/coba_view');
        }
        
        public function lihatTes()
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
                $this->load->view('admin/tes/tes_view',$data);
                $this->load->view('admin/footer_view');
        }
        
        public function editTes()
        {
            if($this->input->post('jenis') && $this->input->post('bobot'))
            {

                $tes = $this->tes_model->get_tes($this->input->post('id_tes'));                
                
                                                
                $tes->jenis_tes  = $this->input->post('jenis');                
                $tes->status = $this->input->post('status');
                $tes->bobot = $this->input->post('bobot');                                                                                                                
                
                //echo  $this->input->post('tahun');
                $this->tes_model->update_tes($tes->id_tes,$tes);
                
                redirect(base_url().'tes/lihatTes');
            }
            else
            {
                redirect(base_url().'tes/lihatTes');
            }
        }

        public function deleteTes()
        {
            if($this->input->post('id_tes'))
            {
                $tes = $this->tes_model->get_tes($this->input->post('id_tes'));                                                                                
                $tes->trash  = 'y';
                $this->tes_model->update_tes($tes->id_tes,$tes);
                redirect(base_url().'tes/lihatTes');
            }
            else
            {
                redirect(base_url().'tes/lihatTes');
            }                        
        }
        
        public function tambahTes()
        {
            if($this->input->post('jenis'))
            {
                $tes = array(
                                'id_tes' => '',
                                'jenis_tes' => $this->input->post('jenis'),
                                'status' => $this->input->post('status'),
                                'bobot' => $this->input->post('bobot'),
                                'tahun' => $this->input->post('tahun'),
                                'trash' => 'n',
                            );
                $this->tes_model->add_tes($tes);
                redirect(base_url().'tes/lihatTes');
            }
            else
            {
                redirect(base_url().'tes/lihatTes');
            }
        }
        

        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */