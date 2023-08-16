<?php
// Dados de conexão com o MySQL
$host = 'localhost'; // Endereço do servidor MySQL (geralmente é localhost)
$username = 'root'; // Nome de usuário do MySQL
$password = ''; // Senha do MySQL
$database = 'formulario-davi'; // Nome do banco de dados

// Verificar se os dados foram enviados pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dados do formulário
    $nome = $_POST['nome-registro'];
    $senha = $_POST['senha-registro'];
    $email = $_POST['email-registro'];
    $data_nasc = $_POST['data-registro'];

    // Convertendo a data para o formato do MySQL (YYYY-MM-DD)
    $data_nasc = date('Y-m-d', strtotime($data_nasc));

    // Criando a conexão com o MySQL
    $conn = new mysqli($host, $username, $password, $database);

    // Verificando se houve erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o MySQL: " . $conn->connect_error);
    }

    // Verificar se já existe um usuário com o mesmo nome ou e-mail
    $sql_verificar = "SELECT * FROM usuarios WHERE nome = '$nome' OR email = '$email'";
    $resultado = $conn->query($sql_verificar);

    if ($resultado->num_rows > 0) {
        echo "Já existe um usuário com o mesmo nome ou e-mail!";
    } else {
        // Inserindo os dados na tabela de usuarios
        $sql = "INSERT INTO usuarios (nome, senha, email, data_nasc) VALUES ('$nome', '$senha', '$email', '$data_nasc')";
        if ($conn->query($sql) === TRUE) {
            echo "Conta criada com sucesso!";
            echo "<script>setTimeout(function() { window.location.href = 'index.html'; }, 20000);</script>";
        } else {
            echo "Erro ao criar a conta: " . $conn->error;
        }
    }

    // Fechando a conexão
    $conn->close();
}
if (isset($_GET['responsive'])) {
    echo '<script>document.documentElement.classList.add("responsive");</script>';
  }
?>
