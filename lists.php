<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}

require "saman.php";

$sql = "SELECT * FROM `project_commercial`";

if (isset($_GET['q'])) {
    $s = $_GET['q'];
    $sql .= " WHERE `project` = '$s' ";

}
$fetch = mysqli_query($db, $sql);



?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lists</title>
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
    .info-tab {
        width: 640px;

    }

    .btnn {
        font-family: Arial, Helvetica, sans-serif;
        font-weight: 200;
        font-size: 15px;
        padding: 0%;
        color: #013761;
    }

    .textfo:nth-child(odd) {
        background-color: rgb(223, 223, 223);
    }

    th {
        font-weight: 700
    }

    .ainvid {
        display: flex;

    }

    .secdiv {
        display: none;
    }

    @media screen and (max-width: 800px) {
        .info-tab {
            width: 350px;
        }
    }
</style>

<body>
    <nav class="sidebar vh-100" style="background-color: #139f95;" id="nav-bar">
        <center class="">
            <img src="ttslogo.jpg" width="55%%" class="rounded m-auto">
        </center>
        <hr />
        <div class="mt-3 d-block">

            <a href="dashboard.php" class="text-decoration-none" >
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


    </nav>
    <main class="vh-100" style="background-color: rgba(186, 202, 217, 0.1);position: relative;" id="main-div">
        <?php if (isset($_GET['msg'])) { ?>
            <h3 class="rounded bg-success-subtle m-auto mt-2 w-75 text-success fw-bold p-2 fs-5">
                <?php echo $_GET['msg'] ?>
            </h3>
        <?php } ?>
        <h1 class="p-2 fw-bolder" style="color: #139f95;">Welcome to Total Technical Solution</h1>



        <!-- <h1 class="p-3 fs-4" style="color: #2584ce;">Dashboard</h1> -->

        <div class="d-flex justify-content-between mx-5 my-3 px-4 flex-column">
            <div class="input-group w-100">
                <form action="#" method="get" class="d-flex w-100">

                    <input type="search" id="form1" name="q" class="form-control" placeholder="Search" />

                    <button type="submit" class="btn" style="background-color: #139f95;">
                        <i class="fa fa-search"></i>
                    </button>
                </form>
            </div>
            <span class="w-100 mt-4">
                <button class="btn p-2" onclick="clishow()" style="float:right;background-color: #139f95;">View
                    Clients</button>
            </span>

        </div>



        <div style="max-height: 500px; ;overflow: scroll;" class="table rounded shadow" id="showdiv">
            <table class=" w-100 table " style="text-align: left;background-color: rgb(255, 255, 255);height: 50px;">
                <tr class="pb-4 mx-3 "
                    style="border-bottom: 1px solid rgba(33, 42, 65, 0.622); background-color: #139f95; ">
                    <th>Project</th>
                    <th>Detail</th>
                    <th>Operations</th>
                    <th>Action</th>
                </tr>

                <?php while ($row = mysqli_fetch_array($fetch)) { ?>

                    <tr style="height: 40px;border: 0px;" class="textfo align-content-center">
                        <th>
                            <?php echo $row['project'] ?>
                        </th>

                        <th><button class="btn btnn" onclick="show('<?php echo 'back.php?id=' . $row['project']; ?>')">View
                                Details</button></th>
                        <th><button class="btn btnn" onclick="show('<?php echo 'edit.php?id=' . $row['project']; ?>')"
                                style=" color:
                                #013761;">Edit</button>
                        </th>
                        <th><button class="ms-4 btn btnn p-0 px-2 delbtn" value="<?php echo $row['project']; ?>">
                                <i class="fa fa-trash "></i></button>
                        </th>
                    </tr>
                <?php } ?>


            </table>
        </div>

    </main>

    <a href="logout" class="outbtn btn-danger p-2 fw-medium  text-center text-decoration-none fw-medium text-dark"
        style="font-size: small;bottom: 0px;position: fixed; background-color: #fecc00;">
        <i class="fa fa-sign-out pe-1" aria-hidden="true"></i><span class="hide">logout</span></a>


    <div id="info-tab" style="max-width: 90%;
    display: none;
    background-image: linear-gradient(to right bottom, rgb(19,159,149), rgb(254,204,0));
    position: absolute;
    height:500px;
    overflow:auto;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);" class="rounded m-auto shadow info-tab">
        <div class="p-2">
            <div id="detail">

            </div>
            <button class="close-btn btn " onclick="show()" style="font-size: 18px;">Close</button>

        </div>

    </div>
    <div style="
    display: none;
    height: fit-content;
    position: fixed;
    width:280px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);" id="confor" class=" rounded shadow-lg m-auto bg-light p-3">
        <h6>Are you sure you want to Delete this record</h6>
        <span class="d-flex justify-content-between">
            <button class="btn btn-success" onclick="popup('confor',0)">NO</button>
            <a href="" id="dellink"><button class="btn btn-danger">YES</button></a>
        </span>
    </div>

</body>

</html>
<script>


    function show(id) {
        if (id != undefined) {
            let link = id;

            $.ajax({
                url: link,
                success: function (data) {
                    $('#detail').html(data);
                    var checkbox = document.getElementById('emailcheck');
                    document.getElementById('emailcheck').onchange = function () {

                        document.getElementById('emailpaid').disabled = !this.checked;
                        document.getElementById('emailfree').disabled = !this.checked;
                        document.getElementById('emailcustomer').disabled = !this.checked;
                        document.getElementById('emailtts').disabled = !this.checked;
                        document.getElementById('emailpur').disabled = !this.checked;
                        document.getElementById('emailexp').disabled = !this.checked;
                        document.getElementById('emailcompany').disabled = !this.checked;
                    };

                    if (!checkbox.checked) {
                        document.getElementById('emailpaid').disabled = true;
                        document.getElementById('emailfree').disabled = true;
                        document.getElementById('emailcustomer').disabled = true;
                        document.getElementById('emailtts').disabled = true;
                        document.getElementById('emailpur').disabled = true;
                        document.getElementById('emailexp').disabled = true;
                        document.getElementById('emailcompany').disabled = true;
                        console.log("Checkbox is unchecked");

                    }

                }
            });
        }
        console.log(id);
        popup('info-tab')
    }

    function clishow() {
        $.ajax({
            url: "form.php?clientshow=All",
            success: function (data) {
                $('#showdiv').html(data);
                $('.delbtn').click(function () {
                    var b = $(this).val();
                    var yourElement = document.getElementById('dellink');
                    yourElement.setAttribute('href', 'form.php?delete=' + b + "&client=true");
                    popup('confor')
                });
            }

        })
    }

    function showhide(a, b) {
        var show = "#" + a;
        var hide = "#" + b;
        $(show).css('display', 'block');
        $(hide).css('display', 'none');
    }


    $('.delbtn').click(function () {
        var b = $(this).val();
        var yourElement = document.getElementById('dellink');
        yourElement.setAttribute('href', 'form.php?delete=' + b);
        popup('confor')
    });

    function popup(a) {
        if ($('#' + a).css('display') == 'none') {
            $('#' + a).css({ 'display': 'block' })
            $('#' + a).focus();
            $('#nav-bar').css({ 'filter': 'blur(5px)' })
            $('#main-div').css({ 'filter': 'blur(5px)' })
        }
        else {
            $('#' + a).css({ 'display': 'none' })
            $('#nav-bar').css({ 'filter': 'blur(0px)' })
            $('#main-div').css({ 'filter': 'blur(0px)' })
        }
    }

</script>