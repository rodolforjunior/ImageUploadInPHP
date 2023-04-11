<?php

class ProcessaArquivo
{
    public function __construct($arq)
    {
        $this->validaFile($arq);
    }


    public function validaFile($arq)
    { 
        try {
            $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/jpeg']; //MimeTypes é um array que vai conter os possíveis tipos aceitos pelo programa.  
            
            if ($arq['size'] > 4194304) { //É maior que 4MB? Se sim, atira exceção.
                http_response_code(403);
                throw new Exception("O arquivo submetido é maior do que 4MB.", 403);
            }

            if (!in_array($arq['type'], $mime_types)) { //O método in_array vai validar se ao menos um dos tipos presentes no array mime_types corresponde ao que o usuário está tentando enviar para o server.
                http_response_code(403);
                throw new Exception("O arquivo submetido não é uma imagem.", 403);
            } else {
                http_response_code(201);
                throw new Exception("Arquivo enviado!", 201);
            } 
        } catch (\Exception $e) {
            echo json_encode([
                "Mensagem"  => $e->getMessage(),
                "Status" => $e->getCode()
            ]);
        }
    }
}
