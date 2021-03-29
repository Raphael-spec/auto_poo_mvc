<?php

require_once('./app/Router.php');
//Pour ce coup la effet domino .Mais on appelle juste le router qui ressmble otus le chemin parcouru depuis la class categorie jusqu'auu router. on cree une instance de router qu'on colle a la nouveau objet cree pour

$router = new Router();

 $router->getPath();