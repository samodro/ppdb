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
            
            if($this->session->userdata('id_user')==null)
            {
                redirect(base_url().'admin');
            }
           
            $this->load->model('tes_model');
            $this->load->model('periode_model');
            $this->load->model('seleksi_model');
            $this->load->model('kriteria_model');
            $this->load->model('kriteria_seleksi_model');
            $this->load->model('peserta_model');
            $this->load->model('sub_kriteria_model');
            
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
                    redirect(base_url().'seleksi/lihatSeleksi','refresh');
                }
        }
        
        public function kriteriaSeleksi()
        {
            if($this->input->get('id')!='')
            {
                $data['kriteria'] = $this->kriteria_seleksi_model->select_kriteriaseleksi_seleksi($this->input->get('id'));                             
                $data['seleksi'] = $this->seleksi_model->get_seleksi($this->input->get('id'));                                                             
                $data['tes'] = $this->tes_model->get_tes($data['seleksi']->id_tes);    
                $data['sub_kriteria'] = $this->sub_kriteria_model->select_sub_kriteria_byIdTes($data['seleksi']->id_tes);
                $data['peserta'] = $this->peserta_model->get_peserta($data['seleksi']->id_peserta);
                $this->load->view('admin/header_view');
                $this->load->view('admin/seleksi/kriteria_seleksi_view',$data);
                $this->load->view('admin/footer_view');
            }
            else
            {
                redirect(base_url().'seleksi/lihatSeleksi','refresh');
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
            redirect(base_url().'seleksi/kriteriaSeleksi?id='.$kriteria->id_seleksi,'refresh');
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
        
        
        
        public function updateStatusMahasiswa($id_peserta)
        {
            $seleksi = $this->seleksi_model->select_seleksi_byPeserta($id_peserta);
            
            $complete = true;
            foreach($seleksi as $row)
            {
                if($row->status==0) $complete = false;
            }
                       
            $peserta = $this->peserta_model->get_peserta($id_peserta);
            
            if($complete && $peserta->status_peserta==0) $peserta->status_peserta = 1;
            
            $this->peserta_model->update_peserta($peserta->id_peserta, $peserta);
            
            
            
        }
        
        public function AHPsubKriteria($id_tes, $formSubmit)
        {
            $sub_kriteria = $this->sub_kriteria_model->select_sub_kriteria_byIdTes($id_tes);
            
            $ahp1 = array();
            $totalahp1 = array(); 
            $totalahp2 = array(); 
            
            $i = 0;
            
            foreach($sub_kriteria as $row)
            {
                $ahp1[$i] = array();
            }
            
            
            $i = 0;
            foreach($sub_kriteria as $row)
            {
                
                $j = 0;
                $totalahp1[$i] = 0;
                foreach($sub_kriteria as $kolom)
                {
                    $ahp1[$j][$i] = $kolom->bobot/$row->bobot;
                    //echo $j." - ".$i." - ".$ahp1[$j][$i]."<br/>";
                    $totalahp1[$i] += $ahp1[$j][$i];
                    $j++;
                }
                $i++;
            }
            
            if( $formSubmit != 'newsubmit' ) 
            {
                echo "<h1>SUB KRITERIA</h1>";
                echo "<br/> TABEL 1 <br/>";

                echo "<table border='2'><thead><tr>";
                echo "<th></th>";
                for($i = 0; $i<count($sub_kriteria); $i++)
                {
                    echo "<th>".$sub_kriteria[$i]->jenis_sub_kriteria."</th>";
                }
                echo "</tr></thead>";
            
                for($i = 0; $i<count($sub_kriteria); $i++)
                {
                    echo "<tr>";
                    echo "<td>".$sub_kriteria[$i]->jenis_sub_kriteria."</td>";
                    for($j = 0; $j<count($sub_kriteria); $j++)
                    {
                        echo "<td>".sprintf("%.2f", $ahp1[$i][$j])."</td>";
                    }
                    echo "</tr>";
                }

                echo "<tr>";
                echo "<td>Total</td>";                      
                for($i = 0; $i<count($sub_kriteria); $i++)
                {
                    echo "<td>".$totalahp1[$i]."</td>";
                }

                echo "</tr></table>";

            }
          
            
           
            for($i = 0; $i<count($sub_kriteria); $i++)
            {
                $totalahp2[$i] = 0;
                for($j = 0; $j<count($sub_kriteria); $j++)
                {
                    $ahp1[$i][$j] /= $totalahp1[$i];
                     
                    
                    $totalahp2[$i] += $ahp1[$i][$j];
                }
                
            }
            
                      
            if( $formSubmit != 'newsubmit' ) 
            {
                echo "<br/> TABEL 2 <br/>";
                echo "<table border='2'><thead><tr>";
                echo "<th></th>";
                for($i = 0; $i<count($sub_kriteria); $i++)
                {
                    echo "<th>".$sub_kriteria[$i]->jenis_sub_kriteria."</th>";
                }
                echo "<th>Eigen Vektor Normalisasi sub-Kriteria</th></tr></thead>";
                for($i = 0; $i<count($sub_kriteria); $i++)
                {
                    echo "<tr>";
                    echo "<td>".$sub_kriteria[$i]->jenis_sub_kriteria."</td>";
                    for($j = 0; $j<count($sub_kriteria); $j++)
                    {
                        echo "<td>".sprintf("%.2f", $ahp1[$i][$j])."</td>";
                    }
                    echo "<td>".$totalahp2[$i]."</td>";
                    echo "</tr>";
                }

                echo "</table>"; 
            }
            
            $subKriteria = array();
            $i = 0;
            foreach($sub_kriteria as $row)
            {
                
                $subKriteria[$i] = array(
                    'jenis_sub_kriteria' => $row->jenis_sub_kriteria,
                    'bobot' => $row->bobot,
                    'ahp' => $totalahp2[$i]
                );
                $i++;
            }
               
            return $subKriteria;
            
        }
        
        public function AHPKriteria($kriteria, $formSubmit)
        {
            $seleksi = $this->seleksi_model->get_seleksi($kriteria->id_seleksi);
            
            $subKriteria = $this->AHPsubKriteria($seleksi->id_tes, $formSubmit);
            
            $listKriteria = $this->kriteria_seleksi_model->select_kriteriaseleksi_new($kriteria->id_seleksi);
            
            //var_dump($subKriteria);
            //echo count($listKriteria);
            $ahp1 = array();
            $totalahp1 = array(); 
            $totalahp2 = array(); 
            
            $i = 0;
            
            foreach($listKriteria as $row)
            {
                $ahp1[$i] = array();
            }
            
            
            $i = 0;
            foreach($listKriteria as $row)
            {
                
                $j = 0;
                $totalahp1[$i] = 0;
                foreach($listKriteria as $kolom)
                {
                    $ahp1[$j][$i] = $kolom->bobot_kri/$row->bobot_kri;
                    //echo $j." - ".$i." - ".$ahp1[$j][$i]."<br/>";
                    $totalahp1[$i] += $ahp1[$j][$i];
                    $j++;
                }
                $i++;
            }
            
            
            if( $formSubmit != 'newsubmit' ) 
            {
                
            //echo count($listKriteria);
                echo "<h1>KRITERIA</h1>";
                echo "<br/> TABEL 1 <br/>";

                echo "<table border='2'><thead><tr>";
                echo "<th></th>";
                for($i = 0; $i<count($listKriteria); $i++)
                {
                    echo "<th>".$listKriteria[$i]->jenis_kriteria."</th>";
                }
                echo "</tr></thead>";
                for($i = 0; $i<count($listKriteria); $i++)
                {
                    echo "<tr>";
                    echo "<td>".$listKriteria[$i]->jenis_kriteria."</td>";
                    for($j = 0; $j<count($listKriteria); $j++)
                    {
                        echo "<td>".$ahp1[$i][$j]."</td>";
                    }
                    echo "</tr>";
                }

                echo "<tr>";
                echo "<td>Total</td>";                      
                for($i = 0; $i<count($listKriteria); $i++)
                {
                    echo "<td>".$totalahp1[$i]."</td>";
                }

                echo "</tr></table>";
            }
           
            for($i = 0; $i<count($listKriteria); $i++)
            {
                $totalahp2[$i] = 0;
                for($j = 0; $j<count($listKriteria); $j++)
                {
                    $ahp1[$i][$j] /= $totalahp1[$i];
                    
                    
                    $totalahp2[$i] += $ahp1[$i][$j];
                }                
            }
            
            if( $formSubmit != 'newsubmit' ) 
            {
                echo "<br/> TABEL 2 <br/>";
                echo "<table border='2'><thead><tr>";
                echo "<th></th>";
                for($i = 0; $i<count($listKriteria); $i++)
                {
                    echo "<th>".$listKriteria[$i]->jenis_kriteria."</th>";
                }
                echo "<th>Eigen Vektor Normalisasi Kriteria</th></tr></thead>";
                for($i = 0; $i<count($listKriteria); $i++)
                {
                    echo "<tr>";
                    echo "<td>".$listKriteria[$i]->jenis_kriteria."</td>";
                    for($j = 0; $j<count($listKriteria); $j++)
                    {
                        echo "<td>".$ahp1[$i][$j]."</td>";
                    }
                    echo "<td>".$totalahp2[$i]."</td>";
                    echo "</tr>";
                }

               echo "</table>";
            }
            
           $total = 0;
           $i = 0;
           
           if( $formSubmit != 'newsubmit' ) 
           {
               echo "<br/> TABEL 3 <br/>";
               echo "<table border='2'><thead><tr>";
               echo "<th>Jenis Kriteria</th>";
               echo "<th>Nilai</th>";
               echo "<th>Eigen Vektor sub-Kriteria</th>";
               echo "<th>Eigen Vektor Kriteria</th>";
               echo "<th>Status</th>";
               echo "<th>Hasil</th>";

               echo "</tr></thead>";
           }
           
           foreach($listKriteria as $row)
           {
               if( $formSubmit != 'newsubmit' ) 
               {
                   echo "<tr>";
                   echo "<td>".$row->jenis_kriteria."</td>";
               }
               if($row->status_asli==1)
               {
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$row->nilai."</td>";
                   foreach($subKriteria as $sub)
                   {
                       //echo $sub['jenis_sub_kriteria']."-".$row->nilai."<br/>";
                       if($sub['jenis_sub_kriteria'] == $row->nilai)
                       {
                           if( $formSubmit != 'newsubmit' ) echo "<td>".$sub['ahp']."</td>";
                           $row->ahp = $sub['ahp'];
                       }
                   }
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$totalahp2[$i]."</td>";
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$row->status_asli."</td>";
                   
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$row->ahp * $totalahp2[$i]."</td>";
                   $total += $row->ahp * $totalahp2[$i];
                   
               }
               else
               {
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$row->nilai."</td>";
                   foreach($subKriteria as $sub)
                   {
                       if($sub['jenis_sub_kriteria'] == $row->nilai)
                       {
                           if( $formSubmit != 'newsubmit' ) echo "<td>".$sub['ahp']."</td>";
                       }
                   }
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$totalahp2[$i]."</td>";
                   if( $formSubmit != 'newsubmit' ) echo "<td>".$row->status_asli."</td>";
                   if( $formSubmit != 'newsubmit' ) echo "<td>0</td>";
               }
               if( $formSubmit != 'newsubmit' ) echo "</tr>";
               $i++;
           }
           if( $formSubmit != 'newsubmit' ) echo "<tr><td></td><td></td><td></td><td></td>";
           if( $formSubmit != 'newsubmit' ) echo "<td></td><td>".$total."</td></tr></table>";
           
           $seleksi->totalnilai = $total;
           
           $this->seleksi_model->update_seleksi($seleksi->id_seleksi, $seleksi);
           $this->updateStatusSeleksi($seleksi->id_seleksi);
           $this->updateStatusMahasiswa($seleksi->id_peserta);
        }
        
        
        public function editNilai()
        {
            if($this->input->post('id_kriteria_seleksi') && $this->input->post('nilai'))
            {
                $kriteria = $this->kriteria_seleksi_model->get_kriteriaseleksi($this->input->post('id_kriteria_seleksi'));
                $kriteria->nilai = $this->input->post('nilai');
                $kriteria->status = 1;
                $this->kriteria_seleksi_model->update_kriteriaseleksi($kriteria->id_kriteria_seleksi, $kriteria);
                $formSubmit = $this->input->post('submitForm');
                if($this->input->post('status')==1)
                {
                    
                    $this->AHPKriteria($kriteria,$formSubmit);
                    $this->updateStatusSeleksi($kriteria->id_seleksi);
                    //$this->updateStatusMahasiswa(->id_peserta);
                    
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
                    
                    $this->updateStatusMahasiswa($seleksi->id_peserta);
                }
                
                $formSubmit = $this->input->post('submitForm');
                
                
                if( $formSubmit == 'newsubmit' )                
                {
                    redirect(base_url().'seleksi/kriteriaSeleksi?id='.$kriteria->id_seleksi,'refresh');
                }
            }
            else
            {
                redirect(base_url().'seleksi/lihatSeleksi','refresh');
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
?>