<?php  
include("connection.php");  
session_start();  

if(!isset($_SESSION['employee_id'])){  
    header("Location: login.php");  
    exit();  
}  

$admin_id = $_SESSION['employee_id'];

/* =========================  
   (REMOVED ROLE CHECK - OPEN ACCESS)  
========================= */

// UPDATE LEAVE  
if(isset($_POST['update_leave'])){  

    $leave_id = $_POST['leave_id'];  
    $status   = $_POST['status'];  
    $comment  = mysqli_real_escape_string($conn, $_POST['comment']);  

    mysqli_query($conn,"  
        UPDATE leave_requests  
        SET status='$status',  
            admin_comment='$comment',  
            updated_at=NOW()  
        WHERE id='$leave_id'  
    ");  
}  

/* =========================  
   FILTER SYSTEM  
========================= */  
$filter = "ALL";  

if(isset($_GET['filter'])){  
    $filter = $_GET['filter'];  
}  

if($filter == "ALL"){  
    $query = "SELECT lr.*, e.full_name  
              FROM leave_requests lr  
              JOIN employees e ON lr.employee_id = e.id  
              ORDER BY lr.id DESC";  
}  
else{  
    $query = "SELECT lr.*, e.full_name  
              FROM leave_requests lr  
              JOIN employees e ON lr.employee_id = e.id  
              WHERE lr.status='$filter'  
              ORDER BY lr.id DESC";  
}  

$leaves = mysqli_query($conn,$query);  
?>  

<!DOCTYPE html>  
<html>  
<head>  
<meta charset="UTF-8">  
<title>Leave Panel</title>  

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
align-items:center;
}  

.container{  
padding:20px;  
}  

.filters{  
margin-bottom:15px;  
}  

.filters a{  
padding:8px 12px;  
margin-right:8px;  
background:white;  
border-radius:6px;  
text-decoration:none;  
color:#2563EB;  
font-weight:bold;  
box-shadow:0 2px 6px rgba(0,0,0,0.1);  
}  

.filters a:hover{  
background:#2563EB;  
color:white;  
}  

.card{  
background:white;  
padding:15px;  
margin-bottom:15px;  
border-radius:10px;  
box-shadow:0 4px 12px rgba(0,0,0,0.08);  
}  

.row{  
display:flex;  
justify-content:space-between;  
gap:10px;  
}  

.small{  
font-size:13px;  
color:#555;  
}  

.Pending{color:orange;font-weight:bold;}  
.Approved{color:green;font-weight:bold;}  
.Rejected{color:red;font-weight:bold;}  

textarea, select{  
width:100%;  
padding:6px;  
margin-top:6px;  
border-radius:6px;  
border:1px solid #ccc;  
}  

button{  
margin-top:8px;  
padding:6px 10px;  
border:none;  
border-radius:6px;  
cursor:pointer;  
background:#2563EB;
color:white;
}  

</style>  
</head>  

<body>  

<div class="navbar">  
<b>Leave Approval Panel</b>  
<a href="admin_dashboard.php" style="color:white;text-decoration:none;">Back</a>  
</div>  

<div class="container">  

<div class="filters">  
    <a href="admin_leave.php?filter=ALL">All</a>  
    <a href="admin_leave.php?filter=Pending">Pending</a>  
    <a href="admin_leave.php?filter=Approved">Approved</a>  
    <a href="admin_leave.php?filter=Rejected">Rejected</a>  
</div>  

<?php if(mysqli_num_rows($leaves) > 0){ ?>  

<?php while($row = mysqli_fetch_assoc($leaves)) { ?>  

<div class="card">  

<div class="row">  
    <b><?php echo htmlspecialchars($row['full_name']); ?></b>  
    <span class="<?php echo $row['status']; ?>">  
        <?php echo $row['status']; ?>  
    </span>  
</div>  

<div class="small">  
    Type: <?php echo $row['leave_type']; ?><br>  
    From: <?php echo $row['from_date']; ?> |  
    To: <?php echo $row['to_date']; ?>  
</div>  

<p class="small">  
    Reason: <?php echo $row['reason']; ?>  
</p>  

<form method="POST">  

<input type="hidden" name="leave_id" value="<?php echo $row['id']; ?>">  

<label>Status</label>  
<select name="status">  
    <option <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>  
    <option <?php if($row['status']=="Approved") echo "selected"; ?>>Approved</option>  
    <option <?php if($row['status']=="Rejected") echo "selected"; ?>>Rejected</option>  
</select>  

<label>Comment</label>  
<textarea name="comment"><?php echo $row['admin_comment']; ?></textarea>  

<button type="submit" name="update_leave">Update</button>  

</form>  

</div>  

<?php } ?>  

<?php } else { ?>  
<p>No leave requests found.</p>  
<?php } ?>  

</div>  

</body>  
</html>