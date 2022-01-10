<?php
class InventoryClass extends CI_Model
{
    function TripDeliveries_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('trip_Id', 'trip_Id', 'required');
        $this->form_validation->set_rules('againsttype_id', 'againsttype_id', 'required');
        $this->form_validation->set_rules('against_id', 'against_id', 'required');
        $this->form_validation->set_rules('sortby', 'sortby', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Required Details');
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function TripDeliveries_Save()
    {
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TripDeliveries '" . $_POST['trip_Id'] . "'
    ,'" . $_POST['againsttype_id'] . "'
    ,'" . $_POST['against_id'] . "'
    ,'" . $_POST['sortby'] . "'
	,'" . $_POST['User_Id'] . "'
	,'1'	
	";
        $query = $this->db->query($qry);
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $data = "The duplicate key value is";
            if (($out = strpos($err, "$data")) !== FALSE) {
                $Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
                $this->session->set_flashdata('msgU', "$Values_of_the_Message  Already Exist");
            } else {
                $this->session->set_flashdata('msgU', "Not Saved");
            }
        }
        echo "<script> history.go(-1);</script>";
    }
    function GoodsJournal_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('GoodsJournalType_Id', 'GoodsJournalType_Id', 'required');
        $this->form_validation->set_rules('from_warehouse_id', 'from_warehouse_id', 'required');
        $this->form_validation->set_rules('goodsjournal_date', 'goodsjournal_date', 'required');
        $this->form_validation->set_rules('goodsjournal_reference', 'import_reference', 'required');
        $this->form_validation->set_rules('goodsjournal_description', 'Import_description', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        $this->form_validation->set_rules('Goods_Id[]', 'Goods_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Required Details');
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function GoodsJournal_Save()
    {
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransGoodsJournal '" . $_POST['GoodsJournalType_Id'] . "'
            ,'" . $_POST['User_Id'] . "'           
            ,'" . $this->GM->DateTimeSplit($_POST['goodsjournal_date'])  . "'
            ,'" . $_POST['goodsjournal_reference'] . "'
            ,'" . $_POST['goodsjournal_description'] . "'
            ,'" . $_POST['User_Id'] . "'
            ,'1'
            ,'" . $_POST['Abut'] . "'	
            ";
        $query = $this->db->query($qry);
        if ($query) {
            $query = $query->result();
            foreach ($query as $Row) {
                $lastid =  $Row->LastID;
            }
            if ($lastid) {
                $Goods_Id = $_POST['Goods_Id'];
                $query = true;
                foreach ($Goods_Id as $key => $n) {
                    $qry = '';
                    if ($query == false) {
                        $this->session->set_flashdata('msgD', 'Partial Not Saved Contact System Admin!');
                        echo "<script> history.go(-1);</script>";
                        exit;
                    }
                    $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransGoodsJournalGoods '" . $lastid . "'
                            ,'" . $Goods_Id[$key] . "'                         
                            ,'3'	                          	
                            ,'" . $_POST['User_Id'] . "'	
                            ,'1'                          
                            ";
                    $query = $this->GM->prdinsert($qry);
                }
                $this->session->set_flashdata('msgS', 'Success!!!');
            } else {
                $this->session->set_flashdata('msgU', "Not Saved");
            }
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $data = "The duplicate key value is";
            if (($out = strpos($err, "$data")) !== FALSE) {
                $Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
                $this->session->set_flashdata('msgU', "$Values_of_the_Message Not Saved");
            } else {
                $this->session->set_flashdata('msgU', "Not Saved");
            }
        }
        echo "<script> history.go(-1);</script>";
    }
    function GoodsTransfer_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('from_warehouse_id', 'from_warehouse_id', 'required');
        $this->form_validation->set_rules('to_branch_id', 'to_branch_id', 'required');
        $this->form_validation->set_rules('to_warehouse_id', 'to_warehouse_id', 'required');
        $this->form_validation->set_rules('goodstransfer_date', 'goodstransfer_date', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        $this->form_validation->set_rules('Product_Id[]', 'Product_Id', 'required');
        if ($_POST['currentoffice_Id'] == $_POST['to_branch_id']) {
            $_POST['GoodsTransferType'] = '2';
        } else {
            $_POST['GoodsTransferType'] = '1';
        }
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Required Details');
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function GoodsTransfer_Save()
    {
        $qry = "dbo.Exec_TransGoodsTransfer '" . $_POST['GoodsTransferType'] . "'
            ,'" . $_POST['User_Id'] . "'
            ,'" . $_POST['from_warehouse_id'] . "'
            ,'" . $_POST['to_branch_id'] . "'
            ,'" . $_POST['to_warehouse_id'] . "'
            ,'" . $this->GM->DateTimeSplit($_POST['goodstransfer_date'])  . "'
            ,'" . $_POST['GoodsTransfer_Reference'] . "'
            ,'" . $_POST['GoodsTransfer_Description'] . "'
            ,'" . $_POST['GoodsTransfer__Subtotal'] . "'
		,'" . $_POST['GoodsTransfer_TotalDiscountAmount'] . "'
		,'" . $_POST['GoodsTransfer_TotalTaxAmount'] . "'
		,'" . $_POST['GoodsTransfer_GrandTotalAmount'] . "'
            ,'" . $_POST['User_Id'] . "'
            ,'1'
            ,'" . $_POST['Abut'] . "'	
            ";
        $query = $this->db->query($qry);
        if ($query) {
            $query = $query->result();
            foreach ($query as $Row) {
                $lastid =  $Row->LastID;
            }
            if ($lastid) {
                $Trans_GoodsTransferProduct_Product_Id = $_POST['Product_Id'];
                $Trans_GoodsTransferProduct_Quantity = $_POST['Qty'];
                $Trans_GoodsTransferProduct_Rate = $_POST['Rate'];
                $Trans_GoodsTransferProduct_DiscountType_Id = $_POST['Discounttype'];
                $Trans_GoodsTransferProduct_Discount = $_POST['Discount'];
                $Trans_GoodsTransferProduct_Tax_Id = $_POST['Tax'];
                $Trans_GoodsTransferProduct_Taxcost = $_POST['Taxamount'];
                $Trans_GoodsTransferProduct_Grandtotal = $_POST['productamount'];
                $Trans_GoodsTransferProduct_Description = $_POST['productdesc'];
                foreach ($Trans_GoodsTransferProduct_Product_Id as $key => $n) {
                    $qry = '';
                    if ($query == false) {
                        $this->session->set_flashdata('msgD', 'Partial Not Saved Contact System Admin!');
                        echo "<script> history.go(-1);</script>";
                        exit;
                    }
                    $prdqry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransGoodsTransferProduct '" . $lastid . "'
                            ,'" . $Trans_GoodsTransferProduct_Product_Id[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Quantity[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Rate[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_DiscountType_Id[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Discount[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Tax_Id[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Taxcost[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Grandtotal[$key] . "'
                            ,'" . $Trans_GoodsTransferProduct_Description[$key] . "'
                            ,'" . $_POST['User_Id'] . "'
                            ,'1'
                            ,'" . $_POST['Abut'] . "'
                            ";
                    $query = $this->GM->prdinsert($prdqry);
                }
                $this->session->set_flashdata('msgS', 'Success!!!');
            } else {
                $this->session->set_flashdata('msgU', "Not Saved");
            }
        } else {
            $err = $this->db->error();
            $err = $err['message'];
            $data = "The duplicate key value is";
            if (($out = strpos($err, "$data")) !== FALSE) {
                $Values_of_the_Message = substr($err, strpos($err, "$data") + 26);
                $this->session->set_flashdata('msgU', "$Values_of_the_Message Not Saved");
            } else {
                $this->session->set_flashdata('msgU', "Not Saved");
            }
        }
        echo "<script> history.go(-1);</script>";
    }
    function GoodsTransferGoods_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('to_branch_id', 'to_branch_id', 'required');
        $this->form_validation->set_rules('to_warehouse_id', 'to_warehouse_id', 'required');
        //$this->form_validation->set_rules('GoodsTransfer_Id', 'GoodsTransfer_Id', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        $this->form_validation->set_rules('Goods_Id[]', 'Goods_Id', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', 'Fill in All Required Details');
            //print_r(validation_errors());exit;
            echo "<script> history.go(-1);</script>";
        } else {
            return true;
        }
    }
    function GoodsTransferGoods_Save()
    {
        echo '<pre>';
        print_r($_POST);die;
        $Goods_Id = $_POST['Goods_Id'];
        $query = true;
        foreach ($Goods_Id as $key => $n) {
            $qry = '';
            if ($query == false) {
                $this->session->set_flashdata('msgD', 'Partial Not Saved Contact System Admin!');
                echo "<script> history.go(-1);</script>";
                exit;
            }
            $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransGoodsTransferGoods '" .  $_POST['GoodsTransfer_Id'] . "'
                            ,'" . $Goods_Id[$key] . "'                         
                            ,'" . $_POST['to_branch_id'] . "'	
                            ,'" . $_POST['to_warehouse_id'] . "'	
                            ,'" . $_POST['User_Id'] . "'	
                            ,'1'                          
                            ";
            $query = $this->GM->prdinsert($qry);
        }
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $this->session->set_flashdata('msgU', "Not Saved");
        }
        echo "<script> history.go(-2);</script>";
    }
    //Trip
    function Trip_Validation()
    {
        $this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');
        $this->form_validation->set_rules('User_Id', 'User_Id', 'required');
        $this->form_validation->set_rules('Warehouseid', 'Warehouseid', 'required');
        $this->form_validation->set_rules('area_Id', 'area_Id', 'required');
        $this->form_validation->set_rules('Truck_Id', 'Truck_Id', 'required');
        $this->form_validation->set_rules('Driver_Id', 'Driver_Id', 'required');
        $this->form_validation->set_rules('Helper_Id', 'Helper_Id', 'required');
        $this->form_validation->set_rules('AssignDate', 'AssignDate', 'required');
        $this->form_validation->set_rules('AssignTime', 'AssignTime', 'required');
        $this->form_validation->set_rules('description', 'description', 'required');
        $this->form_validation->set_rules('Trip_status_id', 'Trip_status_id', 'required');
        $this->form_validation->set_rules('Abut', 'Abut', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msgU', "Please Fill all Required Details");
            print_r(validation_errors());
            print_r($_POST);
            // echo "<script> history.go(-1); </script>";
        } else {
            return true;
        }
    }
    function Trip_Save()
    {
        $datetime = $_POST['AssignDate'] . ' ' . $_POST['AssignTime'];
        $qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Trip '" . $_POST['Warehouseid'] . "'
							,'" . $_POST['area_Id'] . "'
							,'" . $_POST['Truck_Id'] . "'
							,'" . $_POST['Driver_Id'] . "'
							,'" . $_POST['Helper_Id'] . "'
							,'" .  $this->GM->DateTimeSplit($datetime) . "'
							,'" . $_POST['description'] . "'
							,'" . $_POST['Trip_status_id'] . "'
							,'" . $_POST['User_Id'] . "'
							,'1'
							,'" . $_POST['Abut'] . "'
                            ";
        $query = $this->db->query($qry);
        $query = $query->result();
        foreach ($query as $Row) {
            $lastid = $Row->LastID;
            $directory = Trip_directory . "/" . $_SESSION['currentdatabasename'] . "/" . $lastid;
            if (!is_dir($directory)) {
                mkdir($directory, 0777, TRUE);
            }
        }
        if ($lastid) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $this->session->set_flashdata('msgU', "Not Saved");
        }
        echo "<script> history.go(-1); </script>";
    }
    //10-01-2022
    function GoodsTransfer_Save_External()
    {
        $Goods_Id = $_POST['Goods_Id'];
        $query = true;
        $Country_Id = $_POST['to_country_id'];
        if($Country_Id ==5){
            $database_name ='cosmo_qator';
        }else if($Country_Id ==2){
            $database_name ='cosmo_qator';// this we need to change
        }else{
            $database_name ='cosmo_qator';
        }
        $_POST['GoodsTransfer_Id'] =0;
        foreach ($Goods_Id as $key => $n) {
            $qry = '';
            if ($query == false) {
                $this->session->set_flashdata('msgD', 'Partial Not Saved Contact System Admin!');
                echo "<script> history.go(-1);</script>";
                exit;
            }
            //for source @start
            $qry = "".$database_name.".dbo.Exec_TransGoodsTransferGoodsExternal '" .  $_POST['GoodsTransfer_Id'] . "'
                            ,'" . $Goods_Id[$key] . "'                         
                            ,'" . $_POST['from_warehouse_id'] . "'   
                            ,'" . $_POST['to_warehouse_id'] . "'    
                            ,'" . $_POST['User_Id'] . "'    
                            ,'1'
                            ,'Transfer Out'                          
                            ,'5'
                            ,'" . $_POST['to_country_id'] . "'    
                            ,'-1'
                            ";
            // echo $qry;die;
            $query = $this->GM->prdinsert($qry);
            //for source @end
        }
        if ($query) {
            $this->session->set_flashdata('msgS', 'Success!!!');
        } else {
            $this->session->set_flashdata('msgU', "Not Saved");
        }
        echo "<script> history.go(-2);</script>";
    }
}
