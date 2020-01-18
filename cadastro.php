<?php
require_once("classcad.php");
if($_POST){
    $opcao = $_POST['opcao'];
    
    if(isset($_POST['id'])){
        $id = $_POST['id'];
    }
    if(isset($_POST['nome'])){
        $nome = $_POST['nome'];
    }
    if(isset($_POST['email'])){
        $email = $_POST['email'];
    }
    if(isset($_POST['pro'])){
        $pro = $_POST['pro'];
    }
    
    
    
if($opcao == "Cadastro"){
    $cad = new cadastros();
    $cad->cadUsuario($nome, $email, $pro);
    $resposta = $cad->getRetorno();
    $resp = $resposta["resultado"];
    
}

if($opcao == "Atualizar"){
    $cad = new cadastros();
    $cad->atualizaU($id, $nome, $email, $pro);
    $resposta = $cad->getRetorno();
    $resp =  $resposta["resultado"];
    
}
    
if($opcao == "Excluir"){
    $cad = new cadastros();
    $cad->apagaU($id);
    $resposta = $cad->getRetorno();
    $resp =  $resposta["resultado"];
    
}
    
if($opcao == "Cadastrar Profissão"){
    $cad = new cadastros();
    $cad->cadPro($nome);
    $resposta = $cad->getRetorno();
    $resp = $resposta["resultado"];
    
}
    
}


?>