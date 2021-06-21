<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Agency - Start Bootstrap Theme</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php#portfolio">Skelbimai</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Mano paskyra</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Masthead-->
        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading">Sveiki atvyke į geriausių skelbimų puslapį!</div>
                <div class="masthead-heading text-uppercase">Malonu susipažinti!</div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#portfolio">Žiūrėti visus skelbimus</a>
            </div>
        </header>
       
        <!-- Portfolio Grid-->
        <section class="page-section bg-light" id="portfolio">
            <?php
                require_once "config.php";
                $sql = "SELECT pavadinimas,kategorija,aprasymas,image FROM skelbimai";
        
                $q = $pdo->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $counter = 1;
            ?>


            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase">Skelbimai</h2>
                    <h3 class="section-subheading text-muted">Čia matysite naujausius skelbimus.</h3>
                </div>
                <div class="row">
                    <?php while ($row = $q->fetch()): ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <!-- Portfolio item 1-->
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal<?php echo $counter; $counter+=1;?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img src="data:image/jpeg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" alt="..." width="420" height="250" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo htmlspecialchars($row['pavadinimas']) ?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo htmlspecialchars($row['kategorija']); ?></div>
                            </div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>
        </section>
        
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 text-lg-start">Copyright &copy; Domas Pocius</div>
                    <div class="col-lg-3 text-lg-start">Visos teisės saugomos </div>
                    <div class="col-lg-3 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="#!"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <div class="col-lg-3 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Portfolio Modals-->
        <!-- Portfolio item 1 modal popup-->
        <?php
                $sql = "SELECT pavadinimas,kategorija,aprasymas,image FROM skelbimai";
                $q = $pdo->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $counter = 1;
        ?>
        <?php while ($row = $q->fetch()): ?>
        <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $counter; $counter+=1;?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project details-->
                                    <h2 class="text-uppercase"><?php echo htmlspecialchars($row['pavadinimas']) ?></h2>
                                    <p class="item-intro text-muted"><?php echo htmlspecialchars($row['kategorija']) ?></p>
                                    <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $row['image'] ).'" height="350" width="450" />'; ?>
                                    <p><?php echo htmlspecialchars($row['aprasymas']) ?></p>
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-times me-1"></i>
                                        Uždaryti
                                    </button>
                                    <div class="widget-area no-padding blank" style="padding-top: 25px";>
                                        <div class="status-upload">
                                            <form>
                                                <textarea placeholder="Ką manote apie šią prekę?" ></textarea>
                                                <button type="submit" class="btn btn-success green"><i class="fa fa-share"></i> Share</button>
                                            </form>
                                        </div><!-- Status Upload  -->
                                    </div><!-- Widget Area -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endwhile; ?>

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
