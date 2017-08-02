<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Leitor</title>

		<?php

			function login(){

	    		if (!isset($_POST['user']) || !isset($_POST['pass'])) {
	    			return false;
	    		}

				$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
				$query = "call checkIfUserExists(".$_POST['user'].")";

				$result = mysqli_query($connection, $query);

				if (!$result || mysqli_num_rows($result) == 0) {
					?>
		    			<script type="text/javascript">
		    				alert("Usuário não existe");
		    			</script>
	    			<?php
				
					return false;
				} else {
					
					mysqli_next_result($connection);
					
					$query = "call checkPassword('".$_POST['pass']."', ".$_POST['user'].")";
					$result = mysqli_query($connection, $query);					
					if (!$result || mysqli_num_rows($result) == 0) {
						?>
			    			<script type="text/javascript">
			    				alert("Senha Incorreta");
			    			</script>
		    			<?php
					
						return false;
					} else {
						mysqli_next_result($connection);

						$query = "call isLeitor('".$_POST['user']."')";
				
						$result = mysqli_query($connection, $query);

						if (($user = mysqli_fetch_array($result)) == null) {
							?>
				    			<script type="text/javascript">
				    				alert("Você não está cadastrado como leitor");
				    			</script>
			    			<?php

							return false;
						}else{
							session_start();
							$_SESSION['user'] = $_POST['user'];
							$_SESSION['pass'] = $_POST['pass'];
							$_SESSION['tipo'] = $_POST['tipo'];
							$_SESSION['qtdEmprestimos'] = $user['qtdEmprestimos'];
							$_SESSION['penalizado'] = $user['penalizado'];
							$_SESSION['codleitor'] = $user['codLeitor'];
							return true;
						}
					}
				}
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
	                <!-- <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                    <ul class="nav navbar-nav navbar-right">
	                        <li>
	                            <a style="color: white;" href="cadastro/livro.php">Cadastrar um livro!</a>
	                        </li>
	                        <li>
	                            <a style="color: white;" href="cadastro/autor.php">Cadastrar um autor!</a>
	                        </li>
	                        <li>
	                            <a style="color: white;" href="cadastro/editora.php">Cadastrar uma editora!</a>
	                        </li>
	                    </ul>
	                </div> -->
	            </div>
	        </nav>
			
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); top: 50px;">
			  <div style="top: 0px; width: 100%; height: 100%; background-color: white;">
			      <div class="modal-header">
			          <h1 class="text-center">Empréstimos</h1>
			      </div>
			      <div class="modal-body" style="overflow-y: scroll; height: 100%;">
			      		<?php

			      			if ($_SESSION['penalizado'] == 1) {
								$query = "select * from penalizacao where codLeitor = ".$_SESSION['user'];
								$dtFim = mysqli_fetch_array(mysqli_query($connection,$query))['dtFim'];
								echo "<h1>Voce esta penalizado ate $dtFim</h1>";
							} else {

				      			if ($_SESSION['qtdEmprestimos'] < 3){
									?>
										<a class="btn-lg btn-primary btn btn-block" style="background-color: rgba(34, 139, 34 ,0.8); border-color: #006400;" href="cadastro/emprestimo.php">Realizar empréstimos</a>
									<?php
								} else {
									?>
										<h3 align="center">Você já tem 3 empréstimos, faça devoluções para poder pegar mais exemplares!</h3>
									<?php
								}
								if ($_SESSION['qtdEmprestimos'] > 0) {
									?>
										<a class="btn btn-primary btn-lg btn-block" style="background-color: #1E90FF; border-color: #4682B4;" href="cadastro/devolucoes.php">Fazer devoluções</a>
									<?php
								}
							}
			      		?>
			      </div>
			      <div class="modal-footer">	
			      </div>
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
		  <div class="modal-dialog">
		  <div class="modal-content" style="top: 60px;">
		      <div class="modal-header">
		          <h1 class="text-center">Login Leitor</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" method="post" action="leitor.php">
		            <div class="form-group">
		              <input type="number" name="user" required class="form-control input-lg" placeholder="Código de usuário">
		            </div>
		            <div class="form-group">
		              <input type="password" name="pass" required class="form-control input-lg" placeholder="Senha	">
		            </div>
		            <input type="hidden" name="tipo" value="usuario"/>
		            <div class="form-group">
		              <button class="btn btn-primary btn-lg btn-block" style="background-color: rgba(0,0,0,0.8); border-color: #ccc;">LOGIN</button>
		              <span class="pull-right"><a href="cadastro/leitor.php" style="color: gray;">Fazer registro</a></span>
		            </div>
		          </form>
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