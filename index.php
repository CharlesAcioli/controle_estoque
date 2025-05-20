<?php
include_once("conexao.php");

$ordem = isset($_GET['ordem']) && strtoupper($_GET['ordem']) === 'DESC' ? 'DESC' : 'ASC';

$nova_ordem = $ordem === 'ASC' ? 'DESC' : 'ASC';

$q = $pdo->query("SELECT produto.*, categoria.nome AS categoria_nome
                FROM produto
                JOIN categoria ON produto.categoria_id = categoria.id
                ORDER BY produto.id $ordem");

$produtos = $q->fetchALL(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <h1>Lista de produtos</h1>
    <a href="create.php">Adicionar Produto</a>
    <table border="1">
        <tr>
            <!-- Para adiconar setas: Segurar Alt e digite 15☼/ 16►/ 17◄/ 18↕/ 19‼/ 22▬/ 23↨/ 24↑/ 25↓/ 26→/ 27←/ -->
            <th><a href="?ordem=<?= $nova_ordem ?>">ID<?= $ordem === 'ASC' ? '↑' : '↓'?></a></th>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Valor</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($produtos as $produto) : ?>
        <tr>
            <td><?= $produto['id'] ?></td>
            <td><?= $produto['nome'] ?></td>
            <td><?= $produto['quantidade'] ?></td>
            <td>R$<?= number_format($produto['valor'], 2, ',', '.') ?></td>
            <td><?= $produto['categoria_nome'] ?></td>
            <td>
                <a href="update.php?id=<?= $produto['id'] ?>">Editar</a>
                <a href="delete.php?id=<?= $produto['id'] ?>" onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>