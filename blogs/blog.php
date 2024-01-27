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
<!DOCTYPE html>
<html>

<head>
  <!--TITLE-->
  <title>Blogs</title>

  <!--SHORTCUT ICON-->
  <link rel="shortcut icon" href="../images/favicon.icon" />

  <!--META TAGS-->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="" />
  <meta name="keywords" content="" />
  <meta name="author" content="" />
  <script src="https://kit.fontawesome.com/d01dc6f594.js" crossorigin="anonymous"></script>

  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
  <style>
    #wrapper {
      margin: 0 auto;
      display: block;
      width: 960px;
    }

    .page-header {
      text-align: center;
      font-size: 1.5em;
      font-weight: normal;
      border-bottom: 1px solid #ddd;
      margin: 30px 0
    }

    #pagination {
      margin: 0;
      padding: 0;
      text-align: center
    }

    #pagination li {
      display: inline
    }

    #pagination li a {
      display: inline-block;
      text-decoration: none;
      padding: 5px 10px;
      color: #000
    }

    /* Active and Hoverable Pagination */
    #pagination li a {
      border-radius: 5px;
      -webkit-transition: background-color 0.3s;
      transition: background-color 0.3s
    }

    #pagination li a.active {
      background-color: var(--yellow);

      color: #fff
    }

    #pagination li a:hover:not(.active) {
      background-color: #ddd;
    }

nav li {
    transition-duration: .5s;

}

nav li:hover {
    background-color: red;
    text-decoration: none;
    color: white;
}

.nav-link {
    color: black;
}

.nav-link:hover {
    color: white;
}

span {
    color: red;
    font-weight: bold;
}

.horizontal-divider {
    width: 25%;
    display: flex;
    background-color: red;
}


.header-image {
    background-size: cover;
    background-repeat: no-repeat;
}

.header-new {
    background-color: rgba(0, 0, 0, 0.5);
    background-image: url('https://www.getscholify.com/CAROUSEL-1.jpg');
    height: 600px;
    background-position: center center;
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;

}

nav {
    text-transform: uppercase;
    font-weight: bold;
}

.first .row {
    margin-top: 3%;
    margin-top: 3%;
}



  </style>
  <!--FONTAWESOME-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<!--GOOGLE FONTS-->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet" />

<!--STYLE SHEET-->
<link rel="stylesheet" href="../css/main.css" />
<link rel="stylesheet" href="css/blog.css" />
</head>

