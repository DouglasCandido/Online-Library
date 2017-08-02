<script type='text/javascritpt' src="js/jquery.js"></script>
<script type="text/javascript" src="http://www.workshop.rs/jqbargraph/jqBarGraph.js"></script>
<link rel="stylesheet" href="http://www.workshop.rs/jqbargraph/styles.css" type="text/css" />
<?php

	$connection = mysqli_connect("localhost", "root", "", "bibliotecabdd");
	$query = "select * from totalEmprestimosAluno;";

	$r = mysqli_query($connection, $query);
	?>
	<table>
		<tr>
			<th>Nome</th>
			<th>Total de Emprestimos</th>
		</tr>
	
	<?php
	while (($n = mysqli_fetch_array($r)) != null){

		echo "<tr><td>$n['nome'] </td><td>$n['tot'] </td></tr> ";
	}
	echo "</table>";


?>