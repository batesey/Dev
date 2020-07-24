<?php 

include ('server.php');
$purchased = " "; 
$tester = "";
$check = "";

// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "";
    session_start();
} else {
    header("location: index.php");
}
$uid = $_SESSION['id'];
$sql = "SELECT tester FROM users WHERE id = $uid";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $tester = $row["tester"];
  }} 

if(isset($_POST['submit'])) {
    $sql = "SELECT product_id FROM orders WHERE uid = $uid";
$result = $link->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $check = $row["product_id"];
    $purchased = mysqli_real_escape_string($link, $_POST['products']);
  }} 
  if ($check === $purchased) {
      echo "<script>alert('You Already own this product'); location.href='./main.php';</script>";
  } else {
    $purchased = mysqli_real_escape_string($link, $_POST['products']);
    $sql = "INSERT INTO orders (uid, product_id) VALUES ('$uid', '$purchased')";
    if(mysqli_query($link, $sql)){
        echo "<script>alert('Order was Successful!'); location.href='./main.php';</script>";
    } else{
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
    }

    
     
    // Close connection
    mysqli_close($link);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="icon" href="logo.png">
    <title>Order Page</title>
</head>
<body>    
    <form style="margin-left: 1em;" method="post">
    <h3 class="card-title">Select Your Product</h3>
    <select name="products">
    <option value="1">LTFE - Bodrum</option>
    <?
    
    if ($tester == 1) {
        echo '<option value="2">EGSS - Stansted</option>';
    } 
    ?>
   </select> 
   <br>
    <input class="btn btn-success" style="margin-top: 1em;" type="submit" name="submit" value="Purchase">     <a href="./main.php" style="margin-top: 1em;" class="btn btn-danger">Return</a>
    </form>

</body>
</html>