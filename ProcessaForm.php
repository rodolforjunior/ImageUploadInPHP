<?php
include 'ProcessaArquivo.php';

try {
    if ($_SERVER["REQUEST_METHOD"] !== "POST") {
        http_response_code(403);
        throw new Exception("Requisição Inválida.", 403);
    } else {
        $arquivo = $_FILES['image'];     
        $checkFileType = new ProcessaArquivo($arquivo);

    }
} catch (Exception $e)  {
    echo json_encode([
        "Mensagem" => $e->getMessage(),
        "Status" => $e->getCode(),
    ]);
}
 