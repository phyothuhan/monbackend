<?php


$host="localhost";
$db="monfairdb";
$user="root";
$password="";
function getSelectOneColumnValue($table,$columnname,$columnvalue,$selectvalue)
{
	$query="SELECT  * FROM ".$table." WHERE ".$columnname."='".$columnvalue."'";
    $mysqli=connect();
	   $result=$mysqli->query($query);
	$row = $result->fetch_assoc();
	return $row[$selectvalue];
}
function getCode($code)
{
$pattern="MFI_000";

   $tmp=explode($pattern,$code);
   return $tmp[1];
}

function printCombowithscript($sql,$namesandscript ,$display_column,$id,$combosize)
	{
	 //  $result=search($sql);
	   $i=0;
	   echo "<select size=$combosize $namesandscript class=ss>";
	   $mysqli=connect();
	   $result=$mysqli->query($sql);
	$rownumber=mysqli_num_rows($result);

	if($rownumber>0 )
	{ 
	   while($row = $result->fetch_assoc())
	   {
		
		    echo "<option value=".$row[$id].">".$row[$display_column]."</option>";
	
	   }
	   echo "</select>";
	}
	}
function convertToidandnameCombo($table,$id,$display_column,$selectname)
{
$query="SELECT * FROM ".$table;
$mysqli=connect();
    $result=$mysqli->query($query);
	$rownumber=mysqli_num_rows($result);
	
	if($rownumber>0 )
	{ 
	  echo "<select name=".$selectname.">";
		 while($row = $result->fetch_assoc())
		 {
			 
			echo "<option value=".$row[$id]." >".$row[$display_column]."</option>";
			
		 }
	 echo "</select>";
	}
	

}
function connect()
{	
		//Open a new connection to the MySQL server
		$mysqli = new mysqli('localhost','root','','monfairdb');
		
		//Output any connection error
		if ($mysqli->connect_error) {
			die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
		}
  return $mysqli;

}
function getTodayDate()
	{
	 return "20". date("y")."-". date("m")."-".date("d");
	}
function search($query)
{	 $mysqli=connect();

	$result =$mysqli->query ($query);
	return $result;
}
function printTable($query,$columncount,$columnname,$column_name)
{
    $mysqli=connect();

    $result =$mysqli->query ($query);
    $rowcount=mysqli_num_rows($result);
    $row=0;
    if($rowcount>0)
    {


        echo "<table border=1>";
        echo "<tr>";
        for($i=0;$i<count($columnname);$i++)
        {
            echo "<td>";
            echo $columnname[$i];
            echo "</td>";
        }
        echo "</tr>";
        while($row=$result->fetch_assoc())
        {

            echo "<tr>";
            for($col=0;$col<$columncount;$col++)
            {
                echo "<td>";
                echo $row[$column_name[$col]];

                echo "</td>";
            }


            echo "</tr>";
            $row++;
        }
        echo "</table>";
    }

}
function fillToCombowithtitle($table,$columnindex,$selectname,$title)
{
$query="SELECT  * FROM ".$table;
 $mysqli=connect();
	$result=$mysqli->query($query);
	$rownumber=mysqli_num_rows($result);

	$row=0;
	if($rownumber>0 )
	{
	  echo "<select name=".$selectname.">";
	  echo "<option>".$title."</option>";
      while($row=$result->fetch_array(MYSQLI_NUM))
		 {
			echo "<option>".$row[$columnindex]."</option>";
			
		 }
	 echo "</select>";
	}
	

}
function searchTable($query,$columncount,$columnname,$column_name,$selectid)
{
    $mysqli=connect();

    $result =$mysqli->query ($query);
    $rowcount=mysqli_num_rows($result);
    $row=0;
    if($rowcount>0)
    {


        echo "<table border=1>";
        echo "<tr>";
        for($i=0;$i<count($columnname);$i++)
        {
            echo "<td>";
            echo $columnname[$i];
            echo "</td>";
        }
        echo "</tr>";
        while($row=$result->fetch_assoc())
        {

            echo "<tr>";
            for($col=0;$col<$columncount;$col++)
            {
                echo "<td>";
                echo $row[$column_name[$col]];

                echo "</td>";
            }
  echo "<td><a href=appointmentform.php?id=".$row[$selectid]." >Make Appointment</td>";

            echo "</tr>";
            $row++;
        }
        echo "</table>";
    }

}
function saveData($itm,$tname)
{
            $data="INSERT INTO ".$tname." VALUES(";
    for($i=0;$i< count($itm);$i++)
    {

        if($i==0)
        {
			    if (is_numeric($itm[$i]))
				{
				   $data=$data.$itm[$i].",";
				}
				else
				{
				     $data=$data."'".$itm[$i]."',";
				}
     
        }
        else if($i==count($itm)-1)
        {
			if (is_numeric($itm[$i]))
				{
				   $data=$data.$itm[$i].")";
				}
				else
				{
				     $data=$data."'".$itm[$i]."')";
				}
           
        }
        else
        {
			if (is_numeric($itm[$i]))
				{
				   $data=$data.$itm[$i].",";
				}
				else
				{
				     $data=$data."'".$itm[$i]."',";
				}
     
        }

    }

      process($data);
 
   
                     
}

function process($query)
{
	$mysqli=connect();
	$mysqli->query($query);
	$mysqli->close();
}
function getaID($format,$table)
    {
 
  mysql_connect("localhost","root","");
	mysql_select_db("royal");
                    $query="SELECT * FROM ".$table;
                 
                    $result=mysql_query($query);
					
                    $row= mysql_numrows($result)  ;
                    $i=0;
                    $data="";
                    $rid="";
                 
                    if($row !=0)
                    {
                      
                        $data=array(mysql_result($result, $i,0));
                        $i=$i+1;
                       while($i<$row)
                    {
                        array_push($data,mysql_result($result, $i,0));
                        $i=$i+1;
                     }
                     $temp= explode($format, $data[0]);
                     $mx=$temp[1];
                  for($k=1;$k<count($data);$k++)
                  {
                      $tmp= explode($format, $data[$k]);
                      
                      if( $tmp[1]>$mx)
                      {
                          $mx= $tmp[1];
                         
                      }

                  }
                  $mx=$mx+1;
                  $rid=$format.$mx;
     
                    }
                    else
                    {

                      $rid=$format."1";
                     
                    }
      
	  
       return $rid;
}
function getID($tableName,$fieldName,$prefix,$noOfLeadingZeros,$start)
{
	$newID="";
	$sql="";
	$value=1;
	$mysqli=connect();
	$sql="SELECT " . $fieldName . " FROM " . $tableName . " ORDER BY " . $fieldName ;	
	
	$results = $mysqli->query($sql);
	$noOfRow=0;
	//$record = $mysqli->query($query) ;
	$oldID= "";
while($row = $results->fetch_assoc()) {
   
       $oldID=  $row[$fieldName ];
  $noOfRow++;
}  

//$row =mysqli_fetch_assoc($results);


	
	if ($noOfRow<1)
	{		
		return $start;
	}
	else
	{
		//$oldID=$row[$fieldName];	//Reading Last ID
		//echo "<script>alert('$oldID')
		$oldID=str_replace($prefix,"",$oldID);	//Removing "Prefix"

		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$prefix . NumberFormatter($value,$noOfLeadingZeros);			
		return $newID;		
	}
}

function NumberFormatter($number,$n) 
{	
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

?>