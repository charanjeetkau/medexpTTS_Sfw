<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}
require "saman.php";
$ab = "";

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $mail = $_POST['mail'];
    $sql = "INSERT INTO `client_details`(`name`, `phone`, `email`, `location`) 
    VALUES ('$name','$phone','$location','$mail')";

    if (mysqli_query($db, $sql) == TRUE) {
        $ab = "<p class='text-center text-success fs-5'>Record Updated Succefully</p>";
    } else {
        $ab = "<p class='text-center text-danger fs-5'>Something Went Wrong $sql</p>";

    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Urbanist">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="style.css" rel="stylesheet" type="text/css">

</head>

<style>
    main {
        backdrop-filter: blur(15px);
        background-color: #ffffff00;

        overflow-y: scroll;
        border-radius: 20px;
        padding: 0%;
    }

    label {
        font-size: 14px;
        color: #0000008b;
        font-weight: 200;
    }

    input {
        font-size: 14px;
        font-weight: 500;
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    span label {
        padding-inline-start: 18px;
    }

    h3 {
        color: black;
        font-size: medium;
        width: 100%;
        text-align: center;
        font-weight: 800;
    }

    .date {
        background-color: #ffffff58;
    }

    .f-div {
        width: 100%
    }

    .s-div {
        width: 100%
    }

    .nav-bar {
        height: 50px;
        background-color: rgba(255, 255, 255, 1);
    }

    .main-div {
        display: block;
        width: 100%;
    }

    @media screen and (max-width: 800px) {
        .main-div {
            display: block;
        }

        .f-div {
            width: 100%
        }

        .s-div {
            width: 100%
        }



    }

    .col-head {
        background-color: #139f95;
        height: 50px;
    }

    .col-head th {
        text-align: center;
        font-size: medium;
        color: white;
    }

    .text-info:nth-child(odd) {
        background-color: rgb(223, 223, 223);
    }
</style>

<body>
    <nav class="sidebar vh-100" style="background-color: #139f95;">
        <center class="">
            <img src="ttslogo.jpg" width="55%%" class="rounded m-auto">
        </center>
        <hr />
        <div class="mt-3 d-block">

            <a href="dashboard.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-tachometer px-2" aria-hidden="true"></i><span class="hide">Dashboard</span>
                </p>
            </a>

            <a href="lists.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-th-list px-2" aria-hidden="true"></i><span class="hide">Lists</span>
                </p>
            </a>

            <a href="add.php" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-user-plus px-2" aria-hidden="true"></i><span class="hide">Add Client</span>
                </p>
            </a>

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
        <a href="logout.php" class="outbtn btn-danger p-2 fw-medium  text-center text-decoration-none fw-medium text-dark"
            style="font-size: small;bottom: 0px;position: fixed; background-color: #fecc00;">
            <i class="fa fa-sign-out pe-1" aria-hidden="true"></i><span class="hide">logout</span></a>

    </nav>
    <main class="bg-gradient" style="overflow: scroll;color:#139f95;">
        <?php
        if (isset($_GET['msg'])) { ?>
            <h3 class="rounded bg-danger-subtle m-auto mt-2 w-75 text-danger fw-bold p-2">
                <?php echo $_GET['msg'] ?>
            </h3>
        <?php }
        echo $ab;

        ?>


        <div class="justify-content-center align-items-center m-auto main-div">

            <!-----------Contact info left panel-------->
            <div class="fs-5 pt-2 p-3 f-div m-auto">
                <form action="insert.php" method="post">

                    <h3 class="rounded bg-warning fw-bold p-2">Required Detail</h3>

                    <label for="name" class=" ps-2 mt-5">Name</label>
                    <input type="text" name="name" style="font-size: 15px;" class="w-100 date form-control"
                        placeholder="Abc Xyz" required>

                    <label for="phone" class=" ps-2 pt-4">Phone</label>
                    <input type="tel" name="phone" style="font-size: 15px;" class="w-100 date form-control "
                        placeholder="+91 736XXXXXXX" required>

                    <label for="mail" class=" ps-2 pt-4">Email</label>
                    <input type="email" name="mail" style="font-size: 15px;" class="w-100 date form-control"
                        placeholder="example@email.com" required>

                    <label for="mail" class=" ps-2 pt-4">Location</label>
                    <input type="text" name="location" style="font-size: 15px;" class="w-100 date form-control"
                        placeholder="Ex. Mumbai" required>




            </div>
            <!------------Details right panel------->

        </div>

        <span class="align-items-center d-flex my-3">
            <input type="submit" value="Submit" name="submit" style="background-color: #139f95;"
                class="w-50 btn fw-bolder text-light rounded-pill px-3 m-auto">
        </span>
        </form>



    </main>

</body>

</html>
<script>
    document.getElementById('emailcheck').onchange = function () {

        document.getElementById('emailpaid').disabled = !this.checked;
        document.getElementById('emailfree').disabled = !this.checked;
        document.getElementById('emailcustomer').disabled = !this.checked;
        document.getElementById('emailtts').disabled = !this.checked;
        document.getElementById('emailpur').disabled = !this.checked;
        document.getElementById('emailexp').disabled = !this.checked;
        document.getElementById('emailcompany').disabled = !this.checked;
    };

</script>