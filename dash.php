<?php
session_start();
if(!isset($_SESSION['userdata'])){
	header("location:log.html");
}
$userdata=$_SESSION['userdata'];
$groupsdata=$_SESSION['groupsdata'];
if($_SESSION['userdata']['status']==0){
	$status='<b style="color:red">Not Voted</b>';
}
else{
	$status='<b style="color:green">Voted</b>';
}
?>
<html>
<head>
<title>Online Voting System-Dashboard</title>
</head>
<body>
<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

#mainSection {
    padding: 10px;
}

#headerSection {
    color:black;
    padding: 20px;
}

#logoutbtn,
#backbtn {
    padding: 8px;
    font-size: 14px;
    background-color: #3867d6;
    color: white;
    border-radius: 5px;
    margin: 10px;
    float: left;
    transition: background-color 0.3s, transform 0.3s;
}

#logoutbtn:hover,
#backbtn:hover {
    background-color: #0056b3;
    transform: scale(1.05);
}

#logoutbtn:active,
#backbtn:active {
    background-color: #004080;
}

#logoutbtn {
    float: right;
}

#mainpanel {
    padding: 10px;
}

#Profile,
#Groups {
    background-color: white;
    padding: 20px;
}

#Profile {
    width: 30%;
    float: left;
}

#Groups {
    width: 60%;
    float: right;
}

#votebtn {
     background-color: #3867d6;
     color: white;
	 margin: 10px;
	 width: 70px; 
     height: 40px; 
     border: none; 
	 padding: 8px;
     font-size: 14px; 
	 border-radius: 5px;
	 border:10px;
	 
}
#votebtn:hover {
    background-color: #003366;
}
#voted {
    padding: 8px;
    font-size: 14px;
    background-color: green;
    color: white;
    border-radius: 5px;
	transition: background-color 0.3s, transform 0.3s;
    transform: scale(1.05);
}

img {
    max-width: 100%;
    height: auto;
}

hr {
    border: none;
    border-top: 1px solid #ccc;
    margin: 20px 0;
}
@keyframes scaleButton {
    from {
        transform: scale(0);
    }
    to {
        transform: scale(1);
    }
}
</style>
<div id="mainSection">
<center>
<div id="headerSection">
<a href="reg.html"><button id="backbtn">Back</button></a>
<a href="logout.php"><button id="logoutbtn">Logout</button></a>
<h1>Online Voting System</h1>
</div>
</center>
<hr>
<div id="mainpanel">
<div id="Profile">
<center><img src="<?php echo $userdata['photo']?>" height="100" width="100"></center><br><br>
<b>Name:</b><?php echo $userdata['name']?><br><br>
<b>Mobile:</b><?php echo $userdata['mobile']?><br><br>
<b>Address:</b><?php echo $userdata['address']?><br><br>
<b>Status:</b><?php echo $status?><br><br>
</div>
<div id="Groups">
<?php
 if($_SESSION['groupsdata']){
	for($i=0;$i<count($groupsdata);$i++){
?>
<div>
<img style="float:right" src="<?php echo $groupsdata[$i]['photo']?>" height="100" width="100"><br><br>
<b>Group Name:</b><?php echo $groupsdata[$i]['name']?><br><br>
<form action="vote.php" method="POST">
<input  type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']?>">
<input  type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']?>">
<?php
if($_SESSION['userdata']['status']==0){
?>
<input type="submit" name="votebtn" value="vote" id="votebtn">
<?php
}
else{
	?>
	<button disabled type="button" name="votebtn" value="vote" id="voted">Voted</button>
	<?php
}
?>
</form>
</div>
<hr>
<?php
	}
 }
 else
 {
 }
 ?>
 </div>
 </div>
</body>
</html>