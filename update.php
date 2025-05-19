<?php
include_once("conexao.php");

$q = $pdo->prepare("SELECT * FROM categoria");
$q->execute();
$categorias = $q->fetchAll(PDO::FETCH_ASSOC);

$id = $_GET['id'] ?? null;

if(!$id){
    echo "ID do produto não informado";
    exit();
}

$id = $_GET["id"];
$q = $pdo->prepare("SELECT * FROM produto WHERE id = :id");
$q->bindValue(":id", $id);
$q->execute();
$produto = $q->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nome = $_POST["nome"];
    $quantidade = $_POST["quantidade"];
    $valor = $_POST["valor"];
    $categoria_id = $_POST["categoria_id"];

    $stmt = $pdo->prepare("UPDATE produto SET nome=:nome, quantidade=:quantidade, valor=:valor,  categoria_id=:categoria_id WHERE id=:id");
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":quantidade", $quantidade);
    $stmt->bindValue(":valor", $valor);
    $stmt->bindValue(":categoria_id", $categoria_id);
    $stmt->bindValue(":id", $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="update.css">
    <title>Atualizar Produto</title>
</head>
<body>
    <h1>Atualizar Produto</h1>
    <form action="update.php?id=<?= $id?>" method="POST">
        <label for="">Nome:</label>
        <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

        <label for="">Quantidade:</label>
        <input type="text" name="quantidade" value="<?= htmlspecialchars($produto['quantidade']) ?>" required>

        <label for="">Valor:</label>
        <input type="number" name="valor" step="0.01" value="<?= htmlspecialchars($produto['valor']) ?>" required>

        <label for="">Categoria:</label>
        <select name="categoria_id">
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"
                    <?= $categoria['id'] == $produto['categoria_id'] ? 'selected' : "" ?>>
                    <?= htmlspecialchars($categoria['nome']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Atualizar</button>
    </form>

    <a href="index.php">Voltar</a>
</body>
</html>