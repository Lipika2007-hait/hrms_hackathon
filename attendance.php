<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

// FETCH ONLY EMPLOYEES (EXCLUDE HR/ADMIN)
$employees = mysqli_query($conn,"
SELECT * FROM employees
WHERE role='Employee'
ORDER BY full_name ASC
");

// NUMBER OF DAYS (MONTH VIEW)
$days = 10; // you can change to 30 for full month

// STATUS OPTIONS (DEMO)
function randomStatus(){
    $r = rand(1,3);
    if($r == 1) return "P";
    if($r == 2) return "A";
    return "L";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Attendance Table</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f7fb;
}

/* NAVBAR */
.navbar{
background:#2563EB;
color:white;
padding:15px 25px;
display:flex;
justify-content:space-between;
}

/* CONTAINER */
.container{
padding:20px;
overflow-x:auto;
}

/* TABLE */
table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:10px;
overflow:hidden;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

th, td{
border:1px solid #eee;
padding:10px;
text-align:center;
font-size:14px;
}

th{
background:#2563EB;
color:white;
}

/* STATUS COLORS */
.present{color:green;font-weight:bold;}
.absent{color:orange;font-weight:bold;}
.leave{color:red;font-weight:bold;}

.name{
text-align:left;
font-weight:bold;
}

</style>
</head>

<body>

<div class="navbar">
<b>HRMS - Attendance Sheet</b>

<div>
<a href="admin_dashboard.php" style="color:white;text-decoration:none;">
Back
</a>
</div>
</div>

<div class="container">

<table>

<tr>
<th>Employee</th>

<?php for($d=1;$d<=$days;$d++){ ?>
<th><?php echo "Day ".$d; ?></th>
<?php } ?>

</tr>

<?php while($emp = mysqli_fetch_assoc($employees)) { ?>

<tr>

<td class="name">
<?php echo $emp['full_name']; ?>
</td>

<?php for($d=1;$d<=$days;$d++){

$status = randomStatus();

if($status=="P"){
    echo "<td class='present'>🟢</td>";
}
else if($status=="A"){
    echo "<td class='absent'>🟡</td>";
}
else{
    echo "<td class='leave'>✈</td>";
}

} ?>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>