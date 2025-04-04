<?php
// Carrega variáveis de ambiente do arquivo .env
$envPath = __DIR__ . '/.env';
if (file_exists($envPath)) {
    $envVars = parse_ini_file($envPath, false, INI_SCANNER_RAW);
    foreach ($envVars as $key => $value) {
        putenv("$key=$value");
    }
}

// Uso das variáveis de ambiente
$host = getenv('DB_HOST');
$port = getenv('DB_PORT');
$db_name = getenv('DB_NAME');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');

try {
    $conexao = new mysqli($host, $db_user, $db_pass, $db_name);
    if ($conexao->connect_error) {
        throw new Exception('Erro ao conectar: ' . $conexao->connect_error);
    }
} catch (Exception $e) {
    echo 'Erro ao conectar: ' . $e->getMessage();
    exit;
}

?>