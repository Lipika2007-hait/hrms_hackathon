<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$emp_id = $_SESSION['employee_id'];

$result = mysqli_query($conn,"
SELECT * FROM payroll
WHERE employee_id='$emp_id'
ORDER BY year DESC, month DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>My Payroll</title>

<style>
body{font-family:Arial;background:#f4f7fb;padding:20px;}
.card{background:#fff;padding:15px;margin-bottom:15px;border-radius:10px;}
.row{display:flex;justify-content:space-between;}
.small{color:#555;font-size:13px;}
</style>
</head>

<body>

<h2>My Salary Details</h2>

<?php while($row = mysqli_fetch_assoc($result)) { ?>

<div class="card">

<div class="row">
<b><?php echo $row['month']." ".$row['year']; ?></b>
<b>Net: ₹<?php echo $row['net_salary']; ?></b>
</div>

<div class="small">
Basic: ₹<?php echo $row['basic_salary']; ?><br>
Housing: ₹<?php echo $row['housing_allowance']; ?><br>
Transport: ₹<?php echo $row['transport_allowance']; ?><br>
Bonus: ₹<?php echo $row['performance_bonus']; ?><br>
Tax: ₹<?php echo $row['tax_deduction']; ?><br>
Leave Deduction: ₹<?php echo $row['leave_deduction']; ?>
</div>

</div>

<?php } ?>

</body>
</html>