<?php

require_once 'ADMIN/conexao.php'; 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    
    $endereco = $_POST['endereco']; 
   
    $senha = $_POST['senha'];
    $confSenha = $_POST['confSenha'];
    
    if ($senha !== $confSenha) {
        die("As senhas não coincidem. Tente novamente.");
    }

    $senha_hash = password_hash($senha, PASSWORD_DEFAULT);

    $sql = "INSERT INTO clientes (nome, email, telefone, endereco, senha) 
            VALUES (?, ?, ?, ?, ?)"; 
    
   
    try {
        $stmt = $pdo->prepare($sql);
        
    
        $stmt->execute([
            $nome, 
            $email, 
            $telefone, 
            $endereco, 
            $senha_hash 
        ]);
        
       
        echo "Cadastro completo realizado com sucesso! 🎉 Você será redirecionado.";
        header("Refresh: 3; url=../index.html");
        exit;
        
    } catch (PDOException $e) {
        
        if ($e->getCode() == '23000') {
            echo "Erro: Alguma informação exclusiva (como Usuário ou Email) já está cadastrada.";
        } else {
            echo "Erro ao inserir dados: " . $e->getMessage();
        }
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
        <h1>CADASTRO DE CLIENTE</h1>
        <form action="cadastroCliente.php" method="POST">
            <label>Nome Completo:</label>
            <input type="text" name="nome" required>
            <label>Email:</label>
            <input type="text" name="email" required>
            <label>Telefone:</label>
            <input type="text" name="telefone" required>    
            <label>Endereço:</label>
            <input type="text" name="endereco" required>              
            <label>Senha:</label>
            <input type="password" name="senha" id="cadastroSenha" required>
            <label>Confirme a Senha:</label>
            <input type="password" name="confSenha" id="cadastroConfSenha" required> 
            
            <input type="submit" name="cadSubmit" value="Cadastrar">

        </form>

</html>