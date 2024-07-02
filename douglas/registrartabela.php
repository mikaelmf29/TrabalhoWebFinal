<?php
$error_message = "";

if (isset($_POST['submit'])) {
    include_once('config.php');
    
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];

  
    $stmt_check = $conexao->prepare("SELECT nome FROM categorias WHERE nome = ?");
    $stmt_check->bind_param("s", $nome);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $error_message = "Já existe uma categoria com esse nome. Por favor, escolha outro nome.";
    } else {
      
        $stmt_insert = $conexao->prepare("INSERT INTO categorias (nome, descricao) VALUES (?, ?)");
        $stmt_insert->bind_param("ss", $nome, $descricao);

        if ($stmt_insert->execute()) {
         
            header("Location: sistema.php");
            exit();
        } else {
            echo "Erro ao cadastrar a categoria: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    }

    $stmt_check->close();
    $conexao->close();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Categorias</title>
    <link rel="stylesheet" href="styles.css">
    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        header {
            margin-bottom: 20px;
            text-align: center;
        }

        header h1 {
            font-size: 1.5em;
            color: #333;
        }

        main {
            display: flex;
            flex-direction: column;
        }

        .inputBox {
            margin-bottom: 15px;
        }

        .inputBox label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .inputBox input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 1em;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastro de Categorias</h1>
        </header>
        <main>
            <form action="registrartabela.php" method="POST">
                <?php if (!empty($error_message)): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
                <?php endif; ?>
                <div class="inputBox">
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" required>
                </div>
                <div class="inputBox">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" required>
                </div>
                <button type="submit" name="submit">Cadastrar Categoria</button>
            </form>
        </main>
    </div>
</body>
</html>
