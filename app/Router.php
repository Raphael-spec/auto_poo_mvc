<?php

require_once('./models/Driver.php');
require_once('./models/Categorie.php');
require_once('./models/Voiture.php');
require_once('./models/admin/AdminCategorieModel.php');
require_once('./controllers/admin/AdminCategorieController.php');
require_once('./models/admin/AdminVoitureModel.php');
require_once('./controllers/admin/AdminVoitureController.php');

class Router{
    private $ctrca;
    private $ctrv;

    public function __construct()
    {
        $this->ctrca = new AdminCategorieController();
        $this->ctrv = new AdminVoitureController();
        //on refait lamemechose que predemment effet domino on recupere les infos admincategoriecontroller en creeant une instance qu'on la colle au nouveau objet cree dans le router et onlui associe, plus bas la methode admincategorie controller listcategorie. Et on rappelle tous les requires qui ont ete neccasire a l'elaboration du chemin et de la donnee comme precedemment
    }

    public function getPath(){

        if(isset($_GET['action'])){

                switch($_GET['action']){
                    
                    case 'list_cat':
                        $this->ctrca->listCategories();
                        break;
                    
                    //case 'delete_cat':
                    //     if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
                    //         $id = $_GET['id'];
                    //         $this->ctrca->removeCat($id);
                    //     }
                    //     break;
                    
                    case 'delete_cat':
                         // if(isset($_GET['id']) && $_GET['id'] < 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
                         //     $id = $_GET['id'];
                             $this->ctrca->removeCat();
                        // }
                        break;
                    
                    case 'edit_cat':
                        $this->ctrca->editCat();
                        break;

                    case 'add_cat':
                        $this->ctrca->addCat();
                        break;

                    case 'list_v':
                        $this->ctrv->listVoitures();
                        break;
    


            }
        }
    }
}