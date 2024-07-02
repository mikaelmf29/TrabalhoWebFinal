<?php


function simulatePostRequest($url, $data)
{
    $options = [
        'http' => [
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ],
    ];
    $context  = stream_context_create($options);
    return file_get_contents($url, false, $context);
}


$postData = [
    'submit' => true,
    'nome' => 'Test User',
    'senha' => 'password',
    'email' => 'test@example.com',
    'data_nascimento' => '2000-01-01',
    'telefone' => '123456789',
    'cidade' => 'Test City',
    'endereco' => 'Test Address'
];


$response = simulatePostRequest('http://localhost/douglas/registrocliente.php', $postData);


include_once('config.php');


$result = mysqli_query($conexao, "SELECT * FROM usuarios WHERE email='test@example.com'");
$userExists = mysqli_num_rows($result) > 0;


mysqli_query($conexao, "DELETE FROM usuarios WHERE email='test@example.com'");


mysqli_close($conexao);


if ($userExists) {
    echo "Teste de registro de usuário passou.\n";
} else {
    echo "Teste de registro de usuário falhou.\n";
}

?>