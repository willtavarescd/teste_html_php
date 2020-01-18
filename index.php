<?php
require_once("cadastro.php");
$exibe = new cadastros();
$resultadoP = $exibe->listarProf();
$resultadoU = $exibe->listarUsuarios();
?>

<html>
    <head>
                 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>cadastros simples</title>
    </head>
<body>

<div class="container" style="margin-top: 40px">
    
    <div class="row">
    <div class="col col-5 border border-secondary">
        
    
<form action="" method="post">
    Nome: <input type="text" name="nome" class='form-control form-control-sm border border-primary' required>
    E-mail <input type="email" name="email" class="form-control form-control-sm border border-primary" required>
    Profissão: <select name="pro" class="form-control form-control-sm border border-primary" required>
    <option value=""></option>
    <?php
    foreach($resultadoP as $indice){
   echo "<option value=" . $indice["id_profissao"] . ">" . $indice["profissao"] . "</option>";
   
}
    
    ?>

    </select><br/>
<input type="submit" name="opcao" class="btn btn-sm btn-outline-primary" value="Cadastro" >
    </form>
        </div>
        
        
            <div class="col offset-2 col-4 border border-secondary ">
        
    
<form action="" method="post">
    Nome da profissão: <input type="text" name="nome" class='form-control form-control-sm border border-primary' required>
   <Br/>
<input type="submit" name="opcao" class="btn btn-sm btn-outline-primary"  value="Cadastrar Profissão" >
    </form>
        </div>
    </div>
    <br/>
    <br/>
    
    
<div class="alert alert-danger alert-dismissible fade show" id="msg" role="alert" <?php if(isset($resp)){echo "style='display: block'";}else{ echo "style='display: none'";} ?> >

  <strong>Mensagem : </strong> <?php if(isset($resp)){echo $resp;} ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"  onclick="fechar();">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
    
    
    
    <table class="table" >
  <thead>
    <tr>
      <th scope="col">Nome</th>
      <th scope="col">E-mail</th>
      <th scope="col">Profissão</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>

    
    
    
       <?php
foreach($resultadoU as $indice){
    echo "<tr>";
    echo "<form action='' method='post' >";
    
    echo "<input type='text' name='id' value='" . $indice["id"] . "' hidden>" ;
    echo "<td><input type='text' name='nome' value='" . $indice["nome"] . "' onkeyup='mudar(" . $indice["id"] . ");' class='form-control form-control-sm border border-primary' required></td>" ;
    echo "<td><input type='email' name='email' value='" . $indice["email"] . "' onkeyup='mudar(" . $indice["id"] . ");' class='form-control form-control-sm border border-primary' required></td>" ;
    echo "<td><select name='pro' onchange='mudar(" . $indice["id"] . ");' class='form-control form-control-sm border border-primary' required>";
    $idu = $indice["id"];
    $proU = $indice["id_p"];
    foreach($resultadoP as $indice){
        
        if($indice["id_profissao"] == $proU){
            $marca= "selected";}else{ $marca ="";}
        
        echo "<option value='" . $indice["id_profissao"] . "'". $marca . " >" . $indice["profissao"] . "</option>";
   
}
  echo "</select></td>";
    echo "<td><input type='submit' id='" . $idu . "' name='opcao' value='Atualizar' style='display: none'></td>";
    echo "<td><input type='submit' name='opcao' value='Excluir'></td>";
    echo "</form>";
    echo "</tr>";
    
    
    
   
}
    
    ?> 
  </tbody>
</table>
    </div>    
<script>
function mudar(id){
    document.getElementById(id).style.display="inline";
} 
function fechar(){
    document.getElementById("msg").style.display="none";
}    
    
</script>  
    
</body>
</html>