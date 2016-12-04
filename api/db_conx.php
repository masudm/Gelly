<?php
                        //"localhost", "user", "password", "database"
$db_conx = mysqli_connect("localhost", "root", "", "recipe");
//evaluate the connection
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
    exit();
}
?>
