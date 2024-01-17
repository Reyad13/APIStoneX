<?php
session_start();

if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading test</title>
    <link rel="stylesheet" href="index.css">
    <style>
</style>
</head>
    <body>
    <header>
        <div class="user-info">
            <div class="user-details">
                <div class="user-name">StoneX</div>
            </div>
        </div>
    </header>
        <?php
            include_once "includes/coursRealTime.php";
        ?>

        <form action="spotFeature/spotForm.php" method="post">
            <button type="submit">Effectuer une opération de spot</button>
        </form>

        <form action="listFeature/ListForm.php" method="post">
            <button type="submit">Rechercher mon opération</button>
        </form>
    </body>
</html>
