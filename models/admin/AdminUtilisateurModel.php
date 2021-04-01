<?php

class AdminUtilisateurModel extends Driver{
    
    public function getUsers(){
        $sql ="SELECT * 
               FROM utilisateurs u
               INNER JOIN grade g
               ON u.id_g = g.id_g
               ORDER BY u.id DESC";

        $result = $this->getRequest($sql);

        $rows = $result->fetchAll(PDO::FETCH_OBJ);
        $tabUser = [];

        foreach($rows as $row){
            $user = new Utilisateurs();
            $user->setId($row->id);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setLogin($row->login);
            $user->setPass($row->pass);
            $user->getGrade()->setId_g($row->id_g);
            $user->getGrade()->setNom_g($row->nom_g);
            $user->setEmail($row->email);
            $user->setStatut($row->statut);
            array_push($tabUser,$user);
        }
            return $tabUser;

    }

    public function updateStatut(Utilisateurs $user){
            $sql = "UPDATE utilisateurs
                    SET statut = :statut
                    WHERE id = :id";
            
            $result = $this->getRequest($sql, ['statut'=>$user->getStatut(), 'id'=>$user->getId()]);
            return $result->rowCount();

    }

    public function signIn($loginEmail, $pass){//pas d'objet sinon je serai obligé de bidouiller a cause de logemail, dans le controller on exploite 
        $sql = "SELECT *
                FROM utilisateurs
                WHERE (login = :logEmail OR email = :logEmail) AND pass = :pass";
        
        $result = $this->getRequest($sql,['logEmail'=>$loginEmail, 'pass'=>$pass]);// pas besoin de get puisque on utilise pas l'utilisatuer (a verifier)

        $row = $result->fetch(PDO::FETCH_OBJ);

        return $row;
    }

    public function register(Utilisateurs $user){
        
        $sql = "SELECT *
                FROM utilisateurs
                WHERE email = :email";
        
        $result = $this->getRequest($sql, ['email'=>$user->getEmail()]);
        
        if($result->rowCount() == 0){
            
            $req = "INSERT INTO utilisateurs(nom, prenom, login, email, pass, statut, id_g)
                    VALUES(:nom, :prenom, :login, :email, :pass, :statut, :id_g)";
           
           $tabUsers = ['nom'=>$user->getNom(), 
                        'prenom'=>$user->getPrenom(), 
                        'login'=>$user->getLogin(), 
                        'email'=>$user->getEmail(), 
                        'pass'=>$user->getPass(), 
                        'statut'=>$user->getStatut(),
                        'id_g'=>$user->getGrade()->getId_g()
                        ];
            
                $res = $this->getRequest($req, $tabUsers);
            
                return $res;
        }else{
                return "Cet utilisateur existe déjà";

        }
    }

    public function selectGrade(){
        $sql="SELECT *
              FROM grade";
        
        $res = $this->getRequest($sql);
        $rows = $res->fetchAll(PDO::FETCH_OBJ);
        $tabcat =[];

        foreach($rows as $row){

            $addU = new Grade();
            $addU->setId_g($row->id_g);
            $addU->setNom_g($row->nom_g);
            array_push($tabcat,$addU);
        }
  
        return $tabcat;
       
    }
    
}