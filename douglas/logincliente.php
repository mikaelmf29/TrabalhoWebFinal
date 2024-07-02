<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
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
    max-width: 400px;
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

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: #333;
}

.form-group input {
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
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Login</h1>
        </header>
        <main>
            <form action="testlogin.php" method="POST">
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="text"name="email" placeholder="Email" >
                </div>
                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" placeholder="Senha">
                </div>
                <button type="submit" name="submit" class="btn">Entrar</button>
            </form>
        </main>
    </div>
</body>
</html>