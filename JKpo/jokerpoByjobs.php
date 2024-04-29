<!DOCTYPE html>
<html lang="pt-br">
    <head>
       <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Rock Paper Scissors</title>
        <?php
        $base = 'jogodados';
        $user = 'root';
        $pass = '';
        $host = 'localhost';
        $con = new mysqli($host, $user, $pass, $base);
        ?>
    </head>
<body>
    <form action="" method="post">
            <label for="nome">Seu Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br>
            <label for="opcao">Escolha sua opção:</label>
            <select name="opcao" id="opcao" required>
                <option value="pedra">Pedra</option>
                <option value="papel">Papel</option>
                <option value="tesoura">Tesoura</option>
            </select>
            <br>
            <input type="submit" value="Jogar">
    </form>    

    <?php
            //isset posibilitando a adição da escolha ao jogador na base de dados atraves da "array" _POST
        if (isset($_POST['opcao'])) {
            // Opções disponíveis
            $opcoes = ["pedra", "papel", "tesoura"];

            // Escolha do usuário
            $escolha_usuario = $_POST['opcao'];
            $nome = $_POST['nome'];

            // Escolha aleatória do computador
            $escolha_computador = $opcoes[array_rand($opcoes)];

            // Determina o vencedor
            if ($escolha_usuario == $escolha_computador) {
                $resultado = "Empate!";
            } elseif (($escolha_usuario == "pedra" && $escolha_computador == "tesoura") ||
                      ($escolha_usuario == "papel" && $escolha_computador == "pedra") ||
                      ($escolha_usuario == "tesoura" && $escolha_computador == "papel")) {
                $resultado = "$nome ganhou!";
            } else {
                $resultado = "Computador ganhou!";
            };

            echo "<h2>Resultado:</h2>";
            echo "<p>$nome escolheu $escolha_usuario</p>";
            echo "<p>O computador escolheu $escolha_computador</p>";
            echo "<p>$resultado</p>";


            //  inserindo os jogadores
            $sql = "INSERT INTO resultados (jogada_jogador, jogador_nome, computador, resultado) VALUES ('$escolha_usuario','$nome', '$escolha_computador', '$resultado')";
            $resultado = mysqli_query($con, $sql); 
                    
            # mostrando os jogadores
           $tabela = mysqli_query($con,"SELECT * FROM resultados");
             echo "<table border=5px><tr><td>Nome</td><td>Escolha</td><td>Resultado</td></tr>";
             while ($tab = mysqli_fetch_array($tabela)) {
                $nome_jogador = $tab['jogador_nome'];
                $escolha_jogador = $tab['jogada_jogador'];
                $resultado_jogo = $tab['resultado'];
                    //aqui eu tive que colocar os dados coletados no banco de dados com os nomes das colunas 
                    echo "<tr><td>".$nome_jogador. "</td><td>".$escolha_jogador."</td><td>".$resultado_jogo."</td></tr>";
                    
              
            }      
             
             echo "</table>";
            
        }

        mysqli_close($con);        
    ?>

</body>
</html>
        