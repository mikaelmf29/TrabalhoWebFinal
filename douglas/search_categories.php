<?php
include 'config.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $searchParam = "%$search%";
    $stmt = $conexao->prepare("SELECT * FROM categorias WHERE idcategorias LIKE ? OR nome LIKE ? OR descricao LIKE ?");
    $stmt->bind_param("sss", $searchParam, $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
    $categories = array();
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
    $stmt->close();
} else {
    $result = $conexao->query("SELECT * FROM categorias");
    $categories = array();
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}

echo json_encode($categories);
$conexao->close();
?>