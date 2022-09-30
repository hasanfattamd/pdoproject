<?php
    require_once "db.php";

    if(isset($_POST['deleteData'])){
        $id = $_POST['id'];
    }

        $db = new DB();
        $db->deleteData($id);
        header('Location:index.php');
?>
