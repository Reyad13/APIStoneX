<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche opération</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <div class="user-info">
            <div class="user-details">
                <div class="user-name">StoneX</div>
            </div>
        </div>
    </header>
    <div class="container">
        <h2>Recherche opération</h2>
        <form action="listSearchAPI.php" method="post">
            <label for="clordid">ClOrdID :</label>
            <input type="text" id="clOrdID" name="clOrdID" required>
            <br>
            <input type="submit" value="Envoyer">
        </form>
        <div class="button-container">
                        <a href="../index.php" class="button">Retour à l'accueil</a>
        </div>
    </div>
</body>
</html>
