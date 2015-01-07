<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class peserta_model extends CI_Model{
    private  $table_peserta;
    
    public function __construct() {
        parent::__construct();
        $this->table_peserta    =   'peserta';
        
    }
    
  
    function add_peserta($data){
        $this->db->insert($this->table_peserta, $data);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    function select_peserta()
    {
        $this->db->where('trash','n');
        $SQL    =   $this->db->get($this->table_peserta);
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
    
    function select_peserta_periode($periode)
    {
        $this->db->where('trash','n');
        $this->db->where('periode',$periode);
        $this->db->order_by('id_peserta', "asc");
        $SQL    =   $this->db->get($this->table_peserta);
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
    
    
    
    function update_peserta($id_peserta, $data)
    {
        $this->db->where('id_peserta', $id_peserta);
        $this->db->update($this->table_peserta, $data);
        if($this->db->affected_rows() > 0)
            return true;
        else
            return false;
    }
    
    
    function delete_peserta($id_peserta)
    {
        $this->db->where('id_peserta', $id_peserta);
        $this->db->delete($this->table_peserta);
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
        $SQL = "select periode from peserta where trash = 'n' group by periode";
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
    
    function select_peserta_periode_total_lolos($periode,$kuota)
    {
        $SQL = "select * from (select p.*, sum(s.totalnilai * t.bobot) as 'total' from peserta p, seleksi s, tes t where t.id_tes = s.id_tes and p.id_peserta = s.id_peserta and p.periode = '$periode' and p.status_peserta > 0 and s.tahun = '$periode' and p.trash = 'n' and s.trash = 'n' group by p.id_peserta) a order by a.total desc limit 0, $kuota";
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
    
    function select_peserta_periode_total($periode)
    {
        $SQL = "select * from (select p.*, sum(s.totalnilai * t.bobot) as 'total' from peserta p, seleksi s, tes t where t.id_tes = s.id_tes and p.id_peserta = s.id_peserta and p.periode = '$periode' and p.status_peserta > 0 and s.tahun = '$periode' and p.trash = 'n' and s.trash = 'n' group by p.id_peserta) a order by a.total desc";
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
    
    
    function get_peserta($id_peserta)
    {
        $SQL = "select * from peserta where id_peserta = $id_peserta and trash = 'n'";
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
    
    function get_peserta_afterinsert($timestamp, $nama, $asal)
    {
        $SQL = "select * from peserta where  nama like '$nama' and asal_sekolah = '$asal' and timestamp = ? and trash = 'n'";
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
    
    function update_status($id_peserta, $status)
    {
        $SQL = "update peserta set status_peserta = '$status' where id_peserta = $id_peserta ";
        $query = $this->db->query($SQL);
        if($this->db->affected_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    
    
}

?>
