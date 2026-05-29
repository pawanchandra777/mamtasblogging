<?php

session_start();

include '../includes/config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}


// DELETE VIDEO

if(isset($_GET['delete'])){

    $id = $_GET['delete'];

    // FETCH THUMBNAIL

    $img = mysqli_fetch_assoc(

    mysqli_query($conn,

    "SELECT thumbnail FROM videos
    WHERE id='$id'")

    );

    // DELETE IMAGE

    if(file_exists("../uploads/".$img['thumbnail'])){

        unlink("../uploads/".$img['thumbnail']);
    }

    // DELETE VIDEO

    mysqli_query($conn,

    "DELETE FROM videos
    WHERE id='$id'");

    // DELETE COMMENTS

    mysqli_query($conn,

    "DELETE FROM comments
    WHERE video_id='$id'");

    // DELETE LIKES

    mysqli_query($conn,

    "DELETE FROM likes
    WHERE video_id='$id'");

    header("Location: manage-videos.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Manage Videos
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.table-box{
    background:white;
    padding:25px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.thumb{
    width:120px;
    height:80px;
    object-fit:cover;
    border-radius:8px;
}

.action-btn{
    margin:2px;
}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="table-box">

<h2 class="mb-4">
Manage Videos
</h2>

<table class="table table-bordered table-hover align-middle">

<tr class="table-dark">

<th>ID</th>
<th>Thumbnail</th>
<th>Title</th>
<th>Category</th>
<th>Views</th>
<th width="250">
Action
</th>

</tr>

<?php

$query = mysqli_query($conn,

"SELECT * FROM videos
ORDER BY id DESC");

while($row = mysqli_fetch_assoc($query)){

?>

<tr>

<td>
<?php echo $row['id']; ?>
</td>

<td>

<img src="../uploads/<?php
echo $row['thumbnail'];
?>"

class="thumb">

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

<!-- VIEW -->

<a href="../video.php?id=<?php
echo $row['id'];
?>"

class="btn btn-primary btn-sm action-btn">

View

</a>


<!-- EDIT -->

<a href="edit-video.php?id=<?php
echo $row['id'];
?>"

class="btn btn-warning btn-sm action-btn">

Edit

</a>


<!-- DELETE -->

<a href="manage-videos.php?delete=<?php
echo $row['id'];
?>"

class="btn btn-danger btn-sm action-btn"

onclick="return confirm('Delete this video permanently?')">

Delete

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</div>

</body>
</html>