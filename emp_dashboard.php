<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['employee_id'];

// =========================
// CHECK IN / CHECK OUT
// =========================
if(isset($_POST['attendance_action'])){

    if($_POST['attendance_action']=="checkin"){
        $status = "Checked In";
    }else{
        $status = "Checked Out";
    }

    mysqli_query($conn,"
        UPDATE employees
        SET attendance_status='$status',
            last_action_time=NOW()
        WHERE id='$id'
    ");
}

// Reload updated user immediately (NO redirect)
$userQuery = mysqli_query($conn,"
SELECT * FROM employees
WHERE id='$id'
");

$user = mysqli_fetch_assoc($userQuery);
?>

<!DOCTYPE html>
<html lang="en">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>HRMS Dashboard</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial,Helvetica,sans-serif;
}

body{
background:#f4f7fb;
}

.navbar{
height:70px;
background:#2563EB;
display:flex;
justify-content:space-between;
align-items:center;
padding:0 30px;
color:#fff;
box-shadow:0 2px 10px rgba(0,0,0,.15);
}

.left-nav{
display:flex;
align-items:center;
gap:40px;
}

.logo{
font-size:24px;
font-weight:bold;
}

.logo i{
margin-right:8px;
}

.menu{
display:flex;
gap:25px;
}

.menu a{
color:#fff;
text-decoration:none;
font-weight:bold;
}

.right-nav{
display:flex;
align-items:center;
gap:20px;
position:relative;
}

.status-btn{
background:#fff;
border:none;
padding:9px 18px;
border-radius:30px;
cursor:pointer;
font-weight:bold;
}

.red-dot{
color:red;
font-size:18px;
}

.green-dot{
color:green;
font-size:18px;
}

.avatar{
width:45px;
height:45px;
border-radius:50%;
background:#fff;
color:#2563EB;
display:flex;
justify-content:center;
align-items:center;
font-size:20px;
font-weight:bold;
cursor:pointer;
}

.dropdown{
display:none;
position:absolute;
top:65px;
right:0;
width:230px;
background:#fff;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,.2);
overflow:hidden;
z-index:100;
}

.dropdown button,
.dropdown a{
display:block;
width:100%;
padding:14px;
border:none;
background:#fff;
text-align:left;
cursor:pointer;
text-decoration:none;
color:#333;
font-size:15px;
}

.dropdown button:hover,
.dropdown a:hover{
background:#f5f5f5;
}

.checkin{
color:green;
font-weight:bold;
}

.checkout{
color:red;
font-weight:bold;
}

.container{
padding:30px;
}

.top-bar{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
}

.new-btn{
background:#2563EB;
color:#fff;
border:none;
padding:12px 20px;
border-radius:8px;
cursor:pointer;
}

.search-box input{
width:300px;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
outline:none;
}

.employee-grid{
display:grid;
grid-template-columns:repeat(auto-fill,minmax(280px,1fr));
gap:20px;
}

.employee-card{
background:#fff;
padding:18px;
border-radius:12px;
display:flex;
align-items:center;
gap:15px;
box-shadow:0 5px 15px rgba(0,0,0,.08);
}

.employee-photo{
width:70px;
height:70px;
border-radius:50%;
background:#2563EB;
color:#fff;
display:flex;
justify-content:center;
align-items:center;
font-size:28px;
font-weight:bold;
}

.employee-info h3{
margin-bottom:5px;
}

.employee-info p{
margin:2px 0;
font-size:14px;
color:#666;
}

.employee-status{
margin-top:8px;
font-weight:bold;
}

</style>

</head>

<body>

<div class="navbar">

<div class="left-nav">

<div class="logo">
<i class="fa-solid fa-building"></i> HRMS
</div>

<div class="menu">
<a href="emp_dashboard.php">Employees</a>
<a href="attendance.php">Attendance</a>

</div>

</div>

<div class="right-nav">

<button class="status-btn" id="statusBtn">

<?php
if($user['attendance_status']=="Checked In"){
    echo "<span class='green-dot'>●</span> Checked In";
}else{
    echo "<span class='red-dot'>●</span> Checked Out";
}
?>

</button>

<div class="dropdown" id="attendanceMenu">

<form method="POST">

<button type="submit"
name="attendance_action"
value="checkin"
class="checkin">
🟢 Check In
</button>

<button type="submit"
name="attendance_action"
value="checkout"
class="checkout">
🔴 Check Out
</button>

</form>

<hr>

<div style="padding:12px;font-size:13px;">

<b>Status:</b>
<?php echo $user['attendance_status']; ?>

<br><br>

<b>Since:</b>
<?php
echo !empty($user['last_action_time'])
? date("g:i A",strtotime($user['last_action_time']))
: "--:--";
?>

</div>

</div>


<div class="avatar" id="avatar">
<?php echo strtoupper(substr($user['full_name'],0,1)); ?>
</div>

<div class="dropdown" id="profileMenu">

<a href="profile.php">
<i class="fa-solid fa-user"></i>
My Profile
</a>

<a href="logout.php">
<i class="fa-solid fa-right-from-bracket"></i>
Logout
</a>

</div>

</div>

</div>

<div class="container">

<div class="top-bar">

<button class="new-btn">
<i class="fa-solid fa-plus"></i>
New Employee
</button>

<div class="search-box">
<input
type="text"
id="searchEmployee"
placeholder="Search employee...">
</div>

</div>

<div class="employee-grid">

<?php

$list = mysqli_query($conn,"
SELECT * FROM employees
ORDER BY full_name ASC
");

while($emp = mysqli_fetch_assoc($list)){

$status = "🟡 Absent";

if($emp['attendance_status'] == "Checked In"){
    $status = "🟢 Present";
}

if($emp['attendance_status'] == "On Leave"){
    $status = "✈ On Leave";
}

?>

<div class="employee-card">

<div class="employee-photo">
<?php echo strtoupper(substr($emp['full_name'],0,1)); ?>
</div>

<div class="employee-info">

<h3><?php echo htmlspecialchars($emp['full_name']); ?></h3>

<p>
<strong>Login ID:</strong>
<?php echo htmlspecialchars($emp['login_id']); ?>
</p>

<p>
<strong>Email:</strong>
<?php echo htmlspecialchars($emp['email']); ?>
</p>

<p>
<strong>Role:</strong>
<?php echo htmlspecialchars($emp['role']); ?>
</p>

<div class="employee-status">
<?php echo $status; ?>
</div>

</div>

</div>

<?php } ?>

</div>

</div>

<script>

// ==============================
// SEARCH EMPLOYEE
// ==============================
const searchEmployee = document.getElementById("searchEmployee");

searchEmployee.addEventListener("keyup", function () {

    let value = this.value.toLowerCase();
    let cards = document.querySelectorAll(".employee-card");

    cards.forEach(function(card){

        if(card.innerText.toLowerCase().includes(value)){
            card.style.display = "flex";
        }else{
            card.style.display = "none";
        }

    });

});


// ==============================
// DROPDOWN MENUS
// ==============================
const statusBtn = document.getElementById("statusBtn");
const attendanceMenu = document.getElementById("attendanceMenu");

const avatar = document.getElementById("avatar");
const profileMenu = document.getElementById("profileMenu");

statusBtn.addEventListener("click", function(e){
    e.stopPropagation();

    attendanceMenu.style.display =
        attendanceMenu.style.display === "block"
        ? "none"
        : "block";

    profileMenu.style.display = "none";
});

avatar.addEventListener("click", function(e){
    e.stopPropagation();

    profileMenu.style.display =
        profileMenu.style.display === "block"
        ? "none"
        : "block";

    attendanceMenu.style.display = "none";
});

document.addEventListener("click", function(){
    attendanceMenu.style.display = "none";
    profileMenu.style.display = "none";
});

</script>

</body>
</html>