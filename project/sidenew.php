<?php
require "connect.php";

?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>

        *{
            box-sizing: border-box;
        }
        body{
            color: grey;
        }
        #sidebar{
            width: 20%;
            padding: 10px;
            margin: 0;
            float: left;
        }
        #products{
            width: 80%;
            padding: 10px;
            margin: 0;
            float: right;
        }
        ul{
            list-style: none;
            padding: 5px;
        }
        li a{
            color:#838383;
            text-decoration: none;
        }
        li a:hover{
            text-decoration: none;
            color: darksalmon;
        }
        .fa-circle{
            font-size: 20px;
        }
        #gold{
            color:#eedfa9;
        }
        #black{
            color:Black;
        }
        #blue{
            color:#0096FF;
        }
        .card{
            width: 250px;
            display: inline-block;
            height: 300px;
        }
        .card-img-top{
            width: 250px;
            height: 210px;
        }
        .card-body p{
            margin: 2px;
        }
        .card-body{
            padding: 0;
            padding-left: 2px;
        }
        .filter{
            display: none;
            padding: 0;
            margin: 0;
        }
        
        @media(min-width:991px){
            .navbar-nav{
                margin-left: 35%;
            }
            .nav-item{
                padding-left: 20px;
            }
            .card{
                width: 190px;
                display: inline-block;
                height: 300px;
            }
            .card-img-top{
                width: 188px;
                height: 210px;
            }
            #mobile-filter{
                display: none;
            }
        }
        @media(min-width:768px) and (max-width:991px){
            .navbar-nav{
                margin-left: 20%;
            }
            .nav-item{
                padding-left: 10px;
            }
            .card{
                width: 230px;
                display: inline-block;
                height: 300px;
                margin-bottom: 10px;
            }
            .card-img-top{
                width: 230px;
                height: 210px;
            }
            #mobile-filter{
                display: none;
            }
        }
        @media(min-width:568px) and (max-width:767px){
            .navbar-nav{
                margin-left: 20%;
            }
            .nav-item{
                padding-left: 10px;
            }
            .card{
                width: 205px;
                display: inline-block;
                height: 300px;
                margin-bottom: 10px;
            }
            .card-img-top{
                width: 203px;
                height: 210px;
            }
            .fa-circle{
                font-size: 15px;
            }
            #mobile-filter{
                display: none;
            }
        }
        @media(max-width:567px){
            .navbar-nav{
                margin-left: 0%;
            }
            .nav-item{
                padding-left: 10px;
            }
            #sidebar{
                width: 100%;
                padding: 10px;
                margin: 0;
                float: left;
            }
            #products{
                width: 100%;
                padding: 5px;
                margin: 0;
                float: right;
            }
            .card{
                width: 230px;
                display: inline-block;
                height: 300px;
                margin-bottom: 10px;
                margin-top: 10px;
            }
            .card-img-top{
                width: 230px;
                height: 210px;
            }
            .list-group-item{
                padding: 3px;
            }
            .offset-1{
                margin-left: 8%;
            }
            .filter{
                display: block;
                margin-left: 70%;
                margin-top: 2%;
            }
       
            #mobile-filter{
                padding: 10px;
            }
        }
              </style>  

</head>
  <body>
    </br>
    </br>
    <section id="sidebar">
        <div>
            <h6 >Shop by category</h6> <hr>
            <ul>
               <li><a href="allproduct.php">All Products</a></li>
               </br><hr style="width:250px;">
                <li><a href="phone.php">Phone</a></li>
                </br><hr style=" width:250px;">
                <li><a href="tablet.php">Tablet</a></li>
                </br><hr style="width:250px;">
                <li><a href="accessories.php">Accessories</a></li>
            
            </ul>
        </div>

  
    </section>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>