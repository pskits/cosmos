<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('Usersclass');
    }
    function file_upload()
    {
        $config['upload_path']          = $_REQUEST['path'];
        $config['allowed_types']        = 'jpeg|jpg|png|pdf';
        $config['file_name']          = $_REQUEST['upload_request_filename'];
       
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('upload_request_file')) {
            $this->session->set_flashdata('msgS', "Sussessfully Uploaded");
        } else {
            $this->session->set_flashdata('msgD', $this->upload->display_errors());
        }
        echo "<script> history.go(-1);</script>";
    }
    //user_switchrights
    public function User_switchrights()
    {
        $this->load->view('Users/Users_View');
    }
	  public function AllowtoProcess_Commit()
    {
        if ($this->Usersclass->AllowtoProcess_Validation()) {
            $this->Usersclass->AllowtoProcess_Save();
        }
    }
	 //DealerAllowProcess
	 public function DealerAllowProcess()
    {
        $this->load->view('Users/DealerAllowProcess');
    }
	//DealerAllowProcess_View
	 public function DealerAllowProcess_View()
    {
        $this->load->view('Users/DealerAllowProcess_View');
    }
    public function User_switchrights_Create($officeid)
    {
        $dbdata = $this->GM->office($officetype = "0", $status = "1", $officeid);
        $data = array('Office_name' => $dbdata[0]->office_Name, 'office_dbname' => $dbdata[0]->office_dbname, 'But' => 'Create', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Users/Users_Create', $data);
    }
    public function User_switchrights_Commit()
    {
        if ($this->Usersclass->User_switchrights_Validation()) {
            $this->Usersclass->User_switchrights_Save();
        }
    }
    //Admin
    public function Admin()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->Admin(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/Admin', $data);
    }
    public function Admin_commit()
    {
        if ($this->Usersclass->Admin_Validation()) {
            $this->Usersclass->Admin_Save();
        }
    }
    public function Admin_View()
    {
        $this->load->view('Users/Admin_View');
    }
    public function Adminuser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/Adminuser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/Admin_View') . "'</script>";
        }
    }
    //Dealer
    public function Dealer_View()
    {
        $this->load->view('Users/Dealer_View');
    }
    public function Dealeruser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/Dealeruser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/Dealer_View') . "'</script>";
        }
    }
    public function Dealer_credit()
    {
        if ($this->Usersclass->DealerCredit_Validation()) {
            $this->Usersclass->DealerCredit_Save();
        }
    }
    //WarehouseIncharge
    public function WarehouseIncharge()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->WarehouseIncharge(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/WarehouseIncharge', $data);
    }
    public function WarehouseIncharge_commit()
    {
        if ($this->Usersclass->WarehouseIncharge_Validation()) {
            $this->Usersclass->WarehouseIncharge_Save();
        }
    }
    public function WarehouseIncharge_View()
    {
        $this->load->view('Users/WarehouseIncharge_View');
    }
    public function WarehouseInchargeuser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/WarehouseInchargeuser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/WarehouseIncharge_view') . "'</script>";
        }
    }
	
	//WarehouseManager
    public function WarehouseManager()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->WarehouseManager(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/WarehouseManager', $data);
    }
    public function WarehouseManager_commit()
    {
        if ($this->Usersclass->WarehouseManager_Validation()) {
            $this->Usersclass->WarehouseManager_Save();
        }
    }
    public function WarehouseManager_View()
    {
        $this->load->view('Users/WarehouseManager_View');
    }
    public function WarehouseManageruser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/WarehouseManageruser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/WarehouseManager_view') . "'</script>";
        }
    }
	
    //Salary
    public function Salary()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $ur = base64_decode($_GET['ur']);
            $dbdata = $this->GM->Salary($ur, $paytype_id = "0", $status = "1", $Key);
            if (isset($dbdata[0])) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/Salary', $data);
    }
    public function AttendanceList_View()
    {
        $this->load->view('Users/AttendanceList_View');
    }
    public function Attendance()
    {
        if ((isset($_REQUEST['Key'])) && (isset($_REQUEST['ur']))) {
            $_GET['User_Id'] = base64_decode($_REQUEST['Key']);
            $_GET['UserRole_Id'] = base64_decode($_REQUEST['ur']);
            $this->load->view('Users/Attendance');
        } else {
            echo "<script>window.location='" . site_url('Users/AttendanceList_View') . "'</script>";
        }
    }
    public function Attendance_Edit()
    {
        if (isset($_REQUEST['Key'])) {
            $Attendance_Id = base64_decode($_REQUEST['Key']);
            $dbdata = $this->GM->AttendanceTime($Attendance_Id, $Attendancetimezone = "0", $status = "1", $Attendance_Status_Id = "0",$Urole="0",$Uid="0", $from_date = '', $to_date = '');
            if (isset($dbdata[0])) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $this->load->view('Users/Attendance_Edit', $data);
        } else {
            echo "<script>window.location='" . site_url('Users/AttendanceList_View') . "'</script>";
        }
    }
    public function Attendance_Save()
    {
        if ($this->Usersclass->Attendance_Validation()) {
            $this->Usersclass->Attendance_Save();
        }
    }
    public function Salary_Save()
    {
        if ($this->Usersclass->Salary_Validation()) {
            $this->Usersclass->Salary_Save();
        }
    }
    public function Salary_View()
    {
        $this->load->view('Users/Salary_View');
    }
    public function Salaryuser_views()
    {
        if ((isset($_GET['Key'])) && (isset($_GET['ur']))) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $_GET['UserRole_Id'] = base64_decode($_GET['ur']);
            $this->load->view('Users/Salaryuser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/Salary_view') . "'</script>";
        }
    }
    public function Hike_Save()
    {
        if ($this->Usersclass->Hike_Validation()) {
            $this->Usersclass->Hike_Save();
        }
    }
    public function Deduction_Save()
    {
        if ($this->Usersclass->Deduction_Validation()) {
            $this->Usersclass->Deduction_Save();
        }
    }
    public function SalaryAmount_Save()
    {
        if ($this->Usersclass->SalaryAmount_Validation()) {
            $this->Usersclass->SalaryAmount_Save();
        }
    }
    //SalesExecutve
    public function SalesExecutve()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->SalesExecutve(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/SalesExecutve', $data);
    }
    public function SalesExecutve_commit()
    {
        if ($this->Usersclass->SalesExecutve_Validation()) {
            $this->Usersclass->SalesExecutve_Save();
        }
    }
    public function SalesExecutve_View()
    {
        $this->load->view('Users/SalesExecutve_View');
    }
    public function SalesExecutveuser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/SalesExecutveuser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/SalesExecutve_View') . "'</script>";
        }
    }
	
	//SalesManager
    public function SalesManager()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->SalesManager(0, $Key);			
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;					
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/SalesManager', $data);
    }
    public function SalesManager_commit()
    {
        if ($this->Usersclass->SalesManager_Validation()) {
            $this->Usersclass->SalesManager_Save();
        }
    }
    public function SalesManager_View()
    {
        $this->load->view('Users/SalesManager_View');
    }
    public function SalesManageruser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/SalesManageruser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/SalesManager_View') . "'</script>";
        }
    }
	
    //AccountsManager
    public function AccountsManager()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->AccountsManager(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/AccountsManager', $data);
    }
    public function AccountsManager_commit()
    {
        if ($this->Usersclass->AccountsManager_Validation()) {
            $this->Usersclass->AccountsManager_Save();
        }
    }
    public function AccountsManager_View()
    {
        $this->load->view('Users/AccountsManager_View');
    }
    public function AccountsManageruser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/AccountsManageruser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/AccountsManager_View') . "'</script>";
        }
    }
    //Driver
    public function Driver()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->Driver(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/Driver', $data);
    }
    public function Driver_commit()
    {
        if ($this->Usersclass->Driver_Validation()) {
            $this->Usersclass->Driver_Save();
        }
    }
    public function Driver_View()
    {
        $this->load->view('Users/Driver_View');
    }
    public function Driveruser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/Driveruser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/Driver_View') . "'</script>";
        }
    }
    //Helper
    public function Helper()
    {
        if (isset($_GET['Key'])) {
            $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Key = base64_decode($_GET['Key']);
            $dbdata = $this->GM->Helper(0, $Key);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        } else {
            $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        }
        $this->load->view('Users/Helper', $data);
    }
    public function Helper_commit()
    {
        if ($this->Usersclass->Helper_Validation()) {
            $this->Usersclass->Helper_Save();
        }
    }
    public function Helper_View()
    {
        $this->load->view('Users/Helper_View');
    }
    public function Helperuser_views()
    {
        if (isset($_GET['Key'])) {
            $_GET['User_Id'] = base64_decode($_GET['Key']);
            $this->load->view('Users/Helperuser_views');
        } else {
            echo "<script>window.location='" . site_url('Users/Helper_View') . "'</script>";
        }
    }
}
