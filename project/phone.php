<?php
include_once "header.php";
require 'connect.php';
include_once "sidenew.php";
?>

<style>
  body
  {
    background:#eaedfe;
  }
</style>

           
<?php

try {

  $sql = $pdo->prepare("SELECT * FROM products WHERE category_id=18");
  $sql->execute();
  $pro = $sql->fetch();
  if ($pro) {
   echo '<div class="container mt-5">';
    echo '<div class="row row-cols-1 row-cols-md-4 g-4">';
     
      echo ('
     
      <div class="col-lg-4 col-md-6 my-5" >
          
      <div class="card" style="background:#f9f9f9">
    
      <img class="card-img-top" src="image/'.$pro['product_m_img'].'" alt="Card image">
     
       <div class="card-body">
          <h4 class="card-title text-center" style="color:black">'.$pro['product_name'].'</h4>
          <p class="card-text text-center"style="color:black">$'.$pro['product_price'].'</p>
         
        </div>
        </div>
        </div>
     ') ;
  
      };
     echo '</div>';
     echo '</div>';
  }
catch (PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
} finally {
  $conn = NULL;
}



include "footer.php";
?>

</body>
</html>