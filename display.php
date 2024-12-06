<?php
$cn = mysqli_connect('localhost', 'root', '', 'login');
$dqry = "SELECT * FROM login";
$rs = mysqli_query($cn, $dqry);
$rc = mysqli_num_rows($rs);
function approveVoter($id, $cn)
{
    $approveQuery = "UPDATE login SET approved = 1 WHERE id = $id";
    mysqli_query($cn, $approveQuery);
	$cqry="SELECT *from login WHERE id=$id";
	$rs=mysqli_query($cn,$cqry);
	$r=mysqli_fetch_array($rs);
	$id=$r[0];
	$name=$r[1];
	$mobile=$r[2];
	$address=$r[3];
	$password=$r[4];
	$role=$r[5];
	$image=$r[6];
	$status=$r[7];
	$votes=$r[8];
	$con1=mysqli_connect("localhost","root","","vote");
	$insert=mysqli_query($con1,"INSERT INTO vote(name,mobile,address,password,role,photo,status,votes)VALUES('$name',$mobile,'$address','$password','$role','$image',0,0)");
}

function deleteVoter($id, $cn)
{
    $deleteQuery = "DELETE FROM login WHERE id = $id";
    mysqli_query($cn, $deleteQuery);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['action'])) {
        $id = $_POST['id'];
        if ($_POST['action'] == 'approve') {
            approveVoter($id, $cn);
        } elseif ($_POST['action'] == 'delete') {
            deleteVoter($id, $cn);
        }
        
		
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Voter Details</title>
    <style>
       /* Resetting default browser styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

a{
	text-decoration:none;
	color:black;
}

/* Global styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

table {
    border-collapse: collapse;
    width: 60%;
    margin: 0 auto;
}

th, td {
    border: 1px solid black;
    padding: 10px;
}

caption {
    font-size: 1em;
    margin-bottom: 10px;
}

button {
    padding: 8px 16px;
    cursor: pointer;
    border-radius: 5px;
    border: none;
    color: white;
    font-weight: bold;
    transition: background-color 0.3s, transform 0.3s;
    background-color: #3867d6;
    animation: scaleButton 0.3s ease-in-out forwards; /* Initial scale animation */
}

button.approve {
    background-color: #008CBA; /* Blue */
}   

button.delete {
    background-color: #f44336; /* Red */
}

button.logout {
    background-color: #555; /* Dark Grey */
}

button:hover {
    background-color: #0056b3; /* Darker Blue on hover */
    transform: scale(1.05);
}

button:active {
    transform: scale(0.95);
}

div {
    text-align: center;
    margin-top: 20px;
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
	<script>
        function handleAction(id, action) {
            document.getElementById('id').value = id;
            document.getElementById('action').value = action;
            document.getElementById('actionForm').submit();
        }
    </script>
</head>
<body>
<?php
if ($rc != 0) {
    echo "<table border='2' cellpadding='10' cellspacing='5' align='center'>";
    echo "<caption><b><h2>Voter Details</h2></b></caption>";
    echo "<tr><th>id</th><th>name</th><th>mobile</th><th>password</th><th>address</th><th>role</th><th>Action</th>";
    while ($r = mysqli_fetch_array($rs)) {
        echo "<tr>";
        echo "<td>" . $r[0] . "</td>";
        echo "<td>" . $r[1] . "</td>";
        echo "<td>" . $r[2] . "</td>";
        echo "<td>" . $r[3] . "</td>";
        echo "<td>" . $r[4] . "</td>";
		echo "<td>" . $r[5] . "</td>";
        echo"<td>";
		
		echo "<input type='hidden' name='id' value='{$r[0]}'>";
		if ($r['approved']) {
            echo "<button class='approve approved' disabled>Approved</button><br>";
        } else {
        echo "<td><button class='approve' onclick='handleAction(".$r[0].", \"approve\")'>Approve</button><br>";
		}
		if ($r['approved']) {
            echo "<button id='deleteBtn{$r[0]}' class='delete' disabled>Delete</button>";
        } else {
            echo "<button id='deleteBtn{$r[0]}' class='delete' onclick='handleAction(".$r[0].", \"delete\")'>Delete</button>";
        }
		
        echo"</td>";
        echo "</tr>";
    }
    echo "</table>";
}
?>
<div style='text-align:center;margin-top: 20px;'>
<a href="count.php">View Votes</a>
<div style='text-align:center;margin-top: 20px;'>
<button class="logout" onclick="location.href='logout.php';">Logout</button>
<form id="actionForm" method="post" style="display: none;">
<input type="hidden" id="id" name="id">
<input type="hidden" id="action" name="action">
</form>
</div>
</body>
</html>