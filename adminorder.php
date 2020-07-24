<?php
include ('server.php');
session_start();
$uid = $_SESSION['id'];
if ($_SESSION['username'] == "harvey") {
    echo " ";
} else {
    header('Location: index.php');
}
$username = $_POST["username"];

$sql = "DELETE FROM orders WHERE uid = $uid";
$result = $link->query($sql);



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Order Control</title>
</head>
<body>
<div class="wrapper">
<form method="post">
    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
        <label>Users ID</label>
        <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" value="Delete All Orders From User">
        <a class="btn btn-danger"" href="./">Return</a>
    </div>
</div>
</form>
</body>
</html>