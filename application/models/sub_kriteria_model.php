<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
     1  = penilaian sub_kriteria
     * 2  = pengumpulan
 *      3 = penilaian angka
     */

class sub_kriteria_model extends CI_Model{
    private  $table_sub_kriteria;
    
    public function __construct() {
        parent::__construct();
        $this->table_sub_kriteria    =   'sub_kriteria';
        
    }
    
  
    function add_sub_kriteria($data){
        $this->db->insert($this->table_sub_kriteria, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_sub_kriteria()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_sub_kriteria);
        if($SQL->num_rows() > 0)
        {
            foreach ($SQL->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
    
    function update_sub_kriteria($id_sub_kriteria, $data)
    {
        $this->db->where('id_sub_kriteria', $id_sub_kriteria);
        $this->db->update($this->table_sub_kriteria, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_sub_kriteria($id_sub_kriteria)
    {
        $this->db->where('id_sub_kriteria', $id_sub_kriteria);
        $this->db->delete($this->table_sub_kriteria);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }      
    
    function select_sub_kriteria_periode($periode)
    {
        $this->db->where('trash','n');
        $this->db->where('tahun',$periode);
        $this->db->order_by('id_sub_kriteria','asc');
        $SQL    =   $this->db->get($this->table_sub_kriteria);
        if($SQL->num_rows() > 0)
        {
            foreach ($SQL->result() as $row) {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
    
    function get_sub_kriteria($id_sub_kriteria)
    {
        $SQL = "select * from sub_kriteria where id_sub_kriteria = ? and trash = 'n'";
        $query = $this->db->query($SQL, $id_sub_kriteria);
        if($this->db->affected_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                return $row;    
            }
        }
        else
        {
            return null;
        }
    }   
    
    function select_sub_kriteria_byIdTes($id_tes)
    {
        $SQL = "select * from sub_kriteria where id_tes = $id_tes and trash = 'n'";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                $data[] =   $row;
            }
            return $data;
        }
        else
        {
            return null;
        }
    }
    
    
    function get_sub_kriteria_afterinsert($jenis_sub_kriteria, $tahun)
    {
        $SQL = "select * from sub_kriteria where  jenis_sub_kriteria = '$jenis_sub_kriteria' and tahun = '$tahun' and trash = 'n'";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() == 1)
        {
            foreach($query->result() as $row)
            {
                return $row;    
            }
        }
        else
        {
            return null;
        }
    }   
    
    
}

?>
