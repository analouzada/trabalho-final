<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db_connection.php';

// Verifique se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $evento_id = $_POST['id'];

    // Exclua o evento do banco de dados
    $query = "DELETE FROM events WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $evento_id);
    $stmt->execute();

    // Redirecione de volta para a página inicial após a exclusão do evento
    header('Location: index.php');
    exit();
} else {
    echo "<p>Método inválido para excluir evento.</p>";
}

// Redirecione de volta para a página inicial após a criação, edição ou exclusão do evento
header('Location: index.php');
exit();
?>