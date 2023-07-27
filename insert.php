<?php
session_start();
ob_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}

require "saman.php";
$sql = "";
if (isset($_GET['project'])) {
    $domain = $_POST['domain'];
    $domainname = $_POST['domainname'];
    $domainpurchase = $_POST['domainpurchase'];
    $domainexpiry = $_POST['domainexpiry'];
    $host = $_POST['hosting'];
    $hostpurchase = $_POST['hostpurchase'];
    $hostexpiry = $_POST['hostexpiry'];
    $project = $_POST['name'];
    $seo = $_POST['seo'];
    if (isset($_POST['emailcheck'])) {
        $emailcheck = $_POST['emailcheck'];
        $emailtype = $_POST['emailtype'];
        $email = $_POST['email'];
        $emailcompany = $_POST['emailprovider'];
        $emailpurchase = $_POST['emailpurchase'];
        $emailexpiry = $_POST['emailexpiry'];
        $sql = "INSERT INTO `project_details` (
            `domain_name`, `project` ,
            `domain`,`domain_purchase`,`domain_expiry`,
            `hosting`,`hosting_purchase`,`hosting_expiry`,
            `is_email_service`,`email_type`,`email`,
            `email_provider`,`email_purchase`,
            `email_expiry`,`SEO`) VALUES ('$domainname'
            ,'$project','$domain','$domainpurchase','$domainexpiry'
            ,'$host','$hostpurchase','$hostexpiry','$emailcheck','$emailtype'
            ,'$email','$emailcompany','$emailpurchase','$emailexpiry','$seo')";
    } else {
        $sql = "INSERT INTO `project_details` (
        `domain_name`, `project` ,
        `domain`,`domain_purchase`,`domain_expiry`,
        `hosting`,`hosting_purchase`,`hosting_expiry`,`SEO`)
        VALUES ('$domainname'
        ,'$project','$domain','$domainpurchase','$domainexpiry'
        ,'$host','$hostpurchase','$hostexpiry','$seo')";
    }
    $exsql = "SELECT `project` FROM `project_details` WHERE `project` = '$project'";
    $exfetch = mysqli_query($db, $exsql);
    $ab = mysqli_num_rows($exfetch);
    echo $ab;
    if ($ab == 0) {
        if (mysqli_query($db, $sql)) {
            echo "done";
            echo $sql;
            header("Location:detail.php?msg=$project added succesfully");
        } else {
            echo $sql;
            echo mysqli_error($db);
        }
    } else {
        header("Location:detail.php?msg=Duplicate entry for $project. Try unique Name");
    }
} elseif (isset($_GET['price'])) {
    $project = $_POST['project'];
    $aprice = $_POST['askprice'];
    $fprice = $_POST['finalprice'];
    $projstart = $_POST['projstart'];
    $client = $_POST['name'];
    $projend = $_POST['projend'];
    $desc = $_POST['brief'];
    $sql = "INSERT INTO `project_commercial`(`project`, `ask_price`, `final_price`,
    `project_start`,`project_end`,`brief`,`client`) 
    VALUES ('$project' , '$aprice' , '$fprice','$projstart','$projend','$desc','$client')";
    $exsql = "SELECT `project` FROM `project_commercial` WHERE `project` = '$project'";
    $exfetch = mysqli_query($db, $exsql);
    $ab = mysqli_num_rows($exfetch);
    echo $ab;
    if ($ab == 0) {
        if (mysqli_query($db, $sql)) {
            echo "done";
            echo $sql;
            header("Location:commercial.php?msg=$project added succesfully");
        } else {
            echo $sql;
            echo mysqli_error($db);
        }
    } else {
        header("Location:commercial.php?msg=Duplicate entry for $project . Try unique Name");
    }
} elseif (isset($_GET['pay'])) {
    $project = $_POST['project'];
    $price = $_POST['payment'];
    $paydate = $_POST['paydate'];
    $sql = "INSERT INTO `payment_history`( `project`, `payment`, `pay_date`) 
    VALUES ('$project' , '$price' , '$paydate')";
    if (mysqli_query($db, $sql) == true) {
        echo "done";
        header("Location:payment.php?msg=Payment Added");
    } else {
        echo $sql;
    }

} else {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['mail'];
    $location = $_POST['location'];
    $sql = "INSERT INTO `client_details`(`name`, `phone`, `email`, `location`) 
    VALUES ('$name','$phone','$email','$location')";
    $exsql = "SELECT `name` FROM `client_details` WHERE `name` = '$name'";
    $exfetch = mysqli_query($db, $exsql);
    $ab = mysqli_num_rows($exfetch);
    echo $ab;
    if ($ab == 0) {
        if (mysqli_query($db, $sql)) {
            echo "done";
            echo $sql;
            header("Location:add.php?msg=$name client added succesfully");
        } else {
            echo $sql;
            echo mysqli_error($db);
        }
    } else {
        header("Location:add.php?msg=Duplicate entry for $name . Try unique Name");
    }
}


?>