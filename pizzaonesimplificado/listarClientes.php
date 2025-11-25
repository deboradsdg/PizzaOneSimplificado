<?php
    
    require_once "ADMIN/conexao.php";

   
    $sql ="SELECT * FROM clientes";
    
    $comando = $pdo->prepare($sql);
    
    $comando->execute();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/painel.css">
    <title>Ajustar Preços e Status</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; color: #141414 }
        th, td { border: 1px solid  #141414; padding: 10px; text-align: left; }
        input[type="number"], select { width: 100px; padding: 5px; }
        .submit-cell button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <h1>Listagem de clientes</h1>
        <a href="painel.php">Voltar ao Painel</a>
    </header>
    <main>
    <body>
        
        <table border="1">
        <tr>
            <th> Nome</th> <th> Endereço</th> <th> Telefone</th><th> Email</th><th>Senha</th>
        </tr>
        <?php
            while ($cliente = $comando->fetch()){
            ?>
            <tr>
                <td><?= $cliente['nome'] ?></td>
                <td><?= $cliente['endereco'] ?></td>
                <td><?= $cliente['telefone'] ?></td>
                <td><?= $cliente['email'] ?></td>
                <td><?= $cliente['senha'] ?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </body>
</html>