<body>
  <!--HEADER-->
      <header>

        <nav class="navbar navbar-expand-lg bg-none ">
            <div class="container">
                <a class="navbar-brand d-flex justify-content-start" href="../../index.html"><img src="https://www.getscholify.com/logo.png" alt=""
                        srcset="" width="150px"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
                    aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <ul class="navbar-nav ms-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">

                        <li class="nav-item">
                            <a class="nav-link" href="../../about-us/index.html">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../why-us/index.html">Why Us</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Contribute With Us
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item"
                                        href="../../Individual_Contribution/index.html">Contribute As An
                                        Individual</a></li>
                                <li><a class="dropdown-item"
                                        href="../../Corporate_Contribution/index.html">Contribute As An
                                        Corporate</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../../Join_Our_Team/index.html">Join Our Team</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://www.getscholify.com/scholarship">Scholarships</a>
                        </li>

                    </ul>
                    <a href="../../ApplyNow/index.html" class="ms-auto"><button class="btn btn-danger">Apply
                            for
                            Scholarship</button></a>
                </div>
            </div>

        </nav>
        <div class="container-fluid header-new">
            <div class="row">
                <div class="col-lg-12 header-image text-light d-flex justify-content-center align-items-center">
                    <div class="header-text">
                        <!--<h2 style="font-size: xx-large;">BUSINESS MANAGEMENT</h2>-->
                    </div>
                </div>
            </div>
        </div>
    </header>

  <!--BLOG SECTION-->
  <div class="blog_container">
    <div class="blog_content">
      <div class="left_content">
        <?php
        if (isset($_GET['search'])) {
          $keyword = $_GET['search'];
          $postQuery = "SELECT * FROM posts WHERE title LIKE '%$keyword%' ORDER BY id DESC LIMIT $result,$post_per_page";
        } else {
          $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_page";
        }

        $runPQ = mysqli_query($db, $postQuery);
  $categories = getAllCategory($db);
            foreach ($categories as $ct) {
        while ($post = mysqli_fetch_assoc($runPQ)) {
          
        ?>
          <!--CARD BEGINING-->
          
          <div class="blog_card" id="<?= $ct['name'] ?>">
              
            <a href="post.php?id=<?= $post['id'] ?>" title="<?= $post['title'] ?>" class="figure">
              <img src="./images/<?= getPostThumb($db, $post['id']) ?>" alt="" loading="lazy" />
              <span class="tag"><?= date('j', strtotime($post['created_at'])) ?> <?= date('M', strtotime($post['created_at'])) ?></span>
            </a>
            <section>
              <a href="post.php?id=<?= $post['id'] ?>" class="title"><?= $post['title'] ?></a>

              <p><?= $post['description'] ?></p>

            </section>
          </div>

        <?php
}
        }
        ?>

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



        <!--CARD ENDS-->
      </div>
      <br>
      <center>
        <ul id="pagination">
          <?php

          if ($page > 1) {
            $switch = "";
          ?>
            <li>
              <a class="<?= $switch ?>" href="?<?php if (isset($_GET['search'])) {
                                                  echo "search=$keyword&";
                                                } ?>page=<?= $page - 1 ?>" tabindex="-1"><i class='fa fa-chevron-left '></i></a>
            </li>
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
          <?php
          $class = '';
          for ($opage = 1; $opage <= $total_pages; $opage++) {
            if ($page == $opage) {
          ?>
              <li><a class="active" href="javascript:void(0)"><?= $opage ?></a></li>
            <?php
            } else {
            ?>
              <li><a href="?page=<?= $opage ?>" class="inactive"><?= $opage ?></a></li>
            <?php
            }
          }
          if ($page < $total_pages) {
            $nswitch = "";
            ?>
            <li><a class="<?= $nswitch ?>" href="?<?php if (isset($_GET['search'])) {
                                                    echo "search=$keyword&";
                                                  } ?>page=<?= $page + 1 ?>"><i class="fa fa-chevron-right"></i></a></li>
          <?php
          } else {
            $nswitch = "disabled";
          }
          ?>

        </ul>
      </center>
    </div>

    <div class="blog_content right_content">
      <!--SEARCH COLUMN BEGINING-->
      <div class="columns search_column">
        <section class="search">
          <form>
            <fieldset>
              <input type="text" name="search" placeholder="Search..." maxlength="100" required="" />
            </fieldset>
            <fieldset>
              <button type="submit" class="btn1">
                <i class="fa fa-search"></i>
              </button>
            </fieldset>
          </form>
        </section>
      </div>
      <!--SEARCH COLUMN ENDS-->
      <!--BOOKS COLUMN BEGINING-->
      <div class="columns books">
        <span class="title">Instagram Posts
          <a href="https://www.instagram.com/techlearnsofficial/" title="Explore More"><i class="fa fa-share"></i></a></span>
        <section>
          <div class="cards">
            <div class="card_part card_part-one" style="
                  background-image: url(./images/3.webp);
                "></div>
            <div class="card_part card_part-two" style="
                  background-image: url(./images/20.webp);
                "></div>
            <div class="card_part card_part-three" style="
                  background-image: url(./images/7.webp);
                "></div>
            <div class="card_part card_part-four" style="
                  background-image: url(./images/11.webp);
                "></div>
            <div class="card_part card_part-five" style="
                  background-image: url(./images/13.webp);
                "></div>
            <div class="card_part card_part-six" style="
                  background-image: url(./images/25.webp);
                "></div>
          </div>
        </section>
      </div>
      <!--BOOKS COLUMN ENDS-->
      <!--CATEGORIES COLUMN BEGINING-->
      <div class="columns categories">
        <span class="title">Categories</span>
        <section>
          <?php
          $categories = getAllCategory($db);
          $count = 1;
          foreach ($categories as $ct) {
          ?>
            <a href="#"><?= $ct['name'] ?></a>
          <?php
            $count++;
          }
          ?>
        </section>
      </div>
      <!--CATEGORIES COLUMN ENDS-->
      <!--POSTS COLUMN BEGINING-->
      <div class="columns posts">
        <span class="title">Recent Posts
</span>
          <section>
            <?php

            $postQuery = "SELECT * FROM posts ORDER BY id DESC LIMIT $result,$post_per_subpage";


            $runPQ = mysqli_query($db, $postQuery);

            while ($post = mysqli_fetch_assoc($runPQ)) {
            ?>
              <a href="post.php?id=<?= $post['id'] ?>" title="<?= $post['title'] ?>"><img src="./images/<?= getPostThumb($db, $post['id']) ?>" alt="" loading="lazy" />
                <p style="word-break: break-all;"><?= $post['title'] ?></p>
              </a>
            <?php

            }
            ?>
          </section>
        
      </div>
 
      <!--POSTS COLUMN ENDS-->
      <!--COMMENTS COLUMN BEGINING-->
      <div class="columns comments">
        <span class="title">
          Recent Updates
        </span>
        <section>
          <marquee direction="up" scrollamount="4" onMouseOver="this.stop()" onMouseOut="this.start()" class="marquee2">
            <p>
              Success is no accident. It is hard work, perseverance, learning, studying, sacrifice and most of all, love of what you are doing or learning to do
            </p>
            <p>
              There are no secrets to success. It is the result of preparation, hard work, and learning from failure.
            </p>
            <p>
              People always say that I didn’t give up my seat because I was tired, but that isn’t true. I was not tired physically… No, the only tired I was, was tired of giving in.
            </p>
          </marquee>
        </section>
      </div>
      <!--COMMENTS COLUMN ENDS-->
      <!--SOCIAL MEDIA ICONS BEGINING-->
      <!-- <div class="columns social_icons">
        <a href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
        <a href="#" title="Instagram"><i class="fa fa-instagram"></i></a>
        <a href="#" title="Youtube"><i class="fa fa-youtube"></i></a>
        <a href="#" title="Whatsapp"><i class="fa fa-whatsapp"></i></a>
        <a href="#" title="Telegram"><i class="fa fa-telegram"></i></a>
      </div> -->
      <!--SOCIAL MEDIA ICONS ENDS-->
    </div>
  </div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>