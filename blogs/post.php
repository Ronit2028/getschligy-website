<?php
require('components/db.php');
include('components/function.php');
$post_id = $_GET['id'];

$postQuery = "SELECT * FROM posts WHERE id=$post_id";
$runPQ = mysqli_query($db, $postQuery);
$post = mysqli_fetch_assoc($runPQ);

$currentpage = 0;
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$post_per_page = 5;
$result = ($page - 1) * $post_per_page;
$post_per_subpage = 3;


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet'>
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <title>GetScholify-<?= $post['title'] ?></title>
    <style>.nav-item { margin-bottom: 23px; }</style>
</head>

<body>


    <header>

        <nav class="navbar navbar-expand-lg bg-none ">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-start" href="https://www.getscholify.com/"><img src="logo.png" alt="" srcset="" width="150px"></a>
                <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="true" aria-label="Toggle navigation">
                    <i class="fa fa-bars" aria-hidden="true"></i>
                </button>
               <div class="navbar-collapse collapse show" id="navbarScroll" style="
    text-align: right;
">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="
">

                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/about-us/">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/why-us/">Why Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/contribute-with-us/">
                                Contribute With Us
                            </a>
                            <!--<ul class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                            <!--    <li><a class="dropdown-item" href="./Individual_Contribution/index.html">Contribute As-->
                            <!--            An Individual</a></li>-->
                            <!--    <li><a class="dropdown-item" href="./Corporate_Contribution/index.html">Contribute As An-->
                            <!--            Corporate</a></li>-->
                            <!--</ul>-->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/Join_Our_Team/">Join Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/scholarship">Scholarships</a>
                        </li>
<a href="https://www.getscholify.com/ApplyNow/"><button class="btn btn-danger">Apply for
                            Scholarship</button></a>
                  
                   
                </ul></div>
            </div>

        </nav>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="header-text">

                    </div>
                </div>
            </div>
        </div>
    </header>
    <main>
        <section class="main-container mt-4 pt-4 mb-4 pb-4">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <h3>
                            <div class="row">
                                <div class="selection-section">
                                    <div class="row">
                                        <p> Filter By: </p>
                                    </div>
                                    <div class="row  mb-3 pb-3">
                                        <button class="btn btn-outline-danger">All</button>
                                        <button class="btn btn-outline-danger">Engineering</button>
                                        <button class="btn btn-outline-danger">EdTech</button>
                                    </div>
                                </div>
                                <div class="social-section">
                                    <div class="row">
                                        <p> Know What's Happending in our <span> Social Media </span></p>
                                    </div>
                                    <div class="row  mb-3 pb-3">
                                        <img src="WhatsApp Image 2023-04-22 at 11.09.14.jpg" alt="" srcset="" width="100%">
                                    </div>
                                </div>
                            </div>
                        </h3>
                    </div>
                    <div class="col-lg-9">
                        <div class="blog-section">
                            <?php $post_images = getImagesByPost($db, $post['id']);   ?>
                            <div class="row">

                                <?php
                                $c = 1;
                                foreach ($post_images as $images) {

                                ?>
                                    <a href="post.php?id=<?= $post['id'] ?>" class="figure">
                                        <img src="./images/<?= $images['image'] ?>" alt="" loading="lazy" />
                                        
                                    </a>

                                <?php
                                    $c++;
                                }
                                ?>
                                <h3>
                                    <?= $post['title'] ?>
                                </h3>
                                <p>
                                    <strong>  <?= $post['writter'] ?> </strong>
                                </p>
                                <p>
                                    <strong><?=getCategory($db, $post['category_id'])?> </strong>
                                </p>
                            </div>
                            <div class="row">
                                <p>
                                    <?= $post['content'] ?>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer class="text-center text-lg-start">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
            <!-- Left -->
            <div class="me-5 d-none d-lg-block">
                <span>Get connected with us on social networks:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="https://www.facebook.com/Getscholify/?ref=py_c&paipv=0&eav=AfYIScWUfeJs15LKCsyiKT7SVrRxVWYwi6ZSao1OwKpu6gMM_T7O9GU-JpGb7pNNDjw&_rdr" class="me-4 text-reset">
                    <i class="fa fa-facebook-f"></i>
                </a>


                <a href="https://www.instagram.com/getscholify/?r=nametag" class="me-4 text-reset">
                    <i class="fa fa-instagram"></i>
                </a>
                <a href="https://www.linkedin.com/company/getscholify/" class="me-4 text-reset">
                    <i class="fa fa-linkedin"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            About
                        </h6>
                        <p>
                            Getscholify is a digital platform which provides scholarships to students who want to pursue
                            their higher education. It acts as a bridge between students, institutions,and corporates.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Links
                        </h6>
                          <p>
                            <a href="  https://www.getscholify.com/blogs/" class="text-reset">Blogs</a>
                        </p>
                        <p>
                            <a href="https://www.getscholify.com/" class="text-reset">Courses</a>
                        </p>
                        <p>
                            <a href="https://www.getscholify.com/scholarship" class="text-reset">Scholarships</a>
                        </p>
                        <p>
                            <a href="../Join_Our_Team/index.html" class="text-reset">Join Us</a>
                        </p>

                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">
                            Company
                        </h6>
                        <p>
                            <a href="https://www.getscholify.com/about" class="text-reset">About</a>
                        </p>
                        <p>
                            <a href="https://www.getscholify.com/contact_us" class="text-reset">Talk to Us</a>
                        </p>
                        <p>
                            <a href="https://www.getscholify.com/contact_us" class="text-reset">Help</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold mb-4">Contact Us</h6>
                        <p><i class="fa fa-home me-3"></i> Chandigarh, India</p>
                        <p>
                            <i class="fa fa-envelope me-3"></i>
                            getscholify@gmail.com
                        </p>
                        <p><i class="fa fa-phone me-3"></i> +91 75209 88888</p>

                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2021 Copyright:
            <a class="text-reset fw-bold" href="https://getscholify.com/">getscholify.com</a>
        </div>
        <!-- Copyright -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f86f59e8ea.js" crossorigin="anonymous"></script>

</body>

</html>