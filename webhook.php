<?php
header("Content-Type: application/json");

// Lê os dados do webhook
$dados = file_get_contents("php://input");
$json = json_decode($dados, true);

if (isset($json['pix'])) {
    foreach ($json['pix'] as $pagamento) {
        $txid = $pagamento['txid'];
        $valor = $pagamento['valor'];
        $horario = $pagamento['horario'];

        // Salvar o pagamento recebido
        file_put_contents("pagamentos.txt", "Pagamento recebido: TXID: $txid, Valor: R$ $valor, Horário: $horario\n", FILE_APPEND);
    }

    echo json_encode(["status" => "ok"]);
    exit;
}

echo json_encode(["error" => "Nenhum pagamento recebido"]);
exit;
?>