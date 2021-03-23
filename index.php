<?php 
include "process.php";


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <title>PHP CRUD With MYSQL and Bootstrap 4</title>
  </head>
  <body>
    <?php if(isset($_SESSION['message'])){ ?>
  <div class="alert-dismissible text-center alert alert-<?php echo $_SESSION['message_type']; ?>">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <b><?php echo $_SESSION['message']; ?></b>
  </div>
  <?php } unset($_SESSION['message'])  ?>
<?php
 $result = $mysqli->query("SELECT * FROM users") or die($mysqli->error);
?>
  <div class="container">
      <div class="row justify-content-center  ">
      <table class="table">
         <thead class="bg-dark text-light">
            <tr>
            <th>Image</th>
              <th>First name</th>
              <th>Last name</th>
              <th>Email</th>
              <th>Location</th>
              <th colspan="2">Action</th>
            </tr>
         </thead>
         <tbody>
 <?php 
          while ($row = $result->fetch_assoc()) {
  ?>
    <tr>
            <td><img src="<?php echo $row['photo'] ?>" width="30" alt="" srcset=""></td>
            <td><?php echo $row['first_name'] ?></td>
            <td><?php echo $row['last_name'] ?></td>
            <td><?php echo $row['email'] ?></td>
            <td><?php echo $row['location'] ?></td>
            <td>
                   <a href="details.php?details=<?php echo $row['id'] ?>" class="btn btn-primary">Details</a> 
                  <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                  <a href="process.php?delete=<?php echo $row['id'] ?>"  class="btn btn-danger" onclick="return confirm('Do you  want to delete this data?')">Delete</a>
            </td>
    </tr>
<?php } ?>
         </tbody>
      </table>
      </div>
        <div class="row justify-content-center">
            <div class="col-lg-4">
            <form action="process.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id;?>">
                <div class="form-group">
                  <label for="first_name">First name</label>
                  <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First name" aria-describedby="helpId" value="<?php echo $first_name; ?>" required>
                </div>
                <div class="form-group">
                  <label for="last_name">Last name</label>
                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last name" aria-describedby="helpId" value="<?php echo $last_name; ?>"  required>
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control" placeholder="Email" aria-describedby="helpId" value="<?php echo $email;?>" required>
                </div>
                <div class="form-group">
                  <label for="location">Location</label>
                  <input type="text" name="location" id="location" class="form-control" placeholder="Location" aria-describedby="helpId" value="<?php echo $location;?>">
                </div>
                <div class="form-group">
                    <input type="hidden" name="old_img" value="<?php echo $photo; ?>">
                  <label for="image">Image Upload</label>
                  <input  type="file" name="image" id="image" class="custom-file">
                  <img src="<?php echo $photo; ?>" width="120" class="img-thumbnail" alt="" srcset="">
                </div>
                <div class="form-group">
                <?php if($update == true){?>
                    <button name="update" type="submit" class="btn btn-primary mt-2">Update</button>
               <?php }else{?>
                <button name="save_btn" type="submit" class="btn btn-primary mt-2">Submit</button>
            <?php   } ?>
                </div>
            </form>
        </div>
        </div>
    </div>




























































































    

    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>