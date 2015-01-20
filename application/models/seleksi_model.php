<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



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
    
    function select_seleksi_byPeserta($id_peserta)
    {
        $this->db->where('trash','n');
        $this->db->where('id_peserta',$id_peserta);
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
    
    function select_seleksi_byPesertaNew($id_peserta)
    {
        $SQL = "select s.*, t.*,t.status as 'status_tes' from seleksi s, tes t where s.id_tes = t.id_tes and s.trash = 'n' and t.trash = 'n' and s.id_peserta = $id_peserta";
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
    
    function select_seleksi_detail()
    {
        $SQL = "select s.id_seleksi, p.no_test, p.nama, t.jenis_tes, s.totalnilai, k.jenis_kriteria, ks.nilai
                 from seleksi s, peserta p, tes t, kriteriaseleksi ks, kriteria k where p.id_peserta = s.id_peserta and t.id_tes = s.id_tes and t.status != 2 and t.trash = 'n' and s.trash = 'n' and p.trash = 'n' and k.trash = 'n' and ks.trash = 'n' and k.id_kriteria = ks.id_kriteria and s.id_seleksi = ks.id_seleksi order by p.no_test, t.jenis_tes asc
                ";
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
    
    function get_seleksi_byPesertaTes($id_peserta, $id_tes)
    {
        $SQL = "select * from seleksi where id_peserta = ? and id_tes = $id_tes and trash = 'n'";
        $query = $this->db->query($SQL, $id_peserta);
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
