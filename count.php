<?php
$con2=mysqli_connect("localhost","root","","vote");
$eqry="SELECT *from vote where role=2";
$rs=mysqli_query($con2,$eqry);
$bookcount=0;
$mousecount=0;
while($r=mysqli_fetch_array($rs)){
echo "<img style='float:left' src='".$r[6]."' height='100' width='100'><br><br>";
echo "<br><br><br><H2>".$r[1]."</H2>";
echo "<h5>Votes for ".$r[1]." is:".$r[8]."</H5>";
echo "<hr><br>";
}
?>
<html>
<head><title>View</title></head>
<style>
a{
	text-decoration:none;
	color:white;
	font-size:15px;
}
button{
	border:1px;
	border-radius:7px;
	color:black;
	background-color:#474343;
}
</style>
<body>
<center><button><a href="display.php">Go Back</a></button></center>
</body>
</html>