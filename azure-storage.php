<?php
require 'vendor/autoload.php';

use MicrosoftAzure\Storage\Blob\BlobRestProxy;

// Lê variáveis de ambiente definidas no ambiente da App
$accountName = getenv('joaoalves30394');
$accountKey  = getenv('J1ON1LVKngZQ1OS9JY3wnSL6wFexQYFJUNQRKuXa3ZXNNEbTu8n6bzl1SurOZRWrt9TjXg0E4POK+ASt0CRitg==');

if (!$accountName || !$accountKey) {
    die("Erro: variáveis de ambiente AZURE_STORAGE_ACCOUNT ou AZURE_STORAGE_KEY não definidas.");
}

$connectionString = "DefaultEndpointsProtocol=https;AccountName={$accountName};AccountKey={$accountKey};EndpointSuffix=core.windows.net";

$blobClient = BlobRestProxy::createBlobService($connectionString);
$containerName = "imagens";
?>