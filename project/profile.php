<?php
include "header.php";
require "connect.php";
?>


<?php



try {
    //$userid=$_SESSION['userLogin'];
    //$user_id=$userid
   // if(7){
    $sql = $pdo->prepare("SELECT * FROM users WHERE user_id=7");
    $sql->execute();
   // $statment = $pdo->query($sql);
    $pro = $sql->fetch();
}

catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
};


  
if (isset($_POST['update'])) {
    $state = check($_POST['name'],  $_POST['email'], $_POST['phone']);
};




 






?>
<div class="container">
<div class="row flex-lg-nowrap">
  <div class="col-12 col-lg-auto mb-3" style="width: 200px;">
    
  </div>

  <div class="col">
    <div class="row">
      <div class="col mb-3">
        <div class="card">
          <div class="card-body">
            <div class="e-profile">
              <div class="row">
                <div class="col-12 col-sm-auto mb-3">
                  <div class="mx-auto" style="width: 140px;">
                    <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                      <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;"><img class="card-img-top" src=" image/<?php  echo  $pro['user_img']?>"></span>
 
                    </div>
                  </div>
                </div>
                <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                  <div class="text-center text-sm-left mb-2 mb-sm-0">
                  <form class="form" method="post" action="edit.php" enctype="multipart/form-data" >

                    <div class="mt-2">
                      <button class="btn btn-primary" type="button" style="background:#717ce8;">

                        <i class="fa fa-fw fa-camera"></i>
                      
                        <input type="file" name="image">
                      </button>
                    
                    </div>
                  </div>
                  <div class="text-center text-sm-right">
                    <span class="badge badge-secondary">administrator</span>
                   
                  </div>
                </div>
              </div>
              <ul class="nav nav-tabs">
                <li class="nav-item"><a href="" class="active nav-link">Settings</a></li>
              </ul>
              <div class="tab-content pt-3">
                <div class="tab-pane active">

                    
                    <div class="row">
                      <div class="col">
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Full Name</label>
                              <input class="form-control" type="text" name="name" placeholder="" value="<?php echo $pro['user_name'] ?>">
                              <span class="error" style= "color:red;"><?php echo $errors[0] ?? "" ?></span>
                              </br>
                            </div>
                          </div>
                          
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Email</label>
                              <input class="form-control" type="email" placeholder="" name="email" value="<?php echo  $pro['user_email'] ?>">
                              <span class="error" style= "color:red;"><?php echo $errors[1] ?? "" ?></span>
                              </br>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Phone</label>
                              <input class="form-control" type="text" placeholder="" name="phone" value="<?php echo  $pro['user_phone'] ?>">
                              <span class="error" style= "color:red;"><?php echo $errors[2] ?? "" ?></span></div>
                              </br>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col">
                            <div class="form-group">
                              <label>Address</label>
                              <input class="form-control" type="text" name="address" placeholder="" value="<?php echo  $pro['user_address'] ?>">
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                   
                  </br>
                    <div class="row">
                      <div class="col d-flex justify-content-end">
                        <button class="btn btn-primary" type="submit" name="update" style="background:#717ce8;margin-right:10px;">Save Changes</button>
                        </form>
                        <form action="orders.php" method="post">
                        <a href=""><button class="btn btn-primary" name="orders" type="submit" style="background:#717ce8">Show orders</button></a>
                        </form>
                      </div>
                    </div>
                
        
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12 col-md-3 mb-3">
        <div class="card mb-3">
          <div class="card-body">
            <div class="px-xl-3">
              <a class="btn btn-block btn-secondary" href="index.php?status=logout">
                <i class="fa fa-sign-out"></i>
                <span>Logout</span>
            </a>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <h6 class="card-title font-weight-bold">Support</h6>
            <p class="card-text">Get fast, free help from our friendly assistants.</p>
            <button type="button" class="btn btn-primary" style="background:#717ce8">Contact Us</button>
          </div>
        </div>
      </div>
    </div>

  </div>
  <?php

  ?>
</div>
</div>



<?php
function check($name, $email, $phone)
{
    global $errors;
	$regexName      = "/^[A-z ]{3,}$/";
	$regexPhone      = "/^((\+)((0[ -])|((91 )))((\d{12})+|(\d{10})+))|\d{5}([- ]*)\d{6}$/";
	$regexEmail     = "/^[A-z0-9._-]+@(hotmail|gmail|yahoo).com$/";
	$state = true;
	// Validation
	if (empty($name) || trim($name) == "") {
		$errors[0] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexName, $name)) {
		$errors[0] = "This field is not correct, only letters are allowed";
		$state     = false;
	}
	if (empty($email) || trim($email) == "") {
		$errors[1] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexEmail, $email)) {
		$errors[1] = "This field is not correct";
		$state     = false;
	}
    if (empty($phone) || trim($phone) == "") {
		$errors[2] = "This field is required";
		$state     = false;
	} else if (!preg_match($regexPhone, $phone)) {
		$errors[2] = "This field is not correct, enter a valid phone number";
		$state     = false;
	}
	return $state;
}

?>

<?php
include 'orders.php';
include "footer.php";
?>
</body>
</html>