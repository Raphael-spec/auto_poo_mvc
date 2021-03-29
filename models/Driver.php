<?php

abstract class Driver{
    //Abstrait pour que nous ayons pas a faire une instance

    private static $bd;

    /**
     * Get the value of bd
     */ 
    private static function getBd()
    {
        if(self::$bd === null){//empty, on peut mettre a la place de null
            try{
                self::$bd = new PDO('mysql:host=localhost; dbname=auto','root','');
                self::$bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                echo'ok...';
            }catch(PDOException $e){
                die($e->getMessage());
            }

        }
        return self::$bd;
    }

    protected function getRequest($sql, $params = null){
        $result = self::getBd()->prepare($sql);//verifie que la requete est bonne
        $result->execute($params);
        //Cette fonction aete cree de fonction a ce nous ayons pas a repeter cette syntaxe pour faire appel aune requete

        return $result;
    }
}

