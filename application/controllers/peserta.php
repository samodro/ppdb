<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Peserta extends CI_Controller {

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
            
            $this->load->model('peserta_model');
            $this->load->model('periode_model');
        }
        
	public function index()
	{
                
		$this->load->view('admin/header_view');
                $this->load->view('admin/dashboard_view');
                $this->load->view('admin/footer_view');
	}
        public function lihatPeserta()
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
                
                $data['peserta'] = $this->peserta_model->select_peserta_periode($tahun);
                
                $this->load->view('admin/header_view');
                $this->load->view('admin/peserta/peserta_view',$data);
                $this->load->view('admin/footer_view');
        }
        
        public function editPeserta()
        {
            if($this->input->post('nama') && $this->input->post('alamat'))
            {
                $tgl = substr($this->input->post('tanggal'), 0, 2);
                $bln = substr($this->input->post('tanggal'), 3, 2);
                $thn = substr($this->input->post('tanggal'), 6, 4); 

                $peserta = $this->peserta_model->get_peserta($this->input->post('id_peserta'));                
                
                                                
                $peserta->nama  = $this->input->post('nama');                
                $peserta->alamat = $this->input->post('alamat');
                $peserta->ttl = $thn."-".$bln."-".$tgl;
                $peserta->tempat = $this->input->post('tempat');
                $peserta->asal_sekolah = $this->input->post('asal');
                $peserta->nilaiUN = $this->input->post('nilai');            
                $peserta->nama_orang_tua = $this->input->post('ortu');                                                                                                  
                
                //echo  $this->input->post('tahun');
                $this->peserta_model->update_peserta($peserta->id_peserta,$peserta);
                
                redirect(base_url().'peserta/lihatPeserta');
            }
            else
            {
                redirect(base_url().'admin');
            }
        }
        
        public function deletePeserta()
        {
            if($this->input->post('id_peserta'))
            {
                $peserta = $this->peserta_model->get_peserta($this->input->post('id_peserta'));                                                                                
                $peserta->trash  = 'y';
                $this->peserta_model->update_peserta($peserta->id_peserta,$peserta);
                redirect(base_url().'peserta/lihatPeserta');
            }
            else
            {
                redirect(base_url().'admin');
            }                        
        }
        public function tambahPeserta()
        {
            if($this->input->post('nama') && $this->input->post('alamat'))
            {
                $tgl = substr($this->input->post('tanggal'), 0, 2);
                $bln = substr($this->input->post('tanggal'), 3, 2);
                $thn = substr($this->input->post('tanggal'), 6, 4); 

                $peserta = array(
                        'id_peserta' => '',                        
                        'no_test' => '',                        
                        'nama' => $this->input->post('nama'),                        
                        'alamat' => $this->input->post('alamat'),
                        'ttl' => $thn."-".$bln."-".$tgl,
                        'tempat' => $this->input->post('tempat'),
                        'asal_sekolah' => $this->input->post('asal'),
                        'nilaiUN' => $this->input->post('nilai'),
                        'periode' => $this->input->post('tahun'),
                        'nama_orang_tua' => $this->input->post('ortu'),                                                                       
                        'timestamp' => date("Y-m-d H:i:s"),                        
                        'trash' => 'n',
                );
                
                //echo  $this->input->post('tahun');
                $this->peserta_model->add_peserta($peserta);
                
                redirect(base_url().'peserta/lihatPeserta');
            }
            else
            {
                redirect(base_url().'peserta/lihatPeserta');
            }
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */