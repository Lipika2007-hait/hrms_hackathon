<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id']) || !isset($_SESSION['role'])){
    header("Location: login.php");
    exit();
}

// ONLY ADMIN / HR CAN ACCESS
if($_SESSION['role'] != "HR" && $_SESSION['role'] != "Admin"){
    die("Access Denied");
}

// FETCH ALL EMPLOYEES
$employees = mysqli_query($conn,"
SELECT * FROM employees
ORDER BY full_name ASC
");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

body{
margin:0;
font-family:Arial;
background:#f4f7fb;
}

/* NAVBAR */
.navbar{
background:#2563EB;
padding:15px 25px;
color:white;
display:flex;
justify-content:space-between;
align-items:center;
}

.menu a{
color:white;
margin-right:20px;
text-decoration:none;
font-weight:bold;
}

/* CONTAINER */
.container{
padding:25px;
}

/* GRID */
.grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(260px,1fr));
gap:20px;
}

/* CARD */
.card{
background:white;
padding:18px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
cursor:pointer;
transition:0.2s;
}

.card:hover{
transform:scale(1.03);
}

/* FIRST LETTER AVATAR */
.avatar{
width:60px;
height:60px;
border-radius:50%;
background:#2563EB;
color:white;
display:flex;
justify-content:center;
align-items:center;
font-size:24px;
font-weight:bold;
margin-bottom:10px;
}

/* STATUS */
.status{
font-weight:bold;
margin-top:5px;
}

.present{color:green;}
.absent{color:orange;}
.leave{color:red;}

a{
text-decoration:none;
color:black;
}

</style>
</head>

<body>

<div class="navbar">

<div><b>HRMS ADMIN</b></div>

<div class="menu">
<a href="admin_dashboard.php">Employees</a>
<a href="attendance.php">Attendance</a>

</div>

</div>

<div class="container">

<h2>Employee List</h2>

<div class="grid">

<?php while($emp = mysqli_fetch_assoc($employees)) { ?>

<a href="employee_profile.php?id=<?php echo $emp['id']; ?>">

<div class="card">

<!-- FIRST LETTER AVATAR -->
<div class="avatar">
<?php echo strtoupper(substr($emp['full_name'],0,1)); ?>
</div>

<h3><?php echo htmlspecialchars($emp['full_name']); ?></h3>

<p><?php echo htmlspecialchars($emp['email']); ?></p>

<p><b><?php echo $emp['role']; ?></b></p>

<p class="status">
<?php
if($emp['attendance_status']=="Checked In"){
    echo "<span class='present'>🟢 Present</span>";
}
else if($emp['attendance_status']=="On Leave"){
    echo "<span class='leave'>✈ On Leave</span>";
}
else{
    echo "<span class='absent'>🟡 Absent</span>";
}
?>
</p>

</div>

</a>

<?php } ?>

</div>

</div>

</body>
</html>