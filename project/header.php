<?php

session_start();
 $dbServerName = 'localhost';
 $dbUserName = 'root';
 $dbPassword = '';
 $dbName = 'mobile';
 // set DSN (Data Source Name) :string has the associated data structure to describe a connection to the data source.
 $dsn = "mysql:host=$dbServerName;dbname=$dbName";

 // create PDO instance
 $pdo = new PDO($dsn,$dbUserName,$dbPassword);
 $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// For Logout
if (isset($_GET['status']) && $_GET['status'] == 'logout') {
  unset($_SESSION['userLogin']);
  unset($_SESSION['adminLogin']);
//   unset($_SESSION['shopping_cart']);
  header("Location: index.php");
}

// For Comments
if (isset($_GET['comment'])) {
  if (isset($_SESSION['userLogin'])) {
      $user_id = $_SESSION['userLogin'];
      $prodcut_id = $_GET['id'];
      $comment_content = $_GET['message'];
    $sqlInserComment = "INSERT INTO comments (user_id,prodcut_id,comment_content,comment_date) 
    VALUES (?,?,?,?)";
    $stmt = $pdo->prepare($sqlInserComment);
    $stmt->execute([$user_id,$prodcut_id,$comment_content,NOW()]);

    
    $id = $_GET['id'];
    header("location: single-product.php?id={$id}");
  } else {
    echo "<script>alert('You must be logged in')</script>";
  }
}

