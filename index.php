<?php
include('azure-storage.php');

$perPage = 16;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

try {
    $result = $blobClient->listBlobs($containerName);
    $blobs = $result->getBlobs();
    $total = count($blobs);
    $blobs = array_slice($blobs, ($page - 1) * $perPage, $perPage);
} catch (Exception $e) {
    die("Erro ao aceder ao Azure Blob Storage: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Galeria Cloud - João Alves</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8fff8;
        }
        .header {
            background-color: #198754;
            color: white;
            padding: 1rem;
        }
        .gallery img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 0.5rem;
        }
        .footer {
            font-size: 0.9rem;
            color: #555;
            text-align: center;
            margin-top: 2rem;
            padding: 1rem;
        }
    </style>
</head>
<body>

<div class="header text-center">
    <h2>Projeto Final — Galeria de Imagens</h2>
    <p>João Alves - 30394 | Computação em Cloud Pública | ISTEC</p>
</div>

<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <a href="upload.php" class="btn btn-success">📤 Enviar Imagem</a>
    </div>

    <?php if (empty($blobs)): ?>
        <div class="alert alert-secondary">Sem imagens. Carrega uma imagem para começar.</div>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4 g-4 gallery">
            <?php foreach ($blobs as $blob): ?>
                <div class="col">
                    <img src="<?= $blob->getUrl() ?>" alt="Imagem">
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="mt-4 d-flex justify-content-center">
        <?php
        $pages = ceil($total / $perPage);
        if ($page > 1) echo "<a class='btn btn-outline-success me-2' href='?page=" . ($page - 1) . "'>← Anterior</a>";
        if ($page < $pages) echo "<a class='btn btn-outline-success' href='?page=" . ($page + 1) . "'>Próxima →</a>";
        ?>
    </div>
</div>

<div class="footer">
    &copy; <?= date('Y') ?> João Alves - Projeto Final ISTEC
</div>

</body>
</html>