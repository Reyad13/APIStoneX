<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Opérations de Spot</title>
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
            <h2>Effectuer une opération de spot</h2>

            <form action="spotPriceView.php" method="post">
                <label for="pair">Paire :</label>
                <input type="text" id="pair" name="pair" required>
                
                <label for="deal">Type transaction (1=>ACHAT, 2=>VENDRE):</label>
                <input type="number" id="deal" name="deal" required min="1" max="2">
                
                <label for="quantity">Quantité (Ounces):</label>
                <input type="number" id="quantity" name="quantity" step="any" required>

                <label for="remarks">Commentaire :</label>
                <input type="text" id="remarks" name="remarks" readonly="readonly" placeholder="OPE SPOT MYSAAMP"></input>


                <button type="submit">Demander un prix</button>

            </form>
            <div class="button-container">
                    <a href="../index.php" class="button">Retour à l'accueil</a>
            </div>
        </div>
        <script>
            document.getElementById("remarks").setAttribute("readonly", "readonly");
        </script>
    </body>
</html>
