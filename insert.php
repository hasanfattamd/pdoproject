<?php
    require_once "db.php";

    if(isset($_POST['insertData'])){
        $name = $_POST['name'];
    }

        $db = new DB();
        $db->insertData($name);
        header('Location:index.php');
?>
