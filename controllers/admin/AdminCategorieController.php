<?php

// require_once('../../models/Driver.php');
// require_once('../../models/Categorie.php');
// require_once('../../models/admin/AdminCategorieModel.php');

class AdminCategorieController{

    private $adCat;
    public function __construct()
    {   
        $this->adCat = new AdminCategorieModel();
    }

    public function listCategories(){
        //effet domino nouscreeons une instance de admincategorie model pour recuperer ces infos et les coller dans la nouvelle proprieté crée en appelant ca fonction get cetegorie dans la nouvelle fonction listcategorie et rappelle de nouveau les require de chaque element qui ont ete necessaire a l'elaboration du chemin
        $allCat = $this->adCat->getCategories();
        require_once('./views/admin/adminCategoriesItems.php');
        //apres on a mis ca pour que le controller recupere le views d'abord ../../ et apres ./
        // return $allCat;
    }

//     public function removeCat($idCat){

//         $nbLine = $this->adCat->deleteCat($idCat);
//         if($nbLine > 0){
//             header('location:index.php?action=list_cat');
//         }
//     }

        public function removeCat(){
            if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
                $id = trim($_GET['id']);
                
                $nbLine = $this->adCat->deleteCat($id);

                if($nbLine > 0){
                        header('location:index.php?action=list_cat');
                    }

            }
    
        }


        public function editCat(){
           // echo'edit categorie';// Pour tester
           if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
           
            $id = trim($_GET['id']);
           $cat = $this->adCat->categorieItem($id);
           //$cat different de celui de model mais pas de celui en dessous

           if(isset($_POST['soumis']) && !empty($_POST['categorie'])){
               
                $categorie = trim(addslashes(htmlentities($_POST['categorie'])));
               $cat->setNom_cat($categorie);
               $nb = $this->adCat->updateCategorie($cat);
                
               if($nb > 0){
                    header('location:index.php?action=list_cat');
                }

           }

           require_once('./views/admin/adminEditCat.php');
           }

        }

        public function addCat(){
            if(isset ($_POST['soumis']) && !empty($_POST['categorie'])){
                $nom_cat = trim(htmlentities(addslashes($_POST['categorie'])));
                $newCat = new Categorie();
                $newCat->setNom_cat($nom_cat);

                $ok = $this->adCat->insertCategorie($newCat);
                if($ok){
                    header('location:index.php?action=list_cat');
                }
            }
            require_once('./views/admin/adminAddCat.php');
        }
}
// $adminCat = new AdminCategorieController();
// var_dump($adminCat->listCategories()) ;
//Avec les require et le vardump pour tester si le message circulait aussi

// rien a voir variable super globale $get