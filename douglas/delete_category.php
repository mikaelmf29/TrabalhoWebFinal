<?php
include 'config.php';

$idcategorias = $_POST['id'];

$stmt = $conexao->prepare("DELETE FROM categorias WHERE idcategorias=?");
$stmt->bind_param("i", $idcategorias);

if ($stmt->execute()) {
    echo "Categoria excluída com sucesso";
} else {
    echo "Erro: " . $stmt->error;
}

$stmt->close();
$conexao->close();
?>