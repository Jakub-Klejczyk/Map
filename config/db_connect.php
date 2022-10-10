<?php

$conn = mysqli_connect('localhost', 'delta', 'DeLtA123PaRtNe', 'delta_partner');

if(!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>