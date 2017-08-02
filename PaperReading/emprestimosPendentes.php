<?php 
	session_start();
	$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
	$aprovado = $_POST['aprovado'];
	$cod = $_POST['codEmp'];
	$codExemp = $_POST['codExe'];
	$codLei = $_POST['codLei'];

	$qtd = 0;
	$query = "select * from getemprestimos where cod = '$codLei'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		while (($qtds = mysqli_fetch_array($result)) != null) {
			$qtd = $qtds['emprestimos'];
		}
	}
	if ($aprovado != "1") {
		$totEmp = $qtd - 1;
		echo $totEmp;
		$query = "call updateEmprestimoLeitor('$codLei','$totEmp')";
		$result = mysqli_query($connection,$query);

		if ($result) {
			$query = "call updateEmprestimoExemplar('$codExemp', 0)";
			$result = mysqli_query($connection,$query);
			if ($result) {
				$query = "call upPendente('$cod',0,0,0)";
				$result = mysqli_query($connection,$query);
				if ($result) {
					echo "blz 0";
				} else {
					echo "erro blz 0: ".mysqli_error($connection);
				}
			} else {
				echo "erro 3: ". mysqli_error($connection);
			}
		} else {
			echo "erro 2: ".mysqli_error($connection);
		}
	} else {
		$query = "call upPendente('$cod',0,1,1)";
		$result = mysqli_query($connection,$query);
		if ($result) {
			echo "blz 1";
		} else {
			echo "erro blz 1: ".mysqli_error($connection);
		}
	}

	header('Location: index.html');

?>