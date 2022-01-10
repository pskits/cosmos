<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Ticketsystem extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
       $this->load->model('Ticketsystemclass');
    }
     //Truck
     public function index()
     {
		 
	$data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Ticketsystem/DefaultEntry', $data);
   
    }
	   public function CreateTicket_Save()
    {
        if ($this->Ticketsystemclass->CreateTicket_Validation()) {
            $this->Ticketsystemclass->CreateTicket_Save();
        }
    }
	  public function issuetTicketPendingList()
     {
		 
	 $this->load->view('Ticketsystem/issuetTicketPendingList');
   
    }
	
}
