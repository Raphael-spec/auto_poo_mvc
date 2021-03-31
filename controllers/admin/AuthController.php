<?php
session_start();
class AuthController{

    public static function isLogged(){//methode de class c'est une methode static
        if(!isset($_SESSION['Auth'])){
            header('location:index.php?action=login');
            exit;
        }
    }

    public static function logout(){
        unset($_SESSION['Auth']);//destroy detruis toutes les sessions la dif entre unset
        header('location:index.php?action=login');
    }

    public static function accessUser(){
        if($_SESSION['Auth']->id_g == 3){
            header('location:index.php?action=login');
            exit; //bloquer l'execuiton du site
        }
    }
}