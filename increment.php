<?php

include("advance_control.php");
$username="root";
$password="";
$db="monfairdb";
$sql = "SELECT COUNT(*) FROM attendance_view WHERE AttendanceDate='".getTodayDate()."' AND status='noprint'";

$con=connect();
$result = mysqli_query( $con,$sql) or trigger_error("SQL", E_USER_ERROR);
$r = mysqli_fetch_array($result);
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 5;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_REQUEST['currentpage']) && is_numeric($_REQUEST['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_REQUEST['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$sql = "SELECT * FROM attendance_view  WHERE AttendanceDate='".getTodayDate()."' AND status='noprint' LIMIT $offset, $rowsperpage";
//echo $sql;
$result = mysqli_query( $con,$sql) or trigger_error("SQL", E_USER_ERROR);
echo "<table class=\"table table-striped\"><tr><th>Paticipant ID</th><th>Organization Name</th><th>Participant name</th><th>Position</th><th>Guest Type</th><th>Status</th></tr>";
// while there are rows to be fetched...
while ($list = mysqli_fetch_assoc($result)) {
	$id="MFI_000".$list['participantid'];
	$ogname=base64_encode($list['organizationname']);
		$fnname=base64_encode($list['firstname']." ".$list['lastname']);
			$os=base64_encode($list['position']);
			$status=base64_encode($list['status']); // echo data
   echo  "<td>$id</td><td>".base64_decode($ogname)."</td><td>".base64_decode($fnname)."</td><td>".base64_decode($os)."</td><td>".$list['guesttype']."</td><td><a target=\"_blank\" href=\"report.php?on=$ogname&fn=$fnname&os=$os&id=$id\"  class=\"btn btn-primary\" >Print</a></td>";
   echo "<tr/>";
} // end while
echo "</table>";
/******  build the pagination links ******/
// range of num links to show
$range = 3;

// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " [<b>$x</b>] ";
      // if not current page...
      } else {
         // make it a link
         echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/


?>