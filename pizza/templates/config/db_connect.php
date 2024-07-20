

<?php 
    $db_connect = mysqli_connect("localhost", "alpha", "alpha123", "alpha_pizzas");

    if(!$db_connect) {
        echo 'connection error: ' . mysqli_connect_error();
    }
?>