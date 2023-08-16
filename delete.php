<?php
// Dados de conexão com o MySQL
$host = 'localhost'; // Endereço do servidor MySQL (geralmente é localhost)
$username = 'root'; // Nome de usuário do MySQL
$password = ''; // Senha do MySQL
$database = 'formulario-davi'; // Nome do banco de dados

// Verificar se o ID do usuário foi fornecido na URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Criando a conexão com o MySQL
    $conn = new mysqli($host, $username, $password, $database);

    // Verificando se houve erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o MySQL: " . $conn->connect_error);
    }

    // Excluir o usuário com base no ID
    $sql = "DELETE FROM usuarios WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Usuário excluído com sucesso!";
    } else {
        echo "Erro ao excluir o usuário: " . $conn->error;
    }

    // Fechando a conexão
    $conn->close();
} else {
    echo "ID do usuário não fornecido.";
}
if (isset($_GET['responsive'])) {
    echo '<script>document.documentElement.classList.add("responsive");</script>';
  }
?>
