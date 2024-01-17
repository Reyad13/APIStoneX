<?php

    $request_data = json_encode(array(
        "ClOrdId" => (string)$clOrdID
    ));

    // Construit les en-têtes de la requête
    $headers = array(
        'Content-Type: application/json',
        'TokenID: eyJhbGciOiJIUzUxMiJ9.eyJFbnRpdHkiOiJTUE0iLCJpc3MiOiJPcm9zb2Z0IFNvbHV0aW9ucyBQdnQuIEx0ZC4iLCJDbGllbnRJZCI6IlMwMTQiLCJlbnYiOiJkZW1vIiwiZXhwIjoxNzM1Njg5NTk5fQ.agokh8jQVL6JKLI2otJVn-nrn85OR2U2toDR-t_7pT2EMEYt8va_1MxcjIja43XhH21Say5RRjVuZrdJUUtNUA'
    );

    // Initialise une session cURL
    $ch = curl_init('https://pmxconnect.demo.stonex.com/v1_3/GetRequestStatus');
    

    // Configure les options de la requête cURL
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Exécute la requête cURL et récupère la réponse
    $response = curl_exec($ch);

    // Vérifie s'il y a des erreurs
    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        // Affiche la réponse de l'API
        //echo "Réponse de l'API : " . $response;exit;
        // Ferme la session cURL
        curl_close($ch);

        // Redirige vers la page d'affichage
        header('Location: listResult.php?clOrdID=' . $clOrdID . '&response=' . urlencode($response));
        exit();
    }

?>
