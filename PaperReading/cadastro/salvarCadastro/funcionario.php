<?php
  
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

    $cargo = $_POST['tCargo'];
    $turno = $_POST['tTurno'];

    $query = "select cadastroUsuario('$cpf' , '$email', '$nome', '$cidade', '$rua', '$num', '$bairro', '$senha', '$uf')";
    $result = mysqli_query($connection,$query);

    if ($result) {
        while ($fetch = mysqli_fetch_row($result)) {
            $query = "call cadastroFuncionario($fetch[0], '$cargo', '$turno')";
            $result = mysqli_query($connection, $query);
        } 
        header('Location: ../../funcionario.php');
        
    } else {
        echo "Ocorreu falha!".mysqli_error($connection);
    }
    mysqli_close($connection);

?>