<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Funcionário</title>

		<?php

    	function login(){    		

				/*?>
	    			<script type="text/javascript">
	    				alert("Usuário não existe");
	    			</script>
    			<?php
    			*/
    		if (!isset($_POST['user']) || !isset($_POST['pass'])) {
    			return false;
    		}

    		$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");

			$query = "call checkIfUserExists(".$_POST['user'].")";
			
			if (mysqli_num_rows(mysqli_query($connection, $query)) == 0){
				?>
	    			<script type="text/javascript">
	    				alert("Usuário não existe");
	    			</script>
    			<?php
				
				return false;
			}else{	
			
				$password = $_POST['pass'];
				$user = $_POST['user'];
				
				mysqli_next_result($connection);
				
				$query = "call checkPassword('$password', $user)";
				$result = mysqli_query($connection, $query);
				
				if (mysqli_num_rows($result) == 0) {
					?>
		    			<script type="text/javascript">
		    				alert("Senha incorreta!");
		    			</script>
	    			<?php
					
					return false;
				}else{
					
					mysqli_next_result($connection);
					
					$query = "call isFuncionario('".$_POST['user']."')";
					$result = mysqli_query($connection, $query);
					
					if (!$result || mysqli_num_rows($result) == 0){
						?>
			    			<script type="text/javascript">
			    				alert("Você não está cadastrado como funcionario");
			    			</script>
		    			<?php

						return false;
					}else{
						session_start();
						$_SESSION['user'] = $_POST['user'];
						$_SESSION['pass'] = $_POST['pass'];
						$_SESSION['tipo'] = $_POST['tipo'];
						
						return true;
						session_destroy();
					}
				}
			}}
		function empPendentes(){
			$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");

			$query = "select * from emprestimosPendentes";
			$result = mysqli_query($connection, $query);

			if ($result) {
				if(mysqli_num_rows($result) == 0){
					echo "<h3 align=\"center\">Não existem empréstimos pendentes</h3>";
				} else {
					while (($emp = mysqli_fetch_array($result)) != null) { 
						$codEmp = $emp['codEmprestimo'];
						$nome = $emp['nomeLeitor'];
						$livro = $emp['tituloLivro'];
						$codExemp = $emp['exemplar'];
						$codLei = $emp['codLei'];
						?>
						<form style="margin-bottom: 10px;" class="form col-md-4 center-block" align="center" method="post" action="emprestimosPendentes.php">
							<fieldset style="padding: 15px; background-color: #EEE9E9;">
								<b><?= $nome?> </b> solicita <b><?= $livro?></b><br/>
								Aprovado
								<input class="short" type="radio" id="aprovado" name="aprovado" value="1" checked />
								<br/>
								Negado
								<input class="short" type="radio" id="negado" name="aprovado" value="0" />
								<br/>
								<button class="btn btn-primary btn-lg btn-block" style="background-color: rgba(0,0,0,0.8); border-color: #ccc;">Confirmar</button>
								<input type="hidden" name="codEmp" value="<?= $codEmp?>"/>
								<input type="hidden" name="codExe" value="<?= $codExemp?>"/>
								<input type="hidden" name="codLei" value="<?=$codLei?>" />
							</fieldset>
						</form>


				<?php 
					}
				}
			} else {
				echo mysqli_error($connection);
			}
		} ?>
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

	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
	                </div>
	            </div>
	        </nav>
			
			<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); top: 50px;">
			  <div style="top: 0px; width: 100%; height: 100%; background-color: white;">
			      <div class="modal-header">
			          <h1 class="text-center">Aprovar Empréstimos</h1>
			      </div>
			      <div class="modal-body" style="overflow-y: scroll; height: 100%;">
			      		<?php empPendentes();

			      		$connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
			      		$query = "select * from getMaiorLeitor";			 
			      		$result = mysqli_query($connection, $query);

			      		?>
			      			<div class="col-lg-12-offset"></div>
			      		<?php

			      		if ($result) {
			      			while (($qtds = mysqli_fetch_array($result)) != null) {
			      				?>
								
								<hr/><br/><h4>Leitor que pegou mais livros: <b><?= $qtds[1]?></b> efetuou empréstimo de <b><?= $qtds[0]?></b> livros</h4>
								<?php
							}
			      		} else {
			      			echo mysqli_error($connection);
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
		          <h1 class="text-center">Login Funcionário</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" method="post" action="funcionario.php">
		            <div class="form-group">
		              <input type="number" name="user" class="form-control input-lg" placeholder="Número de Login" required>
		            </div>
		            <div class="form-group">
		              <input type="password" name="pass" class="form-control input-lg" placeholder="Senha" required>
		            </div>
		            <input type="hidden" name="tipo" value="funcionario"/>
		            <div class="form-group">
		              <button class="btn btn-primary btn-lg btn-block" style="background-color: rgba(0,0,0,0.8); border-color: #ccc;">LOGIN</button>
		              <span class="pull-right"><a href="cadastro/funcionario.php" style="color: gray;">Fazer registro</a></span>
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