<?php
include_once("conexao.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $categoria_id = $_POST["categoria_id"];

    $stmt = $pdo->prepare("INSERT INTO produto (nome, quantidade, valor, categoria_id) VALUES (:nome, :quantidade, :valor, :categoria_id)");
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":quantidade", $quantidade);
    $stmt->bindValue(":valor", $valor);
    $stmt->bindValue(":categoria_id", $categoria_id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

$q = $pdo->query("SELECT * FROM categoria");
$categorias = $q->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <title>Adicionar Produto</title>
</head>
<body>
    <h1>Adicionar Produto</h1>
    <form action="create.php" method="POST">
        <label for="">Nome:</label>
        <input type="text" name="nome" required>

        <label for="">Quantidade:</label>
        <input type="text" name="quantidade" required>

        <label for="">Valor:</label>
        <input type="number" name="valor" step="0.01" required>

        <label for="">Categoria:</label>
        <select name="categoria_id">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= $categoria['nome'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Salvar</button>
    </form>

    <a href="index.php">Voltar</a>
</body>
</html>