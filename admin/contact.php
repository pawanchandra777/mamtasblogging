<?php

include '../includes/config.php';

if(isset($_POST['send'])){

    $name = $_POST['name'];

    $email = $_POST['email'];

    $message = $_POST['message'];

    mysqli_query($conn,

    "INSERT INTO contact_messages
    (name,email,message)

    VALUES(
    '$name',
    '$email',
    '$message'
    )");

    $success = "Message Sent Successfully!";
}

?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>
Contact Us | MamtasBlogging
</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
rel="stylesheet">

<style>

body{
    background:#f5f5f5;
}

.contact-box{
    background:white;
    padding:40px;
    border-radius:20px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);
}

</style>

</head>

<body>

<div class="container mt-5 mb-5">

<div class="row justify-content-center">

<div class="col-md-8">

<div class="contact-box">

<h1 class="mb-4 text-center">
Contact Us
</h1>

<?php if(isset($success)){ ?>

<div class="alert alert-success">

<?php echo $success; ?>

</div>

<?php } ?>

<form method="POST">

<div class="mb-3">

<label>
Your Name
</label>

<input type="text"
name="name"
class="form-control"
required>

</div>

<div class="mb-3">

<label>
Email Address
</label>

<input type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>
Message
</label>

<textarea
name="message"
class="form-control"
rows="5"
required></textarea>

</div>

<button
name="send"
class="btn btn-dark w-100">

Send Message

</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>