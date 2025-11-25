<?php

require_once 'ADMIN/conexao.php'; 

$mensagem = "";

if (isset($_POST['submit_update'])) {
    $id_produto = $_POST['id_produto'];
    $novo_preco = $_POST['preco'];
    $novo_tipo = $_POST['tipo'];
    $novo_ativo = isset($_POST['ativo']) ? 1 : 0;
 ; 


    $sql_update = "UPDATE produtos SET preco = ?, tipo = ?, ativo = ? WHERE id = ?";
        
    try {
        $stmt_update = $pdo->prepare($sql_update);
        $stmt_update->execute([$novo_preco, $novo_tipo, $novo_ativo, $id_produto]);

        $mensagem = "Produto ID #$id_produto atualizado com sucesso!";
    } catch (PDOException $e) {
        $mensagem = "Erro ao atualizar produto: " . $e->getMessage();
    }
}

$sql_produtos = "SELECT id, nome, preco, tipo, ativo FROM produtos ORDER BY tipo, nome ASC";

try {
    $stmt_produtos = $pdo->query($sql_produtos);
    $produtos = $stmt_produtos->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao carregar lista de produtos: " . $e->getMessage());
}

$tipo_opcoes = ['Pizza', 'Pizza Doce', 'Sobremesa', 'Bebida'];
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/painel.css">
    <title>Ajustar Preços e Status</title>
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        input[type="number"], select { width: 100px; padding: 5px; }
        .submit-cell button { padding: 5px 10px; cursor: pointer; }
    </style>
</head>
<body>
    <header>
        <h1>Ajuste de Preços e Status de Produtos</h1>
        <a href="painel.php">Voltar ao Painel</a>
    </header>
    <main>
        
        <?php if ($mensagem): ?>
            <p style="color: green; font-weight: bold;"><?php echo $mensagem; ?></p>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Produto</th>
                    <th>Tipo</th>
                    <th>Preço (R$)</th>
                    <th>Ativo?</th>
                    <th>Ação</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($produtos as $produto): ?>
                    <form action="alterarProduto.php" method="POST">
                        <input type="hidden" name="id_produto" value="<?php echo $produto['id']; ?>">
                        <tr>
                            <td><?php echo $produto['id']; ?></td>
                            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
                            
                            <td>
                                <select name="tipo" required>
                                    <?php foreach ($tipo_opcoes as $tipo): ?>
                                        <option value="<?php echo $tipo; ?>" <?php echo ($tipo == $produto['tipo']) ? 'selected' : ''; ?>>
                                            <?php echo $tipo; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </td>
                            
                            <td>
                                <input type="number" name="preco" step="0.01" min="0" value="<?php echo number_format($produto['preco'], 2, '.', ''); ?>" required>
                            </td>
                            
                            <td style="text-align: center;">
                            <input type="checkbox" name="ativo" value="1" 
                            <?php echo ($produto['ativo'] == 1) ? 'checked' : ''; ?>>
                            </td>
                            
                            <td class="submit-cell">
                                <button type="submit" name="submit_update">Salvar</button>
                            </td>
                        </tr>
                    </form>
                <?php endforeach; ?>
            </tbody>
        </table>

    </main>
</body>
</html>