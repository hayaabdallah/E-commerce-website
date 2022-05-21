<?php 

require 'connect.php';
include_once 'header.php'
?>
   
<?php

 if(isset($_POST['orders']))
 {
 
 
   try {
      $sql = "SELECT * FROM orders  JOIN users WHERE orders.user_id = 7  AND users.user_id = 7;";
      $stat = $pdo->query($sql);
      $order = $stat->fetchAll();
  
      $coun = $stat->rowCount();
  if ($coun === 0 ){
  echo '<div class="container-fluid  mt-100">
  <div class="row">
  
  <div class="col-md-12">
  
  <div class="card">
    <div class="card-header">
        <h5>Cart</h5>
    </div>
    <div class="card-body cart">
        <div class="col-sm-12 empty-cart-cls text-center">
            <img src="https://i.imgur.com/dCdflKN.png" width="130" height="130" class="img-fluid mb-4 mr-3">
            <h3><strong>Your order is Empty</strong></h3>
            <h4>Add order to make me happy:)</h4>
            <a href="#" class="btn btn-primary cart-btn-transform m-3" data-abc="true" style="background-color: #717ce8;">continue shopping</a>
  
  
        </div>
    </div>
  </div>
  
  
  </div>
  
  </div>
  
  </div>';
  }else {
       ?>
  <div class="container">
          <h3>Your order</h3>
          <br>
          <table class="table table-striped table-hover">
              <thead>
                  <tr>
                      <th scope="col">Name </th>
                      <th scope="col">Email</th>
                      <th scope="col">Address </th>
                      <th scope="col">Phone</th>
                      <th scope="col">Totel</th>
                  </tr>
              </thead>
              <tbody>
  </div>
                  <?php
               
                foreach($order as $value):
                 
  
                  ?>
                  
                      <tr scope="row">
                      <td> <?php  echo  $value['user_name']; ?></td>
                          <td> <?php  echo  $value['user_email'] ; ?></td>
                          <td><?php echo   $value['order_address']; ?></td>
                          <td> <?php  echo '(+962)'.$value['phone_number'] ; ?></td>
                          <td><?php echo   $value['order_total_amount']; ?></td>
                            
                      </tr> </tbody> </table>
                     <?php
                     endforeach;
                  }}
                  catch (PDOException $e){
                    echo "Faild"  . $e->getMessage() . "<br/>";
                   
                  }
 
 };
 
