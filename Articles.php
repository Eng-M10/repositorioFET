<?php
require_once 'core/init.php';

// ... (código existente)

// Função para obter os artigos do Medium
function getMediumArticles($username, $count = 6) {
    $token = 'SEU_ACCESS_TOKEN'; // Substitua pelo seu access token
    $url = "https://api.medium.com/v1/users/$username/posts?limit=$count";

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $token,
        'Content-Type: application/json',
    ));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Obtém os artigos do Medium para o usuário 'seu_username'
$mediumArticles = getMediumArticles('seu_username');

?>
