<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Editora</title>

		<?php
	        function writeInput($placeholder, $type, $name, $maxlength, $id, $value){
	            echo "<input class=\"form-control \" required id=\"$id\" placeholder=\"$placeholder\" type=\"$type\" name=\"$name\" maxlength=\"$maxlength\" value=\"$value\" />\n";
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
		          <h1 class="text-center">Registro Editora</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" name="formPagina" method="post" action="salvarCadastro/editora.php">
		            <?php
				        writeInput("Nome", "text", "tNome", "90","tNome", "");
				        writeInput("CNPJ","text","tCnpj","40", "tCnpj", "");
				        echo "<br/>";
				        writeInput("Telefone", "number", "tTel", "10", "tTel", "");
				        writeInput("Email", "email", "tEmail", "90", "tEmail", "");
				        echo "<br/>";
				        writeInput("Cidade","text","tCidade","40", "tCidade", "");
				        echo "<select required style=\"background-color: rgba(0,0,0,0.1); border-color: darkgrey;\" class=\"form-control\" id=\"tUf\" name=\"tUf\">";
				        echo "<option style=\"height: 46px; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; border-radius: 6px;\" value=\"\">UF</option>";
				                

				                $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
				                $query = "select * from getUfs;";

				                $ufs = mysqli_query($connection, $query);
				                while(($uf = mysqli_fetch_array($ufs)) != null) {
				                    echo "<option value='$uf[codUf]'>$uf[sigla]</option>";
				                }

				        echo ("</select>");
				    	echo "<br/>";
				        writeInput("Rua", "text", "tRua", "90", "tRua", "");
				        writeInput("Bairro", "text", "tBairro", "90", "tBairro", "");
				        writeInput("Numero", "number", "tNumero", "11", "tNumero", "");
				        echo "<br/>";
				        echo "<button class=\"btn btn-primary btn-lg btn-block\" style=\"background-color: rgba(0,0,0,0.8); border-color: #ccc;\">Cadastrar</button>";
				        writeInput("", "reset", "bLimpar", "", "", "Limpar");
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