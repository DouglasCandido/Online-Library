<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="../css/styles.css" rel="stylesheet">
		<title>Devoluções</title>

		<?php

    	function login(){
    		session_start();

    		if (!isset($_SESSION['user']) || !isset($_SESSION['pass'])) {
    			return false;
    		}
  

    		if ($_SESSION['tipo'] == "usuario") {
    			return true;
    		} else {
    			return false;
    		}
    	}

    	function getEmprestimos(){
			$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
			$query = "select * from emprestimo where codLeitor = ".$_SESSION['user']." AND ocorrendo = 1";
			$emprestimos = mysqli_query($connection,$query);

			$i = 0;
			$emprestimo = array();
			while (($e = mysqli_fetch_array($emprestimos)) != null){
				$emprestimo[$i++] = $e;
			}

			return $emprestimo;
		}

		function getNameByExemp($codExemp){
			$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
			$query = "select li.titulo from emprestimo em, exemplar ex, livro li where 
				em.codExemplar = ".$codExemp." AND
				em.codExemplar = ex.codExemplar AND
				ex.codLivro = li.codLivro";
			return mysqli_fetch_array(mysqli_query($connection,$query))['titulo'];
		}

    	?>
	</head>
	<body style="background: url('img/biblioteca.jpg'); background-size: cover;">
		<?php
			if (login()) {

				?>
			<nav class="navbar navbar-default navbar-fixed-top topnav nav-down" style="background-color: rgb(25,25,25);" role="navigation">
	            <div class="container topnav">
	                <a  name="inicio"></a>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
	                        <span class="sr-only">Navegação</span>
	                    </button>
	                    <a style="color: white;" class="navbar-brand topnav" href="index.html">PaperReading</a>
	                </div>
	            </div>
	        </nav>
			
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); top: 50px;">
			  <div style="top: 0px; width: 100%; height: 100%; background-color: white;">
			      <div class="modal-header">
			          <h1 class="text-center">Efetuar Devolução</h1>
			      </div>
			      <div class="modal-body" style="overflow-y: scroll; height: 100%;">
			      		<?php
			      			$e = getEmprestimos();
			      			for ($i=0; $i < sizeof($e); $i++) {
								echo "<form style=\"margin-bottom: 10px;\" class=\"form col-md-4 center-block\" method=\"post\" action=\"salvarCadastro/devolucoes.php\"><fieldset style=\"padding: 15px; background-color: #EEE9E9;\">";
								echo "<h2>Nome do exemplar:</h2> <h4>".getNameByExemp($e[$i]['codExemplar'])."</h4><h2> Inicio: </h2> <h4>".$e[$i]['dtEmprestimo']."</h4><h2> Fim: </h2><h4>".$e[$i]['dtPrevista']."</h4><button class=\"btn btn-primary btn-lg btn-block\" style=\"background-color: rgba(0,0,0,0.8); border-color: #ccc;\">Devolver</button>";
								echo "<input type=\"hidden\" name=\"codExemplar\" value=\"".$e[$i]['codExemplar']."\"/>";
								echo "<input type=\"hidden\" name=\"codEmprestimo\" value=\"".$e[$i]['codEmprestimo']."\"/>";
								echo "<input type=\"hidden\" name=\"devol\" value=\"".$e[$i]['dtPrevista']."\"/>";
								echo "</fieldset></form>\n";
							}
			      		?>
			      </div>
			      <div class="modal-footer">	
			      </div>
			  </div>
			</div>

		<?php
			} else {
		?>
		<nav class="navbar navbar-default navbar-fixed-top topnav nav-down" style="background-color: rgb(25,25,25);" role="navigation">
            <div class="container topnav">

                <a  name="inicio"></a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Navegação</span>
                    </button>
                    <a style="color: white;" class="navbar-brand topnav" href="index.html">PaperReading</a>
                </div>
            </div>
        </nav>

		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); top: 50px;">
		  <div style="top: 0px; width: 100%; height: 100%; background-color: white;">
		      <div class="modal-header">
		          <h1 class="text-center">Aprovar Empréstimos</h1>
		      </div>
		      <div class="modal-body" style="overflow-y: scroll; height: 100%;">
		      		Acesso negado!
		      </div>
		      <div class="modal-footer">	
		      </div>
		  </div>
		  </div>
		</div>

		<?php
			}

		?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>