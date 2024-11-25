<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// application/core/MY_Loader.php
class MY_Loader extends CI_Loader {
    
    public function __construct()
    {
        parent::__construct();
        
        // Load the User_Model library globally

    }

    public function template($view, $data = array())
    {
        // Load header view
        $this->view('template/header', $data);

        // Load topnav
        $this->view('template/appheader', $data);

        // Load main container
        $this->view('template/maincontainer', $data);

        // Load footer
        $this->view('template/footer', $data);
    }
}

