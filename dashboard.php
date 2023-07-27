<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}

require "saman.php";

$days = 30;
if(isset($_GET['r'])){
    $days = $_GET['r'];
}
$days = (int)$days;
$projsql = "SELECT `project`, `project_end` FROM `project_commercial` 
    WHERE `project_end` >= CURDATE() AND `project_end` <= CURDATE() + INTERVAL $days DAY"; 
$domain = "SELECT `project`, `domain_expiry` FROM `project_details` 
            WHERE `domain_expiry` >= CURDATE() AND `domain_expiry` <= CURDATE() + INTERVAL $days DAY";
$hosting = "SELECT `project`, `hosting_expiry` FROM `project_details` 
            WHERE `hosting_expiry` >= CURDATE() AND `hosting_expiry` <= CURDATE() + INTERVAL $days DAY";
$email = "SELECT `project`, `email_expiry` FROM `project_details` 
        WHERE `email_expiry` >= CURDATE() AND `email_expiry` <= CURDATE() + INTERVAL $days DAY";

$project = mysqli_query($db,$projsql);
$fetchdomain = mysqli_query($db,$domain);
$fetchhosting = mysqli_query($db,$hosting);
$fetchemail = mysqli_query($db,$email);



?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Urbanist">
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
        crossorigin="anonymous"
        />
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"
    ></script>
    <script
        src="jquery-3.6.4.min.js"
    ></script>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link href="style.css" rel="stylesheet" type="text/css"> 

</head>

<style>
    .col-head{
        background-color:#139f95;
        height: 50px;
    }

    .col-head th{
        text-align: center;
        font-size: medium;
        color: white;
    }
    .text-info:nth-child(odd) {
            background-color: rgb(223, 223, 223);
        }
    th{
        width: fit-content;
    }
    table p{
        width:max-content;
    }
    
</style>

<body>
    <nav class="sidebar vh-100" style="background-color: #139f95;">
        <center class="">
            <img src="ttslogo.jpg" width="55%%" class="rounded m-auto">
        </center><hr/>
        <div class="mt-3 d-block">
            
            <a href="dashboard.php" class="text-decoration-none"><p class="nav-btn mx-2 ">
                <i class="fa fa-tachometer px-2" aria-hidden="true"></i><span class="hide">Dashboard</span>
            </p></a>

            <a href="lists.php" class="text-decoration-none"><p class="nav-btn mx-2 ">
                <i class="fa fa-th-list px-2" aria-hidden="true"></i><span class="hide">Lists</span>
            </p></a>

            <a href="add.php" class="text-decoration-none"><p class="nav-btn mx-2 ">
                <i class="fa fa-user-plus px-2" aria-hidden="true"></i><span class="hide">Add Client</span>
            </p></a>

            <a href="detail.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-code px-2" aria-hidden="true"></i><span class="hide">Project Details</span>
                </p>
            </a>

            <a href="commercial.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-briefcase px-2" aria-hidden="true"></i><span class="hide">Project Commercial</span>
                </p>
            </a>

            <a href="payment.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-file px-2" aria-hidden="true"></i><span class="hide">payment</span>
                </p>
            </a>

        </div>
        <a href="logout.php" class="progress-bar progress-bar-striped progress-bar-animated outbtn btn-danger p-2 fw-medium  text-center text-decoration-none fw-medium text-dark"  
        style="font-size: small;bottom: 0px;position: fixed; background-color: #fecc00;">
        <i class="fa fa-sign-out pe-1" aria-hidden="true"></i><span class="hide">logout</span></a>

    </nav>
    <main class="vh-100" style="background-color: rgba(186, 202, 217, 0.1);">
        <h1 class="p-2 fs-3 fw-bolder text-center text-uppercase" style="color: #139f95; text-shadow:3px 3px 3px pink; " >Welcome to Total Technical Solution</h1>
        <p class="progress-bar progress-bar-striped progress-bar-animated text-center fw-bolder text-dark w-100 p-2" style="background-color: #fecc00;">Expiry in <?php echo $days?> Days</p> 
       
        <div>
            <div class="dropdown" style="float: right;margin:0% 5% 3% 0%;">
                <a class="btn text-white fw-medium dropdown-toggle shadow-lg" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: #139f95;">
                <?php echo $days?> Days Left
                </a>
              
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="?r=7">7 Days</a></li>
                  <li><a class="dropdown-item" href="?r=15">15 Days</a></li>
                  <li><a class="dropdown-item" href="?r=30">30 Days</a></li>
                  <li><a class="dropdown-item" href="?r=60">60 Days</a></li>
                  <li><a class="dropdown-item" href="?r=90">90 Days</a></li>
                </ul>
              </div>
        </div>
            
        <div class="d-flex justify-content-between shadow-lg m-auto rounded" 
            style="overflow-x: scroll;overflow-y: scroll;width: 90%;max-height:550px;">
                
                <table class="w-100 ">
                    <tr class="th p-2 col-head progress-bar progress-bar-striped progress-bar-animated">
                        <th >Project deadline</th></tr>

                    <?php while($row = mysqli_fetch_array($project)){ ?>
                    <tr class="text-info justify-content-between th ps-2" style="border: 0px;">
                        <th><p><?php echo $row['project'] ?></p></th>
                        <th><p><?php echo $row['project_end'] ?></p></th>
                    </tr>
                    <?php } ?>
              
                </table>
                <table class="w-100" style="border-left: 1px solid rgba(56, 56, 56, 0.43);border-right: 1px solid rgba(56, 56, 56, 0.446);">
                    <tr class="th p-2 fs-3 col-head progress-bar progress-bar-striped progress-bar-animated" >
                        <th >Domain Expiry</th></tr>
                    
                    <?php while($roow = mysqli_fetch_array($fetchdomain)){ ?>
                    <tr class="text-info justify-content-between th">
                        <th><?php echo $roow['project'] ?></th><br>
                        <th><?php echo $roow['domain_expiry'] ?></th>
                    </tr>
                    <?php } ?>
                  
                </table>
                <table class="w-100" style="border-left: 1px solid rgba(56, 56, 56, 0.43);border-right: 1px solid rgba(56, 56, 56, 0.446);">
                    <tr class="th p-2 fs-3 col-head progress-bar progress-bar-striped progress-bar-animated" >
                        <th >Hosting Expiry</th></tr>
                    
                    <?php while($roow = mysqli_fetch_array($fetchhosting)){ ?>
                    <tr class="text-info justify-content-between th">
                        <th><?php echo $roow['project'] ?></th><br>
                        <th><?php echo $roow['hosting_expiry'] ?></th>
                    </tr>
                    <?php } ?>
                  
                </table>
                <table class="w-100">
                    <tr class="th p-2  fs-3 col-head progress-bar progress-bar-striped progress-bar-animated">
                        <th>Email Expiry</th></tr>
                    <?php while($rw = mysqli_fetch_assoc($fetchemail)){ ?>
                    <tr class="text-info justify-content-between th pe-2">
                        <th><?php echo $rw['project'] ?></th>
                        <th><?php echo $rw['email_expiry'] ?></th>
                    </tr>
                    <?php } ?>
                   
                </table>
                
        </div>

        <div>


        </div>
    </main>
    
</body>
</html>
<script>
    
</script>