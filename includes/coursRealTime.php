<?php
    // Construit les en-têtes de la requête
    $headers = array(
        'Content-Type: application/json',
        'Accept: application/json',
        'TokenID: eyJhbGciOiJIUzUxMiJ9.eyJFbnRpdHkiOiJTUE0iLCJpc3MiOiJPcm9zb2Z0IFNvbHV0aW9ucyBQdnQuIEx0ZC4iLCJDbGllbnRJZCI6IlMwMTQiLCJlbnYiOiJkZW1vIiwiZXhwIjoxNzM1Njg5NTk5fQ.agokh8jQVL6JKLI2otJVn-nrn85OR2U2toDR-t_7pT2EMEYt8va_1MxcjIja43XhH21Say5RRjVuZrdJUUtNUA'
    );

    // Initialise une session cURL
    $ch = curl_init("https://pmxconnect.demo.stonex.com/v1_3/GetSpotRates/ALL");

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
    //echo "xx : $response ";
    if ($data !== null && isset($data['result'])) {
        $pairesDesirees = array('XAGEUR', 'XAUEUR', 'XAUUSD', 'XAGUSD');
        // filtrage des paires
        $donneesFiltrees = array_filter($data['result'], function($result) use ($pairesDesirees) {
            return in_array($result['Pair'], $pairesDesirees);
        });

?>
        <div class="container">
            <h2>Cours en temps réel</h2>
            <div id="realTimeData">
                <table class="real-time-table" id="realTimeTable">
                    <thead>
                        <tr>
                            <th>Paire</th>
                            <th>Achat</th>
                            <th>Vente</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($donneesFiltrees as $result) {
                            echo '<tr>
                                    <td>' . htmlspecialchars($result['Pair']) . '</td>
                                    <td>' . htmlspecialchars($result['Ask']) . '</td>
                                    <td>' . htmlspecialchars($result['Bid']) . '</td>
                                </tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </div>
<script>
    setInterval(function() {
        location.reload();
    }, 2000); 
</script>
<?php
} else {
    echo "Erreur API : ".$data['error_msg']. "\n";
}
?>