<?php

// require_once('../Categorie.php');
// require_once('../Driver.php');

class AdminCategorieModel extends Driver{

    public function getCategories(){
        $sql = "SELECT *
                FROM categorie";

        $result = $this->getRequest($sql);
        // quand tu fais appel a une autre requete et tu veux le coller de cette fonction donc $this represente l'objet

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        //orm
        $tabCat = [];

        foreach ($rows as $row) {
            $cat = new Categorie();
            //nous creeons une instance de catgorie pour coller les infos que nous recuperons de la base de donnee à notre class, puisqu'elle est vide et ainsi interagir avec la base de donnée on met tout ca dans la methode getCategorie pour etre ainsi appeler dans le controller
            $cat->setId_cat($row->id_cat);
            $cat->setNom_cat($row->nom_cat);
            array_push($tabCat, $cat);
        }
        return $tabCat;
    }

    public function deleteCat($id){
        $sql = "DELETE FROM categorie
                WHERE id_cat = :id";
        $result = $this->getRequest($sql, ['id'=>$id]);
        $nb = $result->rowCount();//Pour connaitre le nbr de ligne impacté
        return $nb;
    }

    public function categorieItem($id){
        $sql = "SELECT *
                FROM categorie
                WHERE id_cat = :id";
        $result = $this->getRequest($sql,['id'=>$id]);
        if($result->rowCount() > 0){

            $row = $result->fetch(PDO::FETCH_OBJ);
            
            $cat = new Categorie();
            $cat->setId_cat($row->id_cat);//il attend un objet et non pas un tableau fetchAll recupere un tableau , et nous on a qu'une seule ligne donc un objet
            $cat->setNom_cat($row->nom_cat);

            return $cat;

        }
    }

    public function updateCategorie(Categorie $cat){ // pour lui passer un objet on veut tout lui donnerid et le nom
        $sql = "UPDATE categorie
                SET nom_cat = :nom
                WHERE id_cat = :id";
        
        $result = $this->getRequest($sql, ['nom'=>$cat->getNom_cat(), 'id'=>$cat->getId_cat()]);

        if($result->rowCount() > 0){
            $nb = $result->rowCount();//C'est le ocntroller qui va nous rediriger
            return $nb;
        }
    }

    public function insertCategorie(Categorie $cat){
        $sql = "INSERT INTO categorie(nom_cat)
                VALUES(:nom)";
        $result = $this->getRequest($sql,array('nom'=>$cat->getNom_cat()));

        return $result;

    }
}

//$adminCat = new AdminCategorieModel();
//var_dump($adminCat->getCategories());
//Le require ainsi que le vardump sont en commentaires c'etait pour tester si le message circulait