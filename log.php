<?php
session_start();
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$role=$_POST['role'];
$con1=mysqli_connect("localhost","root","","vote");
$check=mysqli_query($con1,"SELECT *FROM vote WHERE mobile='$mobile' AND password='$password' AND role='$role'");
if(mysqli_num_rows($check)>0){
	$userdata=mysqli_fetch_array($check);
	$groups=mysqli_query($con1,"SELECT *FROM vote WHERE role=2");
	$groupsdata=mysqli_fetch_all($groups,MYSQLI_ASSOC);
	
	$_SESSION['userdata']=$userdata;
	$_SESSION['groupsdata']=$groupsdata;
	
	echo'<script>
	     window.location="dash.php";
		 </script>';
}
else
{
	echo'<script>
	     alert("Invalid credentials or user not found!");
		 window.location="log.html";
		 </script>';
}
?>