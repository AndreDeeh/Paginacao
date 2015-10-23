			<?php

	//conexão com banco de dados
	include "conexao.php";
	
	//pegando tipo de consulta: listagem ou contador
   	$tipo=$_GET['tipo'];
	
	//recebendo o cargo escolhido
	//$cargo = $_POST['ListarCargo'];
	
	$cargo = 1;
	
	echo $cargo;
	
	//se o tipo for listagem
   	if($tipo=='listagem'){ 
   		$pag=$_GET['pag']; 
   		$maximo=$_GET['maximo'];
		$inicio = ($pag * $maximo) - $maximo; //Variável para LIMIT da sql
		?>
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
			</tr>
		</thead>
		<?php
				
		$sql="SELECT QUESTOES_CARGO.idQuestoes, QUESTOES.idQuestoes, QUESTOES.Questao FROM QUESTOES_CARGO JOIN QUESTOES ON QUESTOES_CARGO.idQuestoes = QUESTOES.idQuestoes WHERE idCargo = '$cargo' LIMIT $inicio, $maximo"; //consulta no BD
				$resultados = mysql_query($sql) //Executando consulta
				or die (mysql_error()); //Se ocorrer erro mostre-o
				if (@mysql_num_rows($resultados) == 0) //Se não retornar nada
				echo("Nenhum cadastro encontrado");
				while ($res=mysql_fetch_array($resultados)) { //laço para listagem de itens
				$id = $res[1];
				$nome = $res[2];	
			?>
			<tr>
				<td><?php echo $id ?></td>
				<td><?php echo utf8_encode($nome) ?></td>
			</tr>
			<?php } 
	//se o tipo for contador
   	}else if($tipo=='contador'){
   		$sql_res=mysql_query("SELECT * FROM QUESTOES WHERE idHabilitacoes = $cargo "); //consulta no banco
		$contador=mysql_num_rows($sql_res); //Pegando Quantidade de itens
		echo $contador;
   	}else{
   		echo "Solicitação inválida";
   	}
?>
