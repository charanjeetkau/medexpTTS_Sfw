<?php
session_start();
ob_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}

require "saman.php";

$projcom = array();
$projdet = array();

$sql = "SELECT `project` FROM `project_commercial`";
$fetch = mysqli_query($db, $sql);
while ($row = mysqli_fetch_array($fetch)) {
    array_push($projcom, $row['project']);
}

$sql1 = "SELECT `project` FROM `project_details`";
$fetch1 = mysqli_query($db, $sql1);
while ($row = mysqli_fetch_array($fetch1)) {
    array_push($projdet, $row['project']);
}

$only_project = array_diff($projcom, $projdet);


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Details</title>
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
        width: 80%;
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

            <a href="dashboard" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-tachometer px-2" aria-hidden="true"></i><span class="hide">Dashboard</span>
                </p>
            </a>

            <a href="lists" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-th-list px-2" aria-hidden="true"></i><span class="hide">Lists</span>
                </p>
            </a>

            <a href="add" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-user-plus px-2" aria-hidden="true"></i><span class="hide">Add Client</span>
                </p>
            </a>

            <a href="detail" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-code px-2" aria-hidden="true"></i><span class="hide">Project Details</span>
                </p>
            </a>

            <a href="commercial" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-briefcase px-2" aria-hidden="true"></i><span class="hide">Project Commercial</span>
                </p>
            </a>

            <a href="payment" class="text-decoration-none">
                <p class="nav-btn mx-2 ">
                    <i class="fa fa-file px-2" aria-hidden="true"></i><span class="hide">payment</span>
                </p>
            </a>

        </div>
        <a href="logout" class="outbtn btn-danger p-2 fw-medium  text-center text-decoration-none fw-medium text-dark"
            style="font-size: small;bottom: 0px;position: fixed; background-color: #fecc00;">
            <i class="fa fa-sign-out pe-1" aria-hidden="true"></i><span class="hide">logout</span></a>

    </nav>
    <main class=" shadow-lg bg-gradient" style="overflow: scroll;color:#139f95;">
        <?php
        if (isset($_GET['msg'])) { ?>
            <h3 class="rounded bg-danger-subtle m-auto mt-2 w-75 text-danger fw-bold p-2">
                <?php echo $_GET['msg'] ?>
            </h3>
        <?php }

        ?>


        <div class="justify-content-center align-items-center m-auto main-div">



            <div class="fs-5 ps-2 pt-3 m-auto s-div">
                <form action="insert.php?project=0" method="post">
                    <span class="w-75 m-auto align-items-center">
                        <label for="cars" class="mt-3 mx-auto fs-5">Select project</label>
                        <select name="name" id="cars" required class="form-select  mb-3"
                            aria-label="Default select example">
                            <?php
                            foreach ($only_project as $row) {
                                echo "<option value='$row'>$row</option>";
                            }
                            ?>

                        </select>
                    </span>

                    <h3 class="rounded bg-warning fw-bold p-2">Domain Detail</h3>



                    <div class="m-auto mt-4">
                        <label for="domianer">Purchased by</label><br />
                        <div class="btn-group m-auto" role="group" aria-label="Basic radio toggle button group">
                            <input value="customer" type="radio" class="btn-check" name="domain" id="domaincustomer"
                                autocomplete="off" checked>
                            <label class="btn btn-outline-warning" for="domaincustomer"
                                style="font-size: x-small;">Customer</label>

                            <input type="radio" value="tts" class="btn-check" name="domain" id="domaintts"
                                autocomplete="off">
                            <label class="btn btn-outline-warning" for="domaintts"
                                style="font-size: x-small;">TTS</label>
                        </div>
                    </div>

                    <label for="mail" class=" ps-2 pt-4">Domain Name</label>
                    <input type="text" name="domainname" id="domainname" style="font-size: 15px;"
                        class="w-100 date form-control" placeholder="www.xyz.com">

                    <span class="d-block pt-3 m-auto w-100">
                        <label for="purchasedate" class=" ps-2 pt-1">Domain Purchase Date</label>
                        <input type="date" id=" purchasedate" style="font-size: 15px;" name="domainpurchase"
                            class="px-2  date form-control "></span>

                    <span class="d-block pt-3 m-auto w-100">
                        <label for="purchaseexpiry" class=" ps-2 pt-1">Domain Expiry Date</label>
                        <input type="date" id="purchaseexpiry" style="font-size: 15px;" name="domainexpiry"
                            class="px-2  date form-control"></span>

                    <hr />

                    <h3 class="rounded bg-warning fw-bold p-2">Hosting Detail</h3>

                    <span class="d-block mt-5">
                        <label for="domianer mt-5">Purchased by</label><br />
                        <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                            <input value="customer" type="radio" class="btn-check" name="hosting" id="hostcustomer"
                                autocomplete="off" checked>
                            <label class="btn btn-outline-warning" for="hostcustomer"
                                style="font-size: x-small;">Customer</label>

                            <input type="radio" value="tts" class="btn-check" name="hosting" id="hosttts"
                                autocomplete="off">
                            <label class="btn btn-outline-warning" for="hosttts" style="font-size: x-small;">TTS</label>

                        </div>
                    </span>

                    <span class="d-block pt-5 m-auto">
                        <label for="purchasedate" class=" ps-2 pt-1">Hosting Purchase Date</label>
                        <input type="date" id=" purchasedate" style="font-size: 15px;" name="hostpurchase"
                            class="px-2 date form-control w-100"></span>

                    <span class="d-block py-3 m-auto">
                        <label for="purchaseexpiry" class=" ps-2 pt-1">Hosting Expiry Date</label>
                        <input type="date" id="purchaseexpiry" style="font-size: 15px;" name="hostexpiry"
                            class="px-2 date form-control w-100"></span>

                    <hr />

                    <h3 class="rounded bg-warning fw-bold p-2">SEO Detail</h3>

                    <span class="align-items-center d-flex">
                        <input type="checkbox" class="form-check-input " value="seo" name="seo" id="seo"
                            style="font-size: small;width: 20px;" checked>
                        <label for="seo" class="ps-2 form-check-label">SEO Service</label></span>


                    <hr />

                    <h3 class="rounded bg-warning fw-bold p-2">Email Service Detail</h3>

                    <span class="align-items-center d-flex">
                        <input type="checkbox" class="form-check-input " value="emailed" name="emailcheck"
                            id="emailcheck" style="font-size: small;width: 20px;" checked>
                        <label for="emailcheck" class="ps-2 form-check-label">Email Purchased</label></span>

                    <div>
                        <div class="d-flex align-items-center justify-content-between">
                            <span class="d-block mt-1">
                                <label for="domianer mt-1">Email Type</label><br />
                                <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                                    <input value="paid" type="radio" class="btn-check" name="emailtype" id="emailpaid"
                                        autocomplete="off" checked>
                                    <label class="btn btn-outline-warning" for="emailpaid"
                                        style="font-size: x-small;">Paid</label>

                                    <input type="radio" value="free" class="btn-check" name="emailtype" id="emailfree"
                                        autocomplete="off">
                                    <label class="btn btn-outline-warning" for="emailfree"
                                        style="font-size: x-small;">Free</label>

                                </div>
                            </span>

                            <span class="d-block py-3 ">
                                <label for="domianer">Purchased by</label><br />
                                <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                                    <input value="customer" type="radio" class="btn-check" name="email"
                                        id="emailcustomer" autocomplete="off" checked>
                                    <label class="btn btn-outline-warning" for="emailcustomer"
                                        style="font-size: x-small;">Customer</label>

                                    <input type="radio" value="tts" class="btn-check" name="email" id="emailtts"
                                        autocomplete="off">
                                    <label class="btn btn-outline-warning" for="emailtts"
                                        style="font-size: x-small;">TTS</label>

                                </div>
                            </span>
                        </div>

                    </div>

                    <span class="d-block py-3 m-auto">
                        <label for="purchasedate" class=" ps-2 pt-1">Email Service Provider</label>
                        <input type="text" id="emailcompany" style="font-size: 15px;" name="emailprovider"
                            placeholder="xyz company" class="px-2 date form-control w-100"></span>



                    <span class="d-block pt-2 m-auto">
                        <label for="purchasedate" class=" ps-2 pt-1">Email Purchase Date</label>
                        <input type="date" id="emailpur" style="font-size: 15px;" name="emailpurchase"
                            class="px-2 date form-control w-100"></span>

                    <span class="d-block mb-5 py-3">
                        <label for="purchaseexpiry" class=" ps-2 pt-1">Email Expiry Date</label>
                        <input type="date" id="emailexp" style="font-size: 15px;" name="emailexpiry"
                            class="px-2 date form-control w-100"></span>
            </div>
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