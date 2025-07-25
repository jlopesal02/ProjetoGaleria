<?php
include('azure-storage.php');

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];
    if ($file['error'] === UPLOAD_ERR_OK) {
        $content = fopen($file['tmp_name'], "r");
        $blobClient->createBlockBlob($containerName, $file['name'], $content);
        $mensagem = "Imagem enviada com sucesso!";
    } else {
        $mensagem = "Erro ao enviar a imagem.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Upload - Galeria</title>
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
    </style>
</head>
<body>

<div class="header text-center">
    <h2>Upload de Imagem</h2>
    <p>João Alves - 30394 | Computação em Cloud Pública | ISTEC</p>
</div>

<div class="container mt-5">
    <?php if ($mensagem): ?>
        <div class="alert alert-info"><?= $mensagem ?></div>
        <a href="index.php" class="btn btn-outline-success">Voltar à Galeria</a>
    <?php else: ?>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="image" class="form-label">Escolher imagem</label>
                <input class="form-control" type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit" class="btn btn-success">Enviar</button>
            <a href="index.php" class="btn btn-outline-secondary ms-2">Cancelar</a>
        </form>
    <?php endif; ?>
</div>

</body>
</html>