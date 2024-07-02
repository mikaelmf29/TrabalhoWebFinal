<?php
include 'config.php'; 


$feedback = '';

$categoriaFiltro = isset($_GET['categoriaFiltro']) ? $_GET['categoriaFiltro'] : '';


$sqlCategorias = "SELECT * FROM categorias";
$resultadoCategorias = $conexao->query($sqlCategorias);

if ($categoriaFiltro) {
    $sqlProdutos = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON p.categoriaid = c.idcategorias WHERE c.idcategorias = $categoriaFiltro";
} else {
    $sqlProdutos = "SELECT p.*, c.nome AS categoria_nome FROM produtos p JOIN categorias c ON p.categoriaid = c.idcategorias";
}
$resultadoProdutos = $conexao->query($sqlProdutos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lobby - Gerenciamento</title>
    <link rel="stylesheet" href="styles.css">
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            margin-bottom: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 1.5em;
            color: #333;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column; 
            min-height: 100vh;
        }

        .container {
            display: flex;
            justify-content: space-between;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: calc(80% - 20px); 
            max-width: 1200px;
            margin-top: 20px;
        }

        .section {
            width: 48%; 
            max-width: 48%;
            overflow: auto;
            height: 500px; 
        }

        table {
            width: 100%;
            margin-top: 10px;
            border-collapse: collapse;
            text-align: left;
        }

        table th,
        table td {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .buttons {
            margin-top: 20px;
        }

        .buttons a {
            margin-right: 10px;
            text-decoration: none;
        }

        .buttons a:last-child {
            margin-right: 0;
        }

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #45a049;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                width: 100%; 
                max-width: none;
                margin: 10px 0; 
            }

            .section {
                width: 100%;
                max-width: none;
                margin-bottom: 20px; 
                height: auto; 
            }

            table {
                font-size: 0.9em;
            }
        }

      
        .section .buttons {
            margin-top: 20px;
        }

        .section .buttons button {
            margin-top: 20px;
        }
    </style>
</head>
<body>

<header>
    <h1>Bem Vindo ao Lobby</h1>
</header>

<div class="container">
    <div class="section">
        <h2>Categorias Cadastradas</h2>
        <?php
        if ($resultadoCategorias->num_rows > 0) {
            echo '<table>';
            echo '<thead>';
            echo '<tr><th>ID</th><th>Nome</th><th>Descrição</th></tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = $resultadoCategorias->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['idcategorias'] . '</td>';
                echo '<td>' . $row['nome'] . '</td>';
                echo '<td>' . $row['descricao'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo '<p>Não há categorias cadastradas ainda.</p>';
        }
        ?>
        <div class="buttons">
            <a href="registrartabela.php"><button>Cadastrar Categoria</button></a>
            <a href="pesquisa.php"><button>Editar Categoria</button></a>
        </div>
    </div>
    <div class="section">
        <h2>Produtos Cadastrados</h2>
        <form method="get" action="">
            <label for="categoriaFiltro">Filtrar por Categoria:</label>
            <select id="categoriaFiltro" name="categoriaFiltro" onchange="this.form.submit()">
                <option value="">Todas</option>
                <?php
                $resultadoCategorias->data_seek(0); // Resetar ponteiro para reutilizar resultado
                while ($row = $resultadoCategorias->fetch_assoc()) {
                    $selected = ($categoriaFiltro == $row['idcategorias']) ? 'selected' : '';
                    echo '<option value="' . $row['idcategorias'] . '" ' . $selected . '>' . $row['nome'] . '</option>';
                }
                ?>
            </select>
            <?php
            if ($resultadoProdutos->num_rows > 0) {
                echo '<table>';
                echo '<thead>';
                echo '<tr><th>ID</th><th>Nome</th><th>Marca</th><th>Descrição</th><th>Preço</th><th>Quantidade</th><th>Categoria</th></tr>';
                echo '</thead>';
                echo '<tbody>';
                while ($row = $resultadoProdutos->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row['idprodutos'] . '</td>';
                    echo '<td>' . $row['nome'] . '</td>';
                    echo '<td>' . $row['marca'] . '</td>';
                    echo '<td>' . $row['descricao'] . '</td>';
                    echo '<td>' . $row['preco'] . '</td>';
                    echo '<td>' . $row['quantidade'] . '</td>';
                    echo '<td>' . $row['categoria_nome'] . '</td>';
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
            } else {
                echo '<p>Não há produtos cadastrados ainda.</p>';
            }
            ?>

        </form>
        <div class="buttons">
            <a href="registrarproduto.php"><button>Cadastrar Produto</button></a>
            <a href="pesquisaprodutos.php"><button>Editar Produtos</button></a>
        </div>
    </div>
</div>

</body>
</html>