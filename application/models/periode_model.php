<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */

class periode_model extends CI_Model{
    private  $table_periode;
    
    public function __construct() {
        parent::__construct();
        $this->table_periode    =   'periode';
        
    }
    
  
    function add_periode($data){
        $this->db->insert($this->table_periode, $data);
        
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {            
            return false;
        }
    }
    
    function select_periode()
    {
        $this->db->where('trash','n');
        $this->db->order_by('tahun', "desc");
        $SQL    =   $this->db->get($this->table_periode);
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
    
    
    
    function update_periode($id_periode, $data)
    {
        $this->db->where('id_periode', $id_periode);
        $this->db->update($this->table_periode, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_periode($id_periode)
    {
        $this->db->where('id_periode', $id_periode);
        $this->db->delete($this->table_periode);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }       
    
   
    
    function get_periode($id_periode)
    {
        $SQL = "select * from periode where id_periode = $id_periode and trash = 'n'";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                return $row;
            }
        }
        else
        {
            return null;
        }
    }
    
    function get_periodebyTahun($tahun)
    {
        $SQL = "select * from periode where tahun = '$tahun' and trash = 'n'";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            foreach ($query->result() as $row) 
            {
                return $row;
            }
        }
        else
        {
            return null;
        }
    }
    
    function get_periode_afterinsert($timestamp, $zakat, $no_rekening)
    {
        $SQL = "select * from periode where  zakat = $zakat and no_rekening = '$no_rekening' and timestamp = ? and trash = 'n'";
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
