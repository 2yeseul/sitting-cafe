<?php

header("Content-Type: text/html; charset=UTF-8"); 

$db_name="";
$host_name="";
$host_pw="";
$host="";

$connect=mysqli_connect("$host","$host_name","$host_name",$db_name);
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
	
$edit = "select DISTINCT t3.cafeName,t3.numTable,t3.cafeID,t3.numChair,numIn,numOut from cafeInfo as t3 join 
		(select t1.cafeID, t1.uid, t1.numIn, t1.numOut from ESPtable as t1,
		(select cafeID, max(uid) as max_uid from ESPtable group by cafeID ) as t2 
		 where t1.uid=t2.max_uid and t1.cafeID=t2.cafeID) as t4 on t3.cafeID=t4.cafeID
		 where t3.name LIKE '%$n%' ORDER BY t3.cafeID ";
$sql="select * from ESPtable";
$result=mysqli_query($connect,$edit);



 ?>
 

 <!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>앉는 카페</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link type="text/css" rel="stylesheet" href="homeStyle.css">
</head>

<body>
	<nav class="row">
		<img id="miniLogo" class="col-3 col-s-3" src="Logo.png">
		<ul>
			<li class="col-1 col-s-1 tomain"><a href="/index.php">첫화면으로</a></li>
		</ul>
	</nav>
	<section>
		<table class="center">

			<tr>
				<th>카페이름</th>
				<th>혼잡도</th>
				<th>실시간 인원</th>
				<th>테이블 수</th>
				<th>의자 수</th>
			</tr>
		<?php
				while($row = mysqli_fetch_array($result)){
	$totalPeople=$row['numIn']-$row['numOut'];
	
	
	if($totalPeople<0) $totalPeople=0;
	
	
	$per=$totalPeople/$row['numChair'];
	if($per>=0.9) $perName="만석";
	else if($per>=0.6&&$per<0.8) $perName="혼잡";
	else if($per>=0.4&&$per<0.6) $perName="보통";
	else $perName="여유";
			echo "<tr>";
				

			echo "<td>" . $row['cafeName'] . "</td>";
			echo "<td>" . $perName   . "</td>";
			echo "<td>" . $totalPeople    . "</td>";
			echo "<td>" . $row['numTable'] . "</td>";
			echo "<td>" . $row['numChair'] . "</td>";

			echo "</tr>";


$n++;
}
		?>
		
		</table>
	</section>
</body>

</html>
 