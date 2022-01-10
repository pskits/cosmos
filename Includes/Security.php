<?php
// login check in all pages 
if (@$this->session->userdata['cosmolog']['UId']) {
  if((base_url(basename($_SERVER['SCRIPT_FILENAME']))==base_url($_SESSION['application_url']))
  ||((base_url(basename($_SERVER['SCRIPT_FILENAME']))==base_url('cosmo.php'))))
 {
  
 }
  else
  {
    echo "<script>window.location='".base_url($_SESSION['application_url'])."'</script>";
    exit;
  }
}
else
{
  echo "<script>window.location='".site_url('Welcome/logout')."'</script>";
  exit;
}
 
// end of login check
/*start login inactive check*/
//time set
$exptimecheck = date("m/d/Y h:i:s A", strtotime($_SESSION['loginTime']) + 8 * 60 * 60);
$clock = date('m/d/Y h:i:s A');
// check inactive time 
if ((number_format(strtotime($clock))) > (number_format(strtotime($exptimecheck)))) {
  $logouturl = site_url('Welcome/logout');
  echo "<script> alert('Your Session has been Expired! Please Login Again'); window.location='$logouturl'</script>";
  exit;
}
/*end of inactive time*/
//last active time update after inactive check
// $_SESSION['loginTime'] = $clock;
$ctime = $this->GM->changetocurrenttimezone($clock);
$Odate = explode(' ', $ctime);
$time = explode(':', $Odate[1]);
$hr = $time[0];
$min = $time[1];
$sec = $time[2];
$type = $Odate[2];
