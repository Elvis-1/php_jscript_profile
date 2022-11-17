<?php
class Profile{
    // properties
    private $name;
    private $email;
    private $phone;
    private $image;

    private $pdo;
    private $profile_last_id;
    private $image_target_file;

     function __construct($name,$email,$phone, $image,$pdo)
    {
       $this->name = $name;
       $this->email = $email;
       $this->phone = $phone;
       $this->image = $image;
       $this->pdo = $pdo;
    }

    public function getImageFile()
    {
        return $this->image_target_file;
    }

    public function validateProfile()
    {
        
      

        if(empty($this->name)||  $this->name == '')
        {
            // $_SESSION['error'] = 'Name can\'t be empty';
            $message = 'Name can\'t be empty';
            // header('Location: index.php');
            return $message;
        }
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
          //  $_SESSION['error'] = 'Email must be correctly formed';
          $message = 'Email must be correctly formed';
           // header('Location: index.php');
            return $message;
        }
    
        if(!is_numeric( $this->phone)){
           // $_SESSION['error'] = 'Can only accept numbers';
            $message = 'Can only accept numbers';
           // header('Location: index.php');
            return $message;
        }

        $target_dir = "uploads/";
        $target_file = $target_dir . basename($this->image["name"]);
        
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        // Check if image file is a actual image or fake image
     
          $check = getimagesize($this->image["tmp_name"]);
          if($check == false) {
          
            //$_SESSION['error'] =  "File is not an image - " . $check["mime"] . ".";
            $message = "File is not an image - " . $check["mime"] . ".";
           // header('Location: index.php');
            return $message;
          }

    // Check if file already exists
    if (file_exists($target_file)) {
       // $_SESSION['error'] =  "Sorry, file already exists.";
        $message = "Sorry, file already exists.";
        //header('Location: index.php');
        return $message;
      }

      $this->image_target_file = $target_file;
      
      // Check file size
      if ($this->image["size"] > 500000) {
       // $_SESSION['error'] =  "Sorry, your file is too large.";
        $message = "Sorry, your file is too large.";
        //header('Location: index.php');
        return $message;
      }
      
      // Allow certain file formats
      if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" ) {
        //$_SESSION['error'] =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        //header('Location: index.php');
        return $message;
      }
      
  
        if (move_uploaded_file($this->image["tmp_name"], $target_file)) {
        //  echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
        } else {
          $_SESSION['error'] =  "Sorry, there was an error uploading your file.";
          $message = "Sorry, there was an error uploading your file.";
        //  header('Location: index.php');
          return $message;
        }

        return true;
    }

    public function insertIntoProfile()
{
        $stmt = $this->pdo->prepare('INSERT INTO profile(name,email,phone,image) VALUES(:nm,:em,:ph,:im)');

        $res = $stmt->execute(array(
           ':nm'=> $this->name,
           ':em'=>$this->email,
           ':ph'=>$this->phone,
           ':im'=>$this->image_target_file
         ));
   if($res)
   {


       $_SESSION['name'] = $_POST['name'];
       $this->$profile_last_id = $this->pdo->lastInsertid();
       $_SESSION['profile_id'] =  $this->$profile_last_id;
       return  true;

   }
    }

public static function getProfile($pdo, $profile_id)
{
    $stmt = $pdo->prepare('SELECT * FROM profile WHERE profile_id = :pid');
    $stmt->execute(array(
        ':pid'=>$profile_id,
    ));
    
    $profile_details = $stmt->fetch(PDO::FETCH_ASSOC);
    return $profile_details;
}

}