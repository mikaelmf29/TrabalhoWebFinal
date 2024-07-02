<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loja de Compras</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        async function getAdvice() {
            try {
                const response = await fetch('https://api.adviceslip.com/advice');
                const data = await response.json();
                if (data && data.slip && data.slip.advice) {
                    const advice = data.slip.advice;
                    document.getElementById('advice').innerText = advice;
                }
            } catch (error) {
                console.error('Erro ao obter conselho:', error);
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Bem-vindo à Nossa Loja</h1>
        </header>
        <main>
            <button class="btn" onclick="location.href='logincliente.php'">Entrar</button>
            <button class="btn" onclick="location.href='registrocliente.php'">Me cadastrar</button>
            <br><br>
            <h2>Conselho do Dia:</h2>
            <p id="advice"></p>
            <button class="btn" onclick="getAdvice()">Obter Conselho</button>
        </main>
    </div>
</body>
</html>