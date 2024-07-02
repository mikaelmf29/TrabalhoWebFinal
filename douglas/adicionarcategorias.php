<?php
include 'config.php';

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

if ($nome && $descricao) {
    $sql = "INSERT INTO categorias (nome, descricao) VALUES ('$nome', '$descricao')";
    if ($conexao->query($sql) === TRUE) {
        echo "Nova categoria adicionada com sucesso";
    } else {
        echo "Erro: " . $sql . "<br>" . $conexao->error;
    }
} else {
    echo "Nome e descrição da categoria são obrigatórios";
}

$conexao->close();
?>