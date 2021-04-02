    
    <?php ob_start();

// var_dump($_POST);
?>
<div class="container">
<h2 class="text-center font-monospace text-decoration-underline mb-4 mt-4">Formulaire d'ajout d'utilisateur</h2>
    <div class="row">
        <div class="col-8 offset-2">
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="text-center" enctype="multipart/form-data">

                <div class="row mt-3">
                    <div class="col">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom">
                    </div>
                    <div class="col">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Prenom">
                    </div>
                    <div class="col">
                        <label for="grade">Grade</label>
                        <select id="id_g" name="id_g" class="form-select">
                            <option value="">Choisir</option>

                            <?php foreach ($add as $use) { ?>
                                
                                <option value="<?php echo $use->getId_g() ?>"><?php echo $use->getNom_g() ?></option>

                            <?php }; ?>


                        </select>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col">
                        <label for="login">Login</label>
                        <input type="text" id="login" name="login" class="form-control" placeholder="Login">
                    </div>
                    <!-- <div class="col">
                        <label for="statut">Statut</label>
                        <input type="number" id="statut" name="statut" class="form-control" placeholder="Statut">
                    </div> -->
                    <div class="col">
                        <label for="mail">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="email">
                    </div>
                </div>
                <div class="col">
                        <label for="pass">Mot de passe</label>
                        <input type="pass" id="pass" name="pass" class="form-control" placeholder=" Mot de Passe">
                    </div>
                <button type="submit" class="btn btn-secondary  col-12 mt-3" name="submit">Ajouter</button>
            </form>
        </div>
    </div>
</div>

<?php $contenu = ob_get_clean(); // Nettoie la mémorisation et renvoie les données
    require_once("./views/templateAdmin.php");
?>