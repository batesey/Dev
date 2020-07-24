<?php
// Initialize the session
session_start();
include ('server.php');
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
    exit;
}
 $username = $_SESSION['username'] ;
$email = $_SESSION['email'];
$pid = "";

$upper = strtoupper($_SESSION['username']);

$uid = $_SESSION["id"];

$sql = "SELECT tester FROM users WHERE id = $uid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $tester = $row["tester"];
    }}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Account page for <? echo htmlspecialchars($upper); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" href="logo.png">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }

    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($upper); ?></b>. Welcome to the Development Portal.</h1>
    </div>
    <p>
        <? if ( $_SESSION["username"] == 'harvey' ) {
    echo "<a class='btn btn-success' href='register.php'>Register A New User</a>" ;
    echo "<a class='btn btn-info'  style='margin-left:5px;'  href='adminorder.php'>Manage User Orders</a>" ;

} ?>
        <a href="order.php" class="btn btn-warning">Order Products</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>

    </p>
    <?
    $uid = $_SESSION["id"];
    $sql = "SELECT id FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $userid = $row["id"];
        $_SESSION['id'] = $userid;
        }
}
    $sql = "SELECT product_id FROM orders WHERE uid = $uid";
    $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $pid = array();
            // output data of each row
            while($row = $result->fetch_assoc()) {
            $pid[] = $row["product_id"];
    }
}
        if (empty($pid)) {
            echo "";
        } else {
    foreach($pid as $value){
        $_SESSION['pid'] = $value;
        $sql = "SELECT pname FROM products WHERE pid = $value";
            $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                $pname = array();
                $arrayLength = count($pname);
                // output data of each row
                while($row = $result->fetch_assoc()) {
                $pname[] = $row["pname"];
                $_SESSION['pname'] = $pname;
        foreach($pname as $name) {
            if ($value == 2 && $tester == 0) {
                $button = "<button class='btn btn-info' style='margin-left: 1%;'><a href='#'>Unable to download this product</a></button>";
            } else {
                $button = "<button  class='btn btn-info' style='margin-left: 1%;' ><a href='download/index.php?a=$name'>Download $name</a></button>";
            }}
echo $button;
                }}}}
    $conn->close();?>
</body>
</html>