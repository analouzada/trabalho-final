<!DOCTYPE html>
<html>
<head>
    <title>Site de Vendas de Ingressos</title>
    <link rel="stylesheet" href="css/style2.css">
    <link rel="shortcut icon" href="ico/icone.png" type="image/png">
</head>
<body>
    <div class="container form-container">
    <h1 >SITE DE VENDA DE INGRESSOS</h1>

    <?php
    // Inclua o arquivo de conexão com o banco de dados
    include 'db_connection.php';

    // Função para exibir os eventos
    function exibirEventos(){
        global $conn;

        // Recupere os eventos do banco de dados
        $query = "SELECT * FROM events";
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            echo "<div class='event-container'>";
            echo "<h2>Eventos Disponíveis:</h2>";
            echo "<ul>";
            foreach ($result as $row) {
                echo "<li><a href='detalhes_evento.php?id=". $row['id'] . "'>" . $row['nome'] . "</a></li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Nenhum evento encontrado.</p>";
        }
    }

    // Chame a função para exibir os eventos
    exibirEventos();
    ?>


    <h2>Adicionar Novo Evento:</h2>
<form action="criar_evento.php" method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br>

    <label for="texto">Texto:</label>
    <textarea name="texto" required></textarea><br>

    <label for="data">Data:</label>
    <input type="date" name="data" required><br>

    <label for="preco">Preço:</label>
    <input type="number" name="preco" step="0.01" required><br>

    <label for="cidade">Cidade:</label>
    <input type="text" name="cidade" required><br>

    <input type="submit" value="Adicionar Evento">
    </div>
    </div>
</form>
</body>
</html>