<?php



try{

    $pdo = new PDO('sqlite:admin/pizzaone.sqlite3');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro){
   
    echo $erro->getMessage();
    exit;
}


$comando1 = "CREATE TABLE IF NOT EXISTS clientes (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nome TEXT,
    telefone TEXT,
    endereco TEXT,
    email TEXT,
    senha TEXT
)";
$pdo->exec($comando1);


$comando2 = "CREATE TABLE IF NOT EXISTS produtos (
    id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    nome TEXT,
    descricao TEXT,
    tipo TEXT,
    imagem TEXT,
    preco REAL,
    ativo TINYINT(1) NOT NULL DEFAULT 1
)";
$pdo->exec($comando2);

?>