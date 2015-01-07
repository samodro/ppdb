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
            
            session_start();
            
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
            if($this->input->post('nama') && $this->input->post('asal'))
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
                
                redirect(base_url().'peserta/lihatPeserta','refresh');
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
            if($this->input->post('nama') && $this->input->post('asal'))
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
                        'status_peserta' => 0,                        
                        'trash' => 'n',
                );
                
                //echo  $this->input->post('tahun');
                $this->peserta_model->add_peserta($peserta);
                
                $pesertaafter = $this->peserta_model->get_peserta_afterinsert($peserta["timestamp"], $peserta["nama"], $peserta["asal_sekolah"]);
                $tes = $this->tes_model->select_tes_periode($this->input->post('tahun'));
                
                
                
                $seleksi = array(
                    'id_seleksi'=> '',
                    'id_peserta'=> $pesertaafter->id_peserta,
                    'id_tes'=> $tes[0]->id_tes,
                    'totalnilai' => '0',
                    'status' => '0',
                    'tahun' => $pesertaafter->periode,
                    'trash' => 'n'                                        
                );
                
                $this->seleksi_model->add_seleksi($seleksi);
                
                $seleksiafter = $this->seleksi_model->get_seleksi_afterinsert($pesertaafter->id_peserta, $tes[0]->id_tes, $pesertaafter->periode);
                $kriteria = $this->kriteria_model->select_kriteria_tes($tes[0]->id_tes);
                
                foreach ($kriteria as $row)
                {
                    $kriteriaseleksi = array (
                        'id_kriteria_seleksi' => '',
                        'id_seleksi' => $seleksiafter->id_seleksi,
                        'id_kriteria' => $row->id_kriteria,
                        'jenis_kriteria' => $row->jenis_kriteria,
                        'nilai' => '0',
                        'status' => 0,
                        'trash' => 'n'
                    );
                    
                    $this->kriteria_seleksi_model->add_kriteriaseleksi($kriteriaseleksi);
                }
                
                redirect(base_url().'peserta/lihatPeserta','refresh');
            }
            else
            {
                redirect(base_url().'peserta/lihatPeserta','refresh');
            }
        }
        
        public function generateNoTes()
        {
            if($this->input->get('tahun')!='')
            {
                $tahun =  $this->input->get('tahun');
                
                $peserta = $this->peserta_model->select_peserta_periode($tahun);
                
                $i = 1;
                foreach($peserta as $row)
                {
                    $no_test = "";
                    if($i<10)
                    {
                        $no_test = "000".$i;
                    }
                    else if($i < 100)
                    {
                        $no_test = "00".$i;
                    }
                    else if($i < 1000)
                    {
                        $no_test = "0".$i;
                    }
                    else
                    {
                        $no_test = $i;
                    }
                    $i++;
                    $row->no_test = $no_test;
                    
                    $this->peserta_model->update_peserta($row->id_peserta,$row);
                        
                }
                
                redirect(base_url().'peserta/lihatPeserta?tahun='.$tahun,'refresh');
            }
            else
            {
                redirect(base_url().'peserta/lihatPeserta','refresh');
            }
        }
        
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */