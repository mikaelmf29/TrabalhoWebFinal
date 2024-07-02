<?php
include 'config.php';

$idprodutos = $_POST['id'] ?? '';

if ($idprodutos) {
    $stmt = $conexao->prepare("DELETE FROM produtos WHERE idprodutos=?");
    $stmt->bind_param("i", $idprodutos);
    if ($stmt->execute()) {
        echo "Produto excluído com sucesso";
    } else {
        echo "Erro: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "ID do produto não fornecido";
}

$conexao->close();
?>