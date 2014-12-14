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
            $this->load->model('kriteria_model');
            $this->load->model('kriteria_seleksi_model');
            $this->load->model('peserta_model');
            
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
            if($this->input->get('id')!='')
            {
                $data['kriteria'] = $this->kriteria_seleksi_model->select_kriteriaseleksi_seleksi($this->input->get('id'));                             
                $data['seleksi'] = $this->seleksi_model->get_seleksi($this->input->get('id'));                                                             
                $data['tes'] = $this->tes_model->get_tes($data['seleksi']->id_tes);                                
                $data['peserta'] = $this->peserta_model->get_peserta($data['seleksi']->id_peserta);
                $this->load->view('admin/header_view');
                $this->load->view('admin/seleksi/kriteria_seleksi_view',$data);
                $this->load->view('admin/footer_view');
            }
            else
            {
                redirect(base_url().'seleksi/lihatSeleksi');
            }
        }
        
        public function updateStatus()
        {
            $kriteria = $this->kriteria_seleksi_model->get_kriteriaseleksi($this->uri->segment(3));
            if($kriteria->status == 0)
            {
                $kriteria->status = 1;                
            }
            else
            {
                $kriteria->status = 0;
            }            
            
            $this->kriteria_seleksi_model->update_kriteriaseleksi($kriteria->id_kriteria_seleksi, $kriteria);
           
            
            $seleksi = $this->updateStatusSeleksi($kriteria->id_seleksi);
            
            if($seleksi->status==1) $this->tambahSeleksi($seleksi);
             
            //echo $seleksi->status;
            redirect(base_url().'seleksi/kriteriaSeleksi?id='.$kriteria->id_seleksi);
        }
        
        public function tambahSeleksi($seleksi)
        {
            $peserta = $this->peserta_model->get_peserta($seleksi->id_peserta);
            
            $cekSeleksi = $this->seleksi_model->select_seleksi_byPeserta($seleksi->id_peserta);
            if(count($cekSeleksi)==1)
            {
                            
                $listtes = $this->tes_model->select_tes_periode($seleksi->tahun);
                                
                //var_dump($listtes);
                foreach($listtes as $tes)
                {
                    //var_dump($tes);
                    
                    if($this->seleksi_model->get_seleksi_byPesertaTes($peserta->id_peserta, $tes->id_tes)) continue;
                    $seleksi = array(
                            'id_seleksi'=> '',
                            'id_peserta'=> $peserta->id_peserta,
                            'id_tes'=> $tes->id_tes,
                            'totalnilai' => '0',
                            'status' => '0',
                            'tahun' => $peserta->periode,
                            'trash' => 'n'                                        
                        );

                    $this->seleksi_model->add_seleksi($seleksi);

                    $seleksiafter = $this->seleksi_model->get_seleksi_afterinsert($peserta->id_peserta, $tes->id_tes, $peserta->periode);
                    $kriteria = $this->kriteria_model->select_kriteria_tes($tes->id_tes);

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
                }
            }
                
        }
        
        public function AHP()
        {
            
        }
        
        public function updateNilaiMahasiswa($id_peserta)
        {
            $seleksi = $this->seleksi_model->select_seleksi_byPeserta($id_peserta);
            
            $total = 0;
            foreach($seleksi as $row)
            {
                $total += $row->totalnilai;
            }
                        
            $peserta = $this->peserta_model->get_peserta($id_peserta);
            //$peserta->
            
        }
        
        public function editNilai()
        {
            if($this->input->post('id_kriteria_seleksi') && $this->input->post('nilai'))
            {
                $kriteria = $this->kriteria_seleksi_model->get_kriteriaseleksi($this->input->post('id_kriteria_seleksi'));
                $kriteria->nilai = $this->input->post('nilai');
                $kriteria->status = 1;
                $this->kriteria_seleksi_model->update_kriteriaseleksi($kriteria->id_kriteria_seleksi, $kriteria);
                
                if($this->input->post('status')==1)
                {
                    
                    //AHP
                    $this->updateStatusSeleksi($kriteria->id_seleksi);
                }
                else
                {
                    $listKriteria = $this->kriteria_seleksi_model->select_kriteriaseleksi_seleksi($kriteria->id_seleksi);
                    
                    $total = 0;
                    $complete = true;
                    foreach($listKriteria as $row)
                    {
                        $total += $row->nilai;
                        if($row->status==0) $complete = false;
                    }
                    
                    $seleksi = $this->seleksi_model->get_seleksi($kriteria->id_seleksi);
                    $seleksi->totalnilai = $total;
                    if($complete) $seleksi->status = 1;
                    $this->seleksi_model->update_seleksi($seleksi->id_seleksi, $seleksi);    
                    
                    //$this->updateNilaiMahasiswa($seleksi->id_peserta);
                }
                redirect(base_url().'seleksi/kriteriaSeleksi?id='.$kriteria->id_seleksi);
            }
            else
            {
                redirect(base_url().'seleksi/lihatSeleksi');
            }
        }
            
        public function updateStatusSeleksi($id_seleksi)
        {
            $kriteria = $this->kriteria_seleksi_model->select_kriteriaseleksi_seleksi($id_seleksi);
                
            $done = true;

            foreach($kriteria as $row)
            {
                if($row->status==0)
                {
                    $done = false;
                    break;
                }
            }

            $seleksi = $this->seleksi_model->get_seleksi($id_seleksi);

            if($done)
            {
                $seleksi->status = 1;                
            }
            else
            {
                $seleksi->status = 0;
            }
                
            $this->seleksi_model->update_seleksi($seleksi->id_seleksi, $seleksi);
            
            return $seleksi;
        }
                
        
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */