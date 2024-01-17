<?php
include_once('../db_connect/db_connection.php');

    $query = "SELECT MAX(ClOrdID) AS lastClOrdID FROM spotope";
    $result = $con->query($query);

    if ($result) {
        $row = $result->fetch_assoc();
        $lastClOrdID = $row['lastClOrdID'];
    } else {
        die("Erreur MySQL : " . $con->error);
    }
    if ($lastClOrdID == '')
    {
        $lastClOrdID = 120000;
    }
    $clOrdID = ++$lastClOrdID;
    //echo "xx $lastClOrdID et $clOrdID";
    $con->close();

    $pair = isset($_GET['pair']) ? $_GET['pair'] : null;
    $deal = isset($_GET['deal']) ? $_GET['deal'] : null;
    if ($deal == 1){
        $deal = 1;
    } else {
        $deal = 2;
    }
    $quantity = isset($_GET['quantity']) ? $_GET['quantity'] : null;
    if (isset($quantity) && $quantity !== "") {
        $quantity = intval($quantity);
    }
    $remarks = isset($_GET['remarks']) ? $_GET['remarks'] : null;
    $tauxASK = isset($_GET['tauxASK']) ? $_GET['tauxASK'] : null;
    $tauxBID = isset($_GET['tauxBID']) ? $_GET['tauxBID'] : null;

    $request_data = json_encode(array(
        "ClOrdId" => (string)$clOrdID,
        "Pair" => $pair,
        "Deal" => $deal,
        "Quantity" => $quantity,
        "Remarks" => $remarks
    ));

    $headers = array(
        'Content-Type: application/json',
        'TokenID: eyJhbGciOiJIUzUxMiJ9.eyJFbnRpdHkiOiJTUE0iLCJpc3MiOiJPcm9zb2Z0IFNvbHV0aW9ucyBQdnQuIEx0ZC4iLCJDbGllbnRJZCI6IlMwMTQiLCJlbnYiOiJkZW1vIiwiZXhwIjoxNzM1Njg5NTk5fQ.agokh8jQVL6JKLI2otJVn-nrn85OR2U2toDR-t_7pT2EMEYt8va_1MxcjIja43XhH21Say5RRjVuZrdJUUtNUA'
    );

    $ch = curl_init('https://pmxconnect.demo.stonex.com/v1_3/Trade');

    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Erreur cURL : ' . curl_error($ch);
    } else {
        // Affiche la réponse de l'API
        //echo "Réponse de l'API : " . $response;exit;
        curl_close($ch);

        header('Location: spotResult.php?pair=' . $pair . '&deal=' . $deal . '&clOrdID=' . $clOrdID .  '&tauxASK=' . $tauxASK .  '&tauxBID=' . $tauxBID . '&response=' . urlencode($response));
        exit();
    }

?>
