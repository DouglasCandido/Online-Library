<?php
    header ('Content-type: text/html; charset=UTF-8');

	/*Macumba pra subtracao de datas*/
	function gerarPena(){
		$diaDeAtraso = 0;
		$today = date("Y-m-d", strtotime("now"));
		
		while ($today > $_POST['devol'] && $diaDeAtraso < 10) {
			
			$_POST['devol'] = date("Y-m-d", strtotime($_POST['devol']." + 1 day"));
			$diaDeAtraso++;
		}
		return $diaDeAtraso;
	}

	function hasPena(){
		$today = date("Y-m-d", strtotime("now"));
		if ($today > $_POST['devol']) {
			return true;
		}
		return false;
	}

	session_start();

	$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
	$codEmp = $_POST['codEmprestimo'];
	$codExemp = $_POST['codExemplar'];

	$qtd = 0;
	$query = "select * from getemprestimos where cod = '".$_SESSION['user']."'";
	$result = mysqli_query($connection, $query);
	if ($result) {
		while (($qtds = mysqli_fetch_array($result)) != null) {
			$qtd = $qtds['emprestimos'];
		}
	}

	$qtd--;

	$query = "call devolver('$codEmp', '$qtd', '".$_SESSION['user']."', '$codExemp',".date("Y-m-d", strtotime("now")).")";
	$result = mysqli_query($connection,$query);

	if ($result) {
		
	} else {
		echo mysqli_error($connection);
	}

	if (hasPena()) {
		$tDiasMulta = 3 * gerarPena();

		$query = "select penalizado from leitor where codLeitor = ".$_SESSION['user'];
		$penalizado = mysqli_fetch_array(mysqli_query($connection,$query))['penalizado'];

		if ($penalizado == "0") {
			$query = "update leitor set penalizado = 1 where codLeitor = ".$_SESSION['user'];
			mysqli_query($connection,$query);

			$query = "insert into penalizacao(codLeitor,dtInicio,dtFim) 
				values (".$_SESSION['user'].",
				curdate(),
				(CURDATE() + interval ".$tDiasMulta." day))";
			mysqli_query($connection,$query);

		}else{
			$query = "select dtFim from penalizacao where codLeitor = ".$_SESSION['user'];;
			$dtFim = mysqli_fetch_array(mysqli_query($connection,$query))['dtFim'];

			$query = "update penalizacao set dtFim = ".date("Y-m-d", strtotime($dtFim." + ".$tDiasMulta." day"))." where codLeitor = ".$_SESSION['user'];
			mysqli_query($connection,$query);
		}
	}

	header('Location: ../../leitor.php');
?>