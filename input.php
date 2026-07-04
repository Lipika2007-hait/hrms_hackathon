<?php
include("connection.php");

// PASSWORD GENERATOR (6 CHAR)
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
<html>
<head>
<title>HRMS Signup</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
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
Already have account? <a href="login.php">Login</a>
</div>

</div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $company = trim($_POST['company_name']);
    $name    = trim($_POST['full_name']);
    $email   = trim($_POST['email']);
    $phone   = trim($_POST['phone']);
    $pass    = $_POST['password'];
    $cpass   = $_POST['confirm_password'];
    $role    = $_POST['role'];

    if($pass != $cpass){
        die("Passwords not match");
    }

    // ❌ NO HASH (as you want)
    $password = $pass;

    // COMPANY CODE
    $companyParts = explode(" ", $company);
    $companyCode = strtoupper(substr($companyParts[0],0,1).
                    substr(end($companyParts),0,1));

    // NAME CODE
    $nameParts = explode(" ", $name);
    $first = strtoupper(substr($nameParts[0],0,2));
    $last  = strtoupper(substr(end($nameParts),0,2));

    $year = date("Y");

    // SERIAL
    $res = mysqli_query($conn,"SELECT COUNT(*) as total FROM employees");
    $row = mysqli_fetch_assoc($res);

    $serial = str_pad($row['total']+1,4,"0",STR_PAD_LEFT);

    $login_id = $companyCode.$first.$last.$year.$serial;

    // INSERT
    mysqli_query($conn,"INSERT INTO employees
    (company_name,full_name,email,phone,login_id,password,role)
    VALUES
    ('$company','$name','$email','$phone','$login_id','$password','$role')");

    echo "<script>
    alert('Registered Successfully\\nLogin ID: $login_id');
    window.location='login.php';
    </script>";
}
?>

<!-- EYE SCRIPT -->
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