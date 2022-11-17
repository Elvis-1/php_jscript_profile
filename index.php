<?php
session_start();
require_once 'php/pdo.php';
require_once 'php/profile.php';


if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_FILES["image"]) )
{
    // instantiate
 $profile = new Profile($_POST['name'],$_POST['email'],$_POST['phone'],$_FILES["image"],$pdo);

 
    // validate
 $result =  $profile->validateProfile();

 // image target file
 $target_file = $profile->getImageFile();

if(is_string($result))
{

  $_SESSION['error'] = $result;
  header('Location: index.php');
  return;
}

      // insert into profile

if($profile->insertIntoProfile())
{
  header('Location:profile.php');
  return;
}
    
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

   
    <title>JavaScript PHP Auth</title>
    <script src="js/sweetalert.js"></script>
</head>
<body>
    <div class="container">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="card">
            
            <h1 id="upload-text">Upload Profile</h1>
            <img src="images/if not God 2.png" alt="ifnotgod" >
            <div id="error"></div>

<?php if(isset($_SESSION['error']))
    {
    ?>
    <script>
Swal.fire({
  icon: '<?php echo $_SESSION['error'];?>',
  title: 'Oops...',
  text: '<?php echo $_SESSION['error'];?>',
  //footer: '<a href="">Why do I have this issue?</a>'
})
    
    </script>

    <?php };
    unset($_SESSION['error']);
    ?>

    <!-- Scrollable modal -->

                    <!-- name -->
        <div class="name">
           
            <input type="text" placeholder="name" name="name" id="name">
        </div>
                <!-- email -->
                <div class="email input-div">
                    
                    <input type="email" placeholder="email" name="email" id="email">
                </div>
                 <!-- phone -->
                <div class="phone input-div">
                 
                 <input type="number" placeholder="phone number" name="phone" id="phone">
                </div>
                 <!-- phone -->
                <div class="image input-div">

                <input type="file" placeholder="image" name="image" id="image">
                 </div>
                 <!-- <button>Upload</button> -->
                 <input id="input" data-bs-toggle="modal" data-bs-target="#staticBackdrop" class="submit" type="submit" onclick="" value="Upload">

        </div>
        </form>
 


    </div>

<script src="js/script.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

</body>
</html>