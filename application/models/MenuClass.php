	<?php

	class MenuClass extends CI_Model
	{
		function __construct()
		{
			parent::__construct();
		}
		function Menu_($userroleid,$typeid)
		{
			$Res = $this->db->query('exec '.$_SESSION['currentdatabasename'].'.dbo.Com_Menu ' .$userroleid. ','.$typeid);
			echo $this->db->last_query();exit;
			return $Res->result();
		}
	
		function SubMenu_($ID,$userroleid)
		{

			$Res = $this->db->query('exec '.$_SESSION['currentdatabasename'].'.dbo.Com_SubMenu ' . $ID.','.$userroleid);
		
			// echo $this->db->last_query();exit;
			return $Res->result();
		}
		function Get_Menu_()
		{
			$Res = $this->db->query('exec '.$_SESSION['currentdatabasename'].'.dbo.Com_Get_Menu');
			return $Res->result();
		}
		function Get_SubMenu_($ID)
		{

			$Res = $this->db->query('exec '.$_SESSION['currentdatabasename'].'.dbo.Com_Get_SubMenu ' . $ID);
			return $Res->result();
		}
	}
	?>
