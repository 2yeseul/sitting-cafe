
<?php

// 한글 깨짐 현상 때문에 사용한 인코딩 코드
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

// 아두이노로 부터 데이터를 받는 부분
$numIn=$_GET["numIn"];
$numOut=$_GET["numOut"];
$cafeID=$_GET["cafeID"];
$uid=$_GET["uid"];

$sql="INSERT INTO ESPtable(numIn,numOut,cafeID,uid) VALUES($numIn,$numOut,$cafeID,$uid)";
	
// sql문 실행 (이 부분에서 아두이노로 받은 데이터 값이 sql로 넘어감
$result=mysqli_query($connect,$sql);


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

	<section class="row center">
		<br> <br> 
		<div class="col-2 col-s-2">　</div>
		<img id="mainLogo" class="col-8 col-s-8" src="Logo.png"> 
		<br><br>
		<form class="form-inline" action="/search/index.php" method="post">

			<input type="text" class="form-control" name="name" id="search"
				placeholder="대학 명을 입력하세요. (예: ‘성신’ or ‘성신여자대학교’)">
			<input type="image" id="button" src="search.svg">
		</form>

	</section>
</body>
</html>