<?php
include("connection.php");
session_start();

if(!isset($_SESSION['employee_id'])){
    header("Location: login.php");
    exit();
}

$logged_id = $_SESSION['employee_id'];

// get logged user
$sessionUser = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM employees WHERE id='$logged_id'
"));

// if viewing someone else (admin click employee card)
$view_id = isset($_GET['id']) ? $_GET['id'] : $logged_id;

$user = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT * FROM employees WHERE id='$view_id'
"));

// UPDATE PROFILE
if(isset($_POST['update_profile'])){

    $is_admin = ($sessionUser['role'] == "admin" || $sessionUser['role'] == "hr");

    // common editable fields
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // admin editable fields
    if($is_admin){

        $full_name = $_POST['full_name'];
        $email = $_POST['email'];
        $department = $_POST['department'];
        $job_title = $_POST['job_title'];
        $manager = $_POST['manager'];
        $tax_percent = $_POST['tax_percent'];

        $sql = "UPDATE employees SET
            full_name='$full_name',
            email='$email',
            phone='$phone',
            address='$address',
            department='$department',
            job_title='$job_title',
            manager='$manager',
            tax_percent='$tax_percent'
            WHERE id='$view_id'";

    } else {

        // employee limited update
        $sql = "UPDATE employees SET
            phone='$phone',
            address='$address'
            WHERE id='$view_id'";
    }

    mysqli_query($conn, $sql);

    header("Location: employee_profile.php?id=$view_id");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
<title>Employee Profile</title>

<style>
body{
font-family:Arial;
background:#f4f7fb;
padding:30px;
}

.container{
max-width:800px;
margin:auto;
background:white;
padding:25px;
border-radius:10px;
box-shadow:0 5px 20px rgba(0,0,0,.1);
}

.avatar{
width:90px;
height:90px;
border-radius:50%;
background:#2563EB;
color:white;
display:flex;
justify-content:center;
align-items:center;
font-size:35px;
margin:auto;
}

input{
width:100%;
padding:10px;
margin:8px 0;
border:1px solid #ccc;
border-radius:6px;
}

label{
font-weight:bold;
}

button{
background:#2563EB;
color:white;
padding:10px 15px;
border:none;
border-radius:6px;
cursor:pointer;
}
</style>
</head>

<body>

<div class="container">

<div class="avatar">
<?php echo strtoupper(substr($user['full_name'],0,1)); ?>
</div>

<h2 style="text-align:center;">Employee Profile</h2>

<form method="POST">

<label>Full Name</label>
<input type="text" name="full_name"
value="<?= $user['full_name']; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<label>Email</label>
<input type="text" name="email"
value="<?= $user['email']; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<label>Phone</label>
<input type="text" name="phone"
value="<?= $user['phone']; ?>">

<label>Address</label>
<input type="text" name="address"
value="<?= $user['address'] ?? ''; ?>">

<label>Department</label>
<input type="text" name="department"
value="<?= $user['department'] ?? ''; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<label>Job Title</label>
<input type="text" name="job_title"
value="<?= $user['job_title'] ?? ''; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<label>Manager</label>
<input type="text" name="manager"
value="<?= $user['manager'] ?? ''; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<label>Tax %</label>
<input type="text" name="tax_percent"
value="<?= $user['tax_percent'] ?? 0; ?>"
<?= ($sessionUser['role']=="employee") ? "readonly" : ""; ?>>

<br>

<?php if($sessionUser['role']=="admin" || $sessionUser['role']=="hr"){ ?>
<button type="submit" name="update_profile">Update Profile</button>
<?php } else { ?>
<button type="submit" name="update_profile">Save Changes</button>
<?php } ?>

</form>

</div>

</body>
</html>