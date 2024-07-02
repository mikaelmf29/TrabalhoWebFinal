<?php
include 'config.php';

$sql = "SELECT * FROM categorias";
$result = $conexao->query($sql);

$categories = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $categories[] = $row;
    }
}
echo json_encode($categories);

$conexao->close();
?>