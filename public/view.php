<?php
require_once __DIR__ . '/../src/bootstrap.php';

$connection = \Database\DBConnection::getConnection();
$cars = \Model\Car::findAll();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Simple CRUD application</title>
</head>
<body>
<div>
    <h2>List Cars</h2>

    <table>

        <?php
        foreach ($cars as $car){
            echo '<tr>';
            echo '<td>' .$car->getBrand(). '</td>';
            echo '<td>'. $car->getColor().'</td>';
            echo '<td>'. $car->getSeats() .'</td>';
            echo '<td><a href="update.php?id=' . $car->getId() . '"><i class="far fa-edit"></i></a></td>';
            echo '<td><a href="delete.php?id=' . $car->getId() . '"><i class="fas fa-times-circle"></a></i></td>';
            echo '</tr>';
        }
        ?>
    </table>

    <a href="index.php">Create New</a>
</div>

</body>
</html>
