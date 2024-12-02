<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        // Include navigation bar
        include('./includes/head.php') ;    
    ?>    
</head>
<body>
    
    <section class="container-fluid">
        <?php
            // Include navigation bar
            include('./includes/navbar.php') ;    
        ?>
    </section>
    <section class="container-fluid" id="section1" style="padding-left: 0px; padding-right: 0px;">
        <div id="customCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
            <!-- Carousel Items -->
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 1">
                </div>
                <div class="carousel-item">
                    <img src="images/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 2">
                </div>
                <div class="carousel-item">
                    <img src="images/2.png" class="d-block w-100" style="height: 60vh; object-fit: cover;" alt="Slide 3">
                </div>
            </div>
        
            <!-- Navigation Buttons -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="0" class="active custom-indicator" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="1" class="custom-indicator" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#customCarousel" data-bs-slide-to="2" class="custom-indicator" aria-label="Slide 3"></button>
            </div>

            <div class="pos">
                <h1 class="text-white" style="font-weight: 900;">
                What We Offer
                </h1>
                <p class="text-white">Explore a world of fitness, fun, and <br> community activities tailored for all ages.</p>
                <div class="row mt-3">
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section3'">
                                Explore Activities <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 mb-3 mb-md-0 mx-auto">
                        <div>
                            <button class="btn px-3 text-white" style="background: #61BC45; text-transform: uppercase; white-space: nowrap;"  onclick="window.location.href='index.php#section4'">
                            Become A Member <i class="bi bi-arrow-right-circle"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="my-5 container-lg">
        <div class="row">
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/3.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 8.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Football</h2>
                    <p class="mt-3 text-center">Join our leagues and <br> tournaments</p>
                    <div class="mt-3">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/4.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 2.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Dance & Fitness</h2>
                    <p class="mt-3 text-center">Stay active with our <br>
                        vibrant classes</p>
                    <div class="mt-3">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/5.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 3.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Cultural Events</h2>
                    <p class="mt-3 text-center">Celebrate tradition and unity</p>
                    <div class="mt-5">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/3.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 8.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Football</h2>
                    <p class="mt-3 text-center">Join our leagues and <br> tournaments</p>
                    <div class="mt-3">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/4.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 2.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Dance & Fitness</h2>
                    <p class="mt-3 text-center">Stay active with our <br>
                        vibrant classes</p>
                    <div class="mt-3">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mx-auto mb-3">
                <div class="relative">
                    <img src="images/5.png" alt="" class="image-fluid w-100" style="border-top-left-radius: 10px; border-top-right-radius: 10px;">
                    <div class="ppos d-none d-lg-block">
                        <img src="images/Group 3.png" alt="" class="image-fluid" style="width: 90%;">
                    </div>
                </div>
                <div class="p-2" style="background-color: #F2F2F2; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                    <h2 class="mt-5 text-center fw-bold">Cultural Events</h2>
                    <p class="mt-3 text-center">Celebrate tradition and unity</p>
                    <div class="mt-5">
                        <button class="btn btn-white w-100 py-2" style="background: #FFFFFF;">
                            Learn More 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
        // Include navigation bar
        include('./includes/footer.php') ;    
    ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        document.querySelectorAll('.search-link').forEach(link => {
          link.addEventListener('click', function(event) {
            event.preventDefault();
      
            // Retirer la classe active de tous les liens
            document.querySelectorAll('.search-link').forEach(l => l.classList.remove('active'));
      
            // Ajouter la classe active au lien cliqué
            this.classList.add('active');
      
            // Masquer tous les contenus
            document.querySelectorAll('.search-content').forEach(content => content.style.display = 'none');
      
            // Afficher le contenu correspondant à l'onglet cliqué
            const targetId = this.getAttribute('data-target');
            document.getElementById(targetId).style.display = 'block';
          });
        });
    </script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
      AOS.init();
    </script>
</body>
</html>