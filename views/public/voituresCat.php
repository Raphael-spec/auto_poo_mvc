<?php ob_start(); 

//var_dump($cars)
?>

<div class="container">
        <div id="carouselExampleControls" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="./assets/images/ferrari2.jpg" class="d-block w-100 "  alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/fefe2.jpg" class="d-block w-100" alt="...">
              </div>
              <div class="carousel-item">
                <img src="./assets/images/f502.jpg" class="d-block w-100" alt="...">
              </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
          </div>
<!--------------------------end carrousel------------------------------------->

<div class="row my-3">
              <div class="col-8">
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach($voitures as $car){?>
                    <div class="col">
                      <div class="card">
                        <img src="./assets/images/<?= $car->getImage();?>" class="card-img-top" height="300" alt="...">
                        <div class="card-body">
                          <h5 class="card-title bg-secondary text-center"><?=strtoupper($car->getCategorie()->getNom_cat());?>: <?= $car->getMarque();?></h5>
                          <p class="card-text"><?= $car->getDescription();?></p>
                          <ul class="list-group">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Mod??le:
                              <span class="badge text-danger rounded-pill"><?= $car->getModele();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Annee:
                              <span class="badge text-danger rounded-pill"><?= $car->getAnnee();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Prix:
                              <span class="badge bg-danger rounded-pill"><?= $car->getPrix();?></span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                              Quantit??:
                              <span class="badge bg-danger rounded-pill"><?= $car->getQuantite();?></span>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                    
              </div>
            </div>
<!------------------------------end cards--------------------------------------------------------->
            <div class="col-4">
                    <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" class="input-group">
                        <input class="form-control text-center" type="search" name="search" id="search" placeholder="Rechecher...">
                        <button type="submit" class="btn btn-outline-secondary" name="soumis"><i class="fas fa-search"></i></button>
                     </form>
                <div class="card">
                    <ul class="list-group list-group-flush">
                      <?php foreach($tabCat as $cat){ ?>
                        <li class="list-group-item text-center">
                          <a class="btn text-center" href="index.php?id=<?=$cat->getId_cat();?>"><?=ucfirst($cat->getNom_cat());?></a>
                        </li>
                      <?php } ?>
                     
                    </ul>
                </div> 
              </div>
<!------------------------------end sidebar--------------------------------------------------------->          
    </div>

<?php $contenu = ob_get_clean();
    require_once("./views/public/templatePublic.php");
?>