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
                    redirect(base_url().'tes/lihatTes');
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