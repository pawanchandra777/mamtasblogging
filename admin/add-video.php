<?php
session_start();
include '../includes/config.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
}

if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $tagline = $_POST['tagline'];
    $story = $_POST['story'];
    $youtube = $_POST['youtube'];
    $category = $_POST['category'];

    $thumbnail = $_FILES['thumbnail']['name'];

    $temp_name = $_FILES['thumbnail']['tmp_name'];

    move_uploaded_file(
        $temp_name,
        "../uploads/".$thumbnail
    );

    $query = "INSERT INTO videos
    (title, tagline, story,
    youtube_link, thumbnail, category)

    VALUES(
    '$title',
    '$tagline',
    '$story',
    '$youtube',
    '$thumbnail',
    '$category'
    )";

    mysqli_query($conn, $query);

    $success = "Video Added Successfully";
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Add Video</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">
Add New Video
</h2>

<?php
if(isset($success)){
    echo "<div class='alert alert-success'>$success</div>";
}
?>

<form method="POST"
enctype="multipart/form-data">

<div class="mb-3">

<label>Video Title</label>

<input type="text"
name="title"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Tagline</label>

<input type="text"
name="tagline"
class="form-control">

</div>

<div class="mb-3">

<label>Story</label>

<textarea
name="story"
class="form-control"
rows="5"></textarea>

</div>

<div class="mb-3">

<label>YouTube Link</label>

<input type="text"
name="youtube"
class="form-control">

</div>

<div class="mb-3">

<label>Thumbnail</label>

<input type="file"
name="thumbnail"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Category</label>

<select
name="category"
class="form-control">

<option>Short Video</option>
<option>Medium Video</option>
<option>Long Video</option>

</select>

</div>

<button type="submit"
name="submit"
class="btn btn-dark">

Upload Video

</button>

</form>

</div>

</body>
</html>