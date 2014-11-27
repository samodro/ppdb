<?php
class Agenda extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function lihat() {
        /* tempat query database
         * start
         */
        $query = "
            select * 
            from agenda
            where id_agenda = 1
            ";
        /* end */
        
        /* query diproses*/
        $result = $this->db->query($query);
        
        /* return hasil query sebagai objek */
        return $result->result();
    }
    
    function cari($cari){
        /* tempat query database
         * start
         */
        $query = "
            select * 
            from agenda
            where nama_agenda = ".$cari;
        /* end */
        
        /* query diproses*/
        $result = $this->db->query($query);
        
        /* return hasil query sebagai objek */
        return $result->result();
    }
    
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
