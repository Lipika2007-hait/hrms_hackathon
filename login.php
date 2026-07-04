<?php
include("connection.php");
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $user_input = trim($_POST['user_input']);
    $password   = trim($_POST['password']);

    $user_input = mysqli_real_escape_string($conn, strtolower($user_input));

    // SEARCH USER (EMAIL OR LOGIN ID)
    $sql = "SELECT * FROM employees
            WHERE LOWER(email)='$user_input'
            OR LOWER(login_id)='$user_input'
            LIMIT 1";

    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        // PASSWORD CHECK (plain text as per your current system)
        if($password == $user['password']){

            // SESSION DATA
            $_SESSION['employee_id'] = $user['id'];
            $_SESSION['login_id']    = $user['login_id'];
            $_SESSION['name']        = $user['full_name'];
            $_SESSION['role']        = $user['role'];

            // ROLE BASED REDIRECT
            if($user['role'] == "Employee"){

                echo "<script>
                    alert('Login Successful!');
                    window.location='emp_dashboard.php';
                </script>";

            }
            else if($user['role'] == "HR" || $user['role'] == "Admin"){

                echo "<script>
                    alert('Login Successful!');
                    window.location='admin_dashboard.php';
                </script>";

            }
            else{

                echo "<script>alert('Invalid role in database!');</script>";

            }

        } else {

            echo "<script>alert('Incorrect Password!');</script>";

        }

    } else {

        echo "<script>alert('User not found!');</script>";

    }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, Helvetica, sans-serif;
}

body{
    background:linear-gradient(135deg,#4F46E5,#2563EB);
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
    padding:20px;
}

.container{
    width:400px;
    background:#fff;
    padding:30px;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    color:#2563EB;
    margin-bottom:8px;
}

p{
    text-align:center;
    color:#666;
    margin-bottom:20px;
    font-size:14px;
}

.input-group{
    margin-bottom:18px;
}

label{
    display:block;
    margin-bottom:6px;
    font-weight:bold;
}

input{
    width:100%;
    padding:12px;
    border:1px solid #ccc;
    border-radius:8px;
    outline:none;
    font-size:15px;
}

input:focus{
    border-color:#2563EB;
    box-shadow:0 0 5px rgba(37,99,235,.3);
}

.password-box{
    position:relative;
}

.password-box input{
    padding-right:45px;
}

.password-box i{
    position:absolute;
    right:15px;
    top:50%;
    transform:translateY(-50%);
    cursor:pointer;
    color:#666;
}

button{
    width:100%;
    padding:12px;
    background:#2563EB;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#1E40AF;
}

.signup-link{
    text-align:center;
    margin-top:18px;
    font-size:14px;
}

.signup-link a{
    color:#2563EB;
    font-weight:bold;
    text-decoration:none;
}

.signup-link a:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="container">

    <h2>Employee Login</h2>
    <p>Human Resource Management System</p>

    <form method="POST">

        <div class="input-group">
            <label>Email or Login ID</label>
            <input type="text" name="user_input" required>
        </div>

        <div class="input-group">
            <label>Password</label>
            <div class="password-box">
                <input type="password" name="password" id="password" required>
                <i class="fa-solid fa-eye" id="togglePassword"></i>
            </div>
        </div>

        <button type="submit">Login</button>

    </form>

    <div class="signup-link">
        Don't have an account? <a href="sign_up.php">Sign Up</a>
    </div>

</div>

<script>
const togglePassword = document.getElementById("togglePassword");
const password = document.getElementById("password");

togglePassword.addEventListener("click", function () {
    if (password.type === "password") {
        password.type = "text";
        this.classList.remove("fa-eye");
        this.classList.add("fa-eye-slash");
    } else {
        password.type = "password";
        this.classList.remove("fa-eye-slash");
        this.classList.add("fa-eye");
    }
});
</script>

</body>
</html>