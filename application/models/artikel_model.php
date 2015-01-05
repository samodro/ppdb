<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
     1  = penilaian huruf
     * 2  = pengumpulan
 *      3 = penilaian angka
 * 5 = penilaian huruf namun CR > 0.1
     */

class artikel_model extends CI_Model{
    private  $table_artikel;
    
    public function __construct() {
        parent::__construct();
        $this->table_artikel    =   'artikel';
        
    }
    
  
    function add_artikel($data){
        $this->db->insert($this->table_artikel, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_artikel()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_artikel);
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
    
    function update_artikel($id_artikel, $data)
    {
        $this->db->where('id_artikel', $id_artikel);
        $this->db->update($this->table_artikel, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_artikel($id_artikel)
    {
        $this->db->where('id_artikel', $id_artikel);
        $this->db->delete($this->table_artikel);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }      
    
    function select_artikel_periode($periode)
    {
        $this->db->where('trash','n');
        $this->db->where('tahun',$periode);
        $this->db->order_by('id_artikel','asc');
        $SQL    =   $this->db->get($this->table_artikel);
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
    
    function get_artikel($id_artikel)
    {
        $SQL = "select * from artikel where id_artikel = ? and trash = 'n'";
        $query = $this->db->query($SQL, $id_artikel);
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
    
    function get_artikelbyJenis($jenis_artikel)
    {
        $SQL = "select * from artikel where jenis_artikel = ? and trash = 'n'";
        $query = $this->db->query($SQL, $jenis_artikel);
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
    
    function get_artikel_pegawai($id_user)
    {
        $SQL = "select * from artikel where id_user = $id_user and trash = 'n'";
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
    
    function get_artikel_afterinsert($jenis_artikel, $tahun)
    {
        $SQL = "select * from artikel where  jenis_artikel = '$jenis_artikel' and tahun = '$tahun' and trash = 'n'";
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
