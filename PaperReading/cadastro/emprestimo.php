<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Empréstimo</title>

		<?php
	        function writeInput($placeholder, $type, $name, $maxlength, $id, $value){
	            echo "<input class=\"form-control \" required id=\"$id\" placeholder=\"$placeholder\" type=\"$type\" name=\"$name\" maxlength=\"$maxlength\" value=\"$value\" />\n";
	        }

	        function writeLivrosDisponiveis() {
		        $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");

		        $query = "select * from livrosDisponiveis";
		        $exemplares = mysqli_query($connection,$query);

		        echo "<select required style=\"background-color: rgba(0,0,0,0.1); border-color: darkgrey;\" class=\"form-control\" id=\"tEmpr\" name=\"tEmpr\">";
		        while (($unid = mysqli_fetch_array($exemplares)) != null) {
		            echo "<option value=\"".$unid['cod']."\">".$unid['t']."</option> \n";
		        }
		        echo "</select>";  
		    }
	    ?>
	</head>
	<body style="background: url('../img/biblioteca.jpg'); background-size: cover;">
		<nav class="navbar navbar-default navbar-fixed-top topnav nav-down" style="background-color: rgb(25,25,25);" role="navigation">
            <div class="container topnav">

                <a  name="inicio"></a>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Navegação</span>
                    </button>
                    <a style="color: white;" class="navbar-brand topnav" href="../index.html">PaperReading</a>
                </div>
            </div>
        </nav>

		<div id="loginModal" class="modal show" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.6); top: 50px; overflow-y: scroll;">
		  <div class="modal-dialog">
		  <div class="modal-content" style="top: 0px;">
		      <div class="modal-header">
		          <h1 class="text-center">Realizar empréstimo</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" name="formPagina" method="post" action="salvarCadastro/emprestimo.php">
		            <?php
				        writeLivrosDisponiveis();
				        echo "<br/>";
				        echo "<button class=\"btn btn-primary btn-lg btn-block\" style=\"background-color: rgba(0,0,0,0.8); border-color: #ccc;\">Cadastrar</button>";
				    ?>
		          </form>
		      </div>
		      <div class="modal-footer">	
		      </div>
		  </div>
		  </div>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>
</html>