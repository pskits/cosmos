<?php
class Warrenty extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if (isset($_SESSION['currentdatabasename'])) {
            $this->db = $this->load->database($_SESSION['currentdatabasename'], TRUE);
        }        
    }
    public function index()
    {
        echo "<script>window.location='" . site_url() . "'</script>";
    }
    public function Warrenty_View()
    {
        $this->load->view('Warrenty/Warrenty_View');
    }
}
?>