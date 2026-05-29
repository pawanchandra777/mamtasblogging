<?php

session_start();

include '../includes/config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}


// TOTAL VIDEOS

$total_videos = mysqli_num_rows(

mysqli_query($conn,

"SELECT * FROM videos")

);


// TOTAL COMMENTS

$total_comments = mysqli_num_rows(

mysqli_query($conn,

"SELECT * FROM comments")

);


// TOTAL LIKES

$total_likes = mysqli_num_rows(

mysqli_query($conn,

"SELECT * FROM likes
WHERE type='like'")

);


// TOTAL CONTACT MESSAGES

$total_messages = mysqli_num_rows(

mysqli_query($conn,

"SELECT * FROM contact_messages")

);


// TOTAL VIEWS

$views_query = mysqli_query($conn,

"SELECT SUM(views) as totalviews
FROM videos");

$views_data = mysqli_fetch_assoc($views_query);

$total_views = $views_data['totalviews'];

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Admin Dashboard
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

body{
    background:#f5f5f5;
    font-family:Arial;
}


/* DASHBOARD */

.dashboard-box{
    background:white;
    padding:30px;
    border-radius:20px;
    box-shadow:0 0 15px rgba(0,0,0,0.1);
}


/* STAT CARDS */

.stat-card{
    border-radius:20px;
    color:white;
    padding:30px;
    text-align:center;
    transition:0.3s;
}

.stat-card:hover{
    transform:translateY(-5px);
}

.stat-card i{
    font-size:40px;
    margin-bottom:15px;
}

.stat-card h1{
    font-size:40px;
}


/* COLORS */

.card1{
    background:linear-gradient(45deg,#0d6efd,#5a9cff);
}

.card2{
    background:linear-gradient(45deg,#198754,#53c98b);
}

.card3{
    background:linear-gradient(45deg,#dc3545,#ff7583);
}

.card4{
    background:linear-gradient(45deg,#212529,#4d5966);
}

.card5{
    background:linear-gradient(45deg,#6f42c1,#9d6bff);
}


/* TABLE */

.table{
    background:white;
}


/* BUTTONS */

.action-btns a{
    margin-right:10px;
    margin-bottom:10px;
}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="dashboard-box">


<!-- HEADER -->

<div class="d-flex justify-content-between align-items-center mb-4">

<div>

<h2 class="fw-bold">
Admin Dashboard
</h2>

<p class="text-muted">
Welcome to MamtasBlogging CMS
</p>

</div>

<a href="logout.php"
class="btn btn-danger">

<i class="fa fa-sign-out-alt"></i>
Logout

</a>

</div>


<!-- STATISTICS -->

<div class="row">

<div class="col-md-3 mb-4">

<div class="stat-card card1">

<i class="fa fa-video"></i>

<h1>
<?php echo $total_videos; ?>
</h1>

<p>
Total Videos
</p>

</div>

</div>


<div class="col-md-3 mb-4">

<div class="stat-card card2">

<i class="fa fa-eye"></i>

<h1>
<?php echo $total_views; ?>
</h1>

<p>
Total Views
</p>

</div>

</div>


<div class="col-md-3 mb-4">

<div class="stat-card card3">

<i class="fa fa-comments"></i>

<h1>
<?php echo $total_comments; ?>
</h1>

<p>
Comments
</p>

</div>

</div>


<div class="col-md-3 mb-4">

<div class="stat-card card4">

<i class="fa fa-thumbs-up"></i>

<h1>
<?php echo $total_likes; ?>
</h1>

<p>
Likes
</p>

</div>

</div>


<div class="col-md-3 mb-4">

<div class="stat-card card5">

<i class="fa fa-envelope"></i>

<h1>
<?php echo $total_messages; ?>
</h1>

<p>
Messages
</p>

</div>

</div>

</div>


<!-- ACTION BUTTONS -->

<div class="action-btns mt-4">

<a href="add-video.php"
class="btn btn-primary">

<i class="fa fa-plus"></i>
Add Video

</a>

<a href="manage-videos.php"
class="btn btn-dark">

<i class="fa fa-video"></i>
Manage Videos

</a>

<a href="messages.php"
class="btn btn-success">

<i class="fa fa-envelope"></i>
Contact Messages

</a>

</div>


<!-- LATEST VIDEOS -->

<h3 class="mt-5 mb-4 fw-bold">
Latest Uploads
</h3>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<tr class="table-dark">

<th>ID</th>
<th>Title</th>
<th>Category</th>
<th>Views</th>
<th>Status</th>

</tr>

<?php

$latest = mysqli_query($conn,

"SELECT * FROM videos
ORDER BY id DESC
LIMIT 5");

while($row = mysqli_fetch_assoc($latest)){

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>
<?php echo $row['title']; ?>
</td>

<td>
<?php echo $row['category']; ?>
</td>

<td>
👁 <?php echo $row['views']; ?>
</td>

<td>

<span class="badge bg-success">
Published
</span>

</td>

</tr>

<?php } ?>

</table>

</div>


<!-- FOOTER -->

<div class="mt-5 text-center text-muted">

© <?php echo date('Y'); ?>
MamtasBlogging Admin Panel

</div>

</div>

</div>

</body>
</html>