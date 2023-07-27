<?php
session_start();
ob_start();
require "saman.php";

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}
$dtext = "Select Client";


$sqlprice = "SELECT `name` FROM `client_details`";
$fetch = mysqli_query($db, $sqlprice);

$sqlpay = "SELECT `id`, `project` FROM `project_commercial`";

if (isset($_GET['cli'])) {
    $a = $_GET['cli'];
    $dtext = $a;
    $sqlpay .= " WHERE `client` = '$a'";
}

$fetch2 = mysqli_query($db, $sqlpay);

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

    .fun {
        display: flex;
    }

    th {
        text-align: center;
    }

    @media screen and (max-width: 800px) {
        .main-div {
            display: block;
        }

        .fun {
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
    <main class="" style="color:#139f95;">
        <?php if (isset($_GET['msg'])) { ?>
            <h3 class="rounded bg-success-subtle m-auto mt-2 w-75 text-success fw-bold p-2">
                <?php echo $_GET['msg'] ?>
            </h3>
        <?php } ?>

        <div class="justify-content-center align-items-center m-auto main-div">
            <h3 class="text-center rounded bg-warning fw-bold p-2 mt-3">Add Payment record</h3>
            <form action="insert.php?pay=0" method="post">
                <span class="w-100 fun ">
                    <span class="m-auto d-flex align-items-center">
                        <label for="cars" class=" mx-auto fs-5 w-100">Select Client</label>
                        <div class="dropdown p-2">
                            <button class="btn btn-light dropdown-toggle" style="border:1px solid grey" type="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                echo $dtext;
                                ?>

                            </button>
                            <ul class="dropdown-menu">
                                <li><a class='dropdown-item' href='?'>All</a></li <?php
                                while ($row = mysqli_fetch_array($fetch)) {
                                    $temp = $row['name'];
                                    echo "<li><a class='dropdown-item' href='?cli=$temp'>$temp</a></li>";
                                }
                                ?> </ul>
                        </div>
                    </span>
                    <hr />
                    <span class="m-auto d-flex align-items-center">
                        <label for="cars" class=" mx-auto fs-5">Select Project</label>
                        <select name="project" id="cars" class="form-select w-50 "
                            onChange="paych(this.options[this.selectedIndex].value)" aria-label="Default select example"
                            required>
                            <option value='All' style='font-size:110%' class='dropdown-item'>All</option>
                            <?php
                            while ($row = mysqli_fetch_array($fetch2)) {
                                $temp = $row['project'];
                                echo "<option value='$temp' class='dropdown-item' style='font-size:110%' >$temp</option>";
                            }
                            ?>

                        </select>
                    </span>
                </span>
                <div class="justify-content-center m-auto p-3 fs-5 m-3 rounded bg-success-subtle bg-gradient"
                    id="paycheck" style="display:flex;flex-direction:column-reverse">


                </div>
                <div>
                    <label for="payment" class=" ps-2 pt-4">Payment</label>
                    <input type="text" name="payment" id="payment" style="font-size: 15px;"
                        class="w-100 date form-control">

                    <label for="payment" class=" ps-2 pt-4">Payment Date</label>
                    <input type="date" name="paydate" id="payment" style="font-size: 15px;"
                        class="w-100 date form-control">

                    <span class="align-items-center d-flex my-3">
                        <input type="submit" value="Submit" name="submit" style="background-color: #139f95;"
                            class="w-50 btn fw-bolder text-light rounded-pill px-3 m-auto">
                    </span>

                </div>
            </form>
        </div>





    </main>

</body>

</html>
<script>
    function paych(a) {
        console.log(a);
        $.ajax({
            url: "form.php",
            type: 'get',
            data: { 'payid': a },
            success: function (data) {
                $('#paycheck').html(data);
            }
        });
    }


</script>