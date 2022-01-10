<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Welcome extends CI_Controller
{
	function __construct()
	{		
		parent::__construct();
		$this->load->library('user_agent');
		
		if ($this->agent->is_browser()) {
			if (($this->agent->browser() == 'Chrome') || ($this->agent->browser() == 'Firefox')) {
			} else {
				echo "This Browser is not Compatable";
				exit;
			}
		} else {
			echo "This is an unauthorised OS/Browser";
			exit;
		}
	}
	public function index()
	{
		if (!@$this->session->userdata['cosmolog']['UId']) {
			$this->load->view('Login');
		} else {
			$this->load->view('Dashboard');
		}
	}
	public function logout()
	{
		@session_start();
		@session_destroy();
		echo "<script>window.location='" . base_url('cosmo.php') . "'</script>";
	}
	public function Switch_Office()
	{
		$this->load->view('Switch_Office');
	}
	public function Switch_Office_Commit()
	{
		$_SESSION['application_url'] = 'cosmo.php';
		if (isset($_REQUEST['Key'])) {
			$officeid = base64_decode($_REQUEST['Key']);
			if (isset($_SESSION['currentdatabasename'])) {
				$office = $this->GM->Switchaccesslist($officetype = "0", $status = "1",  $this->session->userdata['cosmolog']['UId'], $officeid);
				$_SESSION['currentdatabasename'] = $office[0]->office_dbname;
				$_SESSION['dbcolor'] = $office[0]->office_theme;
				$_SESSION['officename'] = $office[0]->office_ShortName;
				$_SESSION['Currencycode'] = $office[0]->Currencycode;
				$_SESSION['Currency_Id'] = $office[0]->Currency_Id;
				$_SESSION['office_Name'] = $office[0]->office_Name;
				$_SESSION['application_url'] = $office[0]->application_url;
			}		
		
			$this->RenderMenu();}		
		echo "<script>window.location='" . base_url($_SESSION['application_url']) . "'</script>";
	}
	public function RenderMenu()
	{
		//Menu has been rendered and stored in session to increase execution time
		$_SESSION['RenderedMenu']['DashboardMenu'] = "";
		$_SESSION['RenderedMenu']['ReportsMenu'] = "";
		foreach ($this->MenuClass->Menu_($_SESSION['cosmolog']['Utype'], '1') as $row) {
			$_SESSION['RenderedMenu']['DashboardMenu'] = $_SESSION['RenderedMenu']['DashboardMenu'] . '<li class="treeview"> <a href="#"> <i class="' . $row->Icon . '"></i> <span>' . $row->Menu . '</span>
				<span class="pull-right-container">
				  <i class="fa fa-angle-left pull-right "></i>
				</span></a>
			  <ul class="treeview-menu">';
			foreach ($this->MenuClass->SubMenu_($row->Menu_Id, $_SESSION['cosmolog']['Utype']) as $srow) {
				$_SESSION['RenderedMenu']['DashboardMenu'] = $_SESSION['RenderedMenu']['DashboardMenu'] . '<li><a href="' . base_url($_SESSION['application_url']."/".$srow->Des."/".$srow->SubDes). '">
					  <i class="fa fa-circle-o "></i> ' . $srow->SubMenu . '</a></li>';
			}
			$_SESSION['RenderedMenu']['DashboardMenu'] = $_SESSION['RenderedMenu']['DashboardMenu'] . '</ul>';
		}
		$_SESSION['RenderedMenu']['DashboardMenu'] = $_SESSION['RenderedMenu']['DashboardMenu'] . '</li></ul>';
		foreach ($this->MenuClass->Menu_($_SESSION['cosmolog']['Utype'], '2') as $row) {
			$_SESSION['RenderedMenu']['ReportsMenu'] = $_SESSION['RenderedMenu']['ReportsMenu'] . '<li class="treeview"> <a href="#"> <i class="' . $row->Icon . '"></i> <span>' . $row->Menu . '</span>
					<span class="pull-right-container">
					  <i class="fa fa-angle-left pull-right "></i>
					</span></a>
				  <ul class="treeview-menu">';
			foreach ($this->MenuClass->SubMenu_($row->Menu_Id, $_SESSION['cosmolog']['Utype']) as $srow) {
				$_SESSION['RenderedMenu']['ReportsMenu'] = $_SESSION['RenderedMenu']['ReportsMenu'] . '<li><a href="' .  base_url($_SESSION['application_url'] . "/" . $srow->Des . "/" . $srow->SubDes ). '">
						  <i class="fa fa-circle-o "></i> ' . $srow->SubMenu . '</a></li>';
			}
			$_SESSION['RenderedMenu']['ReportsMenu'] = $_SESSION['RenderedMenu']['ReportsMenu'] . '</ul>';
		}
		$_SESSION['RenderedMenu']['ReportsMenu'] = $_SESSION['RenderedMenu']['ReportsMenu'] . '</li></ul>';
	}
	public function login()
	{
		if (@$this->session->userdata['cosmolog']['UId']) {
			echo "<script>window.location='" . site_url() . "'</script>";
			exit;
		}
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
		$this->form_validation->set_rules('Username', 'User Name', 'required');
		$this->form_validation->set_rules('Password', 'Password', 'required');
		if ($this->form_validation->run() == TRUE) {
			$qry = "execute cosmo.dbo.Pro_Login '" . $_POST['Username'] . "','" . md5($_POST['Password']) . "','0','1'";
			$Mainresult = $this->db->query($qry);
			$res = $Mainresult->row();
			if (isset($res->status)) {
				if ($res->status == 1) {
					$newdata = array(
						'UId' => $res->userid,
						'Utype' => $res->userroleid
					);
					$_SESSION['userdatabasename'] = $res->Current_Database;
					$_SESSION['switchaccess'] = $res->switchaccess;
					$_SESSION['currentdatabasename'] = $res->Current_Database;
					$_SESSION['loginTime'] = date('m/d/Y h:i:s A');
					$this->session->set_userdata('cosmolog', $newdata);
					echo "<script>window.location='" . site_url('Welcome/Switch_Office_Commit') . '/?Key=' . base64_encode($res->officeid) . "'</script>";
				} else {
					$data = array(
						'Message' => 'Incorrect',
						'Userclass' => 'has-error',
						'Passwordclass' => 'has-error',
						'ErrorMessage' => 'Incorrect Email or Password.'
					);
					$this->load->view('Login', $data);
				}
			} else {
				$data = array(
					'Message' => 'Incorrect',
					'Userclass' => 'has-error',
					'Passwordclass' => 'has-error',
					'ErrorMessage' => 'Your Login has been Disabled'
				);
				$this->load->view('Login', $data);
			}
		} else {
			$data = array(
				'Message' => 'Required',
				'Userclass' => 'has-error',
				'Passwordclass' => 'has-error',
				'ErrorMessage' => 'Email or Password cannot be blank.'
			);
			$this->load->view('Login', $data);
		}
	}
}
