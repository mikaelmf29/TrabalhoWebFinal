<?php
$erro = "";

if(isset($_POST['submit'])) {
    include_once('config.php');
    
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $data_nasc = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $cidade = $_POST['cidade'];
    $endereco = $_POST['endereco'];

    
    $query = "SELECT * FROM usuarios WHERE nome = '$nome' OR email = '$email'";
    $result = mysqli_query($conexao, $query);

    if (mysqli_num_rows($result) > 0) {
        
        $erro = "Nome ou email já cadastrado!";
    } else {
        
        $insertQuery = "INSERT INTO usuarios(nome, senha, email, data_nasc, telefone, cidade, endereco) 
                        VALUES('$nome', '$senha', '$email', '$data_nasc', '$telefone', '$cidade', '$endereco')";
        $insertResult = mysqli_query($conexao, $insertQuery);

        if ($insertResult) {
            header("Location: logincliente.php");
            exit();
        } else {
            $erro = "Erro ao cadastrar o usuário.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
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
            padding: 20px 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 500px;
        }

        header h1 {
            font-size: 2em;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
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

        .btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 15px 20px;
            font-size: 1em;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Cadastro de Cliente</h1>
        </header>
        <main>
            <form action="registrocliente.php" method="POST">
                <?php if($erro != ""): ?>
                    <p class="error"><?php echo $erro; ?></p>
                <?php endif; ?>
                <div class="inputBox">
                    <label for="nome" class="labelInput">Nome:</label>
                    <input type="text" id="nome" name="nome" class="inputUser" required>
                </div>
                <div class="inputBox">
                    <label for="senha" class="labelInput">Senha:</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="inputBox">
                    <label for="email" class="labelInput">Email:</label>
                    <input type="text" id="email" name="email" class="inputUser" required>
                </div>
                <div class="inputBox">
                    <label for="data-nascimento" class="labelInput">Data de Nascimento:</label>
                    <input type="date" id="data_nascimento" name="data_nascimento" required>
                </div>
                <div class="inputBox">
                    <label for="telefone" class="labelInput">Telefone:</label>
                    <input type="tel" id="telefone" name="telefone" class="inputUser" required>
                </div>
                <div class="inputBox">
                    <label for="cidade" class="labelInput">Cidade:</label>
                    <input type="text" id="cidade" name="cidade" class="inputUser" required>
                </div>
                <div class="inputBox">
                    <label for="endereco" class="labelInput">Endereço:</label>
                    <input type="text" id="endereco" name="endereco" class="inputUser" required>
                </div>
                <button type="submit" name="submit" id="submit" class="btn">Cadastrar</button>
            </form>
        </main>
    </div>
</body>
</html>