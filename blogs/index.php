<?php
require('components/db.php');
include('components/function.php');
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
    <title>GetScholify</title>
    <style>
        a {
            display: contents;
            color: black;
            text-decoration: none;
            font-family: 'Raleway';
        }

        :root {
            --color-primary: #1a2556;
            --color-secondary: #a5b3d4;
            --color-gray: #dde6f3;
            --color-light-gray: #f3f6fb;
            --color-white: white;
            --color-black: #3e3743;
            --color-input-hover: rgba(165, 179, 212, 0.6);
            --color-input-focus: rgba(26, 37, 86, 0.45);
            --color-input-error: rgba(255, 94, 31, 0.6);
            --color-input-warning: rgba(166, 145, 54, 0.6);
            --color-input-success: rgba(23, 125, 23, 0.45);
            --color-input-disabled: #dde6f3;
            --font-family: Roboto, Montserrat, sans-serif;
            --font-persian: Yekan, Lalezar, cursive;
            --font-proxima: proxima-soft, Proxima Soft, Proxima Nova Soft, Helvetica, Arial, sans-serif;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            transition: 0.2s ease all;
        }

        button {
            text-transform: uppercase;
            font-weight: bold;
            color: black;
            background-color: white;
            border: none;
            border-radius: 3px;

        }

        .active,
        button:hover {
            text-transform: uppercase;
            font-weight: bold;
            color: white;
            background-color: red;
            border: none;
            border-radius: 3px;
        }

        .pagination {
            width: 400px;
            height: 60px;
            border-radius: 9px;
            overflow: hidden;
        }

        .pagination,
        .pagination__list {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            align-content: center;
        }

        .pagination__list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            width: 350;
            height: 50px;
            border-radius: 9px;
            margin: 0 9px;
            overflow: hidden;
        }

        .pagination__item {
            width: 50px;
            height: 50px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
            align-content: center;
            font-size: 1.1rem;
        }

        .pagination__item>button,
        .pagination__button {
            border: none;
            outline: none;
            stroke: none;
            box-shadow: none;
            cursor: pointer;
            border-radius: 9px;
            background: var(--color-gray);
        }

        .pagination__item>button:hover,
        .pagination__button:hover {
            background: var(--color-secondary);
            color: var(--color-primary);
        }

        .pagination__item>button {
            width: 45px;
            height: 45px;
        }

        .pagination__item>button[data-level=target] {
            background: var(--color-primary);
            color: var(--color-light-gray);
        }

        .pagination--move-prev {
            -webkit-animation: pagination-move-prev 0.5s ease both;
            animation: pagination-move-prev 0.5s ease both;
        }

        .pagination--move-next {
            -webkit-animation: pagination-move-next 0.5s ease both;
            animation: pagination-move-next 0.5s ease both;
        }

        .pagination--move-top {
            -webkit-animation: pagination-move-top 0.5s ease both;
            animation: pagination-move-top 0.5s ease both;
        }

        .pagination__button {
            width: 35px;
            height: 35px;
        }

        @-webkit-keyframes pagination-move-prev {

            from,
            0% {
                transform: translateX(25px);
            }

            50% {
                transform: translateX(-5px);
            }

            to,
            100% {
                transform: translateX(0px);
            }
        }

        @keyframes pagination-move-prev {

            from,
            0% {
                transform: translateX(25px);
            }

            50% {
                transform: translateX(-5px);
            }

            to,
            100% {
                transform: translateX(0px);
            }
        }

        @-webkit-keyframes pagination-move-next {

            from,
            0% {
                transform: translateX(-25px);
            }

            50% {
                transform: translateX(5px);
            }

            to,
            100% {
                transform: translateX(0px);
            }
        }

        @keyframes pagination-move-next {

            from,
            0% {
                transform: translateX(-25px);
            }

            50% {
                transform: translateX(5px);
            }

            to,
            100% {
                transform: translateX(0px);
            }
        }

        @-webkit-keyframes pagination-move-top {

            from,
            0% {
                transform: translateY(-25px);
            }

            50% {
                transform: translateY(10px);
            }

            to,
            100% {
                transform: translateY(0px);
            }
        }

        @keyframes pagination-move-top {

            from,
            0% {
                transform: translateY(-25px);
            }

            50% {
                transform: translateY(10px);
            }

            to,
            100% {
                transform: translateY(0px);
            }
        }
        .nav-item { margin-bottom: 23px; }
    </style>
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
                                        <button type="button" class="btn btn-outline-danger control outline" data-filter="all">All</button>
                                        <?php
                                        $categories = getAllCategory($db);
                                        $count = 1;
                                        foreach ($categories as $ct) {
                                        ?>

                                            <button type="button" class="btn btn-outline-danger control outline" data-filter=".<?php echo  $ct['name'] ?>"><?php echo  $ct['name'] ?></button>
                                        <?php
                                            $count++;
                                        }
                                        ?>
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
                            <div class="row portfolio-item">
                                <?php
                                if (isset($_GET['search'])) {
                                    $keyword = $_GET['search'];
                                    $postQuery = "SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page";
                                } else {
                                    $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
                                }

                                $runPQ = mysqli_query($db, $postQuery);

                                while ($post = mysqli_fetch_assoc($runPQ)) {

                                ?>

                                    <div class="row mix <?php echo getCategory($db, $post['category_id'])?> pd">
                                        <div class="single-blog">
                                            <div class="row">
                                                <a href="post.php?id=<?php echo  $post['id'] ?>" title="<?php echo  $post['title'] ?>" class="figure" style=" display: contents;">
                                                    <div class="col-6">
                                                        <img src="./images/<?php echo  getPostThumb($db, $post['id']) ?>" alt="" srcset="" width="100%">
                                                    </div>
                                                    <div class="col-6">
                                                        <a href="post.php?id=<?php echo  $post['id'] ?>">
                                                            <h5 style="font-weight: bolder;"><?php echo  $post['title'] ?></h5>
                                                        </a>
                                                        <h6><span>Some Description</span></h6>
                                                        <p>
                                                            <?php echo  $post['description'] ?>
                                                        </p>

                                                        <h6>
                                                            <strong> <?php echo  date('j', strtotime($post['created_at'])) ?><?php echo  date('M', strtotime($post['created_at'])) ?></strong>
                                                        </h6>
                                                        <h6>
                                                            <strong> <?php echo  getCategory($db, $post['category_id']) ?> </strong>
                                                        </h6>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                <?php

                                }
                                ?>
                            </div>
                            <?php
                            if (isset($_GET['search'])) {
                                $keyword = $_GET['search'];
                                $q = "SELECT * FROM posts WHERE title LIKE '%$keyword%' ";
                            } else {
                                $q = "SELECT * FROM posts";
                            }

                            $r = mysqli_query($db, $q);
                            $total_post = mysqli_num_rows($r);
                            $total_pages = ceil($total_post / $post_per_page);

                            ?>

                        </div>
                    </div>
                    <br>
                    <center>
                        <ul id="pagination">

                            <section class="pagination">
                                <?php

                                if ($page > 1) {
                                    $switch = "";
                                ?>
                                    <a class="<?php echo  $switch ?>" href="?<?php if (isset($_GET['search'])) {
                                                                            echo "search=$keyword&";
                                                                        } ?>page=<?php echo  $page - 1 ?>" tabindex="-1"> <button id="pg-button-prev" type="button" class="pagination__button">
                                            <i class="fa fa-chevron-left"></i>
                                        </button></a>
                                <?php
                                } else {
                                    $switch = "disabled";
                                }
                                if ($page >= $total_pages) {
                                    $nswitch = "";
                                } else {
                                    $nswitch = "disabled";
                                }
                                ?>
                                <ul class="pagination__list">
                                    <?php
                                    $class = '';
                                    for ($opage = 1; $opage <= $total_pages; $opage++) {
                                        if ($page == $opage) {
                                    ?>

                                            <li class="pagination__item pagination__item--1">
                                                <a class="active" href="javascript:void(0)">
                                                    <button id="pg-button-1" class="btn active" type="button" class="" data-level="target"><strong><?php echo  $opage ?></strong></button></a>
                                            </li>
                                        <?php
                                        } else {
                                        ?>
                                            <li class="pagination__item pagination__item--2">
                                                <a href="?page=<?php echo  $opage ?>" class="btn inactive"> <button id="pg-button-2" type="button" class=""><?php echo  $opage ?> </button></a>
                                            </li>
                                    <?php
                                        }
                                    }

                                    ?>
                                </ul>
                                <?php
                                if ($page < $total_pages) {
                                    $nswitch = "";
                                ?>

                                    <button id="pg-button-next" type="button" class="pagination__button">
                                        <a class="<?php echo  $nswitch ?>" href="?<?php if (isset($_GET['search'])) {
                                                                                echo "search=$keyword&";
                                                                            } ?>page=<?php echo  $page + 1 ?>"> <i class="fa fa-chevron-right"></i> </a>
                                    </button>

                                <?php
                                } else {
                                    $nswitch = "disabled";
                                }
                                ?>
                            </section>


                        </ul>
                    </center>
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
                <a href="" class="me-4 text-reset">
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <!-- Mixitup -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/mixitup/3.2.2/mixitup.min.js'></script>
    <!-- fancybox -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.1.20/jquery.fancybox.min.js'></script>
    <!-- Fancybox js -->
    <script>
        /*Downloaded from https://www.codeseek.co/ezra_siton/mixitup-fancybox3-JydYqm */
        // 1. querySelector
        var containerEl = document.querySelector(".portfolio-item");
        // 2. Passing the configuration object inline
        //https://www.kunkalabs.com/mixitup/docs/configuration-object/
        var mixer = mixitup(containerEl, {
            animation: {
                effects: "fade translateZ(-100px)",
                effectsIn: "fade translateY(-100%)",
                easing: "cubic-bezier(0.645, 0.045, 0.355, 1)"
            }
        });
        // fancybox insilaze & options //
        $("[data-fancybox]").fancybox({
            loop: true,
            hash: true,
            transitionEffect: "slide",
            /* zoom VS next////////////////////
            clickContent - i modify the deafult - now when you click on the image you go to the next image - i more like this approach than zoom on desktop (This idea was in the classic/first lightbox) */
            clickContent: function(current, event) {
                return current.type === "image" ? "next" : false;
            }
        });
    </script>
</body>

</html>