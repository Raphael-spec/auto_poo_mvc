<?php

// require_once('./models/Driver.php');
// require_once('./models/Categorie.php');
// require_once('./models/Voiture.php');
// require_once('./models/Grade.php');
// require_once('./models/Utilisateurs.php');
// require_once('./models/admin/AdminCategorieModel.php');
// require_once('./controllers/admin/AdminCategorieController.php');
// require_once('./models/admin/AdminVoitureModel.php');
// require_once('./controllers/admin/AdminVoitureController.php');
// require_once('./models/admin/AdminUtilisateurModel.php');
// require_once('./controllers/admin/AdminUtilisateurController.php');
// require_once('./models/admin/AdminGradeModel.php');
// require_once('./controllers/admin/AdminGradeController.php');
// require_once('./controllers/admin/AuthController.php');
require_once('./app/autoload.php');



class Router{
    private $ctrca;
    private $ctrv;
    private $ctru;
    private $ctrpub;

    public function __construct()
    {
        $this->ctrca = new AdminCategorieController();
        $this->ctrv = new AdminVoitureController();
        //on refait lamemechose que predemment effet domino on recupere les infos admincategoriecontroller en creeant une instance qu'on la colle au nouveau objet cree dans le router et onlui associe, plus bas la methode admincategorie controller listcategorie. Et on rappelle tous les requires qui ont ete neccasire a l'elaboration du chemin et de la donnee comme precedemment
        $this->ctru = new AdminUtilisateurController();
        $this->ctrpub = new PublicController();
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

                    case 'add_v':
                        $this->ctrv->addVoitures();
                        break;

                    case 'delete_v':
                        $this->ctrv->removeVoiture();
                        break;

                    case 'edit_v':
                        $this->ctrv->editVoiture();
                        break;

                    case 'list_u':
                        $this->ctru->listUsers();
                        break;

                    case 'login':
                        $this->ctru->login();
                        break;

                    case 'logout':
                            AuthController::logout();
                            break;

                    case 'list_g':
                        $this->ctrg->listGrade();
                        break;

                    case 'register':
                        $this->ctru->addUser();
                        break;

                    case 'checkout':
                         $this->ctrpub->recap();
                        break;

                    case 'order':
                         $this->ctrpub->orderCar();
                         break;
    


                }
           
            }else{
                $this->ctrpub->getPubVoitures();
        }
    }
}