<?php ob_start();?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Modification des categories</h1>


<div class="container">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                <input type="text" class="form-control" name="id" value="<?=$cat->getId_cat();?>" readonly>
                <label for="categorie">Categorie</label>
                <input type="text" id="categorie" name="categorie" class="form-control" value="<?=$cat->getNom_cat();?>">
                <button type="submit" class="btn btn-primary col-12 mt-2" name="soumis">Inserer</button>
            </form>
        </div>
    </div>
</div>
<?php
    $contenu = ob_get_clean();
    require_once('./views/templateAdmin.php');
    
?>