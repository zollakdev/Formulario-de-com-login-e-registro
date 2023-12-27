<?php
// Dados de conexão com o MySQL
$host = 'localhost'; // Endereço do servidor MySQL (geralmente é localhost)
$username = 'root'; // Nome de usuário do MySQL
$password = ''; // Senha do MySQL
$database = 'formulario-davi'; // Nome do banco de dados

// Iniciar a sessão
session_start();

// Verificar se os dados foram enviados pelo formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar se as chaves estão definidas no array $_POST
    if (isset($_POST['email-login'], $_POST['senha-login'])) {
        // Dados do formulário
        $email = $_POST['email-login'];
        $senha = $_POST['senha-login'];

        // Criando a conexão com o MySQL
        $conn = new mysqli($host, $username, $password, $database);

        // Verificando se houve erro na conexão
        if ($conn->connect_error) {
            die("Falha na conexão com o MySQL: " . $conn->connect_error);
        }

        // Consultando o banco de dados para verificar se a conta existe
        $sql = "SELECT id FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // A conta existe, obter o ID do usuário
            $row = $result->fetch_assoc();
            $idUsuario = $row['id'];

            // Armazenar o ID do usuário na sessão
            $_SESSION['idUsuario'] = $idUsuario;

            // Fechando a conexão
            $conn->close();

            // Verificar se o email é "root@root" para redirecionar para controle.php
            if ($email === 'root@root') {
                header("Location: controle.php");
                exit;
            } else {
                // Redirecionar para o outro arquivo PHP
                header("Location: principal.php");
                exit;
            }
        } else {
            // A conta não existe ou a combinação de e-mail/senha está incorreta
            echo "Email ou senha inválidos.";
        }
    } else {
        echo "Por favor, preencha todos os campos do formulário.";
    }
}
if (isset($_GET['responsive'])) {
    echo '<script>document.documentElement.classList.add("responsive");</script>';
  }
?>
