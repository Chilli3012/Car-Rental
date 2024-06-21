
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'partials/_dbconnect.php';

?>

<?php
session_start();
$dis="visible";
$page = "AllProduct.php";
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true)
{
    $loggedin = true;  // logged in
}
else{
    $loggedin=false;
    $dis="invisible";
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
    <link rel="stylesheet" href="AllProductstyle.css">
    <title>Booked Cars</title>
</head>
<body>

   <!-- header section   -->

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

    <section class="all-section">

        <!-- row1  -->
        <div class="row justify-content flex-wrap align-items-left">
            <h2 class="section-title text-center">Booked Cars</h2>


            

                <?php
                $sql="SELECT * from car";
                $result=mysqli_query($conn,$sql);
                $rowcount=mysqli_num_rows($result);

                if ($rowcount >0)    { 
                    while($row=mysqli_fetch_assoc($result))
                    {
                        $id=$row['id'];
                        $model=$row['model'];
                        $num=$row['num'];
                        $capacity=$row['capacity'];
                        $rent=$row['rent'];
                        $available=$row['available'];
                        $booked=$row['booked'];
                        $duration=$row['duration'];
                        $startdate=$row['startdate'];
                        $image_path=$row['image_path'];
                        if(empty($image_path))
                        {
                            $image_path="Images/car5.jpg";
                        }
                        
                        echo '
                        <div class="col-12 col-md-6 col-lg-3">
                        <form method="post" action="user_detail.php">
                            <div class="card overflow-hidden"> 
                                <img class="card-img-top image-styling" src="'.$image_path.'" alt="Car">
                                <div class="card-body">
                                    <p>Vechicle Model: '.$model.' </p>
                                    <p>Vechicle number: '.$num.' </p>
                                    <p>seating capacity: '.$capacity.'</p>
                                    <p>Rent per day: '.$rent.'</p>
                                    <input type="hidden" name="id" value="'.$row['id'].'">';
                                    if(!$loggedin){
                                        echo '<a href="login.php"><button type="button" name="submit" class="btn btn-primary">Rent</button></a>';
                                    }
                                    else{
                                        echo '<a href="user_detail.php"><button type="submit" name="submit" class="btn btn-primary button-85">User`s Detail</button></a>';
                                    }  
                                echo '</div>
                            </div>
                        </form>
                        </div>';
                    }
                }
                else{
                    echo '<h4>Sorry. No car is available!</h4>';
                }
                ?>
        </div>

    </section>


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