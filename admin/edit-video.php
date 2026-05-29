<?php

session_start();

include '../includes/config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

$id = $_GET['id'];

$query = mysqli_query($conn,

"SELECT * FROM videos
WHERE id='$id'");

$row = mysqli_fetch_assoc($query);


// UPDATE VIDEO

if(isset($_POST['update'])){

    $title = $_POST['title'];

    $tagline = $_POST['tagline'];

    $story = $_POST['story'];

    $youtube = $_POST['youtube'];

    $category = $_POST['category'];

    $thumbnail = $_FILES['thumbnail']['name'];


    // NEW IMAGE

    if($thumbnail != ""){

        unlink("../uploads/".$row['thumbnail']);

        move_uploaded_file(

        $_FILES['thumbnail']['tmp_name'],

        "../uploads/".$thumbnail
        );

    }else{

        $thumbnail = $row['thumbnail'];
    }


    mysqli_query($conn,

    "UPDATE videos SET

    title='$title',

    tagline='$tagline',

    story='$story',

    youtube_link='$youtube',

    thumbnail='$thumbnail',

    category='$category'

    WHERE id='$id'");


    header("Location: manage-videos.php");
}

?>

<!DOCTYPE html>
<html>

<head>

<title>Edit Video</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.edit-box{
    background:white;
    padding:30px;
    border-radius:15px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.thumb{
    width:220px;
    border-radius:10px;
}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="edit-box">

<h2 class="mb-4">
Edit Video
</h2>

<form method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Title</label>

<input type="text"
name="title"
class="form-control"

value="<?php echo $row['title']; ?>"

required>

</div>

<div class="mb-3">

<label>Tagline</label>

<input type="text"
name="tagline"
class="form-control"

value="<?php echo $row['tagline']; ?>">

</div>

<div class="mb-3">

<label>Story</label>

<textarea
name="story"
class="form-control"
rows="6"><?php echo $row['story']; ?></textarea>

</div>

<div class="mb-3">

<label>YouTube Embed Link</label>

<input type="text"
name="youtube"
class="form-control"

value="<?php echo $row['youtube_link']; ?>">

</div>

<div class="mb-3">

<label>Current Thumbnail</label>

<br><br>

<img src="../uploads/<?php
echo $row['thumbnail'];
?>"

class="thumb">

</div>

<div class="mb-3">

<label>Change Thumbnail</label>

<input type="file"
name="thumbnail"
class="form-control">

</div>

<div class="mb-3">

<label>Category</label>

<select
name="category"
class="form-control">

<option <?php
if($row['category']=="Short Video")
echo "selected";
?>>

Short Video

</option>

<option <?php
if($row['category']=="Medium Video")
echo "selected";
?>>

Medium Video

</option>

<option <?php
if($row['category']=="Long Video")
echo "selected";
?>>

Long Video

</option>

</select>

</div>

<button
name="update"
class="btn btn-dark">

Update Video

</button>

</form>

</div>

</div>

</body>
</html>