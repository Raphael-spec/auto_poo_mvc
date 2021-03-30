categories...
<?php ob_start();?>
<h1 class="display-6 text-center font-monospace text-decoration-underline">Listes des Utilisateurs</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Login</th>
            <th>Email</th>
            <th>Grade</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($allUsers as $user) { ?>
        <tr>
            <td><?=$user->getId();?></td>
            <td><?=$user->getNom();?></td>
            <td><?=$user->getPrenom();?></td>
            <td><?=$user->getLogin();?></td>
            <td><?=$user->getEmail();?></td>
            <td><?=$user->getGrade()->getNom_g();?></td>

            <td class="text-center">
                <a class="btn btn-success" href="">
                    <i class="fas "></i>
                    <?php echo($user->getStatut()) ?"Désactiver" : "Activer";?>
                </a>
            </td>
            
        </tr>
        <?php } ?>
    </tbody>

</table>


<?php
    $contenu = ob_get_clean();
    // echo $contenu;
    require_once('./views/templateAdmin.php');
    //on fait un require de templateAdminqui va appeleer la strucutre de l'affichage comme header et un footer. Et dans celui ci on lui colle le $sontenu qui est egal obgetclean pour afficher les dos ouroboros
?>
