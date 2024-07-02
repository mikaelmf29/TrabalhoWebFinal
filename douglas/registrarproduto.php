<?php
if (isset($_POST['submit'])) {
    include_once('config.php');
    
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $quantidade = $_POST['quantidade'];
    $categoriaid = $_POST['categoria']; // Captura o idcategorias selecionado

    // Inserção na tabela produtos
    $stmt = $conexao->prepare("INSERT INTO produtos (nome, marca, descricao, preco, quantidade, categoriaid) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssi", $nome, $marca, $descricao, $preco, $quantidade, $categoriaid);

    if ($stmt->execute()) {
        // Redirecionamento após o cadastro bem-sucedido
        header("Location: sistema.php");
        exit();
    } else {
        echo "Erro ao cadastrar o produto: " . $stmt->error;
    }

    $stmt->close();
    $conexao->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="styles.css">
    <style>

/* Estilos para o formulário de cadastro de produtos */

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.container {
    width: 100%;
    max-width: 600px;
    background-color: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    border-radius: 5px;
}

header {
    text-align: center;
    margin-bottom: 20px;
}

h1 {
    color: #333;
}

main {
    display: flex;
    justify-content: center;
}

form {
    width: 100%;
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
}

.inputBox {
    margin-bottom: 15px;
}

.inputBox label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

.inputBox input[type="text"],
.inputBox select {
    width: 100%;
    padding: 8px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 3px;
}

.inputBox select {
    cursor: pointer;
}

button {
    padding: 10px 20px;
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    border-radius: 3px;
    font-size: 16px;
}

button:hover {
    background-color:#45a049;
}
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastro de Produtos</h1>
        </header>
        <main>
            <form action="registrarproduto.php" method="POST">
                <div class="inputBox">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="inputBox">
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" required>
                </div>
                <div class="inputBox">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>
                <div class="inputBox">
                    <label for="preco">Preço:</label>
                    <input type="text" id="preco" name="preco" required>
                </div>
                <div class="inputBox">
                    <label for="quantidade">Quantidade:</label>
                    <input type="text" id="quantidade" name="quantidade" required>
                </div>
                <div class="inputBox">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" name="categoria" required>
                        <?php
                        include_once('config.php');
                        $result = $conexao->query("SELECT * FROM categorias");
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['idcategorias'] . "'>" . $row['nome'] . "</option>";
                        }
                        $conexao->close();
                        ?>
                    </select>
                </div>
                <button type="submit" name="submit">Cadastrar Produto</button>
            </form>
        </main>
    </div>
</body>
</html>