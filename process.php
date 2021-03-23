<?php 
session_start();
$update = false;
$first_name = '';
$last_name = '';
$email = '';
$location = '';
$photo = '';
$mysqli = new mysqli('localhost' , 'root' , '', 'php_crud') or die(mysqli_error($mysqli));
if(isset($_POST['save_btn'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $photo = $_FILES['image']['name'];
   	$upload = "uploads/" .$photo;
  $mysqli->query( "INSERT INTO users (first_name ,last_name, email ,location, photo)  VALUES(' $first_name' , ' $last_name' , '$email','$location','$upload')")or die($mysqli->error);
    move_uploaded_file($_FILES['image']['tmp_name'],$upload);
    $_SESSION['message'] = "Data inserted successfully!";
    $_SESSION['message_type'] = "success";

    header("location : index.php");
}
//delete section
if(isset($_GET['delete'])){
      $id =  $_GET['delete'];
     // $row = $result->fetch_assoc( );
      $imagepath = $row['photo'];
      unlink($imagepath);
      $result = $mysqli->query("SELECT * FROM users WHERE id ='$id' ")or die($mysqli->error);

      $mysqli->query("DELETE FROM users WHERE id= '$id' ")or die($mysqli->error);
      $_SESSION['message'] = "Data deleted successfully!";
      $_SESSION['message_type'] = "danger";

      header("location :index.php");
}
if(isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM users WHERE id = '$id' ")or die($mysqli->error);
        // if(count($result) == 1){
        $row = $result->fetch_array();
        $first_name = $row['first_name'];
        $last_name = $row['last_name'];
        $email = $row['email'];
        $location = $row['location'];
        $photo =$row['photo'];
       // header("location: index.php");
  //  }  
}
//udate part
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $oldImg = $_POST['old_img'];
    if (isset($_FILES['image']['name'])&&($_FILES['image']['name'] !== "")) {
        $newImg ="uploads/".$_FILES['image']['name'];
        unlink($oldImg);
        move_uploaded_file($_FILES['image']['tmp_name'], $newImg);
    }else{
        $newImg = $oldImg;
    }
    $mysqli->query("UPDATE users SET first_name ='$first_name', last_name ='$last_name' , email = ' $email' , location = '$location' , photo = '$newImg' WHERE id='$id' ") or die($mysqli->error);

    $_SESSION['message'] = "Data Updated successfully!";
    $_SESSION['message_type'] = "success";
    header("location : index.php");
}
//details
if(isset($_GET['details'])){
$id = $_GET['details'];
$result = $mysqli->query("SELECT * FROM users WHERE id = $id ")or die($mysqli->error);
    if (isset($result->num_rows) && $result->num_rows >0) {
        $row = $result->fetch_array( );
        $details_id = $row['id'];
        $details_first_name = $row['first_name'];
        $details_last_name = $row['last_name'];
        $details_email = $row['email'];
        $details_location = $row['location'];
        $details_photo = $row['photo'];

     }

}

?>