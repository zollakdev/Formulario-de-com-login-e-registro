<?php
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

// Atualizar os dados no banco de dados, se o formulário de edição for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['nome'], $_POST['email'])) {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];

    // Atualizar os dados na tabela de usuarios
    $sql = "UPDATE usuarios SET nome = '$nome', email = '$email' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        echo "Dados atualizados com sucesso!";
    } else {
        echo "Erro ao atualizar os dados: " . $conn->error;
    }
}

// Consultando os dados da tabela de usuarios
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Controle de Usuários</title>
  <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }

    th, td {
      border: 1px solid #ddd;
      padding: 8px;
      text-align: left;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .edit-form {
      display: inline-block;
    }

    .edit-form input[type="text"] {
      width: 100%;
      padding: 4px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .edit-form button[type="submit"] {
      margin-top: 4px;
      padding: 4px 8px;
      border: none;
      border-radius: 4px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Controle de Usuários</h1>
  <table>
    <tr>
      <th>Nome</th>
      <th>Email</th>
      <th>Data de Nascimento</th>
      <th>Ação</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>";
            echo "<form class='edit-form' action='' method='POST'>";
            echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
            echo "<input type='text' name='nome' value='" . $row['nome'] . "' required>";
            echo "<button type='submit'>Salvar</button>";
            echo "</form>";
            echo "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "<td>" . $row['data_nasc'] . "</td>";
            echo "<td>";
            echo "<a href='delete.php?id=" . $row['id'] . "'>Excluir</a>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum usuário encontrado.</td></tr>";
    }
    ?>
  </table>
</body>
</html>

<?php
// Fechando a conexão
$conn->close();
if (isset($_GET['responsive'])) {
  echo '<script>document.documentElement.classList.add("responsive");</script>';
}
?>
