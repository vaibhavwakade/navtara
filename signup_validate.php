<?php
include('./config.php');

$field = $_GET['field'];
$value = $_GET['value'];

if ($field == 'email') {
    $query = "SELECT * FROM signup WHERE email='$value'";
} elseif ($field == 'mobileNumber') {
    $query = "SELECT * FROM signup WHERE mobileNumber='$value'";
}

$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    echo 'taken';
} else {
    echo 'available';
}
?>
