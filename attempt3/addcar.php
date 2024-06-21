<?php
session_start();
error_reporting(0);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'partials/_dbconnect.php';
    $model=$_POST["model"];
    $num=$_POST["num"];
    $capacity=$_POST["capacity"];
    $rent=$_POST["rent"];

    if(isset($_FILES["image"]) && $_FILES["image"]["error"]==0)
    { 
    $target_dir="Uploads/";
    $target_file=$target_dir.basename($_FILES["image"]["name"]);
    // echo "Target file: ". $target_file;
    $imageFileType=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $uploadOk=1;

    // checking if the file is an image 
    $check=getimagesize($_FILES["image"]["tmp_name"]);
    if($check!=false){
        // echo "File is an image - ".$check["mime"].".";
        $uploadOk=1;
    }
    else{
        // echo "File is not an image.";
        $uploadOk=0;
    }
    
    // checking for file size 
    if($_FILES["image"]["size"]>500000){
        // echo "Sorry, your file is too large.";
        $uploadOk=0;
    }
    
    // allowing certain file format 
    if($imageFileType!="jpg" && $imageFileType!="png" && $imageFileType!="jpeg" && $imageFileType!="gif")
    {
        // echo "sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk=0;
    }

    // checking if $uploadOk is set to 0 by error 
    if($uploadOk==0){
        // echo "Sorry, your file ws not uploaded.";
    }
    else{
        if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file))
        {
            // echo "The file ".basename($_FILES["image"]["name"])." has been uploaded.";
        }else{
            // echo "There was an error uploading your file.";
        }
    }

    $existornot=false;
    $suc=false;
    $showerror=false;
        //Checking whether the email is already registered or not
    $sql="SELECT * FROM car WHERE num='$num'";
    $result=mysqli_query($conn,$sql);
    $rowcount=mysqli_num_rows($result);
    if($rowcount>0) 
        $existornot = true;
    else {
        //Inserting data into users table
        $sql2 = "INSERT INTO `car` (`id`, `model`, `num`, `capacity`, `rent`, `available`, `booked`, `duration`, `startdate`,`image_path`) VALUES (NULL, '$model', '$num', '$capacity', '$rent', current_timestamp(), '0', '1', current_timestamp(),'$target_file')";
        $result1=mysqli_query($conn,$sql2);
        // $sql5="INSERT INTO `car_images` (`car_id`, `image_path`) VALUES ('"
        if($result1)
            $suc=true;
    }
}
else{
    echo "No image file was uploaded.";
}
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="header1style.css">
    <link rel="stylesheet" href="footer1style.css">
    <link rel="stylesheet" href="agencyregistrationstyle.css">
    <script src="loginchecker.js"></script>
    <title>Add Car</title>
</head>
<body>
<!-- header section  -->
    <div >
        <div class="header-part1">
            <nav class="navbar navbar-expand-md navbar-dark">
            <a href="index.php" class="navbar-brand brand-logo">
                <img class="brand-logo" src="Images/logo3.png" alt="logo">
            </a>
            <button class="btn btn-primary navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-pills header-except-logo">
                    <?php 
                    $val1=false; 
                    if(isset($_SESSION['loggedin']) &&  $_SESSION['loggedin'] == true){
                        $val1=true;
                    }
                    if(!$val1)
                    { 
                    echo '<li class="nav-item header-login-button">
                    <a href="login.php"><button type="button" class="btn btn-primary header-login-button1" >login</button><a>
                    </li>
                    <li class="nav-item header-register-button">
                    <a href="register.php"><button type="button" class="btn btn-primary header-register-button1" >Register</button><a>
                    </li>
                    ';
                    }
                    else{ 
                        echo '<li class="nav-item header-loggedin-button">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span>Logged In</span>
                                </button>      
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">';
                                if($_SESSION['emid']>-1)  { 
                                    echo ' 
                                    <a class="dropdown-item" href="addcar.php">Add cars</a>
                                    <a class="dropdown-item" href="booked.php">booked cars</a>';
                                }
                        echo    '<a class="dropdown-item" href="logout.php">LogOut</a>
                                </div>
                            </div>
                        </li>';
                        }
                    ?>
                </ul>
            </div>

            </nav>
        </div>
        <div class="header-part2">
            <div class="menu">
                <ul class="nav nav-pills menu">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link  a-text-color1 home-button">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="AllProduct.php" class="nav-link a-text-color1">Available cars</a>
                    </li>
                    <li class="nav-item">
                        <a href="contact.php" class="nav-link a-text-color1">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


<!-- main code  -->


    <form action="./addcar.php" class="myform" method="post" enctype="multipart/form-data">
        <div class="frm-content">
            <div class="row form flex-column align-items-center justify-content-center">


                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <h2 class="text-center login-title">Add New car</h2>
                    <div class="alert alert-danger" role="alert" <?php if(!isset($existornot) || $existornot==false) echo 'style="display:none"'?>>
                        Car with same vechicle number already exists!!
                    </div>
                    <div class="alert alert-success" role="alert" <?php if(!isset($suc) || $suc==false) echo 'style="display:none"'?>>
                        Successfully added new car!!
                      </div>
                    <label for="model" class="name-title">
                        Model 
                    </label>
                    <input type="text" name="model" id="name" placeholder="Enter vechicle model.." required>
                    <label for="num" class="name-title">
                        Vechicle Number 
                    </label>
                    <input type="text" name="num" id="name" placeholder="Enter vechicle number.." required>
                    <label for="capacity" class="name-title">
                        Seating capacity 
                    </label>
                    <input type="number" name="capacity" id="name" placeholder="Enter seat capacity.." required>
                    <label for="rent" class="name-title">
                        Rent per day 
                    </label>
                    <input type="number" name="rent" id="name" placeholder="Enter rent of vechicle.." required>
                    <label for="rent" class="name-title">
                        Upload car image 
                    </label>
                    <input type="file" name="image" id="name" placeholder="upload the image.." required>

                </div>

                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <button type="submit" class="btn btn-primary register-btn" >+</button>
                </div>

            </div>

        </div>
    </form>


<!-- footer section  -->

<div style="background-color: #252525;padding:20px;">
    <div class="row">
<span class="copyright-text">Your journey starts here. Book your dream car, hassle-free.</span>
<br>
<br>
<span class="copyright-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusamus adipisci harum facilis explicabo quas provident quis culpa vero.</span>
</div>
<br>
<br>
<div class="row">
<div class="col-sm-4">
    <div class="row">
        <a href="index.php" class="footer-heading"><b>Home</b></a>
    </div>
</div>
<div class="col-sm-4">
    <div class="row">
        <a href="#" class="footer-heading"><b>Help</b></a>
    </div>
</div>
<div class="col-sm-4">
    <div class="row">
        <a href="contact.php" class="footer-heading"><b>Contact Us</b></a>
    </div>
</div>
</div>
<hr class="line-divider">
<div class="copyright-section">
<p class="copyright-text" >Copyright ©CarRental 2024-25</p>
</div> 
    </div>


</body>
</html>
