<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */


class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function HelloWorld(){
        $this->load->view('home_view');
    }
}


?>
