<?php

require_once 'ADMIN/conexao.php'; 

if (isset($_POST['submit'])) {

    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem_url = $_POST['imagem_url'];
    $tipo = $_POST['tipo']; 


    $sql = "INSERT INTO produtos (nome, descricao, tipo, preco, imagem) VALUES (?, ?, ?, ?, ?)"; 
    
    try {
        $stmt = $pdo->prepare($sql);
       
        $stmt->execute([$nome, $descricao, $tipo, $preco, $imagem_url]); 
        echo "Produto **$nome** cadastrado com sucesso!";
    } catch (PDOException $e) {
        
        echo "Erro ao cadastrar produto: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/cadastros.css">
    <link rel="shortcut icon" href="MIDIAS/IMAGENS/PRINCIPAL.png" type="image"> 
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA ONE</title>
</head>
<body>
    <header>
        <a href="painel.php">Voltar ao Painel</a>
    </header>
    <main>
         <h1>Cadastro de Novo Produto</h1> 
         <form action="cadastroProdutos.php" method="POST">
        <label>Nome do Produto:</label>
        <input type="text" name="nome" required>
        <label>Descrição:</label>
        <textarea name="descricao" required></textarea>
        <label>Tipo:</label>
        <input type="text" name="tipo" required placeholder="Ex: Pizza, Pizza Doce, Bebida">
        <label>Preço:</label>
        <input type="number" name="preco" step="0.01" required>
        <label>URL da Imagem:</label>
            <input type="text" name="imagem_url" required placeholder="MIDIAS/IMAGENS/nome.png">
            <input id="but" type="submit" name="submit" value="Cadastrar Produto">
</form>
</html>