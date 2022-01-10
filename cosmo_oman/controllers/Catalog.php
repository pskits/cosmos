<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Catalog extends CI_Controller
{
  function __construct()
  {
    parent::__construct();

    $this->load->model('CatalogClass');
  }

  //OfferList start
  public function Offerlist()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Catalog/OfferList', $data);
  }

  public function Offerlist_Save()
  {
    if ($this->CatalogClass->OfferList_Validation()) {
      $this->CatalogClass->OfferList_Save();
    }
  }
  public function Offerlist_View()
  {
    $this->load->view('Catalog/OfferList_View');
  }
  //OfferList end

  //CurrentOffers start
  public function CurrentOffers()
  {
    $data = array('But' => 'Save', 'Icon' => 'fa fa-check', 'BtnColor' => 'bg-Green text-Green');
    $this->load->view('Catalog/CurrentOffers', $data);
  }

  public function CurrentOffers_Save()
  {
    if ($this->CatalogClass->CurrentOffers_Validation()) {
      $this->CatalogClass->CurrentOffers_Save();
    }
  }
  public function CurrentOffers_View()
  {
    $this->load->view('Catalog/CurrentOffers_View');
  }
  //CurrentOffers end



}
