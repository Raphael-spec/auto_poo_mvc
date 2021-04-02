<?php

class AdminUtilisateurController{

    private $adUser;

    public function __construct()
    {
        $this->adUser = new AdminUtilisateurModel();
    }

    public function listUsers(){
        AuthController::isLogged();//(2) Pour s'authentifier 
        
        if(isset($_GET['id']) && isset($_GET['statut']) && !empty($_GET['id'])){// on peut pas mettre empty de statut parce que peut etre de 0. Et il y rsique de ne pas le prendre 
            $id = $_GET['id'];
            $statut = $_GET['statut'];
            $user = new Utilisateurs();
            if($statut == 1){
                $statut = 0;
            }else{
                $statut = 1;
            }

            $user->setId($id);
            $user->setStatut($statut);
            $this->adUser->updateStatut($user);
        }    
        $allUsers = $this->adUser->getUsers();
        require_once('./views/admin/utilisateurs/adminUsersItems.php');
        //return $allUsers;
    }

    public function login(){
        //AuthController::isLogged();//(2) Pas sur le login, on veut pas securiser le login
        if(isset($_POST['soumis'])){
            if(strlen($_POST['pass']) >= 4 && !empty($_POST['loginEmail'])){
                $loginEmail = trim(htmlentities(addslashes($_POST['loginEmail'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                //du coup on ne crée pas d'objet d'une instance puis que en model il ne recois pas d'objet et on les colle  omme ca dans la paranthese
                $data_u = $this->adUser->signIn($loginEmail, $pass);
                if(!empty($data_u)){
                    if($data_u->statut > 0){
                        session_start();
                        $_SESSION['Auth'] = $data_u;
                        header('location:index.php?action=list_v');
        
                    }else{
        
                        $error = "Votre compte a été supprimé";
                    }
                }else{
                    $error = "Votre login/email ou/et mot de passe ne corespondent pas"; 
               
                }
            }else{
                $error = "Entrée les données valides"; 
    
            }
        
        }
        require_once('./views/admin/utilisateurs/login.php');
    }

    public function addUser(){
        
        AuthController::isLogged();
        if(isset($_POST['submit'])){

            if(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL) && strlen($_POST['pass']) >= 4){
        
                
                $nom = trim(htmlentities(addslashes($_POST['nom'])));
                $prenom = trim(htmlentities(addslashes($_POST['prenom'])));
                $login = trim(htmlentities(addslashes($_POST['login'])));
                $pass = md5(trim(htmlentities(addslashes($_POST['pass']))));
                $email = trim(htmlentities(addslashes($_POST['email'])));
                $id_g = trim(htmlentities(addslashes($_POST['id_g'])));
                
        
                $user = new Utilisateurs();
                $user->setNom($nom);
                $user->setPrenom($prenom);
                $user->setLogin($login);
                $user->setPass($pass);
                $user->setEmail($email);
                $user->setStatut(1);
                $user->getGrade()->setId_g($id_g);
        
                $ok = $this->adUser->register($user);
                
                if($ok){
                    header('location:index.php?action=list_u');
                }
            }
        
         }
                $add = $this->adUser->selectGrade();
            
                require_once('./views/admin/utilisateurs/register.php');
        

    }

}