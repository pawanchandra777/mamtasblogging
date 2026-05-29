<?php

include 'includes/config.php';

$social = mysqli_fetch_assoc(
    mysqli_query(
        $conn,
        "SELECT * FROM social_links LIMIT 1"
    )
);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>MamtasBlogging</title>

<meta
name="description"
content="Tour, Travel and Dharmik Videos">

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<link
rel="stylesheet"
href="assets/css/home.css">

</head>

<body>


<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">

<div class="container">

<a
class="navbar-brand fw-bold"
href="index.php">

MamtasBlogging

</a>

<button
class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<div
class="collapse navbar-collapse"
id="navbarNav">

<ul class="navbar-nav me-auto">

<li class="nav-item">

<a
class="nav-link active"
href="index.php">

Home

</a>

</li>

<li class="nav-item">

<a
class="nav-link"
href="#latest">

Latest

</a>

</li>

<li class="nav-item">

<a
class="nav-link"
href="#mostviewed">

Trending

</a>

</li>

<li class="nav-item">

<a
class="nav-link"
href="#shorts">

Shorts

</a>

</li>

<li class="nav-item">

<a
class="nav-link"
href="contact.php">

Contact

</a>

</li>

</ul>


<!-- SEARCH -->

<form
class="d-flex"
method="GET">

<input
class="form-control me-2"
type="search"
name="search"
placeholder="Search Videos">

<button class="btn btn-danger">

Search

</button>

</form>

</div>

</div>

</nav>


<!-- HERO -->

<section class="hero">

<div class="overlay"></div>

<div class="hero-content">

<h1 class="display-3 fw-bold">

MamtasBlogging

</h1>

<p class="lead">

Tour • Travel • Dharmik Stories

</p>

<a
href="#latest"
class="btn btn-danger btn-lg mt-3">

Explore Videos

</a>

</div>

</section>


<!-- LATEST VIDEOS -->

<div
class="container video-section"
id="latest">

<h2 class="section-title">

Latest Videos

</h2>

<p class="section-subtitle">

Explore spiritual journeys and temple stories

</p>

<div class="row video-row">

<?php

if(
    isset($_GET['search']) &&
    trim($_GET['search']) != ''
){

    $search = mysqli_real_escape_string(
        $conn,
        trim($_GET['search'])
    );

    $query = "
        SELECT * FROM videos
        WHERE title LIKE '%$search%'
        OR tagline LIKE '%$search%'
        OR category LIKE '%$search%'
        ORDER BY id DESC
    ";

}else{

    $query = "
        SELECT * FROM videos
        ORDER BY id DESC
    ";
}

$result = mysqli_query($conn, $query);

while($row = mysqli_fetch_assoc($result)){

?>

<div class="col-lg-4 col-md-6">

<a
href="video.php?id=<?php echo (int)$row['id']; ?>"
class="text-decoration-none">

<div class="video-card">

<div class="thumbnail-box">

<img
src="uploads/<?php echo htmlspecialchars($row['thumbnail']); ?>"
alt="<?php echo htmlspecialchars($row['title']); ?>">

<div class="thumbnail-overlay"></div>

<div class="play-btn">

▶

</div>

<div class="video-duration">

HD

</div>

</div>


<div class="video-info">

<div class="channel-logo">

M

</div>

<div class="video-content">

<h5 class="video-title">

<?php
echo htmlspecialchars($row['title']);
?>

</h5>

<div class="video-meta">

MamtasBlogging<br>

👁 <?php echo (int)$row['views']; ?>
views

</div>

</div>

</div>

</div>

</a>

</div>

<?php } ?>

</div>

</div>


<!-- TRENDING VIDEOS -->

<div
class="container video-section"
id="mostviewed">

<h2 class="section-title">

Trending Videos

</h2>

<p class="section-subtitle">

Most viewed spiritual content

</p>

<div class="row video-row">

<?php

$query2 = "
    SELECT * FROM videos
    ORDER BY views DESC
    LIMIT 6
";

$result2 = mysqli_query($conn,$query2);

while($row2 = mysqli_fetch_assoc($result2)){

?>

<div class="col-lg-4 col-md-6">

<a
href="video.php?id=<?php echo (int)$row2['id']; ?>"
class="text-decoration-none">

<div class="video-card">

<div class="thumbnail-box">

<img
src="uploads/<?php echo htmlspecialchars($row2['thumbnail']); ?>"
alt="<?php echo htmlspecialchars($row2['title']); ?>">

<div class="thumbnail-overlay"></div>

<div class="play-btn">

▶

</div>

<div class="video-duration">

TRENDING

</div>

</div>


<div class="video-info">

<div class="channel-logo">

🔥

</div>

<div class="video-content">

<h5 class="video-title">

<?php
echo htmlspecialchars($row2['title']);
?>

</h5>

<div class="video-meta">

Trending Video<br>

👁 <?php echo (int)$row2['views']; ?>
views

</div>

</div>

</div>

</div>

</a>

</div>

<?php } ?>

</div>

</div>


<!-- SHORT VIDEOS -->

<div
class="container video-section"
id="shorts">

<h2 class="section-title">

Short Videos

</h2>

<p class="section-subtitle">

Quick spiritual moments

</p>

<div class="row video-row">

<?php

$short = mysqli_query(
    $conn,
    "
    SELECT * FROM videos
    WHERE category='Short Video'
    ORDER BY id DESC
    "
);

while($s = mysqli_fetch_assoc($short)){

?>

<div class="col-lg-4 col-md-6">

<a
href="video.php?id=<?php echo (int)$s['id']; ?>"
class="text-decoration-none">

<div class="video-card">

<div class="thumbnail-box">

<img
src="uploads/<?php echo htmlspecialchars($s['thumbnail']); ?>"
alt="<?php echo htmlspecialchars($s['title']); ?>">

<div class="thumbnail-overlay"></div>

<div class="play-btn">

▶

</div>

<div class="video-duration">

SHORT

</div>

</div>


<div class="video-info">

<div class="channel-logo">

S

</div>

<div class="video-content">

<h5 class="video-title">

<?php
echo htmlspecialchars($s['title']);
?>

</h5>

<div class="video-meta">

Short Video<br>

👁 <?php echo (int)$s['views']; ?>
views

</div>

</div>

</div>

</div>

</a>

</div>

<?php } ?>

</div>

</div>


<!-- FOOTER -->

<div class="footer text-center">

<h4>

MamtasBlogging

</h4>

<p>

Tour • Travel • Dharmik Stories

</p>

<p>

Follow Us

</p>

<a
href="<?php echo $social['youtube']; ?>"
target="_blank"
class="btn btn-danger">

YouTube

</a>

<a
href="<?php echo $social['facebook']; ?>"
target="_blank"
class="btn btn-primary">

Facebook

</a>

<a
href="<?php echo $social['instagram']; ?>"
target="_blank"
class="btn btn-dark">

Instagram

</a>

<p class="mt-4">

© <?php echo date('Y'); ?>
MamtasBlogging.
All Rights Reserved.

</p>

</div>


<!-- WHATSAPP -->

<a
href="https://wa.me/9329349665"
target="_blank"
class="whatsapp">

<img
src="https://cdn-icons-png.flaticon.com/512/733/733585.png">

</a>


<!-- BOOTSTRAP JS -->

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>

</body>
</html>
