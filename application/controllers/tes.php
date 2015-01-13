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
           
            if($this->session->userdata('id_user')==null)
            {
                redirect(base_url().'admin');
            }
            
            $this->load->model('tes_model');
            $this->load->model('periode_model');
            $this->load->model('kriteria_model');
            $this->load->model('sub_kriteria_model');
            $this->load->model('peserta_model');
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
        
        public function AHPKriteria($listKriteria, $tes)
        {
            
            //var_dump($listKriteria);
            
            //echo count($listKriteria);
            if($listKriteria!=null && count($listKriteria)>0)
            {
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
                        $ahp1[$j][$i] = $kolom->bobot/$row->bobot;
                        //echo $j." - ".$i." - ".$ahp1[$j][$i]."<br/>";
                        $totalahp1[$i] += $ahp1[$j][$i];
                        $j++;
                    }
                    $i++;
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


                $max = 0;


                for($i = 0; $i<count($listKriteria); $i++)
                {                

                    if($totalahp2[$i]>$max) $max = $totalahp2[$i];

                }

                if(count($listKriteria)>2)
                {

                   $CI = ($max-count($listKriteria))/(count($listKriteria)-1);

                   //echo "CI :".$CI."<br/>";
                   $RI = array (
                       1 => 0.00,
                       2 => 0.00,
                       3 => 0.58,
                       4 => 0.90,
                       5 => 1.12,
                       6 => 1.24,
                       7 => 1.32,	
                       8 => 1.41,	
                       9 => 1.45,	
                       10 => 1.49,	
                       11 => 1.51,	
                       12 => 1.48,	
                       13 => 1.56,
                       14 => 1.57,	
                       15 => 1.59
                   );
                   //var_dump($RI);


                   $CR = $CI/$RI[count($listKriteria)];
                }
                else
                {
                    $CR = 0.00;
                }

               if ($CR>0.1)
               {
                   $tes->status = 5;
               }
               else
               {
                   $tes->status = 1;
               }
               
               $this->tes_model->update_tes($tes->id_tes, $tes);
               
               return $CR;
            }
            else
            {
                $tes->status = 5;
                $this->tes_model->update_tes($tes->id_tes, $tes);
                return null;
            }
           
           
        }
        
        
        
        public function detailAHPKriteria($listKriteria)
        {
            
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
                    $ahp1[$j][$i] = $kolom->bobot/$row->bobot;
                    //echo $j." - ".$i." - ".$ahp1[$j][$i]."<br/>";
                    $totalahp1[$i] += $ahp1[$j][$i];
                    $j++;
                }
                $i++;
            }
            
            
            
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
            
           
            for($i = 0; $i<count($listKriteria); $i++)
            {
                $totalahp2[$i] = 0;
                for($j = 0; $j<count($listKriteria); $j++)
                {
                    $ahp1[$i][$j] /= $totalahp1[$i];
                    
                    
                    $totalahp2[$i] += $ahp1[$i][$j];
                }                
            }
            
            
            $max = 0;
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
                if($totalahp2[$i]>$max) $max = $totalahp2[$i];
                echo "<td>".$totalahp2[$i]."</td>";
                echo "</tr>";
            }
            
           echo "</table>";
            
           
           $CI = ($max-count($listKriteria))/(count($listKriteria)-1);
           
           //echo "CI :".$CI."<br/>";
           $RI = array (
               1 => 0.00,
               2 => 0.00,
               3 => 0.58,
               4 => 0.90,
               5 => 1.12,
               6 => 1.24,
               7 => 1.32,	
               8 => 1.41,	
               9 => 1.45,	
               10 => 1.49,	
               11 => 1.51,	
               12 => 1.48,	
               13 => 1.56,
               14 => 1.57,	
               15 => 1.59
           );
           //var_dump($RI);
           echo "RI :".$RI[count($listKriteria)]."<br/>";
           
           $CR = $CI/$RI[count($listKriteria)];
           echo "CR :".$CR;
           
           return $CR;
           
           
        }
        
        public function kriteria()
        {
                if($this->input->get('id_tes')!='')
                {
                    $data['kriteria'] = $this->kriteria_model->select_kriteria_tes($this->input->get('id_tes'));
                    $data['tes'] = $this->tes_model->get_tes($this->input->get('id_tes'));
                    if($data['tes']->status==1 || $data['tes']->status==5)
                        $data['CR'] = $this->AHPKriteria($data['kriteria'], $data['tes']);
                    
                    
                    $this->load->view('admin/header_view');
                    $this->load->view('admin/tes/kriteria_view',$data);
                    $this->load->view('admin/footer_view');
                }
                else
                {
                    redirect(base_url().'tes/lihatTes','refresh');
                }
        }
        
        public function editKriteria()
        {
            if($this->input->post('jenis'))
            {

                $kriteria = $this->kriteria_model->get_kriteria($this->input->post('id_kriteria'));                
                
                                                
                $kriteria->jenis_kriteria  = $this->input->post('jenis');                
                $kriteria->status = $this->input->post('status');
                
                if($this->input->post('bobot')) $kriteria->bobot = $this->input->post('bobot');                                                                                                                
                
                //echo  $this->input->post('tahun');
                $this->kriteria_model->update_kriteria($kriteria->id_kriteria,$kriteria);
                
                
                //update nilai Seleksi
                
                $listpeserta = $this->peserta_model->select_peserta_periode($this->input->post('tahun'));
                if($listpeserta!=null)
                {                    
                    foreach($listpeserta as $peserta)
                    {
                        
                        $kriteria_seleksi = $this->kriteria_seleksi_model->get_kriteriaseleksi_byPesertaandKriteria($peserta->id_peserta, $kriteria->id_kriteria);
                        if($kriteria->status == 5) $kriteria->status = 1;
                        if($kriteria_seleksi!=null)
                        {
                            $this->editNilai($kriteria_seleksi->id_kriteria_seleksi, $kriteria_seleksi->nilai, $kriteria->status);
                        }
                    }
                }
                
                
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'),'refresh');
            }
            else
            {
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'),'refresh');
            }
        }

        public function deleteKriteria()
        {
            if($this->input->post('id_kriteria'))
            {
                $kriteria = $this->kriteria_model->get_kriteria($this->input->post('id_kriteria'));                                                                                
                $kriteria->trash  = 'y';
                $this->kriteria_model->update_kriteria($kriteria->id_kriteria,$kriteria);
                
                
                //tambahan untuk delete kriteria
                $kriteria = $this->kriteria_seleksi_model->select_kriteriaseleksi_kriteria($kriteria->id_kriteria);
                
                foreach($kriteria as $row)
                {
                    $row->trash = 'y';
                    $this->kriteria_seleksi_model->update_kriteriaseleksi($row->id_kriteria_seleksi, $row);
                }
                
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
                
                
                //tambahan untuk otomatis update
                $listpeserta = $this->peserta_model->select_peserta_periode($this->input->post('tahun'));
                if($listpeserta!=null)
                {
                    $kriteriaafter = $this->kriteria_model->get_kriteria_afterinsert($kriteria['id_tes'],$kriteria['jenis_kriteria'],$kriteria['tahun']);
                    foreach($listpeserta as $peserta)
                    {
                        
                        $seleksi = $this->seleksi_model->select_seleksi_byPeserta($peserta->id_peserta);
                        if(count($seleksi)>1)
                        {                            
                                
                                $seleksi = $this->seleksi_model->get_seleksi_byPesertaTes($peserta->id_peserta, $kriteria['id_tes']);                                                                
                                
                                $kriteriaseleksi = array (
                                        'id_kriteria_seleksi' => '',
                                        'id_seleksi' => $seleksi->id_seleksi,
                                        'id_kriteria' => $kriteriaafter->id_kriteria,
                                        'jenis_kriteria' => $kriteriaafter->jenis_kriteria,
                                        'nilai' => '0',
                                        'status' => 0,
                                        'trash' => 'n');
                                

                               $this->kriteria_seleksi_model->add_kriteriaseleksi($kriteriaseleksi); 
                               
                               $seleksi->status = 0;
                               $this->seleksi_model->update_seleksi($seleksi->id_seleksi, $seleksi);
                   
                        }
                        
                        $peserta->status_peserta = 0;
                        $this->peserta_model->update_peserta($peserta->id_peserta,$peserta);
                    }
                }
                
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'),'refresh');
            }
            else
            {
                redirect(base_url().'tes/kriteria?id_tes='.$this->input->post('id_tes'),'refresh');
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
                
                redirect(base_url().'tes/lihatTes','refresh');
            }
            else
            {
                redirect(base_url().'tes/lihatTes','refresh');
            }
        }

        public function deleteTes()
        {
            if($this->input->post('id_tes'))
            {
                $tes = $this->tes_model->get_tes($this->input->post('id_tes'));                                                                                
                $tes->trash  = 'y';
                $this->tes_model->update_tes($tes->id_tes,$tes);
                
                //tambahan untuk bisa delete tes     
                $seleksi = $this->seleksi_model->select_seleksi_tes($tes->id_tes);
                
                foreach($seleksi as $row)
                {
                    $row->trash = 'y';
                    $this->seleksi_model->update_seleksi($row->id_seleksi, $row);
                    
                    $kriteria = $this->kriteria_seleksi_model->select_kriteriaseleksi_seleksi($row->id_seleksi);
                    foreach($kriteria as $kri)
                    {
                        $kri->trash = 'y';
                        unset($kri->jenis);
                        $this->kriteria_seleksi_model->update_kriteriaseleksi($kri->id_kriteria_seleksi, $kri);
                    }
                    
                }
                
                redirect(base_url().'tes/lihatTes','refresh');
            }
            else
            {
                redirect(base_url().'tes/lihatTes','refresh');
            }                        
        }
        
        public function automaticHuruf($id_tes)
        {
            $sub = array(
                'id_sub_kriteria' => '',
                'id_tes' => $id_tes,
                'jenis_sub_kriteria' => 'A',
                'bobot' => '5',
                'trash' => 'n'
                
            );
            
            $i = 5;
            $letters = range('A', 'E');
            
            foreach ($letters as $row)
            {
                $sub['jenis_sub_kriteria'] = $row; 
                $sub['bobot'] = $i--;
                
                
                $this->sub_kriteria_model->add_sub_kriteria($sub);
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
                
                $this->automaticHuruf($this->tes_model->get_tes_afterinsert($tes['jenis_tes'],$tes['tahun'])->id_tes);
                
                
                
                //tambahan untuk bisa nambah kriteria setelah ada data siswa
                
                $listpeserta = $this->peserta_model->select_peserta_periode($this->input->post('tahun'));
                
                if($listpeserta!=null)
                {
                    $tesafter = $this->tes_model->get_tes_afterinsert($tes['jenis_tes'],$tes['tahun']);
                    foreach($listpeserta as $peserta)
                    {
                        $seleksi = $this->seleksi_model->select_seleksi_byPeserta($peserta->id_peserta);
                        if(count($seleksi)>1)
                        {
                            if($this->seleksi_model->get_seleksi_byPesertaTes($peserta->id_peserta, $tesafter->id_tes)) continue;
                                $seleksi = array(
                                        'id_seleksi'=> '',
                                        'id_peserta'=> $peserta->id_peserta,
                                        'id_tes'=> $tesafter->id_tes,
                                        'totalnilai' => '0',
                                        'status' => '0',
                                        'tahun' => $peserta->periode,
                                        'trash' => 'n'                                        
                                    );

                                $this->seleksi_model->add_seleksi($seleksi);
                   
                        }
                        $peserta->status_peserta = 0;
                        $this->peserta_model->update_peserta($peserta->id_peserta,$peserta);
                    }
                }
                
                redirect(base_url().'tes/lihatTes','refresh');
            }
            else
            {
                redirect(base_url().'tes/lihatTes','refresh');
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
        
        public function AHPsubKriteria($id_tes)
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
                                                                                 
            for($i = 0; $i<count($sub_kriteria); $i++)
            {
                $totalahp2[$i] = 0;
                for($j = 0; $j<count($sub_kriteria); $j++)
                {
                    $ahp1[$i][$j] /= $totalahp1[$i];
                     
                    
                    $totalahp2[$i] += $ahp1[$i][$j];
                }
                
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
        
        public function AHPKriteria2($kriteria)
        {
            $seleksi = $this->seleksi_model->get_seleksi($kriteria->id_seleksi);
            
            $subKriteria = $this->AHPsubKriteria($seleksi->id_tes);
            
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
            
            
            
           
                            
           
            
           
            for($i = 0; $i<count($listKriteria); $i++)
            {
                $totalahp2[$i] = 0;
                for($j = 0; $j<count($listKriteria); $j++)
                {
                    $ahp1[$i][$j] /= $totalahp1[$i];
                    
                    
                    $totalahp2[$i] += $ahp1[$i][$j];
                }                
            }
            
           
           
            
           $total = 0;
           $i = 0;
           
          
           
           foreach($listKriteria as $row)
           {               
               if($row->status_asli==1)
               {                   
                   foreach($subKriteria as $sub)
                   {
                       //echo $sub['jenis_sub_kriteria']."-".$row->nilai."<br/>";
                       if($sub['jenis_sub_kriteria'] == $row->nilai)
                       {                           
                           $row->ahp = $sub['ahp'];
                       }
                   }              
                                    
                   $total += $row->ahp * $totalahp2[$i];
                   
               }
               else
               {                   
                   foreach($subKriteria as $sub)
                   {
                       if($sub['jenis_sub_kriteria'] == $row->nilai)
                       {                           
                       }
                   }                  
               }               
               $i++;
           }           
           
           $seleksi->totalnilai = $total;
           
           $this->seleksi_model->update_seleksi($seleksi->id_seleksi, $seleksi);
           $this->updateStatusSeleksi($seleksi->id_seleksi);
           $this->updateStatusMahasiswa($seleksi->id_peserta);
        }
        
        
        public function editNilai($id_kriteria_seleksi, $nilai, $status)
        {
            $kriteria = $this->kriteria_seleksi_model->get_kriteriaseleksi($id_kriteria_seleksi);
            //$kriteria->nilai = $nilai;
            //$kriteria->status = 1;
            //$this->kriteria_seleksi_model->update_kriteriaseleksi($kriteria->id_kriteria_seleksi, $kriteria);           
            if($status==1)
            {

                $this->AHPKriteria2($kriteria);
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