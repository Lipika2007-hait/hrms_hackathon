<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['employee_id'];

/*
========================
LOGGED IN USER DATA
========================
*/
$user = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM employees WHERE id='$user_id'
"));

/*
========================
FILTER (OPTIONAL)
========================
*/
$emp_id = isset($_GET['emp']) ? $_GET['emp'] : "";

/*
========================
EMPLOYEE LIST (FOR FILTER)
========================
*/
$employees = mysqli_query($conn,"
SELECT id, full_name FROM employees
WHERE role='employee'
");

/*
========================
ATTENDANCE DATA
========================
*/
$query = "
SELECT a.*, e.full_name
FROM attendance a
JOIN employees e ON a.employee_id = e.id
";

if($emp_id != ""){
    $emp_id = mysqli_real_escape_string($conn, $emp_id);
    $query .= " WHERE a.employee_id='$emp_id'";
}

$query .= " ORDER BY a.attendance_date DESC";

$data = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
<title>Attendance Dashboard</title>

<style>
body{
font-family:Arial;
background:#f4f7fb;
padding:20px;
}

.container{
max-width:1000px;
margin:auto;
background:white;
padding:20px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

h2{
margin-bottom:15px;
}

select{
padding:10px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:6px;
}

table{
width:100%;
border-collapse:collapse;
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

.status-present{color:green;font-weight:bold;}
.status-absent{color:red;font-weight:bold;}
.status-half{color:orange;font-weight:bold;}
.status-leave{color:gray;font-weight:bold;}
</style>

</head>

<body>

<div class="container">

<h2>Attendance Dashboard</h2>

<!-- FILTER -->
<form method="GET">
<select name="emp" onchange="this.form.submit()">
<option value="">All Employees</option>

<?php while($e=mysqli_fetch_assoc($employees)){ ?>
<option value="<?= $e['id'] ?>"
<?= ($emp_id == $e['id']) ? "selected" : "" ?> >
<?= htmlspecialchars($e['full_name']) ?>
</option>
<?php } ?>

</select>
</form>

<!-- TABLE -->
<table>
<tr>
<th>Employee</th>
<th>Date</th>
<th>Status</th>
</tr>

<?php while($r=mysqli_fetch_assoc($data)){ 

$statusClass = "";
if($r['status']=="Present") $statusClass="status-present";
if($r['status']=="Absent") $statusClass="status-absent";
if($r['status']=="Half Day") $statusClass="status-half";
if($r['status']=="Leave") $statusClass="status-leave";

?>

<tr>
<td><?= htmlspecialchars($r['full_name']) ?></td>
<td><?= $r['attendance_date'] ?></td>
<td class="<?= $statusClass ?>">
<?= $r['status'] ?>
</td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>