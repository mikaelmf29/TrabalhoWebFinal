<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Categorias</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            width: 100%;
            max-width: 800px;
            margin: 20px;
        }
        header {
            text-align: center;
            margin-bottom: 15px;
        }
        header h1 {
            font-size: 1.5em;
            color: #333;
        }
        input[type="text"] {
            width: 100%;
            padding: 6px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9em;
        }
        .table-wrapper {
            max-height: 400px; 
            overflow-y: auto;
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        table thead {
            background-color: #f9f9f9;
        }
        table th,
        table td {
            padding: 8px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 0.9em;
        }
        table th {
            background-color: #f0f0f0;
        }
        table td input[type="text"] {
            width: calc(100% - 12px);
            padding: 4px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 0.9em;
        }
        button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            font-size: 0.8em;
        }
        button:hover {
            background-color: #c0392b;
        }
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }
            table th, table td {
                padding: 6px;
                font-size: 0.8em;
            }
            table td input[type="text"] {
                width: calc(100% - 10px);
                padding: 3px;
            }
            button {
                padding: 4px 10px;
                font-size: 0.7em;
            }
            input[type="text"] {
                padding: 4px;
                font-size: 0.8em;
            }
        }
    </style>
    <script>
        async function fetchCategories(search = '') {
            const response = await fetch(`search_categories.php?search=${search}`);
            const categories = await response.json();
            const tableBody = document.getElementById('categories-table-body');
            tableBody.innerHTML = '';
            categories.forEach(category => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${category.idcategorias}</td>
                    <td><input type="text" value="${category.nome}" data-id="${category.idcategorias}" data-field="nome" onchange="updateCategory(this)"></td>
                    <td><input type="text" value="${category.descricao}" data-id="${category.idcategorias}" data-field="descricao" onchange="updateCategory(this)"></td>
                    <td><button onclick="deleteCategory(${category.idcategorias})">Excluir</button></td>
                `;
                tableBody.appendChild(row);
            });
        }

        async function updateCategory(input) {
            const id = input.getAttribute('data-id');
            const field = input.getAttribute('data-field');
            const value = input.value;

            const formData = new FormData();
            formData.append('id', id);
            formData.append('nome', field === 'nome' ? value : document.querySelector(`input[data-id="${id}"][data-field="nome"]`).value);
            formData.append('descricao', field === 'descricao' ? value : document.querySelector(`input[data-id="${id}"][data-field="descricao"]`).value);

            const response = await fetch('update_category.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.text();
            alert(result);
        }

        async function deleteCategory(id) {
            if (confirm("Tem certeza que deseja excluir esta categoria?")) {
                const formData = new FormData();
                formData.append('id', id);

                const response = await fetch('delete_category.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.text();
                alert(result);
                fetchCategories();
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            document.getElementById('search-input').addEventListener('input', (e) => {
                fetchCategories(e.target.value);
            });

            fetchCategories();
        });
    </script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Gerenciamento de Categorias</h1>
        </header>
        <main>
            <input type="text" id="search-input" placeholder="Pesquisar categorias...">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Ação</th>
                        </tr>
                    </thead>
                    <tbody id="categories-table-body">
    
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>