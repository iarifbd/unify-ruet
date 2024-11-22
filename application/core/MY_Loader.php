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

        // Load main container start
        $this->view('template/maincontainerstart', $data);  

        /*============Dynamic Container========*/
            $this->view($view, $data); 
        /////////////////////////////////////////   

        // Load main container end
        $this->view('template/maincontainerend', $data);

        // Load footer
        $this->view('template/footer', $data);
    }

    public function admintemplate($view, $data = array())
    {
        // Load header view
        $this->view('admin/header', $data);

        // Load topnav
        $this->view('admin/appheader', $data);

        // Load main container start
        $this->view('admin/maincontainerstart', $data);  

        /*============Dynamic Container========*/
            $this->view($view, $data); 
        /////////////////////////////////////////   

        // Load main container end
        $this->view('admin/maincontainerend', $data);

        // Load footer
        $this->view('admin/footer', $data);
    }


}

