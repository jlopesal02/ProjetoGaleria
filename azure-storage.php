<?php
require 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;

// Lê variáveis de ambiente definidas no ambiente da App
$accountName = getenv('AZURE_STORAGE_ACCOUNT');
$accountKey  = getenv('AZURE_STORAGE_KEY');

if (!$accountName || !$accountKey) {
    die("Erro: variáveis de ambiente AZURE_STORAGE_ACCOUNT ou AZURE_STORAGE_KEY não definidas.");
}

$connectionString = "DefaultEndpointsProtocol=https;AccountName={$accountName};AccountKey={$accountKey};EndpointSuffix=core.windows.net";

$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = "imagens";
?>