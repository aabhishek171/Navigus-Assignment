<?php
    $con = mysqli_connect("localhost", "root", "", "quizproject");
    
    if(!$con){
        die("Connection failed".mysqli_connect_error());
    }
?>