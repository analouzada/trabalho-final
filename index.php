<!DOCTYPE html>
<html>
<head>
    <title>Site de Vendas de Ingressos</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="ico/icone.png" type="image/png">
</head>
<body>
    <header>
    <h1>Party Events</h1>
    <input class="cidade" type="text" name="nome" placeholder="Selecione uma cidade..." required><br>
    <input class="evento" type="text" name="cidade" placeholder="Selecione um evento..." required><br>
    <div class="procura"><a href="http://localhost/trabalho-final/index-c.php">Procurar</a></div>
</header>
<div id="menu">
<ul>
<li><p>Menu</p></li>
<li><p>Pré-vendas</p></li>
<li><p>Próximas Estreias</p></li>
<li><p>Promoções</p></li>
<li><p>Produtos e Serviços</p></li>
</ul>
</div>
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
    <img class="banner" src="img/maps.png">

<section class="eventos">
    <div class="evento-card">
    <img width="300px" height="400px" src="img/tropical festival.png">
    <p>DISPONÍVEL</p>    
    </div>
    <div class="evento-card">
    <img width="300px" height="400px" src="img/roberto carlos.png">
    <p>INDISPONÍVEL</p>
</div>
<div class="evento-card">
    <img width="300px" height="400px" src="img/rock.png">
    <p>PRÉ-VENDA</p>
</div>
<div class="evento-card">
    <img width="300px" height="400px" src="img/rock in rio.png">
    <p>PROMOÇÃO</p>
</div>
</section>

</form>


<footer class="rodape"> <img class="rodape" width="1530px" height="234px" src="img/nike.png"> </footer>
</body>
</html>