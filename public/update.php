<?php
require_once __DIR__.'/../src/bootstrap.php';

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $connection = \Database\DBConnection::getConnection();

        $currentData = \Model\Car::read((int) $_GET['id']);

        if(empty($currentData)){
            header("Location: index.php");
        }


    } else {
        header("Location: index.php");
    }

}
if($_SERVER['REQUEST_METHOD'] === "POST") {

        $car = new \Model\Car($_POST);
        $car->update();

        echo "WOW UPDATED :D ";

        header("Refresh:3; url=view.php");

}

?>


<form method="POST">
    <select name="seats">

        <?php
            $arrayLabel = array("3" => "2+1","5" => "4+1");

            foreach($arrayLabel as $key => $value)
            {
                echo "<option value='" . $key . "'" . ($currentData->getSeats()==$key?" selected":"") . ">" . $value . "</option>";
            }
        ?>
    </select>

    <input type="text" name="brand" value="<?php echo $currentData->getBrand();?>" required/>

    <input type="text" name="color" value="<?php echo $currentData->getColor();?>"/>

    <input type="hidden" value="<?= isset($_GET['id'])?$_GET['id']:""; ?>" name="id"/>

    <button>Update</button>

</form>

<a href="view.php">Show list</a>
