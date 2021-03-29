<?php ob_start();?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Ajout de categories</h1>

<div class="container">
    <div class="row">
        <div class="col-6 offset-3">

            <form action="index.php?action=add_cat" method="post">

                <label for="categorie">Catégorie</label>
                <input type="text" id="categorie" name="categorie" class="form-control mt-2" placeholder="Veuillez entrer votre categorie">
                <button  type="submit" class="btn btn-primary col-12 mt-2" name="soumis">Insérer</button>
            </form>


        </div>
    </div>
</div>


<?php
$contenu = ob_get_clean();//ob_get_clean — Lit le contenu courant du tampon de sortie puis l'efface
//echo $contenu;
require_once('./views/templateAdmin.php');

?>