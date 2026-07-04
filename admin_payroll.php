<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$admin_id = $_SESSION['employee_id'];

$admin = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM employees WHERE id='$admin_id'
"));

/* UPDATE PAYROLL */
if(isset($_POST['update'])){

    $id = $_POST['id'];

    $basic = $_POST['basic_salary'];
    $housing = $_POST['housing_allowance'];
    $transport = $_POST['transport_allowance'];
    $bonus = $_POST['performance_bonus'];
    $tax = $_POST['tax_deduction'];

    $net = ($basic + $housing + $transport + $bonus) - $tax;

    mysqli_query($conn,"
        UPDATE payroll SET
        basic_salary='$basic',
        housing_allowance='$housing',
        transport_allowance='$transport',
        performance_bonus='$bonus',
        tax_deduction='$tax',
        net_salary='$net'
        WHERE id='$id'
    ");
}

$data = mysqli_query($conn,"
SELECT p.*, e.full_name
FROM payroll p
JOIN employees e ON p.employee_id=e.id
ORDER BY p.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Payroll</title>

<style>
body{font-family:Arial;background:#f4f7fb;padding:20px;}
.card{background:#fff;padding:15px;margin-bottom:15px;border-radius:10px;}
input{padding:6px;margin:4px;width:120px;}
button{padding:8px;background:green;color:white;border:none;}
</style>
</head>

<body>

<h2>Payroll Management</h2>

<?php while($row = mysqli_fetch_assoc($data)) { ?>

<div class="card">

<b><?php echo $row['full_name']; ?> (<?php echo $row['month']; ?>)</b>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<input type="number" name="basic_salary" value="<?php echo $row['basic_salary']; ?>">
<input type="number" name="housing_allowance" value="<?php echo $row['housing_allowance']; ?>">
<input type="number" name="transport_allowance" value="<?php echo $row['transport_allowance']; ?>">
<input type="number" name="performance_bonus" value="<?php echo $row['performance_bonus']; ?>">
<input type="number" name="tax_deduction" value="<?php echo $row['tax_deduction']; ?>">

<button type="submit" name="update">Update</button>

</form>

</div>

<?php } ?>

</body>
</html>