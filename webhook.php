<?php
header("Content-Type: application/json");

$arquivo = 'total.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, json_encode(["recebido" => 0]));
}

$dadosAtuais = json_decode(file_get_contents($arquivo), true);
$entrada = json_decode(file_get_contents("php://input"), true);

if (isset($entrada["valor"])) {
    $valorRecebido = floatval($entrada["valor"]);
    $dadosAtuais["recebido"] += $valorRecebido;

    file_put_contents($arquivo, json_encode($dadosAtuais, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

    echo json_encode(["status" => "sucesso", "novo_total" => $dadosAtuais["recebido"]]);
} else {
    http_response_code(400);
    echo json_encode(["erro" => "valor ausente ou inválido"]);
}