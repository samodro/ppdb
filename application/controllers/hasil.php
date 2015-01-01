<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Hasil extends CI_Controller {

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
            
            if($this->session->userdata('id_user')==null)
            {
                redirect(base_url().'admin');
            }
            
            $this->load->model('peserta_model');
            $this->load->model('periode_model');
            $this->load->model('tes_model');
            $this->load->model('seleksi_model');
            $this->load->model('kriteria_model');
            $this->load->model('kriteria_seleksi_model');
        }
        
	public function index()
	{
                
		$this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
	}
       
        public function hasilSeleksi()
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
                    $data['periodenow'] = $row;
                    
                }
            }
            $data['peserta'] = $this->peserta_model->select_peserta_periode_total($tahun);
            
            $data['kuota'] = $kuota;

            //var_dump($data['peserta']);
            $this->load->view('admin/header_view');
            $this->load->view('admin/hasil/hasil_seleksi_view',$data);
            $this->load->view('admin/footer_view');
           
        }
        
        public function updatePeserta()
        {
            if($this->input->post('id_peserta'))
            {
                $peserta = $this->peserta_model->get_peserta($this->input->post('id_peserta'));
                if($peserta->status_peserta==1)
                {
                    $peserta->status_peserta = 2;
                }
                else
                {
                    $peserta->status_peserta = 1;
                }
                $this->peserta_model->update_peserta($peserta->id_peserta, $peserta);
                
                redirect(base_url().'hasil/hasilSeleksi?tahun='.$this->input->post('tahun'),'refresh');
            }
            else
            {
                redirect(base_url().'ta/admin','refresh');
            }
        }
        
        public function updateHasil()
        {
            $tahun = $this->input->post('tahun');
            $kuota = $this->input->post('kuota');
            if($tahun && $kuota)
            {
                $periode = $this->periode_model->get_periodebyTahun($tahun);
                $periode->kuota = $kuota;
                $this->periode_model->update_periode($periode->id_periode, $periode);

                $listPeserta = $this->peserta_model->select_peserta_periode_total($tahun);

                $i = 1;
                foreach($listPeserta as $row)
                {
                    if($i<=$kuota)
                        $this->peserta_model->update_status($row->id_peserta, 2);
                    else
                        $this->peserta_model->update_status($row->id_peserta, 1);

                }

                redirect(base_url().'hasil/hasilSeleksi?tahun='.$this->input->post('tahun'),'refresh');
            }
            else
            {
                redirect(base_url().'ta/admin','refresh');
            }
            
            
        }
        
        public function publish()
        {
            $tahun = $this->input->post('tahun');
            if($tahun)
            {
                $periode = $this->periode_model->get_periodebyTahun($tahun);
                
                if($periode->status_periode<=1)
                    $periode->status_periode = 2;
                else
                    $periode->status_periode = 1;
                
                $this->periode_model->update_periode($periode->id_periode, $periode);
                
                redirect(base_url().'hasil/hasilSeleksi?tahun='.$this->input->post('tahun'),'refresh');
            }
            else
            {
                redirect(base_url().'ta/admin','refresh');
            }
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */