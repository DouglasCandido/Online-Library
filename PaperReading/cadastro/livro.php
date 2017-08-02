<!DOCTYPE html>
<html>
<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="../css/bootstrap.min.css" rel="stylesheet">
		<link href="css/styles.css" rel="stylesheet">
		<title>Livro</title>

		<?php
			
	        function writeInput($placeholder, $type, $name, $maxlength, $id, $value){
	            echo "<input class=\"form-control \" required id=\"$id\" placeholder=\"$placeholder\" type=\"$type\" name=\"$name\" maxlength=\"$maxlength\" value=\"$value\" />\n";
	        }

	        function writeSelectAutores(){

			    $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");

			    $query = "select * from getAutor";

			    $autores = mysqli_query($connection,$query);

			    echo "<select required style=\"background-color: rgba(0,0,0,0.1); border-color: darkgrey;\" class=\"form-control\" id=\"tAutor\" name=\"tAutor\">";
			    while(($autor = mysqli_fetch_array($autores)) != null){
			        echo "<option value=\"".$autor['codAutor']."\">".$autor['nome']."</option>";
			        echo "aaa";
			    }
			    echo "</select>";
			}

			function writeSelectEditoras(){

			    $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");

			    $query = "select * from getEditora";

			    $editoras = mysqli_query($connection,$query);

			    echo "<select required style=\"background-color: rgba(0,0,0,0.1); border-color: darkgrey;\" class=\"form-control\" id=\"tEditora\" name=\"tEditora\">";
			    while(($editora = mysqli_fetch_array($editoras)) != null){
			        echo "<option value=\"".$editora['codeditora']."\">".$editora['nome']."</option>";
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
		          <h1 class="text-center">Registro Livro</h1>
		      </div>
		      <div class="modal-body">
		          <form class="form col-md-12 center-block" name="formPagina" method="post" action="salvarCadastro/livro.php">
		            <?php
				        writeInput("Título", "text", "tNome", "90","tNome", "");
				        writeInput("ISBN","text","tIsbn","14", "tIsbn", "");
				        echo "<br/>";
				        writeInput("Edição", "number", "tEd", "10", "tEd", "");
				        writeInput("Quantidade de Exemplares", "number", "tNumber", "", "tNumber", "");
				        echo "<br/>";
				        writeInput("Ano","number","tAno","4", "tAno", "");
				        echo "<select required style=\"background-color: rgba(0,0,0,0.1); border-color: darkgrey;\" class=\"form-control\" id=\"tGen\" name=\"tGen\">";
				        echo "<option style=\"height: 46px; padding: 10px 16px; font-size: 18px; line-height: 1.3333333; border-radius: 6px;\" value=\"\">Gênero</option>";
				                

				                $connection = mysqli_connect("127.0.0.1","root","","bibliotecabdd");
				                $query = "select * from getGen;";

				                $gens = mysqli_query($connection, $query);
				                while(($gen = mysqli_fetch_array($gens)) != null) {
				                    echo "<option value='$gen[codGenero]'>$gen[genero]</option>";
				                }

				        echo ("</select>");
				        writeSelectAutores();
				        writeSelectEditoras();
				    	echo "<br/>";
				        writeInput("Descrição", "text", "tDescricao", "90", "tDescricao", "");
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