<?php
include_once("conexao.php");

$id = $_GET["id"];
$stmt = $pdo->prepare("DELETE FROM produto WHERE id = :id");
$stmt->bindValue(":id", $id);
$stmt->execute();

header("Location: index.php");
exit();