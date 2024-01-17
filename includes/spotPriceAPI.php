<?php

    $pair = $_POST['pair'];
    $deal = isset($_POST['deal']) ? $_POST['deal'] : null;
    if ($deal == 1){
        $deal = 1;
    } else {
        $deal = 2;
    }
    $quantity = isset($_POST['quantity']) ? $_POST['quantity'] : null;
    if (isset($quantity) && $quantity !== "") {
        // Convertir la chaîne en entier
        $quantity = intval($quantity);
    }
    $remarks = $_POST['remarks'];

    // Construit les en-têtes de la requête
    $headers = array(
        'Content-Type: application/json',
        'TokenID: eyJhbGciOiJIUzUxMiJ9.eyJFbnRpdHkiOiJTUE0iLCJpc3MiOiJPcm9zb2Z0IFNvbHV0aW9ucyBQdnQuIEx0ZC4iLCJDbGllbnRJZCI6IlMwMTQiLCJlbnYiOiJkZW1vIiwiZXhwIjoxNzM1Njg5NTk5fQ.agokh8jQVL6JKLI2otJVn-nrn85OR2U2toDR-t_7pT2EMEYt8va_1MxcjIja43XhH21Say5RRjVuZrdJUUtNUA'
    );

    // Initialise une session cURL
    $ch = curl_init("https://pmxconnect.demo.stonex.com/v1_3/GetSpotRates/SPC/$pair");

    // Configure les options de la requête cURL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Exécute la requête cURL et récupère la réponse
    $response = curl_exec($ch);

    // Vérifie s'il y a des erreurs
    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        // Ferme la session cURL
        curl_close($ch);        
    }
    $data = json_decode($response, true);
    if ($data !== null) {
        $pair = $data['result'][0]['Pair'];
        $ask = $data['result'][0]['Ask'];
        $bid = $data['result'][0]['Bid'];
    } else {
        echo "Erreur lors de la conversion JSON\n";
    }

?>
