<?php
// Iniciar a sessão
session_start();

// Verificar se o ID do usuário está definido na sessão
if (isset($_SESSION['idUsuario'])) {
    $idUsuario = $_SESSION['idUsuario'];

    // Dados de conexão com o MySQL
    $host = 'localhost'; // Endereço do servidor MySQL (geralmente é localhost)
    $username = 'root'; // Nome de usuário do MySQL
    $password = ''; // Senha do MySQL
    $database = 'formulario-davi'; // Nome do banco de dados

    // Criando a conexão com o MySQL
    $conn = new mysqli($host, $username, $password, $database);

    // Verificando se houve erro na conexão
    if ($conn->connect_error) {
        die("Falha na conexão com o MySQL: " . $conn->connect_error);
    }

    // Consultar o banco de dados para obter o nome do usuário usando o ID
    $sql = "SELECT nome FROM usuarios WHERE id = '$idUsuario'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // O usuário foi encontrado, obter o nome do usuário
        $row = $result->fetch_assoc();
        $nomeUsuario = $row['nome'];

        // Fechando a conexão
        $conn->close();

        // Exibir o nome do usuário com destaque e movimento
        echo "<html>";
        echo "<head>";
        echo "<title>Bem-vindo</title>";
        echo "<style>";
        echo "body {";
        echo "  display: flex;";
        echo "  justify-content: center;";
        echo "  align-items: center;";
        echo "  height: 100vh;";
        echo "  background-color: #f2f2f2;";
        echo "}";
        echo ".animation {";
        echo "  animation: moveText 2s infinite alternate;";
        echo "}";
        echo "@keyframes moveText {";
        echo "  from { transform: translateX(-20px); }";
        echo "  to { transform: translateX(20px); }";
        echo "}";
        echo "h1 {";
        echo "  font-size: 48px;";
        echo "  text-align: center;";
        echo "  color: #333333;";
        echo "  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);";
        echo "}";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<h1 class=\"animation\">Bem-vindo, <span style=\"color: #ff6600;\">$nomeUsuario</span>!</h1>";
        echo "</body>";
        echo "</html>";
    } else {
        // O usuário não foi encontrado
        echo "Usuário não encontrado.";
    }
} else {
    // O ID do usuário não está definido na sessão
    echo "Acesso não autorizado.";
}
if (isset($_GET['responsive'])) {
    echo '<script>document.documentElement.classList.add("responsive");</script>';
  }
?>
