<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db_connection.php';

// Verifique se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $texto = $_POST['texto'];
    $data = $_POST['data'];
    $preco = $_POST['preco'];
    $cidade = $_POST['cidade'];

    // Insira o novo evento no banco de dados
    $query = "INSERT INTO events (nome, texto, data, preco, cidade) VALUES (:nome, :texto, :data, :preco, :cidade)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':texto', $texto);
    $stmt->bindParam(':data', $data);
    $stmt->bindParam(':preco', $preco);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->execute();

    // Redirecione de volta para a página inicial após a criação do evento
    header('Location: index.php');
    exit();
} else {
    echo "<p>Método inválido para criar evento.</p>";
}

// Redirecione de volta para a página inicial após a criação, edição ou exclusão do evento
header('Location: index.php');
exit();
?>