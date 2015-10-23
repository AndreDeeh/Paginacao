<?php
mysql_connect('localhost', 'root', '') or die('Erro ao conectar com o servidor');
mysql_select_db('paginador') or die ('Erro ao selecionar o banco de dados');

$buscar_cargo = mysql_query("SELECT idCargo, NomeCargo FROM CARGO WHERE StausCadastro = 0");
?>
<html>

	<head>
	  <title>Market Support Communication - Liberar Avaliação</title>
		<script type="text/javascript" src="../js/jquery.js"></script>
		<script type="text/javascript" src="../js/paginador.js"></script>
		<link href="../css/bootstrap.css" rel="stylesheet">
		<script>
			$(document).ready(function(){
				$("#ListarCargo").change(function(){
					var envio = $.post("../../db/getitens.php", {
					ListarCargo: $("#ListarCargo").val()
					})
					envio.fail(function() { alert("Erro na requisição"); })
				});
			});
		</script>	
	</head>

<body>
<form action="escolher_cargo.php" method="POST" id="form1" name="form1" onsubmit="return valida()">
	<div class="conteudo row">
		<div class="col-sm-12">

			<h1>Liberar Avaliação</h1>
			
			<div class="row">
				<div class="col-sm-4">
					<label for="nome">Nome da Avaliação</label> 
				</div>
				<div class="col-sm-4">
					<label for="nome">Data do Cadastro</label> 
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<input type="text" maxlength="50" placeholder="Nome" required pattern = ".{5,}" class="form-control"id="avaliacao" name="avaliacao" onkeypress="return SomenteLetra()">
				</div>
				<div class="col-sm-4">
					<input type="text" class="form-control" id="data" value="<?php echo date('d/m/Y');?>" name="data" readonly>
				</div>
			</div>
			<br>
			<div class = "row">
				<div class="col-sm-8">
					<label>Escolha o Cargo:</label><br>
					<select class="form-control"  id='ListarCargo' name='ListarCargo' style="text-transform: uppercase"> </P>
						<!-- loop para carregar o select através do banco --->
						<option>SELECIONE</option>
						<?php 
							while($cargo = mysql_fetch_array($buscar_cargo)) 
							{
								echo "<option value=" . $cargo['idCargo'] . ">" . utf8_encode($cargo['NomeCargo']) . "</option>";
							} 
						?>		
					</select>
				</div>
				<div class="col-sm-4">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-8">
					<br>
					<table class='table table-hover table-bordered table-striped' id="conteudo" width="100%">
						
					</table>
				</div>
				<div class="col-sm-4">
				</div>
				<div class="col-sm-8">
					<table class='table table-hover table-bordered table-striped' id="paginador">
						
					</table>
				</div>
				<div class="col-sm-4">
				</div>		
			</div>
		</div>
	</div>
</form>
<script>
function valida(){
 
 //valida campos checkbox  
    var todos_inputs = document.getElementsByTagName('input');    
    for (var i=0; i<todos_inputs.length; i++)
	{
        if(todos_inputs[i].id == "habilita")
		{
             if(todos_inputs[i].checked == true)
			 {
                   var ok = true;
                   break;
             }
        }
    }
     if (ok != true){
     alert('selecione a habilitacao!');
     return false;
     } 
}

</script>
</body>
