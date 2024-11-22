<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ShowPage extends CI_Controller {

	public function index()
	{
		$data=array();
		$this->load->template('welcome_message', $data);
	}
}
