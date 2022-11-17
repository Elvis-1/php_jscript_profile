<?php
session_start();
require_once 'php/pdo.php';
require_once 'php/profile.php';

if(!isset($_SESSION['name']) || !isset($_SESSION['profile_id']) )
{
    $_SESSION['error'] =  "You have no profile yet.";
    header('Location: index.php');
    return;
}

$profile_id = $_SESSION['profile_id'];

$profile_details = Profile::getProfile($pdo, $profile_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Information Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   <div class="container">
    <div class="card profile-card">
        <h1>Welome <?= $_SESSION['name']; ?></h1>
        <div class="circle-image"><img class="profile-image" src="<?php echo $profile_details['image'];?>" alt="ifnotgod" ></div>
        <h3>You are all set</h3>
        <p>Expect more with PHP and JavaScript</p>
    </div>
    
   </div> 
</body>
</html>