<?php
    header ('Content-type: text/html; charset=UTF-8');
	$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
	session_start();

	$empr = $_POST['tEmpr'];

	$query = "call addEmprestimo('$empr', '".$_SESSION['user']."')";
	$result = mysqli_query($connection,$query);
	echo $query;

	if ($result) {
		header('Location: ../../leitor.php');
	} else {
		echo "Ocorreu falha! O erro foi: \"".mysqli_error($connection)."\"";
	}
	
?>