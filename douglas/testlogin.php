<?php

if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha']))
{
  include_once('config.php');
  $email = $_POST['email'];
  $senha = $_POST['senha'];


  $sql = "SELECT * FROM usuarios where email = '$email' and senha = '$senha'";
$result = $conexao->query($sql);


if(mysqli_num_rows($result) < 1)
{
    header('Location: logincliente.php');
}
else{
    header('Location: sistema.php');
}
}
else
{
    header('Location:logincliente.php');
}
?>