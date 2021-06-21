<?php
require_once "config.php";
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


$status = $statusMsg = 'ggg'; 
if(isset($_POST['form_submitted'])){ 
    echo "veikia";
    $status = 'error'; 
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        echo "veikia";
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = file_get_contents($image); 
            $announcment_name = $_POST["pavadinimas"];
            $announcment_category = $_POST["kategorija"];
            $announcment_description = $_POST["aprasymas"];
         
            // Insert image content into database 
            //$insert = $db->query("INSERT into images (image, uploaded) VALUES ('$imgContent', NOW())"); 
            // Prepare an insert statement
            $sql = "INSERT INTO skelbimai (pavadinimas, kategorija, aprasymas, vartotojo_id, image) VALUES (:pavadinimas, :kategorija, :aprasymas, :vartotojo_id, :image)";
         
            if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":pavadinimas", $announcment_name, PDO::PARAM_STR);
                $stmt->bindParam(":kategorija", $announcment_category, PDO::PARAM_STR);
                $stmt->bindParam(":aprasymas", $announcment_description, PDO::PARAM_STR);
                $stmt->bindParam(":vartotojo_id", $_SESSION["id"], PDO::PARAM_INT);
                $stmt->bindParam(":image", $imgContent, PDO::PARAM_LOB);
            
            
            
            // Attempt to execute the prepared statement
                if($stmt->execute()){
                // Redirect to login page
                   header("location: welcome.php");
                 } else{
                     echo "Oops! Something went wrong. Please try again later.";
                }

            // Close statement
                unset($stmt);
            }  
        }
        else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }
    else{
        $statusMsg = "fail";
    }
} 
 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    <style>
        body{ font: 14px sans-serif; }
        .wrapper{ width: 360px; padding: 20px; }
    </style>
</head>
<body>
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-shrink" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top"><img src="assets/img/navbar-logo.png" alt="..." /></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="index.php#portfolio">Skelbimai</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Mano paskyra</a></li>
                        <?php if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === true){
                            echo '<li class="nav-item"><a class="nav-link" href="logout.php">Atsijungti</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>



        <form action="" method="post" enctype="multipart/form-data" style="padding-top:10rem;">
            <div class="form-group">
                <label>Skelbimo nuotrauka:</label>
                <input type="file" name="image">
            </div>    
            <div class="form-group">
                <label>Skelbimo pavadinimas</label>
                <input type="text" name="pavadinimas">
            </div>
            <div class="form-group">
                <label>Skelbimo kategorija</label>
                <input type="text" name="kategorija">
            </div>
            <div class="form-group">
                <label>Skelbimo aprasymas</label>
                <input type="text" name="aprasymas">
                <input type="hidden" name="form_submitted" value="1" />
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Įkelti">
            </div>
        </form>

</body>
</html>