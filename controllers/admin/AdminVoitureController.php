<?php

class AdminVoitureController{

    private $advm;

    public function __construct()
    {
      $this->advm = new AdminVoitureModel(); 
      $this->adCat = new AdminCategorieModel();
    }

    public function listVoitures(){
      AuthController::isLogged();//(2) Pour s'authentifier 
      //var_dump($_POST);
        if(isset($_POST['soumis']) && !empty($_POST['search'])){
            $search = trim(htmlspecialchars(addslashes($_POST['search'])));
            $cars = $this->advm->getVoitures($search);
            require_once('./views/admin/voitures/adminVoituresItems.php');
  
        }else{

          $cars = $this->advm->getVoitures();
          require_once('./views/admin/voitures/adminVoituresItems.php');
           //var_dump($cars);
   
        }
    }

    public function addVoitures(){
      AuthController::isLogged();//(2) Pour s'authentifier 


      if (isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){

          $marque = trim(htmlentities(addslashes($_POST['marque'])));
          $modele = trim(htmlentities(addslashes($_POST['modele'])));
          $prix = trim(htmlentities(addslashes($_POST['prix'])));
          $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
          $annee = trim(htmlentities(addslashes($_POST['annee'])));
          $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
          $description = trim(htmlentities(addslashes($_POST['desc'])));
          $image = $_FILES['image']['name'];

          $newV = new voiture();
          $newV->setMarque($marque);
          $newV->setModele($modele);
          $newV->setPrix($prix);
          $newV->setQuantite($quantite);
          $newV->setAnnee($annee);
          $newV->getCategorie()->setId_cat($id_cat);
          $newV->setDescription($description);
          $newV->setImage($image);

          
          $destination = './assets/images/';
          move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
          $ok = $this->advm->insertVoiture($newV);
          if($ok){

            header('location:index.php?action=list_v');
          }

          ///remplir pour la basse de donn??e

         
      }

      //
      $tabCat = $this->adCat->getCategories();
      require_once('./views/admin/voitures/adminAddV.php');

    }


    public function removeVoiture(){
      AuthController::isLogged();//(2) Pour s'authentifier 

      AuthController::accessUser();//(3)
      
      if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){//<1000 ne sert a rien sur ce coup la et dum trim
        
        $id = $_GET['id'];
        $delV = new Voiture();
        $delV->setId_v($id);
        $nb = $this->advm->deleteVoiture($delV);

          if($nb > 0){
                  header('location:index.php?action=list_v');
              }

       }

    }

    public function editVoiture(){
      AuthController::isLogged();//(2) Pour s'authentifier 
      
      if(isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
          $id = $_GET['id'];
          $editV = new Voiture();
          $editV->setId_v($id);
          $editCar = $this->advm->voitureItem($editV);
          
         $tabCat = $this->adCat->getCategories();
         
         if(isset($_POST['soumis']) && !empty($_POST['marque']) && !empty($_POST['prix'])){
             
             $marque = trim(htmlentities(addslashes($_POST['marque'])));
             $modele = trim(htmlentities(addslashes($_POST['modele'])));
             $prix = trim(htmlentities(addslashes($_POST['prix'])));
             $quantite = trim(htmlentities(addslashes($_POST['quantite'])));
             $annee = trim(htmlentities(addslashes($_POST['annee'])));
             $id_cat = trim(htmlentities(addslashes($_POST['cat'])));
             $description = trim(htmlentities(addslashes($_POST['desc'])));
             $image = $_FILES['image']['name'];
             
             $editCar->setMarque($marque);
             $editCar->setModele($modele);
             $editCar->setPrix($prix);
             $editCar->setQuantite($quantite);
             $editCar->setAnnee($annee);
             $editCar->getCategorie()->setId_cat($id_cat);
             $editCar->setDescription($description);
             $editCar->setImage($image);
             
             $destination = './assets/images/';
             move_uploaded_file($_FILES['image']['tmp_name'],$destination.$image);
             $ok = $this->advm->updateVoiture($editCar); 
             if($ok > 0){
                 header('location:index.php?action=list_v');
              }
          }
          require_once('./views/admin/voitures/adminEditV.php');
      }
  }
}