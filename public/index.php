<?php

require_once __DIR__ . '/../src/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['brand']) && !empty($_POST['color']) &&
        in_array($_POST['seats'], ['3', '5'])
    ) {

        $car = new \Model\Car($_POST);
        $car->create();

        echo "Created new row in the database";

        header("Refresh:3; url=view.php");

    }
}
?>
<form method="POST">
    <select name="seats">
        <option value="3">2+1</option>
        <option value="5">4+1</option>
    </select>

    <input type="text" name="brand" required/>

    <input type="text" name="color">

    <button>Submit</button>
</form>

<a href="view.php">Show list.</a>
