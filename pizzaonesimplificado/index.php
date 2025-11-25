<?php
require_once "admin/conexao.php";

// Ordem de exibição dos tipos
$ordem_tipos = "'Pizza', 'Pizza Doce', 'Bebida'";

// Ordenação compatível com SQLITE usando CASE
$sql = "SELECT id, nome, descricao, preco, imagem, tipo 
        FROM produtos
        WHERE ativo = 1
        ORDER BY 
            CASE tipo
                WHEN 'Pizza' THEN 1
                WHEN 'Pizza Doce' THEN 2
                WHEN 'Bebida' THEN 3
                ELSE 4
            END,
            nome ASC";

$comando = $pdo->prepare($sql);
$comando->execute();
$produtos = $comando->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/Principal.css">
    <link rel="shortcut icon" href="MIDIAS/IMAGENS/PRINCIPAL.png" type="image">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>THE PIZZA ONE</title>
</head>
<body>

<header>
    <div id="LT">
        <img src="MIDIAS/IMAGENS/PRINCIPAL.png" alt="Logo The Pizza One">
    </div>
</header>

<main>
<section>
    <h2 id="PI">PEÇA AGORA!!!</h2>

    <div class="cardapio">
        <?php 
        foreach ($produtos as $produto) {
            echo '<div class="pizza"
                    data-id="' . htmlspecialchars($produto['id']) . '"
                    data-nome="' . htmlspecialchars($produto['nome']) . '"
                    data-preco="' . htmlspecialchars(number_format($produto['preco'], 2, '.', '')) . '">';
                    
                echo '<h3>' . htmlspecialchars($produto['nome']) . '</h3>';
                echo '<img src="' . htmlspecialchars($produto['imagem']) . '" alt="' . htmlspecialchars($produto['nome']) . '">';
                echo '<p>' . htmlspecialchars($produto['descricao']) . '</p>';
                echo '<p class="PR">R$ ' . number_format($produto['preco'], 2, ',', '.') . '</p>';

                echo '<aside>';
                echo '<button class="decr">−</button>';
                echo '<span class="qtd">0</span>';
                echo '<button class="incr">+</button>';
                echo '</aside>';

            echo '</div>';
        }
        ?>
    </div>
</section>
</main>

<section id="popup">
    <h5>🧺 Itens no carrinho:</h5>
    <div id="itens"></div>
    <p id="total">Total: R$0,00</p>
    <button id="fechar">Fechar</button>
    <button id="comprar">Comprar</button>
</section>

<script src="JS/Principal.js"></script>

</body>


    <footer>
        <section id="REC">
            <h4>DESENVOLVIDO POR:</h4>
            <p>Paulo, Débora e Juvenal, Alunos da Fatec de Marilia</p>
        </section>
        <section id="frame">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d923.459924692022!2d-49.9546171860178!3d-22.208197483465927!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94bfd7217b8e873b%3A0xd7de49af9e293d42!2sFatec%20Mar%C3%ADlia%20-%20Faculdade%20de%20Tecnologia%20de%20Mar%C3%ADlia!5e0!3m2!1spt-BR!2sbr!4v1759406870866!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </section>
    </footer>
    
</html>
