<?php
    header ('Content-type: text/html; charset=UTF-8');
  
    $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
    $nome = $_POST['tNome'];
    $senha = $_POST['tSenha'];
    $cpf = $_POST['tCPF'];
    $email = $_POST['tEmail'];
    $rua = $_POST['tRua'];
    $num = $_POST['tNumero'];
    $bairro = $_POST['tBairro'];
    $uf = $_POST['tUf'];
    $cidade = $_POST['tCidade'];

    $cod = "";
    
    $query = "select cadastroUsuario('$cpf' , '$email', '$nome', '$cidade', '$rua', '$num', '$bairro', '$senha', '$uf')";
    $result = mysqli_query($connection,$query);

    if ($result) {
        while ($fetch = mysqli_fetch_row($result)) {
            $cod = "".$fetch[0];
            $query = "call cadastroLeitor($fetch[0])";
            $result = mysqli_query($connection, $query);
        }
        header('Location: ../../leitor.php');
        ?>
            <script type="text/javascript">
                alert("Inserido com sucesso, seu código é !".$cod);
            </script>
        <?php
    } else {
        ?>
            <script type="text/javascript">
                alert("Ocorreu erro!");
            </script>
        <?php
        header('Location: ../../leitor.php');
    }
    mysqli_close($connection);

?>