<?php

class Produtos
{

    private $Data;
    private $Id;
    private $Resultado;

    const BD = 'produtos';

    public function CriarProduto(array $data)
    {

        $this->Data = $data;

        if(in_array('', $this->Data)){

                       $this->Resultado = false;
          
        }else{
            if(isset($this->Data['capa'])){
                $enviaFoto = new Uploads('../../uploads/');
                $enviaFoto->Image($this->Data['capa'], date('Y-m-d').time());
             }
             if(isset($enviaFoto) && $enviaFoto->getResult()){
                $this->Data['capa'] = $this->Data['capa'] != null ?  $enviaFoto->getResult() : null;
                
                    $this->Banco();
                    $this->Criar();
             }
        }

    }

    public function upProduto( int $id, array $data)
    {
        $this->Id = $id;
        $this->Data = $data;
        if(!$this->Data){
        return $this-> Resultado = false;
        }

        $this->Banco();
      $this->addImagemNova();
      $this->atualizaProdutoNaLoja();

    }


   public function excluirProduto(int $id)
    {
        $this->Id = (int) $id;
    if(!$id){
      return $this->Resultado = false;
    }

     $this->vaiExcluirDoiBd();
    }

    public function getResultado()
    {
        return $this->Resultado;
    }


    private function addImagemNova()
    {
      if(isset($this->Data['capa'])){
        $enviaFoto = new Uploads('../../uploads/');
        $enviaFoto->Image($this->Data['capa'], date('Y-m-d-').time());

      }
      if(isset($enviaFoto) && $enviaFoto->getResult()){
        $this->Data['capa']  = $this->Data['capa'] != null ? $enviaFoto->getResult() : null; 
      }
    }


    //private

    private function Banco()
    {

        $capa = $this->Data['capa'];

        unset($this->Data['capa']);

        $this->Data = array_map('addslashes', $this->Data);
        $this->Data = array_map('htmlspecialchars', $this->Data);
        $this->Data = array_map('trim', $this->Data);
        preg_replace('/[^[:alnum:]@]/', '',  $this->Data);
        $this->Data['categoria'] = (string) $this->Data['categoria'];
        $this->Data['capa'] = $capa;
        $this->Data['nome'] = (string) $this->Data['nome'];
        $this->Data['valor'] = (string) $this->Data['valor'];
        $this->Data['link'] = (string) $this->Data['link'];
        $this->Data['data'] = date('Y-m-d H:i:s');
        
    }


    private function Criar()
    {
        $criar = new Criar();
        $criar->Criacao(self::BD, $this->Data);
        if(!$criar->getResultado()){
            $this->Resultado = false;
        }else{
            $this->Resultado = true;
        }
    }

    private function atualizaProdutoNaLoja()
    {
      $atualizar = new Atualizar();
      $atualizar->Atualizando(self::BD, $this->Data, "WHERE id = :id", "id={$this->Id}");
      if($atualizar->getResultado()){
        return $this->Resultado = true;
      }
    }


   private function vaiExcluirDoiBd()
   {
    $excluir = new Excluir();
    $excluir->Remover(self::BD, "WHERE id= :id", "id={$this->Id}");
    if($excluir->getResultado()){
       return $this->Resultado = true;
    }
   }

}

?>