<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */

/*
     1  = penilaian huruf
     * 2  = pengumpulan
 *      3 = penilaian angka
     */

class tes_model extends CI_Model{
    private  $table_tes;
    
    public function __construct() {
        parent::__construct();
        $this->table_tes    =   'tes';
        
    }
    
  
    function add_tes($data){
        $this->db->insert($this->table_tes, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_tes()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_tes);
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
    
    function update_tes($id_tes, $data)
    {
        $this->db->where('id_tes', $id_tes);
        $this->db->update($this->table_tes, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_tes($id_tes)
    {
        $this->db->where('id_tes', $id_tes);
        $this->db->delete($this->table_tes);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }      
    
    function select_tes_periode($periode)
    {
        $this->db->where('trash','n');
        $this->db->where('tahun',$periode);
        $this->db->order_by('id_tes','asc');
        $SQL    =   $this->db->get($this->table_tes);
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
    
    function get_tes($id_tes)
    {
        $SQL = "select * from tes where id_tes = ? and trash = 'n'";
        $query = $this->db->query($SQL, $id_tes);
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
    
    function get_tes_pegawai($id_user)
    {
        $SQL = "select * from tes where id_user = $id_user and trash = 'n'";
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
    
    function get_tes_afterinsert($timestamp, $zakat, $no_rekening)
    {
        $SQL = "select * from tes where  zakat = $zakat and no_rekening = '$no_rekening' and timestamp = ? and trash = 'n'";
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
