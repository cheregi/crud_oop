<?php
require_once __DIR__ . '/../src/bootstrap.php';

$id = $_GET['id'];

if($_SERVER['REQUEST_METHOD']== 'GET') {

    if(isset($_GET['id']) && !empty($_GET['id'])){

        $connection = \Database\DBConnection::getConnection();

        $park = new \Model\Car($_GET);

        $park->delete();

        echo 'delete successfull';

        header('Refresh:3; url=view.php');
    }
    else {
        header('Location: view.php');
    }
}



