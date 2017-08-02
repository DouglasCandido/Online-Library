<?php 
    header ('Content-type: text/html; charset=UTF-8');
	$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
    
    $nome = $_POST['tNome'];
    $isbn = $_POST['tIsbn'];
    $ed = $_POST['tEd'];
    $qtd = $_POST['tNumber'];
    $ano = $_POST['tAno'];
    $gen = $_POST['tGen'];
    $editora = $_POST['tEditora'];
    $descricao = $_POST['tDescricao'];
    $autor = $_POST['tAutor'];

    $cod = 0;

    $query = "select cadastroLivro('$isbn', '$nome', $ed, $ano, $qtd, '$gen', '$descricao')";
    $result = mysqli_query($connection,$query);

    if ($result) {
        while ($fetch = mysqli_fetch_row($result)) {
            $cod = $fetch[0];
        }
        echo $autor;
        $query = "call cadastroGeralLivro($cod, '$autor', '$editora');";
        $result = mysqli_query($connection, $query);
        if ($result) {
            header('Location: ../../funcionario.php');
        } else {
            echo $autor;
            echo "Ocorreu falha!".mysqli_error($connection);
        }
    } else {
    	echo "Ocorreu falha!".mysqli_error($connection);
    }

    mysqli_close($connection);
?>