// For Add To Cart
if (isset($_GET["action"]) && $_GET["action"] == "add_to_cart") {

  // Get Data of specific item
  $query         = "SELECT * FROM products WHERE product_id = {$_GET['id']}";
  $result        = mysqli_query($connection, $query);
  $row           = mysqli_fetch_assoc($result);
  if ($row['product_price_on_sale'] == 0) {
    $thePrice = $row['product_price'];
  } else {
    $thePrice = $row['product_price_on_sale'];
  }
  if (isset($_SESSION["shopping_cart"])) {
    $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
    if (!in_array($_GET["id"], $item_array_id)) {
      $count = count($_SESSION["shopping_cart"]);
      $item_array = array(
        'item_id'              =>    $_GET['id'],
        'item_name'            =>    $row['product_name'],
        'item_price'           =>    $thePrice,
        'item_quantity'        =>    $_GET['quantity'],
        'item_total_price'     =>    $thePrice * $_GET['quantity'],
        'item_image'           =>    $row['product_m_img'],
        'item_size'            =>    $_GET['size'] ?? "S"
      );
      $_SESSION["shopping_cart"][$count] = $item_array;
    }
    // IF item is exist in session
    else {
      foreach ($_SESSION["shopping_cart"] as $keys => $values) {
        if ($values['item_id'] == $_GET['id']) {
          $newQuantity = $_GET['quantity'] + $values['item_quantity'];
          $newPrice    = $newQuantity * $values['item_price'];
          $_SESSION["shopping_cart"][$keys]['item_quantity'] = $newQuantity;
          $_SESSION["shopping_cart"][$keys]['item_total_price'] = $newPrice;
          $_SESSION["shopping_cart"][$keys]['item_size'] = $_GET['size'];
        }
      }
    }
    if (isset($_GET['page'])) {
      if ($_GET['page'] == "cat") {
        header("Location: category.php");
      }
      if ($_GET['page'] == "index") {
        header("Location: index.php");
      }
    }
  }
  // IF Session not exist
  else {
    $item_array = array(
      'item_id'           =>    $_GET["id"],
      'item_name'         =>    $row['product_name'],
      'item_price'        =>    $thePrice,
      'item_quantity'     =>   $_GET['quantity'],
      'item_total_price'  =>   $thePrice * $_GET['quantity'],
      'item_image'        =>    $row['product_m_img'],
      'item_size'            =>    $_GET['size'] ?? "S"
    );
    $_SESSION["shopping_cart"][0] = $item_array;
  }
  $totalCart = 0;
  foreach ($_SESSION['shopping_cart'] as $keys => $values) {
    $totalCart += $values['item_total_price'];
  }
  $_SESSION['cart_total_price'] = $totalCart;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Mini-E-commerce Site">
  <title>Mini-E-commerce Site</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="Welcome-Page.css">

  
<!-- <!DOCTYPE html>
<html lang="en">

<head> -->
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="img/favicon.png" type="image/png" />
  <title>Eiser ecommerce</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.css" />
  <!-- <link rel="stylesheet" href="vendors/linericon/style.css" /> -->
  <link rel="stylesheet" href="css/font-awesome.min.css" />
  <link rel="stylesheet" href="css/themify-icons.css" />
  <!-- <link rel="stylesheet" href="css/flaticon.css" /> -->
  <!-- <link rel="stylesheet" href="vendors/owl-carousel/owl.carousel.min.css" /> -->
  <!-- <link rel="stylesheet" href="vendors/lightbox/simpleLightbox.css" /> -->
  <!-- <link rel="stylesheet" href="vendors/nice-select/css/nice-select.css" /> -->
  <!-- <link rel="stylesheet" href="vendors/animate-css/animate.css" /> -->
  <!-- <link rel="stylesheet" href="vendors/jquery-ui/jquery-ui.css" /> -->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <!-- main css -->
  <!-- <link rel="stylesheet" href="css/style.css" /> -->
  <!-- <link rel="stylesheet" href="css/responsive.css" /> -->
  <!-- <link rel="stylesheet" href="css/slider.css"> -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.css" rel="stylesheet" /> -->
  <!-- <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
<style>
    :root {
  --mainColor: #eaedfe;
  --mediumColor: #9da3fb; /#8b22e2/
  --lightColor: #c1c3fc;
  --button-color: #717ce8;
}
* {
  font-family: 'Heebo', sans-serif;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  scroll-behavior: smooth;
}
body {
  background-color: #eaedfe;
}
  .header_area{
      
    background-color:#eaedfe !important;
}
    i.ti {
      cursor: pointer;
    }

    .myBtn {
      border: none;
      background: transparent;
    }

    .myBtn a {
      color: white !important;
    }

    .myBtn a:hover {
      color: black !important;
    }

    .mylinks>li,
    .mylinks>p {
      transition: 0.3s all ease;
    }

    .mylinks>li:hover,
    .mylinks>p:hover {
      color: white;
    }

    [class^="ti-"] {
      font-size: 20px;
    }

    .cont {
      display: flex;
    }

    @media (max-width:500px) {
      .cont {
        margin-top: 10px;
      }

      .cont>li:nth-of-type(1) {
        margin-left: 0;
      }
    }
  .searchTerm{
      border-color: transparent;
      border-radius: 5px;
  }
  </style>

</head>


<body>
  <!--================Header Menu Area =================-->
  <header class="header_area" >
    <div class="main_menu">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light w-100 d-flex justify-content-between">
          <!-- Brand and toggle get grouped for better mobile display -->
          <a class="navbar-brand logo_h" href="index.php">
              
            <img src="logo.png" style=" width: 100px ;" alt="" />
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <!-- <span class="icon-bar"></span>
            <span class="icon-bar"></span> -->
          </button>
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse offset w-100 " id="navbarSupportedContent">
            <div class="row  mr-0">
              <div class="col-lg-7 pr-0 ">
                <ul class="nav navbar-nav d-flex justify-content-end align-items-center ">
                  <li class="nav-item active">
                    <a class="nav-link  " href="index.php">Home</a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link  " href="index.php">About </a>
                  </li>
                  <li class="nav-item ">
                    <a class="nav-link  " href="index.php">Contact </a>
                  </li>
                  
                  <li class="nav-item submenu dropdown">

                    <a href="" class="nav-link dropdown-toggle" data-toggle="dropdown"   id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li class="nav-item">
                        <a class="nav-link" href="category.php">All Categories</a>
                      </li>
                      <?php
                      $sqlSelectcategories   = "SELECT * FROM categories";
                      $stmt = $pdo->prepare($sqlSelectcategories);
                      $stmt->execute();
                    //   $result = mysqli_query($connection, $sql);
                      while ($category =  $stmt->fetch() ) {
                        $category_id = $category['category_id'];
                        $category_name = $category['category_name'];
                      ?>
                        <li class=" nav-item">
                          <a class="nav-link" href="individual_category.php?c_id=<?php echo $category_id; ?>"><?php echo $category_name ?></a>
                        </li>
                      <?php } ?>

                    </ul>
                  </li>
                  <?php
                  if (isset($_SESSION['userLogin']) || isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink  " href="index.php?status=logout">Logout</a>
                    </li>
                  <?php
                  } else { ?>
                    <li class="nav-item">
                      <a class="nav-link mylink  " href="login.php">Login</a>
                    </li>
                  <?php } ?>
                  <?php
                  if (isset($_SESSION['adminLogin'])) { ?>
                    <li class="nav-item">
                      <a class="nav-link  " href="admin/index.php">Admin</a>
                    </li>
                  <?php } ?>
                </ul>
              </div>

              <div class="col-lg-5 pr-0 d-flex justify-content-center align-items-center">
                <ul class="nav navbar-nav navbar-right right_nav pull-right">
                  <div class="h-25  header-search my-auto d-flex justify-content-center">
                    <form action="./search.php" method="post">
                        <div class="input-group ">
                            <input type="text" name="search" placeholder="Search For Product" class="form-control" aria-label="Search For Product" aria-describedby="button-addon2">
                            <button class="btn btn-outline-secondary" type="submit" name="submit" id="button-addon2"><i  class="fa fa-search text-white" aria-hidden="true" ></i></button>
                        </div>
                      <!-- <input class="px-2 py-1 searchTerm" name="search" type="text" placeholder="SEARCH">
                      <button class="myBtn" type="submit" name="submit" class="searchButton">
                      <i  class="fa fa-search " aria-hidden="true" style="cursor:pointer; color :#717ce8;"></i>
                      </button> -->
                    </form>
                  </div>
                  <div class="d-flex  justify-content-center align-items-center">
                    <li class="nav-item " style="padding-top: 3px;">
                      <a href="cart.php" class="icons">
                          <span class=""><?php
                                            // if (isset($_SESSION['shopping_cart'])) {
                                                //   $totalQuantity = 0;
                                                //   foreach ($_SESSION['shopping_cart'] as $keys => $values) {
                                                    //     $totalQuantity += $values['item_quantity'];
                                                    //   }
                                                    //   echo $totalQuantity;
                                                    // } else {
                                                   
                                                        // }
                                                        ?>
                        </span>
                        <i class="fa fa-shopping-cart " style="font-size:1em; color :#707bfb;"></i>
                      </a>
                    </li>
                    <li class="nav-item" style="padding-top: 3px;">
                      <a href=" profile.php" class="icons">
                        <i class="fa-solid fa-user mx-2" style="font-size:1em; color :#707bfb;"></i>
                      </a>
                    </li>
                  </div>
                </ul>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </div>
  </header>
  <!--================Header Menu Area =================-->


  <!-- <section>

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active" style="background-image: url('./4k-.jpg')">
      <div class="carousel-caption">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item" style="background-image: url('./4k-.jpg')">
      <div class="carousel-caption">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item" style="background-image: url('./4k-.jpg')">
      <div class="carousel-caption">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</section> -->