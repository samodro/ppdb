<?php
class Login extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    
    function login($username, $password) {
        $data['username'] = $username;
        $data['password'] = $password;
        $this->db->where($data);
        return $this->db->count_all_results('user');
    }
}

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
