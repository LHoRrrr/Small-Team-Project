<?php 
    include "../config/connectDB.php";
    $sql = "SELECT * FROM tblbanner;";
    $result = mysqli_query($conn,$sql);

    if (!$result){
        die("Query Error!");
    }

    while ($row = mysqli_fetch_assoc($result)){
        echo "ID : " . $row['id_banner'] . "</br>";
        echo "Tittle 1: " . $row['title1_banner'] . "</br>";
    }

    
?>