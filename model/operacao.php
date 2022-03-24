<?php

class Operacao{
    private $con;

    function __construct()
    {
        require_once dirname(__FILE__).'./Conexao.php';

        $bd = new Conexao();

        $this->con = $bd->connect();
    }

    function createFruta($campo_2,$campo_3,$campo_4){
        $stmt = $this->con->prepare("INSERT INTO fruta ('nomeFruta','imgFruta','valorFruta')VALUES(?,?,?)");
        $stmt->bind_param("sss",$campo_2,$campo_3,$campo_4);
            if($stmt->execute())
                return true;
            return var_dump($stmt);
    }

    function getFrutas(){
        $stmt = $this->con->prepare("Select * from fruta");
        $stmt->execute();
        $stmt->bind_result($uidFruta,$nomeFruta,$imgFruta,$valorFruta);

        $dicas = array();

        while($stmt->fetch()){
            $dica = array();
            $dica['uidFruta'] = $uidFruta;
            $dica['nomeFruta'] = $nomeFruta;
            $dica['imgFruta'] = $imgFruta;
            $dica['valorFruta'] = $valorFruta;
            array_push($dicas,$dica);
        }
        return $dicas;
    }

    function updateFrutas($campo_1,$campo_2,$campo_3,$campo_4){
        $stmt = $this->con->prepare("update fruta set nomeFruta = ? ,imgFruta = ? ,valorFruta = ? where uidFruta = ?");
        $stmt->bind_param('sssi',$campo_2,$campo_3,$campo_4,$campo_1);
        if($stmt->execute())
            return true;
        return false;
    }

    function deleteFrutas($campo_1){
        $stmt = $this->con->prepare("delete from fruta where uidFruta= ?");
        $stmt->bind_param("i" ,$campo_1);
        if($stmt->execute())
        return true;
    return false;
    }
}