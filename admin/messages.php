<?php

session_start();

include '../includes/config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>
Contact Messages
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="box">

<h2 class="mb-4">
Contact Messages
</h2>

<table class="table table-bordered">

<tr class="table-dark">

<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Message</th>
<th>Date</th>

</tr>

<?php

$query = mysqli_query($conn,

"SELECT * FROM contact_messages
ORDER BY id DESC");

while($row = mysqli_fetch_assoc($query)){

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['name']; ?>
</td>

<td>
<?php echo $row['email']; ?>
</td>

<td>
<?php echo $row['message']; ?>
</td>

<td>
<?php echo $row['created_at']; ?>
</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>