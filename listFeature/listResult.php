<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Votre opération</title>
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <header>
        <div class="user-info">
            <img src="../../img/logo.png" alt="Logo de l'entreprise" class="logo">
            <div class="user-details">
                <div class="user-name">StoneX</div>
            </div>
        </div>
        <div class="navbar">
            <div class="logout-button">
                <a href="../loginLogout/logout.php" class="navbar-button">
                    Déconnexion
                </a>
            </div>
        </div>
    </header>
        <div class="container">
            <h2>Votre opération</h2>

            <?php
            // Récupère les données de la réponse JSON
            $response_data = json_decode(urldecode($_GET['response']), true);
            $clOrdID = $_GET['clOrdID'];
            

            // Affiche le ClOrdID
            echo '<p>ClOrdID: ' . $clOrdID . '</p>';

            // Vérifie si la réponse de l'API est valide
            if (isset($response_data['result'])) {
                // Affiche les détails de l'opération
                $result = $response_data['result'];
                echo '<p>ID de la transaction: ' . $result['EXID'] . '</p>';
                echo '<p>Status : ' . $result['Status'] . ' Ounces</p>';
                echo '<p>FillPrice : ' . $result['FillPrice'] . '</p>';
            } else {
                // Affiche un message d'erreur si la réponse n'est pas valide
                echo '<p>Erreur dans la réponse de l\'API</p>';
            }
            ?>

            <!-- Bouton pour retourner à index.php -->
            <a href="../index.php" class="button">Retour à l'accueil</a>
        </div>
    </body>
</html>
