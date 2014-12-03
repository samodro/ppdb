<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */


/*
 * 1 = pengumpulan, jika sudah = 7
 * 2 = penilaian huruf, 
 * 3 = penilaian angka, 
 */
class kriteria_model extends CI_Model{
    private  $table_kriteria;
    
    public function __construct() {
        parent::__construct();
        $this->table_kriteria    =   'kriteria';
        
    }
    
  
    function add_kriteria($data){
        $this->db->insert($this->table_kriteria, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_kriteria()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_kriteria);
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
    
    function update_kriteria($id_kriteria, $data)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->update($this->table_kriteria, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_kriteria($id_kriteria)
    {
        $this->db->where('id_kriteria', $id_kriteria);
        $this->db->delete($this->table_kriteria);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }      
    
    function select_kriteria_tes($id_tes)
    {
        $this->db->where('trash','n');
        $this->db->where('id_tes',$id_tes);
        $SQL    =   $this->db->get($this->table_kriteria);
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
    
    function get_kriteria($id_kriteria)
    {
        $SQL = "select * from kriteria where id_kriteria = ? and trash = 'n'";
        $query = $this->db->query($SQL, $id_kriteria);
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
    
    function get_kriteria_pegawai($id_user)
    {
        $SQL = "select * from kriteria where id_user = $id_user and trash = 'n'";
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
    
    function get_kriteria_afterinsert($timestamp, $zakat, $no_rekening)
    {
        $SQL = "select * from kriteria where  zakat = $zakat and no_rekening = '$no_rekening' and timestamp = ? and trash = 'n'";
        $query = $this->db->query($SQL, $timestamp);
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
