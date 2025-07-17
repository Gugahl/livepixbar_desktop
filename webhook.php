<?php
// Arquivo que armazena o total arrecadado
$arquivo = 'total.json';

// Lê o JSON atual ou cria se não existir
$total = file_exists($arquivo) ? json_decode(file_get_contents($arquivo), true) : ["recebido" => 0];

// Recebe os dados enviados pelo LivePix
$entrada = json_decode(file_get_contents("php://input"), true);

// Verifica se tem valor
if (isset($entrada["valor"])) {
    $valor = floatval($entrada["valor"]);
    $total["recebido"] += $valor;
    file_put_contents($arquivo, json_encode($total));
    http_response_code(200);
    echo "OK";
} else {
    http_response_code(400);
    echo "Dados inválidos";
}