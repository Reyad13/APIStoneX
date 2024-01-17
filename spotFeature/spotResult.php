<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif de l'Opération</title>
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
        <h2>Récapitulatif de l'Opération</h2>

        <?php
        $response_data = json_decode(urldecode($_GET['response']), true);
        $pair = $_GET['pair'];
        $deal = $_GET['deal'];
        if($deal == 1) {
            $taux = $_GET['tauxASK'];
        } else {
            $taux = $_GET['tauxBID'];
        }
        $clOrdID = $_GET['clOrdID'];


        echo '<p>ClOrdID: ' . $clOrdID . '</p>';

        // Vérifie si la réponse de l'API est valide
        if (isset($response_data['result'])) {
            $result = $response_data['result'];
            echo '<p>ID de la transaction: ' . $result['EXID'] . '</p>';
            echo '<p>Paire de devises: ' . $pair. '</p>';
            if ($deal == 1) { 
                $deal = "ACHAT";
            } else {
                $deal = "VENDRE";
            }
            echo '<p>Type de transaction: ' . $deal . '</p>';
            echo '<p>Quantité: ' . $result['Quantity'] . ' Ounces</p>';
            echo '<p>Taux: ' . $result['Rate'] . '</p>';
            $taux_final = $result['Rate'];
            $coutTotal = $result['Quantity'] * $result['Rate'];
            echo '<p>Coût total : ' . $coutTotal . ' €</p>';
        } else {
            echo '<p>Erreur dans la réponse de l\'API</p>';
        }
        ?>
        <a href="../index.php" class="button">Retour à l'accueil</a>

        <a href="../listFeature/listForm.php" class="button">Voir mes opérations</a>
    </div>
</body>
</html>
