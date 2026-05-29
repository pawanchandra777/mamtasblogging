<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include '../includes/config.php';

if(isset($_SESSION['admin'])){
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST['login'])){

    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $stmt = mysqli_prepare(
        $conn,
        "SELECT username, password FROM admins WHERE username=?"
    );

    if(!$stmt){
        die("Database Error: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_store_result($stmt);

    if(mysqli_stmt_num_rows($stmt) > 0){

        mysqli_stmt_bind_result(
            $stmt,
            $db_username,
            $db_password
        );

        mysqli_stmt_fetch($stmt);

        if(
            password_verify(
                $password,
                $db_password
            )
        ){

            session_regenerate_id(true);

            $_SESSION['admin'] = $db_username;

            header("Location: dashboard.php");
            exit;

        }else{

            $error = "Invalid Username or Password";

        }

    }else{

        $error = "Invalid Username or Password";

    }

    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>

<html>

<head>

<title>Admin Login</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    background:#f0f2f5;
}

.login-box{
    width:400px;
    margin:auto;
    margin-top:120px;
    background:white;
    padding:40px;
    border-radius:15px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="login-box">

<h2 class="text-center mb-4">
Admin Login
</h2>

<?php
if(isset($error)){
    echo "<div class='alert alert-danger'>$error</div>";
}
?>

<form method="POST">

<div class="mb-3">
<label>Username</label>
<input type="text"
name="username"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>
<input type="password"
name="password"
class="form-control"
required>
</div>

<button
type="submit"
name="login"
class="btn btn-dark w-100">
Login </button>

</form>

</div>

</body>
</html>
