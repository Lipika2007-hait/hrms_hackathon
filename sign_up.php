<?php
include("connection.php");

function generatePassword($length = 6){

    $characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$%&";
    $password = "";

    for($i = 0; $i < $length; $i++){
        $password .= $characters[random_int(0, strlen($characters)-1)];
    }

    return $password;
}

$generatedPassword = generatePassword(6);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HRMS | Sign Up</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:linear-gradient(135deg,#4F46E5,#2563EB);
    padding:20px;
}

/* CARD */
.container{
    width:420px;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,0.2);
}

/* TITLE */
h2{
    text-align:center;
    color:#2563EB;
    margin-bottom:5px;
}

p{
    text-align:center;
    color:#666;
    margin-bottom:20px;
    font-size:14px;
}

/* INPUT BOX */
.input-group{
    margin-bottom:15px;
}

label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
    color:#333;
}

input, select{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
    transition:0.3s;
}

input:focus, select:focus{
    border-color:#2563EB;
    box-shadow:0 0 5px rgba(37,99,235,0.3);
}

/* PASSWORD BOX */
.password-box{
    position:relative;
}

.password-box i{
    position:absolute;
    right:12px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#666;
}

/* BUTTON */
button{
    width:100%;
    padding:12px;
    background:#2563EB;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#1E40AF;
}

/* LINK */
.login-link{
    text-align:center;
    margin-top:15px;
    font-size:14px;
}

.login-link a{
    color:#2563EB;
    font-weight:bold;
    text-decoration:none;
}
</style>

</head>

<body>

<div class="container">

<h2>Create Account</h2>
<p>HR Management System</p>

<form method="POST">


<div class="input-group">
<label>Company Name</label>
<input type="text" name="company_name" required>
</div>

<div class="input-group">
<label>Full Name</label>
<input type="text" name="full_name" required>
</div>

<div class="input-group">
<label>Email</label>
<input type="email" name="email" required>
</div>

<div class="input-group">
<label>Phone</label>
<input type="text" name="phone" maxlength="10" required>
</div>

<div class="input-group">
<label>Password</label>
<div class="password-box">
<input type="password" name="password" id="password"
value="<?php echo $generatedPassword; ?>" required>
<i class="fa-solid fa-eye" id="togglePassword"></i>
</div>
</div>

<div class="input-group">
<label>Confirm Password</label>
<div class="password-box">
<input type="password" name="confirm_password" id="confirmPassword"
value="<?php echo $generatedPassword; ?>" required>
<i class="fa-solid fa-eye" id="toggleConfirmPassword"></i>
</div>
</div>

<div class="input-group">
<label>Role</label>
<select name="role" required>
<option value="">Select Role</option>
<option value="Employee">Employee</option>
<option value="HR">HR</option>
</select>
</div>

<button type="submit">Sign Up</button>

</form>

<div class="login-link">
Already have an account? <a href="login.php">Sign In</a>
</div>

</div>


<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $company = $_POST['company_name'];
    $name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm_password'];
    $role = $_POST['role'];

    if($pass != $cpass){
        die("Passwords not match");
    }

    // ❌ REMOVED HASH (IMPORTANT FIX)
    $password = $pass;

    // COMPANY CODE
    $companyParts = explode(" ", trim($company));
    $companyCode = strtoupper(
        substr($companyParts[0],0,1) .
        substr(end($companyParts),0,1)
    );

    // NAME CODE
    $nameParts = explode(" ", trim($name));
    $first = strtoupper(substr($nameParts[0],0,2));
    $last = strtoupper(substr(end($nameParts),0,2));

    $year = date("Y");

    $res = mysqli_query($conn,"SELECT COUNT(*) as total FROM employees");
    $row = mysqli_fetch_assoc($res);

    $serial = str_pad($row['total']+1,4,"0",STR_PAD_LEFT);

    $login_id = $companyCode.$first.$last.$year.$serial;

    // INSERT
    mysqli_query($conn,"INSERT INTO employees
    (company_name, full_name, email, phone, login_id, password, role)
    VALUES
    ('$company','$name','$email','$phone','$login_id','$password','$role')");

    echo "<script>
        alert('Registered Successfully\\nLogin ID: $login_id');
        window.location='login.php';
    </script>";
}

?>

<!-- EYE TOGGLE SCRIPT -->
<script>

function togglePassword(inputId, iconId){

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    icon.addEventListener("click", function(){

        if(input.type === "password"){
            input.type = "text";
            icon.classList.add("fa-eye-slash");
            icon.classList.remove("fa-eye");
        } else {
            input.type = "password";
            icon.classList.add("fa-eye");
            icon.classList.remove("fa-eye-slash");
        }

    });

}

togglePassword("password","togglePassword");
togglePassword("confirmPassword","toggleConfirmPassword");

</script>

</body>
</html>