<?php

final class File
{
    const TARGET_DIR    = 'files/upload';
    const MAX_FILE_SIZE = 5000000;

    private static $path;
    private static $size;
    private static $extension;
    
    /**
     * @param array $fileData
     * 
     * @return string
     */
    public static function upload(array $fileData): array
    {
        $tempName   = $fileData['tmp_name'];
        self::$size = $fileData['size'];

        $nome = basename($fileData['name']);
        self::$path = self::TARGET_DIR.'/'.basename($nome);

        self::$extension = strtolower(pathinfo(self::$path, PATHINFO_EXTENSION));

        $check = self::checkFileConstraints(); 
        if(!$check['success']) return $check;

        if(move_uploaded_file($tempName, self::$path))
            return [
                'success' => true,
                'message' => 'Arquivo enviado com sucesso.',
                'file_name' => $nome,
                'file_size' => self::$size
            ];
        else 
            return ['success' => false, 'message' => 'Falha ao enviar o arquivo.'];

    }

    /**
     * @param array $info
     * 
     * @return array
     */
    private static function checkFileConstraints(): array
    {
        if(!self::$size) 
            return ['success' => false, 'message' => 'Formato de arquivo inv&aacute;lido.'];
        
        if(file_exists(self::$path)) 
            return ['success' => false, 'message' => 'O arquivo j&aacute; foi enviado.'];
        
        if(self::$size > self::MAX_FILE_SIZE) 
            return ['success' => false, 'message' => 'O limite para o tamanho do arquivo &eacute; de 5 MB.'];
        
        if (self::$extension != "pdf")
            return ['success' => false, 'message' => 'Por favor, envie uma arquivo no formato PDF.'];
        
        return ['success' => true];    
    }
}