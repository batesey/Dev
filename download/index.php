<?php 

session_start();
include('../server.php');

$code = $_GET['a'];
$id = $_SESSION['id'];

$sql = "SELECT pid FROM products WHERE pname = '$code'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pid = $row["pid"];
    }}
    $sql = "SELECT product_id FROM orders WHERE uid = '$id'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $pidown= $row["product_id"];
    }}

$sql = "SELECT cur_version FROM products WHERE pname = '$code'";
$result = $link->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $version = $row["cur_version"];
        $f = "$code$version.zip";
    }}
if ($pid == $pidown) {
    header('Location: '.$f);
} else {
    header('Location: ../main.php');
}
?>