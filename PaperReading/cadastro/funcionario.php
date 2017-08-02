<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Funcionário</title>

		<?php
	        function writeInput($placeholder, $type, $name, $maxlength, $id, $value){
	            echo "<input class=\"form-control \" required id=\"&id\" placeholder=\"$placeholder\" type=\"$type\" name=\"$name\" maxlength=\"$maxlength\" value=\"$value\" />\n";
	        }
	    ?>

	    <script type="text/javascript">
        function mascaraCPF() {
            var valorCPF = document.formPagina.tCPF.value;
            var ultimoValor = document.formPagina.tCPF.value.length - 1;

            if(isNaN(parseInt(valorCPF.charAt(ultimoValor))) == true) {
                valorCPF = valorCPF.replace(valorCPF.charAt(ultimoValor), "");
                document.formPagina.tCPF.value = valorCPF;
            } else {
                if (valorCPF.length == 3) document.formPagina.tCPF.value = document.formPagina.tCPF.value + ".";    
                if (valorCPF.length == 7) document.formPagina.tCPF.value = document.formPagina.tCPF.value + ".";
                if (valorCPF.length == 11) document.formPagina.tCPF.value = document.formPagina.tCPF.value + "-";
            }
        }
    </script>

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
		          <h1 class="text-center">Registro Funcionário</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" name="formPagina" method="post" action="salvarCadastro/funcionario.php">
		            <?php
				        writeInput("Nome Completo", "text", "tNome", "90","tNome", "");
				        writeInput("Senha","password","tSenha","40", "tSenha", "");
				        echo "<br/>";
				        echo "<input class=\"form-control\" id=\"tCPF\" placeholder=\"CPF (APENAS NUMEROS!)\" type=\"text\"
				            name=\"tCPF\" maxlength=\"14\" value=\"\" onkeypress=\"mascaraCPF()\" required />\n";
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
				        writeInput("Cargo", "text", "tCargo", "30", "tCargo", "");
				        writeInput("Turno", "text", "tTurno", "10", "tTurno", "");
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