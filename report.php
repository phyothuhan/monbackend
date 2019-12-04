<?php
include("advance_control.php");
if(isset($_REQUEST["id"]))
{
$con=connect();
$pid=getCode($_REQUEST["id"]);
  	 $sql="SELECT * FROM attendance where participantid='$pid' AND status='printing'";
	 
				 $result=search($sql);
				 $row=mysqli_num_rows($result);
      if($row>0)
	  {
		header("location:attendancelist.php?msg=This person was already printing!");
	   }
	   else
	   {
$sql="UPDATE attendance SET status='printing' WHERE participantid='$pid'";
mysqli_query($con,$sql);
	   }

}
?>
<!DOCTYPE html>
<html>
<head>
	
</head>
<style type="text/css">
body
{
  margin:0px;
  padding:0px;
}
</style>
<body>


	<div id="printer" style="border:none;width:336px;height:480px;">
    	<div style="width:365px;height:100px;border:none;"></div>
       
        <div style="border:none;width:336px;">
		 <h3 align="center" style="margin-bottom:0px;margin-bottom:2px;">&nbsp;</h3>
		<p align="center" style="margin-bottom:3px;margin-top:2px;"><strong>Name:</strong><br/><?php if(isset($_REQUEST["fn"])){ echo base64_decode($_REQUEST["fn"]);} ?></p>
        <p align="center" style="margin-bottom:3px;margin-top:2px;"><strong>Position:</strong><br/><?php if(isset($_REQUEST["os"])){ echo base64_decode($_REQUEST["os"]);} ?></p>
		<p align="center" style="margin-bottom:0;padding-bottom:0;margin-top:3px;"><strong>Organization Name</strong><br/><?php if(isset($_REQUEST["on"])){ echo base64_decode($_REQUEST["on"]);} ?></p>
	<img src="https://chart.googleapis.com/chart?chs=90x90&cht=qr&chl=$regcode(".($z+1).")&choe=UTF-8" title=\"aebf2016\" width=\"140px\" height=\"140px\"
    style="display:block;width:90px;height:90px;margin:0 auto;"/>
	</div>
  
  
    
    </div>
	<button onclick="printElem('printer')" style="margin-left:20px;height:40px;background-color:#FC0;color:#FFF;width:160px;border:none;" >Print</button>


<script>
function printElem(divId) {
    var content = document.getElementById(divId).innerHTML;
    var mywindow = window.open('', 'Print', 'height=508px,width=365px');

    mywindow.document.write('<html><head><title>Print</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(content);  
    mywindow.document.write('</body></html>');

    mywindow.document.close();
    mywindow.focus();
    mywindow.print();
    mywindow.close();
    return true;
}
</script>
</body>
</html>
