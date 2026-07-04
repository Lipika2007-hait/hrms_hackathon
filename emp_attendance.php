<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['employee_id'];

// GET CURRENT MONTH ATTENDANCE
$data = mysqli_query($conn,"
SELECT * FROM attendance
WHERE employee_id='$id'
ORDER BY attendance_date DESC
");

// WEEKLY GROUPING (simple)
$weekly = mysqli_query($conn,"
SELECT WEEK(attendance_date) as week_no,
COUNT(*) as total_days,
SUM(status='Present') as present_days,
SUM(status='Absent') as absent_days,
SUM(status='Half Day') as half_days,
SUM(status='Leave') as leave_days
FROM attendance
WHERE employee_id='$id'
GROUP BY WEEK(attendance_date)
ORDER BY week_no DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Attendance</title>

<style>
body{
font-family:Arial;
background:#f4f7fb;
padding:20px;
}

.container{
max-width:900px;
margin:auto;
background:white;
padding:20px;
border-radius:10px;
}

table{
width:100%;
border-collapse:collapse;
margin-top:15px;
}

th,td{
padding:10px;
border:1px solid #ddd;
text-align:center;
}

th{
background:#2563EB;
color:white;
}

.badge{
padding:5px 10px;
border-radius:5px;
color:white;
}

.present{background:green;}
.absent{background:red;}
.half{background:orange;}
.leave{background:gray;}
</style>
</head>

<body>

<div class="container">

<h2>My Attendance</h2>

<h3>Daily View</h3>

<table>
<tr>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?= $row['attendance_date'] ?></td>
<td>
<span class="badge <?= strtolower(str_replace(' ','',$row['status'])) ?>">
<?= $row['status'] ?>
</span>
</td>
</tr>

<?php } ?>

</table>

<h3 style="margin-top:30px;">Weekly Summary</h3>

<table>
<tr>
<th>Week</th>
<th>Present</th>
<th>Absent</th>
<th>Half Day</th>
<th>Leave</th>
</tr>

<?php while($w=mysqli_fetch_assoc($weekly)){ ?>

<tr>
<td>Week <?= $w['week_no'] ?></td>
<td><?= $w['present_days'] ?></td>
<td><?= $w['absent_days'] ?></td>
<td><?= $w['half_days'] ?></td>
<td><?= $w['leave_days'] ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>