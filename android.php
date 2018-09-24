<?php

header("Content-Type: text/html; charset=UTF-8"); 

$db_name="threepig";
//parse_str( html_entity_decode( $_SERVER['QUERY_STRING']) , $out);


  $connect=mysqli_connect("localhost","threepig","sungshin95",$db_name);
  if (mysqli_connect_errno()){

echo"error:".mysqli_connect_error();

exit;

}

	
  $numIn=$_GET["numIn"];
  $numOut=$_GET["numOut"];
  $cafeID=$_GET["cafeID"];
  $uid=$_GET["uid"];

	$n=$_POST['name'];
	$s="INSERT INTO ESPtable(numIn,numOut,cafeID,uid) VALUES($numIn,$numOut,$cafeID,$uid)";
	$sResult=mysqli_query($connect,$s);
	echo $numIn;
	echo $numOut;
	echo $cafeID;
	//$edit="SELECT cafeName,numTable,numChair,numIn,numOut FROM cafeInfo as ci join ESPtable as et ON ci.cafeID=et.cafeID where name LIKE '%$n%' ORDER BY uid desc limit 1";
	$sql="select * from ESPtable";
	$ard=mysqli_query($connect,$sql);
	$edit = "select DISTINCT t3.cafeName,t3.cafeID, t3.numTable,t3.numChair,numIn,numOut from cafeInfo as t3 join (select t1.cafeID, t1.uid, t1.numIn, t1.numOut from ESPtable as t1,(select cafeID, max(uid) as max_uid from ESPtable group by cafeID ) as t2 where t1.uid=t2.max_uid and t1.cafeID=t2.cafeID) as t4 on t3.cafeID=t4.cafeID where t3.name LIKE '%성신%' ORDER BY t3.cafeID";

	$result=mysqli_query($connect,$edit);

	
	$data=array();
while($row = mysqli_fetch_array($result)){
	$totalPeople=$row['numIn']-$row['numOut'];
	
	
	if($totalPeople<0) $totalPeople=0;
	
	
	$per=$totalPeople/$row['numChair'];
	if($per>=0.9) $perName="만석";
	else if($per>=0.6&&$per<0.8) $perName="혼잡";
	else if($per>=0.4&&$per<0.6) $perName="보통";
	else $perName="여유";
			//echo "<tr>";
			
			array_push($data,
			array('cafeName'=>$row['cafeName'],
				  'perName'=>$perName,
				  'totalPeople'=>$totalPeople,
				  'numTable'=>$row['numTable'],
				  'numChair'=>$row['numChair']));


$n++;
}

 header('Content-Type: application/json; charset=utf8');
$json = json_encode(array("threepig"=>$data), JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
echo $json;



 ?>
 
 