<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * Model pendaftaran NLC
 */


/*
 * 1 = belum lengkap
 * 2 = sudah lengkap
 */
class seleksi_model extends CI_Model{
    private  $table_seleksi;
    
    public function __construct() {
        parent::__construct();
        $this->table_seleksi    =   'seleksi';
        
    }
    
  
    function add_seleksi($data){
        $this->db->insert($this->table_seleksi, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_seleksi()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_seleksi);
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
    
    function update_seleksi($id_seleksi, $data)
    {
        $this->db->where('id_seleksi', $id_seleksi);
        $this->db->update($this->table_seleksi, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_seleksi($id_seleksi)
    {
        $this->db->where('id_seleksi', $id_seleksi);
        $this->db->delete($this->table_seleksi);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }      
    
    function select_seleksi_tes($id_tes)
    {
        $this->db->where('trash','n');
        $this->db->where('id_tes',$id_tes);
        $SQL    =   $this->db->get($this->table_seleksi);
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
    
    function get_seleksi($id_seleksi)
    {
        $SQL = "select * from seleksi where id_seleksi = ? and trash = 'n'";
        $query = $this->db->query($SQL, $id_seleksi);
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
    
    function select_seleksi_peserta($id_tes)
    {
        $SQL = "select * from seleksi s, peserta p where p.id_peserta = s.id_peserta and  s.id_tes = $id_tes and p.trash = 'n' and s.trash = 'n'";
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
    
    function get_seleksi_afterinsert($id_peserta, $id_tes, $tahun)
    {
        $SQL = "select * from seleksi where  id_peserta = '$id_peserta' and id_tes = '$id_tes' and tahun = $tahun and trash = 'n'";
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
