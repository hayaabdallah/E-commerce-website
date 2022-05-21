<?php
include "connect.php";

try{

    function imagePath()
{
	global $imagePath;
	$image = $_FILES['image'] ?? null;
	
	$imagePath = "";
	if ($image && $image['tmp_name']) {
		$imagePath = 'IMG-' . uniqid() . "-" . $image['name'];
		move_uploaded_file($image['tmp_name'], "image/" . $imagePath);
	}
}


    if(isset($_POST['update'])){
   imagePath();
 $i=7;
 $user_name=$_POST["name"];
 $user_email=$_POST["email"];
 $user_phone=$_POST["phone"];
 $user_address=$_POST["address"];
 $user_image=$imagePath;
echo $user_image;

$query= "UPDATE users SET user_name = ?, user_email = ?, user_phone =? , user_address =? , user_img=?  WHERE user_id =?";

$result=$pdo->prepare($query);


$result->execute([$user_name,$user_email,$user_phone,$user_address,$user_image,$i]);
echo ('successfully');
header('location:profile.php');
    }
}
catch (PDOException $e)
{
    echo $query . "</br>" . $e->getMessage();
}
finally{
    $db=Null;
}

?>