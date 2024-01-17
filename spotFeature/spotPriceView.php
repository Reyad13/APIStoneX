<?php include_once "../includes/spotPriceAPI.php"; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Valider l'opération</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }

            .container {
                max-width: 600px;
                margin: 50px auto;
                background-color: #fff;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                text-align: center;
            }

            h2 {
                color: #333;
            }

            p {
                color: #666;
            }

            button {
                background-color: #4caf50;
                color: #fff;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
            }

            button:hover {
                background-color: #45a049;
            }

            .progress-bar-container {
                margin-top: 20px;
                position: relative;
                width: 100%;
                height: 20px;
                background-color: #ddd;
                border-radius: 5px;
                overflow: hidden;
            }

            .progress-bar {
                height: 100%;
                width: 0;
                background-color: #4caf50;
                border-radius: 5px;
                transition: width 1s linear;
            }
        </style>

        <script>
            var pair = <?= json_encode($pair) ?>;
            var deal = <?= json_encode($deal) ?>;
            var quantity = <?= json_encode($quantity) ?>;
            var remarks = <?= json_encode($remarks) ?>;
            var tauxASK  = <?= json_encode($ask) ?>;
            var tauxBID = <?= json_encode($bid) ?>;

            function redirectToSubmitSpotOperation() {
                window.location.href = "spotAPI.php?pair=" + pair + "&deal=" + deal + "&quantity=" + quantity + "&remarks=" + remarks + "&tauxASK=" + tauxASK + "&tauxBID=" + tauxBID;
            }

            function redirectToSpotOperation() {
                window.location.href = "spotForm.php";
            }

            var duree = 5;
            var timePassed = 0;

            function updateProgressBar() {
                var progressBar = document.getElementById('progress-bar');
                timePassed += 1;
                var progressCourcent = (timePassed / duree) * 100;
                progressBar.style.width = progressCourcent + '%';

                if (timePassed >= duree) {
                    clearInterval(progressInterval);
                    redirectToSpotOperation();
                }
            }
            var progressInterval = setInterval(updateProgressBar, 1000);
        </script>
    </head>
    <body>

        <div class="container">
            <h2>Valider l'opération</h2>
            <p>Pour une quantité de : <?= htmlspecialchars($quantity) ?> ONCE</p>
            <?php
                if ($deal == 1) {
                    echo '<p>Taux : ' . htmlspecialchars($ask) . '</p>';
                    $prix = $quantity * $ask;
                    echo "<p>Prix d'achat : " . htmlspecialchars($prix) . " €</p>";
                } else {
                    echo '<p>Taux : ' . htmlspecialchars($bid) . '</p>';
                    $prix = $quantity * $bid;
                    echo "<p> Prix de vente : " . htmlspecialchars($prix) . " €</p>";
                }
            ?>
            <p>Vous avez 5 secondes pour valider l'opération...</p>
            <div class="progress-bar-container">
                <div id="progress-bar" class="progress-bar"></div>
            </div>
            <br><br>
            <button onclick="redirectToSubmitSpotOperation()">Valider l'opération</button>
        </div>
    </body>
</html>
