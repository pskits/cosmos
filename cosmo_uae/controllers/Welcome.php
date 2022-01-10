<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index()
	{
		$this->load->view('Dashboard');
	}
	public function ChangePassword()
	{
		$this->load->view('ChangePassword');
	}
	function Alter_Password()
	{
		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
		$this->form_validation->set_rules('ConfirmPassword', 'ConfirmPassword', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msgU', "Please fill all required fields");
		} else {
			if ($_REQUEST['ConfirmPassword'] == $_REQUEST['password']) {
				$qry =  "cosmo.dbo.Alter_Password '" . md5($_POST['password']) . "'			
				,'" . $_POST['User_Id'] . "'	,'" . $_POST['User_Id'] . "'	
			";
				$query = $this->db->query($qry);
				if ($query) {
					$this->session->set_flashdata('msgS', "Password changed Successfully");
				} else {
					$this->session->set_flashdata('msgU', "Password not changed");
				}
			} else {
				$this->session->set_flashdata('msgU', "Password and Confirm Password does not match");
			}
		}
		echo "<script> history.go(-1);</script>";
	}
	public function logout()
	{
		@session_start();
		@session_destroy();
		echo "<script>window.location='" . base_url('cosmo.php') . "'</script>";
	}
	public function Reports()
	{
		$this->load->view('Reports');
	}
}
