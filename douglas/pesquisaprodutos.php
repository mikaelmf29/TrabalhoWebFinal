<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Produtos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilos básicos para a tabela */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 5px;
            overflow: hidden; /* Evita que a sombra do box-shadow saia da área */
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        main {
            overflow-x: auto; /* Controle de overflow horizontal */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: hidden; /* Evita que a tabela exceda a largura do container */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap; /* Evita que o texto seja quebrado */
        }

        th {
            background-color: #f2f2f2;
        }

        input[type="text"] {
            width: calc(100% - 10px); /* Ajusta para evitar scroll horizontal */
            padding: 5px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        button {
            padding: 5px 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        button:hover {
            background-color: #c0392b;
        }

        /* Estilos para tornar a tabela responsiva */
        @media only screen and (max-width: 768px) {
            table {
                width: 100%;
                overflow-x: auto; /* Adiciona scroll horizontal em telas menores */
                display: block;
            }

            th, td {
                min-width: 150px; /* Largura mínima das colunas */
                display: inline-block;
            }
        }
    </style>
    <script>
        async function fetchProducts(search = '') {
            const response = await fetch(`search_products.php?search=${search}`);
            const products = await response.json();
            const tableBody = document.getElementById('products-table-body');
            tableBody.innerHTML = '';
            products.forEach(product => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${product.idprodutos}</td>
                    <td><input type="text" value="${product.nome}" data-id="${product.idprodutos}" data-field="nome" onchange="updateProduct(this)"></td>
                    <td><input type="text" value="${product.marca}" data-id="${product.idprodutos}" data-field="marca" onchange="updateProduct(this)"></td>
                    <td><input type="text" value="${product.descricao}" data-id="${product.idprodutos}" data-field="descricao" onchange="updateProduct(this)"></td>
                    <td><input type="text" value="${product.preco}" data-id="${product.idprodutos}" data-field="preco" onchange="updateProduct(this)"></td>
                    <td><input type="text" value="${product.quantidade}" data-id="${product.idprodutos}" data-field="quantidade" onchange="updateProduct(this)"></td>
                    <td><button onclick="deleteProduct(${product.idprodutos})">Excluir</button></td>
                `;
                tableBody.appendChild(row);
            });
        }

        async function updateProduct(input) {
            const id = input.getAttribute('data-id');
            const field = input.getAttribute('data-field');
            const value = input.value;

            const formData = new FormData();
            formData.append('id', id);
            formData.append('nome', field === 'nome' ? value : document.querySelector(`input[data-id="${id}"][data-field="nome"]`).value);
            formData.append('marca', field === 'marca' ? value : document.querySelector(`input[data-id="${id}"][data-field="marca"]`).value);
            formData.append('descricao', field === 'descricao' ? value : document.querySelector(`input[data-id="${id}"][data-field="descricao"]`).value);
            formData.append('preco', field === 'preco' ? value : document.querySelector(`input[data-id="${id}"][data-field="preco"]`).value);
            formData.append('quantidade', field === 'quantidade' ? value : document.querySelector(`input[data-id="${id}"][data-field="quantidade"]`).value);

            const response = await fetch('update_product.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();
            alert(result);
        }

        async function deleteProduct(id) {
            if (confirm("Tem certeza que deseja excluir este produto?")) {
                const formData = new FormData();
                formData.append('id', id);

                const response = await fetch('delete_product.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.text();
                alert(result);
                fetchProducts();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('search-input').addEventListener('input', (e) => {
                fetchProducts(e.target.value);
            });

            fetchProducts();
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Produtos</h1>
        </header>
        <main>
            <input type="text" id="search-input" placeholder="Pesquisar produtos...">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Marca</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th>Quantidade</th>
                        <th>Ação</th>
                    </tr>
                </thead>
                <tbody id="products-table-body">
                    <!-- Linhas da tabela serão inseridas aqui -->
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>