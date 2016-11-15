<?php

$mzc = true;

if ($mzc == true) {
    $db_host = "localhost";
    $db_user = "mzc";
    $db_pass = "spring2016";
    $db_name = "mzc_group3";
} else {
    $db_host = "localhost";
    $db_user = "group_group3";
    $db_pass = "cler4cap3";
    $db_name = "group_group3";
}
//echo ("MySQL connect ==>" . $db_host . ", " . $db_user . ", " . $db_pass . ", " . $db_name);
// https://gator3147.hostgator.com:2083/cpsess5858308410/frontend/x3/sql/PhpMyAdmin.html


$dbc = new mysqli($db_host, $db_user, $db_pass, $db_name);
/* check connection */
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>