<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */

class petugas_model extends CI_Model{
    private  $table_petugas;
    
    public function __construct() {
        parent::__construct();
        $this->table_petugas    =   'petugas';
        
    }
    
  
    function add_petugas($data){
        $this->db->insert($this->table_petugas, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_petugas()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_petugas);
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
    
    function select_petugas_periode($periode)
    {
        $this->db->where('trash','n');
        $this->db->where('periode',$periode);
        $SQL    =   $this->db->get($this->table_petugas);
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
    
    function update_petugas($id_petugas, $data)
    {
        $this->db->where('id_user', $id_petugas);
        $this->db->update($this->table_petugas, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_petugas($id_petugas)
    {
        $this->db->where('id_user', $id_petugas);
        $this->db->delete($this->table_petugas);
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
        $SQL = "select periode from petugas where trash = 'n' group by periode";
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
    
    function get_petugas($id_petugas)
    {
        $SQL = "select * from petugas where id_user = $id_petugas and trash = 'n'";
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
    
    function get_petugas_afterinsert($timestamp, $nama, $ttl)
    {
        $SQL = "select * from petugas where  nama like '$nama' and ttl = '$ttl' and timestamp = ? and trash = 'n'";
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
