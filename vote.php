<?php
session_start();
$votes=$_POST['gvotes'];
$total_votes=$votes+1;
$gid=$_POST['gid'];
$uid=$_SESSION['userdata']['id'];
$con1=mysqli_connect("localhost","root","","vote");
$update_votes=mysqli_query($con1,"UPDATE vote SET votes='$total_votes' WHERE id='$gid'");
$update_user_status=mysqli_query($con1,"UPDATE vote SET status=1 WHERE id='$uid'");
if($update_votes and $update_user_status){
    $groups=mysqli_query($con1,"SELECT *FROM vote WHERE role=2");
	$groupsdata=mysqli_fetch_all($groups,MYSQLI_ASSOC);
	
	$_SESSION['userdata']['status']=1;
	$_SESSION['groupsdata']=$groupsdata;
	echo'<script>
	     alert("Voting successful!");
		 window.location="dash.php";
		 </script>';
}
else{
    echo'<script>
	     alert("Some error occured");
		 window.location="dash.php";
		 </script>';
}
?>