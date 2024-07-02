<?php
include 'config.php';

$search = $_GET['search'] ?? '';

if ($search) {
    $searchParam = "%$search%";
    $stmt = $conexao->prepare("SELECT * FROM produtos WHERE idprodutos LIKE ? OR marca LIKE ? OR descricao LIKE ? OR preco LIKE ? OR quantidade LIKE ? OR nome LIKE ?");
    $stmt->bind_param("ssssss", $searchParam, $searchParam, $searchParam, $searchParam, $searchParam, $searchParam);
    $stmt->execute();
    $result = $stmt->get_result();
    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    $stmt->close();
} else {
    $result = $conexao->query("SELECT * FROM produtos");
    $products = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}

echo json_encode($products);
$conexao->close();
?>