<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$employee_id = $_SESSION['employee_id'];

/* =========================
   APPLY LEAVE
========================= */
if(isset($_POST['submit_leave'])){

    $leave_type = mysqli_real_escape_string($conn, $_POST['leave_type']);
    $from_date  = $_POST['from_date'];
    $to_date    = $_POST['to_date'];
    $reason     = mysqli_real_escape_string($conn, $_POST['reason']);

    // VALIDATION (IMPORTANT FIX)
    if($from_date <= $to_date){

        mysqli_query($conn,"
            INSERT INTO leave_requests
            (employee_id, leave_type, from_date, to_date, reason, status)
            VALUES
            ('$employee_id', '$leave_type', '$from_date', '$to_date', '$reason', 'Pending')
        ");

        $msg = "Leave request submitted!";
    } else {
        $msg = "Invalid date range!";
    }
}

/* =========================
   FETCH MY LEAVES
========================= */
$leaves = mysqli_query($conn,"
    SELECT * FROM leave_requests
    WHERE employee_id='$employee_id'
    ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Employee Leave</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f7fb;
}

.navbar{
background:#2563EB;
color:white;
padding:15px;
display:flex;
justify-content:space-between;
}

.container{
padding:20px;
}

/* FORM */
.box{
background:white;
padding:20px;
border-radius:10px;
margin-bottom:20px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

input, select, textarea{
width:100%;
padding:10px;
margin-top:6px;
border:1px solid #ccc;
border-radius:6px;
}

button{
background:#2563EB;
color:white;
padding:10px;
border:none;
border-radius:6px;
cursor:pointer;
margin-top:10px;
}

/* STATUS BADGES */
.Pending{color:orange;font-weight:bold;}
.Approved{color:green;font-weight:bold;}
.Rejected{color:red;font-weight:bold;}

.msg{
margin-bottom:10px;
font-weight:bold;
color:#2563EB;
}

</style>
</head>

<body>

<div class="navbar">
<b>Leave System</b>
<a href="emp_dashboard.php" style="color:white;text-decoration:none;">Back</a>
</div>

<div class="container">

<?php if(isset($msg)) echo "<div class='msg'>$msg</div>"; ?>


<div class="box">

<h3>Apply Leave</h3>

<form method="POST">

<label>Leave Type</label>
<select name="leave_type" required>
    <option>Paid Leave</option>
    <option>Sick Leave</option>
    <option>Unpaid Leave</option>
</select>

<label>From Date</label>
<input type="date" name="from_date" required>

<label>To Date</label>
<input type="date" name="to_date" required>

<label>Reason</label>
<textarea name="reason" required></textarea>

<button type="submit" name="submit_leave">Submit</button>

</form>

</div>

<div class="box">

<h3>My Leave Records</h3>

<table border="1" width="100%" cellpadding="10" cellspacing="0">

<tr>
<th>Type</th>
<th>From</th>
<th>To</th>
<th>Reason</th>
<th>Status</th>
</tr>

<?php while($row = mysqli_fetch_assoc($leaves)) { ?>

<tr>

<td><?php echo $row['leave_type']; ?></td>
<td><?php echo $row['from_date']; ?></td>
<td><?php echo $row['to_date']; ?></td>
<td><?php echo $row['reason']; ?></td>

<td class="<?php echo $row['status']; ?>">
    <?php echo $row['status']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>