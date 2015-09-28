<?php 

class Login extends CI_Controller
{
	function index()
	{
		$this->load->view('customerlogin');
	}
	
	function checkCustomer()
	{
		$this->load->model('login_model');
		$query=$this->login_model->validate();
		if(!($query))
		{
			$this->index();
		}
	}
	
	function logout()
	{
		$this->load->view('customerlogout');
	}
}
