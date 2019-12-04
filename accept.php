<?php
$id="";
include("advance_control.php");
if(isset($_REQUEST["id"]))
{
	

$con=connect();
$pid=getCode($_REQUEST["id"]);
$date=getTodayDate();
$sql="SELECT * FROM attendance where participantid='$pid'  AND AttendanceDate='".getTodayDate()."'";
	 
				 $result=search($sql);
				 $row=mysqli_num_rows($result);
      if($row>0)
	  {
		echo "This person was already attending!";
	   }
	   else
	   {
$eventid='1';
$status='noprint';
$sql="INSERT INTO attendance VALUES('0','$date','$eventid','$pid','$status')";
mysqli_query($con,$sql);
echo "Success";
	   }
}
?>
