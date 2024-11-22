<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminDas extends CI_Controller {

	public function index()
	{
		// page titel
		$data['titel']='Admin Dashboard';

		//bradecum info
		$data['item']='admin';
		$data['url']=base_url('AdminDashboard');

		//sql data
		$data['StuLedg']=$this->Admin_model->StuLedg();

		//load page
		$this->load->admintemplate('admin/dashboard',$data);
	}
}
