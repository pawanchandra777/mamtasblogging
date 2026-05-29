<?php

include 'includes/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("Invalid Video ID");
}


/* =========================
   INCREASE VIDEO VIEWS
========================= */

$stmt = $conn->prepare("
    UPDATE videos
    SET views = views + 1
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();


/* =========================
   LIKE VIDEO
========================= */

if (isset($_POST['like'])) {

    $stmt = $conn->prepare("
        INSERT INTO likes (video_id, type)
        VALUES (?, 'like')
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
}


/* =========================
   DISLIKE VIDEO
========================= */

if (isset($_POST['dislike'])) {

    $stmt = $conn->prepare("
        INSERT INTO likes (video_id, type)
        VALUES (?, 'dislike')
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();
}


/* =========================
   INSERT COMMENT
========================= */

if (isset($_POST['comment_btn'])) {

    $name = trim($_POST['name']);
    $comment = trim($_POST['comment']);

    if ($name != '' && $comment != '') {

        $stmt = $conn->prepare("
            INSERT INTO comments
            (video_id, name, comment)
            VALUES (?, ?, ?)
        ");

        $stmt->bind_param(
            "iss",
            $id,
            $name,
            $comment
        );

        $stmt->execute();
    }
}


/* =========================
   FETCH VIDEO
========================= */

$stmt = $conn->prepare("
    SELECT * FROM videos
    WHERE id = ?
");

$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

$row = $result->fetch_assoc();

if (!$row) {
    die("Video not found");
}


/* =========================
   YOUTUBE EMBED URL
========================= */

$youtube_link = $row['youtube_link'];

$video_id = '';

if (
    preg_match(
        '/v=([^&]+)/',
        $youtube_link,
        $matches
    )
) {

    $video_id = $matches[1];

} elseif (
    preg_match(
        '/shorts\/([^?]+)/',
        $youtube_link,
        $matches
    )
) {

    $video_id = $matches[1];
}

if ($video_id == '') {
    die("Invalid YouTube Link");
}

$embed_url = "https://www.youtube.com/embed/" . $video_id;


/* =========================
   LIKE COUNTS
========================= */

$like_count = $conn->query("
    SELECT COUNT(*) AS total
    FROM likes
    WHERE video_id = $id
    AND type = 'like'
")->fetch_assoc()['total'];

$dislike_count = $conn->query("
    SELECT COUNT(*) AS total
    FROM likes
    WHERE video_id = $id
    AND type = 'dislike'
")->fetch_assoc()['total'];

?>

<?php include 'includes/header.php'; ?>


<div class="container mt-5 mb-5">

<div class="card shadow border-0 p-4 video-page">


<!-- TITLE -->

<h1 class="video-title">

<?= htmlspecialchars($row['title']) ?>

</h1>


<!-- TAGLINE -->

<p class="video-tagline">

<?= htmlspecialchars($row['tagline']) ?>

</p>


<!-- VIDEO PLAYER -->

<div class="ratio ratio-16x9 mb-4 video-frame">

<iframe
src="<?= $embed_url ?>"
title="<?= htmlspecialchars($row['title']) ?>"
loading="lazy"
allowfullscreen>
</iframe>

</div>


<!-- LIKE / DISLIKE -->

<form method="POST" class="mb-4 video-actions">

<button
type="submit"
name="like"
class="btn btn-success">

👍 Like <?= $like_count ?>

</button>

<button
type="submit"
name="dislike"
class="btn btn-danger">

👎 Dislike <?= $dislike_count ?>

</button>

</form>


<!-- STORY -->

<h3 class="mb-3">

Story

</h3>

<p class="video-story">

<?= nl2br(htmlspecialchars($row['story'])) ?>

</p>


<!-- COMMENT FORM -->

<h3 class="mt-5 mb-3">

Leave a Comment

</h3>

<form method="POST">

<div class="mb-3">

<input
type="text"
name="name"
class="form-control"
placeholder="Your Name"
required>

</div>

<div class="mb-3">

<textarea
name="comment"
class="form-control"
rows="4"
placeholder="Write Comment"
required></textarea>

</div>

<button
type="submit"
name="comment_btn"
class="btn btn-dark">

Post Comment

</button>

</form>


<!-- COMMENTS -->

<h3 class="mt-5 mb-4">

Comments

</h3>

<?php

$comments = $conn->query("
    SELECT * FROM comments
    WHERE video_id = $id
    ORDER BY id DESC
");

while ($com = $comments->fetch_assoc()) {

?>

<div class="card mt-3 comment-card">

<div class="card-body">

<h5>

<?= htmlspecialchars($com['name']) ?>

</h5>

<p>

<?= nl2br(
    htmlspecialchars($com['comment'])
) ?>

</p>

<small class="text-muted">

<?= $com['created_at'] ?>

</small>

</div>

</div>

<?php } ?>


<!-- RELATED VIDEOS -->

<h3 class="mt-5 mb-4">

Related Videos

</h3>

<div class="row">

<?php

$category = $row['category'];

$stmt = $conn->prepare("
    SELECT * FROM videos
    WHERE category = ?
    AND id != ?
    ORDER BY id DESC
    LIMIT 4
");

$stmt->bind_param("si", $category, $id);

$stmt->execute();

$related = $stmt->get_result();

while ($rel = $related->fetch_assoc()) {

?>

<div class="col-md-3 mb-4">

<div class="card shadow h-100 related-card">

<img
src="uploads/<?= htmlspecialchars($rel['thumbnail']) ?>"
style="height:180px; object-fit:cover;"
class="card-img-top"
alt="<?= htmlspecialchars($rel['title']) ?>">

<div class="card-body">

<h6 class="fw-bold">

<?= htmlspecialchars($rel['title']) ?>

</h6>

<a
href="video.php?id=<?= $rel['id'] ?>"
class="btn btn-sm btn-primary w-100">

Watch

</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</div>


<?php include 'includes/footer.php'; ?>