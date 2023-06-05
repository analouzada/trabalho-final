<!DOCTYPE html>
<html>
<head>
    <title>Detalhes do Evento</title>
    <link rel="stylesheet" href="css/style4.css">
    <link rel="shortcut icon" href="ico/icone.png" type="image/png">
</head>
<body>
    <div class="container">
    <h1>Detalhes do Evento</h1>

    <?php
    // Inclua o arquivo de conexão com o banco de dados
    include 'db_connection.php';

    // Verifique se o parâmetro de ID do evento foi fornecido
    if (isset($_GET['id'])) {
        $evento_id = $_GET['id'];

        // Recupere as informações do evento do banco de dados
        $query = "SELECT * FROM events WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $evento_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
           
            echo "<h2>Detalhes do Evento</h2>";
            echo "<h3>Evento ID: " . $result['id'] . "</h3>";
            echo "<p>Nome: " . $result['nome'] . "</p>";
            echo "<p>Texto: " . $result['texto'] . "</p>";
            echo "<p>Data: " . $result['data'] . "</p>";
            echo "<p>Preço: R$ " . $result['preco'] . "</p>";
            echo "<p>Cidade: " . $result['cidade'] . "</p>";

            echo "<a href='editar_evento.php?id=" . $result['id'] . "class='btn-editar'>Editar Evento</a>";
        } else {
            echo "<p>Evento não encontrado.</p>";
        }
    } else {
        echo "<p>Parâmetro de ID do evento não fornecido.</p>";
    }
    ?>

    

<!-- Botão de Exclusão -->
<form action="excluir_evento.php" method="POST" onsubmit="return confirm('Tem certeza de que deseja excluir este evento?');">
    <input type="hidden" name="id" value="<?php echo $result['id']; ?>">
    <input type="submit" value="Excluir Evento" class="btn-excluir">
</form>

</body>
</html>