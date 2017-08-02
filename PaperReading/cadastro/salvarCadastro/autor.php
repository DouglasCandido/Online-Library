    <?php
    
    header ('Content-type: text/html; charset=UTF-8');
    
    $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
    $nome = $_POST['tNome'];
    $tel = $_POST['tTel'];
    $cpf = $_POST['tCPF'];
    $email = $_POST['tEmail'];
    $rua = $_POST['tRua'];
    $num = $_POST['tNumero'];
    $bairro = $_POST['tBairro'];
    $uf = $_POST['tUf'];
    $cidade = $_POST['tCidade'];

    $cod = "";
    
    $query = "call cadastroAutor('$cpf' , '$nome', $tel, '$email', '$rua', $num, '$bairro', '$cidade', $uf)";
    $result = mysqli_query($connection,$query);

    if ($result) {
        header('Location: ../../funcionario.php');
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