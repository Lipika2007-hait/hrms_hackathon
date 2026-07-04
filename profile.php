<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['employee_id'];

$query = mysqli_query($conn,"
SELECT * FROM employees
WHERE id='$id'
LIMIT 1
");

$user = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>My Profile</title>

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
padding:40px;
}

.container{
max-width:700px;
margin:auto;
background:#fff;
border-radius:15px;
padding:35px;
box-shadow:0 8px 20px rgba(0,0,0,.12);
}

.title{
text-align:center;
margin-bottom:30px;
color:#2563EB;
}

.avatar{
width:110px;
height:110px;
margin:0 auto 25px;
border-radius:50%;
background:#2563EB;
color:#fff;
display:flex;
justify-content:center;
align-items:center;
font-size:42px;
font-weight:bold;
}

.form-group{
margin-bottom:18px;
}

label{
display:block;
margin-bottom:6px;
font-weight:bold;
color:#444;
}

input{
width:100%;
padding:12px;
border:1px solid #ccc;
border-radius:8px;
background:#f8f8f8;
font-size:15px;
}

.back-btn{
display:inline-block;
margin-top:20px;
padding:12px 22px;
background:#2563EB;
color:#fff;
text-decoration:none;
border-radius:8px;
font-weight:bold;
}

.back-btn:hover{
background:#1E40AF;
}

</style>

</head>

<body>

<div class="container">

<h2 class="title">My Profile</h2>

<div class="avatar">
<?php echo strtoupper(substr($user['full_name'],0,1)); ?>
</div>


<div class="form-group">
<label>Company Name</label>
<input type="text" value="<?php echo htmlspecialchars($user['company_name']); ?>" readonly>
</div>

<div class="form-group">
<label>Full Name</label>
<input type="text" value="<?php echo htmlspecialchars($user['full_name']); ?>" readonly>
</div>

<div class="form-group">
<label>Email Address</label>
<input type="text" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
</div>

<div class="form-group">
<label>Phone Number</label>
<input type="text" value="<?php echo htmlspecialchars($user['phone']); ?>" readonly>
</div>

<div class="form-group">
<label>Login ID</label>
<input type="text" value="<?php echo htmlspecialchars($user['login_id']); ?>" readonly>
</div>

<div class="form-group">
<label>Role</label>
<input type="text" value="<?php echo htmlspecialchars($user['role']); ?>" readonly>
</div>

<div class="form-group">
<label>Attendance Status</label>
<input type="text" value="<?php echo htmlspecialchars($user['attendance_status']); ?>" readonly>
</div>

<div class="form-group">
<label>Last Activity</label>
<input type="text"
value="<?php echo !empty($user['last_action_time']) ? date('d M Y, h:i A', strtotime($user['last_action_time'])) : 'No Activity'; ?>"
readonly>
</div>

<a href="emp_dashboard.php" class="back-btn">
<i class="fa-solid fa-arrow-left"></i> Back to Dashboard
</a>

</div>

</body>
</html>