<?php
    include('db.php');
    $id = $_POST['id'];
    $sql = "SELECT id,title,data FROM page WHERE id = '$id'";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $arr = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo $arr[0]['data'];
    
?>