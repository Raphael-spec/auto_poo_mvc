categories...
<?php ob_start();?>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
<h1 class="display-6 text-center font-monospace text-decoration-underline">Formulaire de connexion</h1>
            <?php if(isset($error)){ ?>
                <div class="alert alert-danger text-center"><?=$error;?></div>
            <?php } ?>
            <form action="<?php $_SERVER['PHP_SELF'];?>" method="post">

                <label for="loginEmail">Login ou Email*</label>
                <input type="text" id="loginEmail" name="loginEmail" class="form-control mt-2" placeholder="Entrez votre login ou votre email...">
                
                <label for="pass">Mot de passe*</label>
                <input type="password" id="pass" name="pass" class="form-control mt-2" placeholder="Entrez votre mot de passe...">

                <button  type="submit" class="btn btn-primary col-12 mt-2" name="soumis">se connecter</button>
            </form>


        </div>
    </div>
</div>



<?php
    $contenu = ob_get_clean();
    // echo $contenu;
    require_once('./views/templateAdmin.php');
    //on fait un require de templateAdminqui va appeleer la strucutre de l'affichage comme header et un footer. Et dans celui ci on lui colle le $sontenu qui est egal obgetclean pour afficher les dos ouroboros
?>

