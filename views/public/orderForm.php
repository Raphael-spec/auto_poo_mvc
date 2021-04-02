<?php ob_start(); 

//var_dump($cars)
?>


<div class="container">
<h1 class="display-6 text-center font-monospace text-decoration-underline">Formulaire de Commandes</h1>

        <form action="">
            <input type="hidden" value="<?=$id?>">

        </form>
</div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>