<?php
require_once("sql.php");

class cadastros{
    private $id;
    private $nome;
    private $email;
    private $pro;
    private $retorno;
    

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }
    
    public function getNome(){
        return $this->nome;
    }
    public function setNome($nome){
        $this->nome = $nome;
    }
    
    public function getEmail(){
        return $this->email;
    }
    public function setEmail($email){
        $this->email = $email;
    }
    
    public function getPro(){
        return $this->pro;
    }
    public function setPro($pro){
        $this->pro = $pro;
    }
    
    public function getRetorno(){
        return $this->retorno;
    }
    public function setRetorno($retorno){
        $this->retorno = $retorno;
    }

    public function cadPro($nome){
      
            $this->setNome($nome);
            
            $sql = new sql();
            $resultado = $sql->select("call sp_profissao(:NOME);", array(
            ":NOME"=>$this->getNome()
            ));
        
            $sql->desliga();
            
        if(!empty($resultado)){          
            if(count($resultado)>0){
                $this->setRetorno($resultado[0]);
            }          
        }else{
          $resultado = array(
              array ("resultado" => "ocorreu um erro ao tentar cadastrar, não esqueça de preencher os campos")
              );
            $this->setRetorno($resultado[0]);
        }
    }
        
    public function cadUsuario($nome,$email,$pro){
      
            $this->setNome($nome);
            $this->setEmail($email);
            $this->setPro($pro);
            
            $sql = new sql();
            $resultado = $sql->select("call sp_usuario(:NOME, :EMAIL, :PRO);", array(
            ":NOME"=>$this->getNome(),
            ":EMAIL"=>$this->getEmail(),
            ":PRO"=>$this->getPro()
            ));
        
            $sql->desliga();
            
        if(!empty($resultado)){          
            if(count($resultado)>0){
                $this->setRetorno($resultado[0]);
            }          
        }else{

          $resultado = array(
              array ("resultado" => "ocorreu um erro ao tentar cadastrar, não esqueça de preencher os campos")
              );
            $this->setRetorno($resultado[0]);
        }
    }
    
    public function atualizaU($id, $nome,$email,$pro){
      
            $this->setId($id);
            $this->setNome($nome);
            $this->setEmail($email);
            $this->setPro($pro);
            
            $sql = new sql();
            $resultado = $sql->select("call sp_atualiza(:ID, :NOME, :EMAIL, :PRO);", array(
            ":ID"=>$this->getID(),
            ":NOME"=>$this->getNome(),
            ":EMAIL"=>$this->getEmail(),
            ":PRO"=>$this->getPro()
            ));
        
            $sql->desliga();
            
        if(!empty($resultado)){          
            if(count($resultado)>0){
                $this->setRetorno($resultado[0]);
            }          
        }else{
            
          $resultado = array(
              array ("resultado" => "ocorreu um erro ao tentar atualizar")
              );
            $this->setRetorno($resultado[0]);
          
        }
    }

    public function apagaU($id){
      
            $this->setId($id);
            
            $sql = new sql();
            $resultado = $sql->select("call sp_apaga(:ID);", array(
            ":ID"=>$this->getId()
            ));
        
            $sql->desliga();
            
        if(!empty($resultado)){          
            if(count($resultado)>0){
                $this->setRetorno($resultado[0]);
            }          
        }else{
              $resultado = array(
              array ("resultado" => "ocorreu um erro ao tentar Apagar cadastro")
              );
            $this->setRetorno($resultado[0]);
        }
    }
    
    
    public function listarUsuarios(){

    $sql = new sql();
    return $sql->select("select * from exibeusuarios;");
    $sql->desliga();
    }
    
    public function listarProf(){

    $sql = new sql();
    return $sql->select("select * from tb_profissao");
    $sql->desliga();
    }
    
}

?>