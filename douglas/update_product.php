<?php
include 'config.php';

$idprodutos = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$marca = $_POST['marca'] ?? '';
$descricao = $_POST['descricao'] ?? '';
$preco = $_POST['preco'] ?? '';
$quantidade = $_POST['quantidade'] ?? '';

if ($idprodutos && $nome && $marca && $descricao && $preco && $quantidade) {
    $stmt = $conexao->prepare("UPDATE produtos SET nome=?, marca=?, descricao=?, preco=?, quantidade=? WHERE idprodutos=?");
    $stmt->bind_param("sssssi", $nome, $marca, $descricao, $preco, $quantidade, $idprodutos);
    if ($stmt->execute()) {
        echo "Produto atualizado com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Todos os campos são obrigatórios";
}

$conexao->close();
?>