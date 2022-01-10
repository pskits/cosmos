<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Category extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
      
        $this->load->model('CategoryClass');
    }
    //Exec_DebitsAgainst
      public function DebitsAgainst()
    {        
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/DebitsAgainst', $data);
    }
    public function DebitsAgainst_Save()
    {
        if ($this->CategoryClass->DebitsAgainst_Validation()) {
            $this->CategoryClass->DebitsAgainst_Save();
        }
    }
    function DebitsAgainst_View()
    {
        $this->load->view('Category/DebitsAgainst_View');
    }
    
    //Bank start
    public function Bank()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Bank', $data);
    }
    public function Bank_Save()
    {
        if ($this->CategoryClass->Bank_Validation()) {
            $this->CategoryClass->Bank_Save();
        }
    }
    public function Bank_View()
    {
        $this->load->view('Category/Bank_View');
    }
    //Currency start
    public function Currency()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Currency', $data);
    }
    public function Currency_Save()
    {
        if ($this->CategoryClass->Currency_Validation()) {
            $this->CategoryClass->Currency_Save();
        }
    }
    public function Currency_View()
    {
        $this->load->view('Category/Currency_View');
    }
    //Country start
    public function Country()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Country', $data);
    }
    public function Country_Save()
    {
        if ($this->CategoryClass->Country_Validation()) {
            $this->CategoryClass->Country_Save();
        }
    }
    public function Country_View()
    {
        $this->load->view('Category/Country_View');
    }
    public function Country_Edit()
    {
        $this->CategoryClass->Country_Edit();
    }
    public function Country_Update()
    {
        if ($this->CategoryClass->Countryedit_Validation()) {
            $this->CategoryClass->Country_Update();
        }
    }
    //Country end
    //State start
    public function State()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/State', $data);
    }
    public function State_Save()
    {
        if ($this->CategoryClass->State_Validation()) {
            $this->CategoryClass->State_Save();
        }
    }
    public function State_View()
    {
        $this->load->view('Category/State_View');
    }
    public function State_Edit()
    {
        $this->CategoryClass->State_Edit();
    }
    public function State_Update()
    {
        if ($this->CategoryClass->Stateedit_Validation()) {
            $this->CategoryClass->State_Update();
        }
    }
    //state end
    //area start
    //Area start
  
    public function Area()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Area', $data);
    }
    public function Area_Save()
    {
        if ($this->CategoryClass->Area_Validation()) {
            $this->CategoryClass->Area_Save();
        }
    }
    public function Area_View()
    {
        $this->load->view('Category/Area_View');
    }
    //area end
    //Warehouse start
    public function Warehouse()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Warehouse', $data);
    }
    public function Warehouse_Save()
    {
        if ($this->CategoryClass->Warehouse_Validation()) {
            $this->CategoryClass->Warehouse_Save();
        }
    }
    public function Warehouse_View()
    {
        $this->load->view('Category/Warehouse_View');
    }
    //Warehouse End
    //Start Deduction
    public function Deduction()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Deduction', $data);
    }
    public function Deduction_Save()
    {
        if ($this->CategoryClass->Deduction_Validation()) {
            $this->CategoryClass->Deduction_Save();
        }
    }
    public function Deduction_View()
    {
        $this->load->view('Category/Deduction_View');
    }
    //End Deduction
    //Start Paytype
    public function Payhead()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Payhead', $data);
    }
    public function payhead_Save()
    {
        if ($this->CategoryClass->payhead_Validation()) {
            $this->CategoryClass->payhead_Save();
        }
    }
    public function payhead_View()
    {
        $this->load->view('Category/payhead_View');
    }
    //End Paytype
    //Start HolidayType
    public function HolidayType()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/HolidayType', $data);
    }
    public function HolidayType_Save()
    {
        if ($this->CategoryClass->HolidayType_Validation()) {
            $this->CategoryClass->HolidayType_Save();
        }
    }
    public function HolidayType_View()
    {
        $this->load->view('Category/HolidayType_View');
    }
    //End HolidayType
    //Start Holiday
    public function Holiday()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Holiday', $data);
    }
    public function Holiday_Save()
    {
        if ($this->CategoryClass->Holiday_Validation()) {
            $this->CategoryClass->Holiday_Save();
        }
    }
    public function Holiday_View()
    {
        $this->load->view('Category/Holiday_View');
    }
    //End Holiday
    //start Device
    public function Device_View()
    {
        $this->load->view('Category/Device_View');
    }
    public function Deviceapproval_views()
    {
        if (isset($_POST['Approval'])) {
            if ($this->CategoryClass->DeviceCode_Validation()) {
                $this->CategoryClass->DeviceCode_Save();
            }
        } elseif (isset($_POST['Activate'])) {
            $_POST['devicestatus'] = '4';
            if ($this->CategoryClass->DeviceStatus_Validation()) {
                $this->CategoryClass->DeviceStatus_Save();
            }
        } elseif (isset($_POST['DeActivate'])) {
            $_POST['devicestatus'] = '5';
            if ($this->CategoryClass->DeviceStatus_Validation()) {
                $this->CategoryClass->DeviceStatus_Save();
            }
        } else {
            $this->load->view('Category/Deviceapproval_views');
        }
    }
    //End device
    //Salut start
    public function Salut()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Salut', $data);
    }
    public function Salut_Save()
    {
        if ($this->CategoryClass->Salut_Validation()) {
            $this->CategoryClass->Salut_Save();
        }
    }
    public function Salut_View()
    {
        $this->load->view('Category/Salut_View');
    }
    //Salut end
    //Paytype start
    public function Paytype()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Paytype', $data);
    }
    public function Paytype_Save()
    {
        if ($this->CategoryClass->Paytype_Validation()) {
            $this->CategoryClass->Paytype_Save();
        }
    }
    public function Paytype_View()
    {
        $this->load->view('Category/Paytype_View');
    }
    //Paytype end
    //UserRole Start
    public function UserRole()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/UserRole_view', $data);
    }
    // UserRole Edit
    //status Start
    public function Status()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/status_view', $data);
    }
    // status Edit
    //ProductCategory start
    public function ProductCategory()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/ProductCategory', $data);
    }
    public function ProductCategory_Save()
    {
        if ($this->CategoryClass->ProductCategory_Validation()) {
            $this->CategoryClass->ProductCategory_Save();
        }
    }
    public function ProductCategory_View()
    {
        $this->load->view('Category/ProductCategory_View');
    }
    //ProductCategory end
    //Product start
    public function Product()
    {
		if(isset($_GET['Product_Id']))
{
	 $data = array('But' => 'Update', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
            $Product_Id = base64_decode($_GET['Product_Id']);
            $dbdata = $this->GM->Product($status=0, $ProductCategory_id=0, $Product_Id);
            if ($dbdata[0]) {
                foreach ($dbdata[0] as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
}
else
{
	 $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
      
}
         $this->load->view('Category/Product', $data);
    }
    public function Product_Save()
    {
        if ($this->CategoryClass->Product_Validation()) {
            $this->CategoryClass->Product_Save();
        }
    }
    public function Product_View()
    {
        $this->load->view('Category/Product_View');
    }
    public function ProductOnly_View()
    {
        $this->load->view('Category/ProductOnly_View');
    }
    //Product end
    //Company Product
    public function OfficeProducts_View()
    {
        $this->load->view('Category/OfficeProducts_View');
    }
    public function OfficeProducts()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/OfficeProducts', $data);
    }
    public function OfficeProducts_Save()
    {
        if ($this->CategoryClass->OfficeProducts_Validation()) {
            $this->CategoryClass->OfficeProducts_Save();
        }
    }
    //CompanyProduct end
    //taxes begin
    public function Taxes()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Taxes', $data);
    }
    public function Taxes_Save()
    {
        if ($this->CategoryClass->Taxes_Validation()) {
            $this->CategoryClass->Taxes_Save();
        }
    }
    public function Taxes_View()
    {
        $this->load->view('Category/Taxes_View');
    }
    //taxes end


    //Truck start
    public function Truck()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/Truck', $data);
    }
    public function Truck_Save()
    {
        if ($this->CategoryClass->Truck_Validation()) {
            $this->CategoryClass->Truck_Save();
        }
    }
    public function Truck_View()
    {
        $this->load->view('Category/Truck_View');
    }
    //Truck end
    //UserRights begin
    public function UserRights()
    {
        $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
        $this->load->view('Category/UserRights', $data);
    }
    public function UserRights_Save()
    {
        if ($this->CategoryClass->UserRights_Validation()) {
            $this->CategoryClass->UserRights_Save();
        }
    }
    public function UserRights_View()
    {
        $this->load->view('Category/UserRights_View');
    }
    public function Submenulist()
    {
        $Menu_Id = $_GET['Menu_Id'];
        $SubMenu_Id = "";
        $data = $this->MenuClass->Get_SubMenu_($Menu_Id);
        $file = $this->GM->Option_($data, 'SubMenu_Id', 'SubMenu', '', 'Select', @set_value('SubMenu_Id') . @$SubMenu_Id);
        echo "$file";
    }
    //UserRights end
}
