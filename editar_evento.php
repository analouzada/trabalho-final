<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
    <link rel="stylesheet" href="css/style3.css">
    <link rel="shortcut icon" href="ico/icone.png" type="image/png">
</head>
<body>
    
</body>
</html>
<div class="container">
<?php
// Inclua o arquivo de conexão com o banco de dados
include 'db_connection.php';

// Verifique se o parâmetro de ID do evento foi fornecido
if (isset($_GET['id'])) {
    $evento_id = $_GET['id'];

    // Verifique se o formulário foi submetido
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $texto = $_POST['texto'];
        $data = $_POST['data'];
        $preco = $_POST['preco'];
        $cidade = $_POST['cidade'];

        // Atualize os dados do evento no banco de dados
        $query = "UPDATE events SET nome = :nome, texto = :texto, data = :data, preco = :preco, cidade = :cidade WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':texto', $texto);
        $stmt->bindParam(':data', $data);
        $stmt->bindParam(':preco', $preco);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':id', $evento_id);
        $stmt->execute();

        // Redirecione de volta para a página de detalhes do evento após a edição
        header('Location: detalhes_evento.php?id=' . $evento_id);
        exit();
    } else {
        // Recupere as informações do evento do banco de dados
        $query = "SELECT * FROM events WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $evento_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            // Exiba o formulário de edição do evento com os valores preenchidos
            ?>
            <h2>Editar Evento</h2>
            <form action="editar_evento.php?id=<?php echo $evento_id; ?>" method="POST">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" value="<?php echo $result['nome']; ?>" required><br>

                <label for="texto">Texto:</label>
                <textarea name="texto" required><?php echo $result['texto']; ?></ ><?php echo $result['texto']; ?></textarea><br>

                <label for="data">Data:</label>
                <input type="date" name="data" value="<?php echo $result['data']; ?>" required><br>

                <label for="preco">Preço:</label>
                <input type="number" name="preco" step="0.01" value="<?php echo $result['preco']; ?>" required><br>

                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" value="<?php echo $result['cidade']; ?>" required><br>

                <input type="submit" value="Salvar Alterações">
            </form>
            <?php
        } else {
            echo "<p>Evento não encontrado.</p>";
        }
    }
} else {
    echo "<p>Parâmetro de ID do evento não fornecido.</p>";
}

?>
</div>