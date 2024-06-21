
<?php
// error_reporting(0);
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include 'partials/_dbconnect.php';
    $name=$_POST["name"];
    $emid=$_POST["emid"];
    $email=$_POST["email"];
    $password=$_POST["password"];
    $re_password=$_POST["re_password"];
    $existornot=false;
    $suc=false;
    $showerror=false;
    $showerror1=false;
    $showerror2=false;

    if($password!=$re_password)
        $showerror=true;
    elseif($emid<0)//emid for employs should be > 0 and for user should be -1 (default)
    {
        $showerror1=true;
    }
    else {
        
        //Checking whether the email is already registered or not
        $sql="SELECT * FROM user WHERE email='$email'";
        $result=mysqli_query($conn,$sql);
        $rowcount=mysqli_num_rows($result);
        $sql2="SELECT * FROM user WHERE emid='$emid'";
        $result2=mysqli_query($conn, $sql2);
        $rowcount2 = mysqli_num_rows($result2);  
        if($rowcount2 > 0){//if user with same emid already exist
            $showerror2=true;
        }
        elseif($rowcount>0) //if user with same email already exisit
            $existornot = true;
        else {//if every thing is fine
            //Inserting data into users table
            $sql2 = "INSERT INTO `user` (`name`, `emid`, `email`, `password`) VALUES ('$name', '$emid', '$email', '$password')";
            $result1=mysqli_query($conn,$sql2);
            if($result1)
                $suc=true;
        }
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
    <title>Agency Registration</title>
</head>
<body>


<!-- header section  -->
    <div>
        <div class="header-part1">
            <nav class="navbar navbar-expand-md navbar-dark">
            <a href="index.php" class="navbar-brand brand-logo">
                <img class="brand-logo" src="Images/logo3.png" alt="logo">
            </a>
            <button class="btn btn-primary navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-expanded="false" aria-controls="navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
        <!-- <a class="btn btn-primary" data-bs-toggle="collapse" href="#navbarSupportedContent" data-toggle="collapse" role="button" aria-controls="navbarSupportedContent" aria-expanded="false">
        </a> -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav nav-pills header-except-logo">
                    <li class="nav-item header-login-button">
                    <a href="login.php"><button type="button" class="btn btn-primary header-login-button1" >login</button><a>
                    </li>
                    <li class="nav-item header-register-button">
                    <a href="register.php"><button type="button" class="btn btn-primary header-register-button1" >Register</button><a>
                    </li>
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


    <form action="./agencyregistration.php" class="myform" method="post">
        <div class="frm-content">
            <div class="row form flex-column align-items-center justify-content-center">


                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <h2 class="text-center login-title">Car Rental Agency Registration</h2>
                    <div class="alert alert-danger" role="alert" <?php if(!isset($existornot) || $existornot==false) echo 'style="display:none"' ?>>
                        Email already exists!!
                    </div>
                    <div class="alert alert-danger" role="alert" <?php if(!isset($showerror) || $showerror==false) echo 'style="display:none"' ?>>
                        Password and Re-enter  password did not match. Please try again.
                    </div>
                    <div class="alert alert-danger" role="alert" <?php if(!isset($showerror1) || $showerror1==false) echo 'style="display:none"' ?>>
                        Invalid Emid!!
                    </div>
                    <div class="alert alert-danger" role="alert" <?php if(!isset($showerror2) || $showerror2==false) echo 'style="display:none"' ?>>
                        Emid already registered!!
                    </div>
                    <div class="alert alert-success" role="alert" <?php if(!isset($suc) || $suc==false) echo 'style="display:none"' ?>>
                        Registered Successfully!! You can login now.
                    </div>
                    <label for="name" class="name-title">
                        Name 
                    </label>
                    <input type="text" name="name" id="name" placeholder="Enter your Name" required>
                    <label for="email" class="employ-title">
                        Employ Id
                    </label>
                    <input type="number" name="emid" id="emid" placeholder="Enter your Employ Id (number greater than equal to 0)" required>
                    <label for="email" class="email-title">
                        E-mail 
                    </label>
                    <input type="email" name="email" id="email" placeholder="Enter your Email id.." required>
                </div>



                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <label for="password" class="password-title">
                        Password 
                    </label>
                    <input type="password" name="password" id="password" placeholder="Enter your Password" required>
                </div>
                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <label for="re_password" class="repassword-title">
                        Re-enter Password 
                    </label>
                    <input type="password" name="re_password" id="re_password" placeholder="Re-enter your Password" required>
                </div>

                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <button type="submit" class="btn btn-primary register-btn" >Register</button>
                </div>
                <div class="col-12 col-md-8 col-lg-6 d-flex flex-column justify-content-around">
                    <a href="login.php" style="margin-bottom: 4%;"><span>or Login</span></a>
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
