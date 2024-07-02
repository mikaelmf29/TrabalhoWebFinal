<?php
include 'config.php';


if (isset($_POST['id']) && isset($_POST['nome']) && isset($_POST['descricao'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];


    $stmt = $conexao->prepare("UPDATE categorias SET nome=?, descricao=? WHERE idcategorias=?");
    $stmt->bind_param("ssi", $nome, $descricao, $id);

    
    if ($stmt->execute()) {
        echo "Categoria atualizada com sucesso";
    } else {
        echo "Erro ao atualizar categoria: " . $stmt->error;
    }

  
    $stmt->close();
} else {
    echo "Dados incompletos para atualizar a categoria";
}


$conexao->close();
?>