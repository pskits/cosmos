<?php
class Catalogclass extends CI_Model
{


	// OfferList
	function Offerlist_Validation()
	{
		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');

		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('OfferName', 'OfferName', 'required');
		$this->form_validation->set_rules('Code', 'Code', 'required');
		$this->form_validation->set_rules('OrderQuantity', 'OrderQuantity', 'required');
		$this->form_validation->set_rules('OfferQuantity', 'OfferQuantity', 'required');
		$this->form_validation->set_rules('CreditPeriod', 'CreditPeriod', 'required');
		$this->form_validation->set_rules('AllowMultiply', 'AllowMultiply', 'required');
		$this->form_validation->set_rules('OfferType_Id', 'OfferType_Id', 'required');
		$this->form_validation->set_rules('Restriction_Id', 'Restriction_Id', 'required');
		$this->form_validation->set_rules('Sorting', 'Sorting', 'required');
		$this->form_validation->set_rules('Status_Id', 'Status_Id', 'required');

		if ($this->form_validation->run() == FALSE) {

			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Catalog/OfferList', $data);
		} else {
			return true;
		}
	}

	function Offerlist_Save()
	{


		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_Offer'" . $_POST['OfferName'] . "'
    ,'" . $_POST['Code'] . "'
    ,'" . $_POST['OrderQuantity'] . "'
      ,'" . $_POST['OfferQuantity'] . "'
    ,'" . $_POST['CreditPeriod'] . "'
    ,'" . $_POST['AllowMultiply'] . "'
    ,'" . $_POST['OfferType_Id'] . "'
    ,'" . $_POST['Restriction_Id'] . "'
    ,'" . $_POST['Sorting'] . "'
	,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	,'" . $_POST['Abut'] . "'	
	";

		$query = $this->db->query($qry);

		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			redirect("Catalog/OfferList");
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
			$data = array('But' => $_POST['Abut'], 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
			$this->load->view('Catalog/OfferList', $data);
		}
	}

	// OfferList end

	// CurrentOffers
	function CurrentOffers_Validation()
	{

		$this->form_validation->set_error_delimiters('<div class="errors" style="color:#FD0004 !important;">', '</div>');

		$this->form_validation->set_rules('User_Id', 'User_Id', 'required');
		$this->form_validation->set_rules('Product_Id', 'Product_Id', 'required');
		$this->form_validation->set_rules('ProductCategory_Id', 'ProductCategory_Id', 'required');
		$this->form_validation->set_rules('Offer_Id', 'Offer_Id', 'required');
		// $this->form_validation->set_rules('Max_quantity', 'Max_quantity', 'min_length[Min_quantity]');
		
		if ($this->form_validation->run() == FALSE) {
			
			$this->session->set_flashdata('msgU', "Please Fill all Required Details");
			echo "<script> history.go(-1);</script>";
		} else {
			return true;
		}
	}

	function CurrentOffers_Save()
	{


		$qry = "".$_SESSION['currentdatabasename'].".dbo.Exec_TransOffer '" . $_POST['Product_Id'] . "'
    ,'" . $_POST['ProductCategory_Id'] . "'
	,'" . $_POST['Offer_Id'] . "'
	,'" . $_POST['SecondOfficeProduct_Id'] . "'
	,'" . $_POST['Max_quantity'] . "'
	,'" . $_POST['Min_quantity'] . "'
    ,'" . $_POST['User_Id'] . "'
	,'" . $_POST['Status_Id'] . "'
	,'" . $_POST['Abut'] . "'	
	";

		$query = $this->db->query($qry);

		if ($query) {
			$this->session->set_flashdata('msgS', 'Success!!!');
			
		} else {
			$err = $this->db->error();
			$err = $err['message'];
			$this->session->set_flashdata('msgU', "Same Data Already Exist");
		
			
		}
		echo "<script> history.go(-1);</script>";
	}

	// CurrentOffers end

}
