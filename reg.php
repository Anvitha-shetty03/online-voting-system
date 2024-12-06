<?php
include("con.php");
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];
$address=$_POST['address'];
$image=$_FILES['photo']['name'];
$tmp_name=$_FILES['photo']['tmp_name'];
$role=$_POST['role'];
if($password==$cpassword){
	move_uploaded_file($tmp_name,"$image");
	$insert=mysqli_query($connect,"INSERT INTO login(name,mobile,address,password,role,photo,status,votes)VALUES('$name',$mobile,'$address','$password','$role','$image',0,0)");

	if($insert){
         		
	echo'<script>
	     alert("Registration Successfull!");
		 window.location="log.html";
		 </script>';
	}
	else{
	echo'<script>
	     alert("Some error occured");
		 window.location="reg.html";
		 </script>';
	}
}
else{
		echo'<script>
	     alert("Password and confirm password does not match");
		 window.location="reg.html";
		 </script>';
}

?>