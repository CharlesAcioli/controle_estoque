<?php
$host = "localhost";
$user = "professor";
$pass = "professor123";
$db = "estoque_construcao";

$pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);

$pdo->exec("CREATE TABLE IF NOT EXISTS
        categoria (id INT PRIMARY KEY
        AUTO_INCREMENT, nome VARCHAR(100)
);");

$pdo->exec("CREATE TABLE IF NOT EXISTS produto (
        id INT PRIMARY KEY AUTO_INCREMENT,
        nome VARCHAR(100) NOT NULL,
        quantidade INT NOT NULL,
        valor INT NOT NULL,
        categoria_id INT NOT NULL,
        FOREIGN KEY (categoria_id) REFERENCES categoria(id)
);");


//Função para adicionar categorias:------v
// $categorias = ["Ferramentas", "Máquinas", "Equipamentos"];
// $stmt = $pdo->prepare("INSERT INTO categoria (nome) VALUES (:nome)");

// foreach ($categorias as $categoria){
//     $stmt->bindValue(":nome", $categoria);
//     $stmt->execute();
// }

//Função para deletar categorias a partir do ID:-----v
// $stmt = $pdo->prepare("DELETE FROM categoria WHERE id > :id");
// $stmt->execute(['id' => 0]);