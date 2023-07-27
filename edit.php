<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit();
}

require "saman.php";
$id = $_GET['id'];

$mainsql = "SELECT * FROM `project_commercial` WHERE `project` = '$id'";
$fetch1 = mysqli_query($db, $mainsql);
$fetch12 = mysqli_query($db, $mainsql);
$main = mysqli_fetch_array($fetch12);


$name = $main['client'];
$project = $main['project'];

$projsql = "SELECT * FROM `project_details` WHERE `project` = '$project'";
$projfetch = mysqli_query($db, $projsql);


$clisql = "SELECT * FROM `client_details` WHERE `name` = '$name'";
$clifetch = mysqli_query($db, $clisql);


if (isset($_GET['update'])) {
    $phone = $_POST['phone'];
    $location = $_POST['location'];
    $mail = $_POST['mail'];
    $domain = $_POST['domain'];
    $domainname = $_POST['domainname'];
    $domainpurchase = $_POST['domainpurchase'];
    $domainexpiry = $_POST['domainexpiry'];
    $host = $_POST['hosting'];
    $hostpurchase = $_POST['hostpurchase'];
    $hostexpiry = $_POST['hostexpiry'];

    $aprice = $_POST['aprice'];
    $fprice = $_POST['fprice'];
    $projstart = $_POST['projstart'];
    $projend = $_POST['projend'];
    $desc = $_POST['brief'];

    $sql1 = "UPDATE `project_details` SET `domain_name`='$domainname',
    `domain`='$domain',`domain_purchase`='$domainpurchase',`domain_expiry`='$domainexpiry',
    `hosting`='$host',`hosting_purchase`='$hostpurchase',`hosting_expiry`='$hostexpiry',";

    $sql2 = "UPDATE `project_commercial` SET `ask_price`='$aprice',
    `final_price`='$fprice',`project_start`='$projstart',`project_end`='$projend',
    `brief`='$desc' WHERE `project` = '$project'";

    $sql3 = "UPDATE `client_details` SET 
    `phone`='$phone',`email`='$mail',`location`='$location' WHERE `name` = '$name'";

    if (isset($_POST['seo'])) {
        $seo = $_POST['seo'];
        $sql1 .= " `SEO`='$seo',";
    } else {
        $sql1 .= " `SEO`= NULL,";
    }


    if (isset($_POST['emailcheck'])) {
        $emailcheck = $_POST['emailcheck'];
        $emailtype = $_POST['emailtype'];
        $email = $_POST['email'];
        $emailcompany = $_POST['emailprovider'];
        $emailpurchase = $_POST['emailpurchase'];
        $emailexpiry = $_POST['emailexpiry'];
        $sql1 .= " `is_email_service` = '$emailcheck' , `email_type`='$emailtype',`email`='$email',
        `email_provider`='$emailcompany',`email_purchase`='$emailpurchase',
        `email_expiry`='$emailexpiry'";
    } else {
        $sql1 .= " `is_email_service` = NULL ,
        `email_type`=NULL,`email`=NULL,
        `email_provider`=NULL,`email_purchase`=NULL,
        `email_expiry`=NULL";
    }
    $sql1 .= " WHERE `project` = '$project'";



    echo $sql1 . "\n\n" . $sql2 . "\n\n" . $sql3;
    if (mysqli_query($db, $sql1) == TRUE) {
        echo "\n\n\n SUccess";
        if (mysqli_query($db, $sql2) == TRUE) {
            echo "\n\n\n SUccess";
            if (mysqli_query($db, $sql3) == TRUE) {
                echo "\n\n\n SUccess";
                header("Location:lists.php");
            } else {
                echo "\n\n\n fail $sql3";
            }
        } else {
            echo "\n\n\n fail $sql2";
        }
    } else {
        echo "\n\n\n fail $sql1";
    }
}


?>




<h1>Update Details</h1>
<form action="edit.php?update=<?php echo $id; ?>&id=<?php echo $id; ?>" method="post">
    <div class="fs-5 pt-2 p-3 f-div m-auto">
        <?php
        if (mysqli_num_rows($clifetch) > 0) {
            while ($clidata = mysqli_fetch_array($clifetch)) {
                ?>



                <h3>Required Details</h3>

                <label for="name" class=" ps-2 mt-2">Name</label>
                <input type="text" value="<?php echo $clidata['name']; ?>" name="name" style="font-size: 15px;"
                    class="w-100 date form-control" placeholder="Abc Xyz" disabled>

                <label for="phone" class=" ps-2 pt-4">Phone</label>
                <input type="tel" value="<?php echo $clidata['phone']; ?>" name="phone" style="font-size: 15px;"
                    class="w-100 date form-control " placeholder="+91 736XXXXXXX" required>

                <label for="mail" class=" ps-2 pt-4">Email</label>
                <input type="email" value="<?php echo $clidata['email']; ?>" name="mail" style="font-size: 15px;"
                    class="w-100 date form-control" placeholder="example@email.com" required>

                <label for="mail" class=" ps-2 pt-4">Location</label>
                <input type="text" value="<?php echo $clidata['location']; ?>" name="location" style="font-size: 15px;"
                    class="w-100 date form-control" placeholder="Mumbai" required>

            <?php }
        } else {
            echo "<h3>No client data</h3>";
        }
        if (mysqli_num_rows($fetch1) > 0) {
            while ($maindata = mysqli_fetch_array($fetch1)) {
                ?>

            </div>
            <!------------Details right panel------->
    <hr />


    <h3>Project Detail</h3>

    <label for="mail" class=" ps-2 pt-4">Project Name</label>
    <input type="text" name="project" style="font-size: 15px;" class="w-100 date form-control"
        placeholder="Ex google, apple" required value="<?php echo $maindata['project'] ?>" disabled>

    <span class="d-block pt-3 m-auto w-100">
        <label for="projstart" class=" ps-2 pt-1">Project Start Date</label>
        <input type="date" id="projstart" style="font-size: 15px;" name="projstart" class="px-2  date form-control "
            value="<?php echo $maindata['project_start'] ?>"></span>

    <span class="d-block pt-3 m-auto w-100">
        <label for="projend" class=" ps-2 pt-1">Project End Date</label>
        <input type="date" id="projend" style="font-size: 15px;" name="projend" class="px-2  date form-control "
            value="<?php echo $maindata['project_end'] ?>"></span>

    <span class="d-block pt-3 m-auto w-100">
        <label for="projend" class=" ps-2 pt-1">Project Ask Price</label>
        <input type="number" id="projend" style="font-size: 15px;" name="aprice" class="px-2  date form-control "
            value="<?php echo $maindata['ask_price'] ?>"></span>

    <span class="d-block pt-3 m-auto w-100">
        <label for="projend" class=" ps-2 pt-1">Project Final Price</label>
        <input type="number" id="projend" style="font-size: 15px;" name="fprice" class="px-2  date form-control "
            value="<?php echo $maindata['final_price'] ?>"></span>

    <span class="d-block pt-3 m-auto w-100">
        <label for="brief" class=" ps-2 pt-1">Project Brief</label>
        <textarea class="w-100 form-control" id="brief" name="brief" rows="5"
            style="font-size: 15px;"></textarea></span>
    <script>
        $("#brief").val('<?php echo $maindata['description'] ?>')
    </script>

    <?php }
        } else {
            echo "<h3>No project commercial details</h3>";
        }
        if (mysqli_num_rows($projfetch) > 0) {
            while ($projdata = mysqli_fetch_array($projfetch)) {
                ?>




    <hr />

    <div class="fs-5 ps-2 m-auto pt-5 s-div ">
        <h3>Domain Detail</h3>


        <?php if ($projdata['domain'] == 'customer') { ?>
        <div class="m-auto mt-4">
            <label for="domianer">Purchased by</label><br />
            <div class="btn-group m-auto" role="group" aria-label="Basic radio toggle button group">
                <input value="customer" type="radio" class="btn-check" name="domain" id="domaincustomer"
                    autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="domaincustomer" style="font-size: x-small;">Customer</label>

                <input type="radio" value="tts" class="btn-check" name="domain" id="domaintts" autocomplete="off">
                <label class="btn btn-outline-dark" for="domaintts" style="font-size: x-small;">TTS</label>
            </div>
        </div>
        <?php } else { ?>
        <div class="m-auto mt-4">
            <label for="domianer">Purchased by</label><br />
            <div class="btn-group m-auto" role="group" aria-label="Basic radio toggle button group">
                <input value="customer" type="radio" class="btn-check" name="domain" id="domaincustomer"
                    autocomplete="off">
                <label class="btn btn-outline-dark" for="domaincustomer" style="font-size: x-small;">Customer</label>

                <input type="radio" value="tts" class="btn-check" name="domain" id="domaintts" autocomplete="off"
                    checked>
                <label class="btn btn-outline-dark" for="domaintts" style="font-size: x-small;">TTS</label>
            </div>
        </div>
        <?php } ?>

        <label for="mail" class=" ps-2 pt-4">Domain Name</label>
        <input type="text" name="domainname" value="<?php echo $projdata['domain_name']; ?>" id="domainname"
            style="font-size: 15px;" class="w-100 date form-control" placeholder="www.xyz.com">

        <span class="d-block pt-3 m-auto w-100">
            <label for="purchasedate" class=" ps-2 pt-1">Domain Purchase Date</label>
            <input type="date" value="<?php echo $projdata['domain_purchase']; ?>" id=" purchasedate"
                style="font-size: 15px;" name="domainpurchase" class="px-2  date form-control w-25"></span>

        <span class="d-block pt-3 m-auto w-100">
            <label for="purchaseexpiry" class=" ps-2 pt-1">Domain Expiry Date</label>
            <input type="date" value="<?php echo $projdata['domain_expiry']; ?>" id="purchaseexpiry"
                style="font-size: 15px;" name="domainexpiry" class="px-2  date form-control w-25"></span>

        <hr />

        <h3>Hosting Detail</h3>

        <?php if ($projdata['hosting'] == 'customer') { ?>
        <span class="d-block mt-5">
            <label for="domianer mt-5">Purchased by</label><br />
            <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                <input value="Customer" type="radio" class="btn-check" name="hosting" id="hostcustomer"
                    autocomplete="off" checked>
                <label class="btn btn-outline-dark" for="hostcustomer" style="font-size: x-small;">Customer</label>

                <input type="radio" value="tts" class="btn-check" name="hosting" id="hosttts" autocomplete="off">
                <label class="btn btn-outline-dark" for="hosttts" style="font-size: x-small;">TTS</label>

            </div>
        </span>
        <?php } else { ?>
        <span class="d-block mt-5">
            <label for="domianer mt-5">Purchased by</label><br />
            <div class="btn-group " role="group" aria-label="Basic radio toggle button group">
                <input value="Customer" type="radio" class="btn-check" name="hosting" id="hostcustomer"
                    autocomplete="off">
                <label class="btn btn-outline-dark" for="hostcustomer" style="font-size: x-small;">Customer</label>

                <input type="radio" value="tts" class="btn-check" name="hosting" id="hosttts" autocomplete="off"
                    checked>
                <label class="btn btn-outline-dark" for="hosttts" style="font-size: x-small;">TTS</label>

            </div>
        </span>
        <?php } ?>



        <span class="d-block pt-5 m-auto">
            <label for="purchasedate" class=" ps-2 pt-1">Hosting Purchase Date</label>
            <input type="date" value="<?php echo $projdata['hosting_purchase']; ?>" id=" purchasedate"
                style="font-size: 15px;" name="hostpurchase" class="px-2 date form-control w-25"></span>

        <span class="d-block py-3 m-auto">
            <label for="purchaseexpiry" class=" ps-2 pt-1">Hosting Expiry Date</label>
            <input type="date" value="<?php echo $projdata['hosting_expiry']; ?>" id="purchaseexpiry"
                style="font-size: 15px;" name="hostexpiry" class="px-2 date form-control w-25"></span>

        <hr />
        <h3>SEO Service</h3>

        <span class="align-items-center d-flex">
            <input type="checkbox" class="form-check-input " value="seo" name="seo" id=""
                style="font-size: small;width: 3%;" <?php if ($projdata['SEO'] != null) {
                    echo "checked";
                } ?>>
            <label for="emailcheck" class="ps-2 form-check-label">SEO</label></span>

        <hr />

        <h3>Email Service Detail</h3>

        <span class="align-items-center d-flex">
            <input type="checkbox" class="form-check-input " value="emailed" name="emailcheck" id="emailcheck"
                style="font-size: small;width: 3%;" <?php if ($projdata['is_email_service'] != null) {
                    echo "checked";
                } ?>>
            <label for="emailcheck" class="ps-2 form-check-label">Email Purchased</label></span>

        <div>


            <div class="d-flex align-items-center justify-content-between">

                <?php if ($projdata['email_type'] == 'paid') { ?>
                <span class="d-block mt-1">
                    <label for="domianer mt-1">Email Type</label><br />
                    <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                        <input value="Paid" type="radio" class="btn-check" name="emailtype" id="emailpaid"
                            autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="emailpaid" style="font-size: x-small;">Paid</label>

                        <input type="radio" value="Free" class="btn-check" name="emailtype" id="emailfree"
                            autocomplete="off">
                        <label class="btn btn-outline-dark" for="emailfree" style="font-size: x-small;">Free</label>

                    </div>
                </span>
                <?php } else { ?>
                <span class="d-block mt-1">
                    <label for="domianer mt-1">Email Type</label><br />
                    <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                        <input value="paid" type="radio" class="btn-check" name="emailtype" id="emailpaid"
                            autocomplete="off">
                        <label class="btn btn-outline-dark" for="emailpaid" style="font-size: x-small;">Paid</label>

                        <input type="radio" value="Free" class="btn-check" name="emailtype" id="emailfree"
                            autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="emailfree" style="font-size: x-small;">Free</label>

                    </div>
                </span>
                <?php } ?>





                <?php if ($projdata['email'] == 'customer') { ?>
                <span class="d-block py-3 ">
                    <label for="domianer">Purchased by</label><br />
                    <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                        <input value="customer" type="radio" class="btn-check" name="email" id="emailcustomer"
                            autocomplete="off" checked>
                        <label class="btn btn-outline-dark" for="emailcustomer"
                            style="font-size: x-small;">Customer</label>

                        <input type="radio" value="tts" class="btn-check" name="email" id="emailtts" autocomplete="off">
                        <label class="btn btn-outline-dark" for="emailtts" style="font-size: x-small;">TTS</label>

                    </div>
                </span>

                <?php } else { ?>
                <span class="d-block py-3 ">
                    <label for="domianer">Purchased by</label><br />
                    <div class="btn-group mx-2" role="group" aria-label="Basic radio toggle button group">
                        <input value="Customer" type="radio" class="btn-check" name="email" id="emailcustomer"
                            autocomplete="off">
                        <label class="btn btn-outline-dark" for="emailcustomer"
                            style="font-size: x-small;">Customer</label>

                        <input type="radio" value="tts" class="btn-check" name="email" id="emailtts" autocomplete="off"
                            checked>
                        <label class="btn btn-outline-dark" for="emailtts" style="font-size: x-small;">TTS</label>

                    </div>
                </span>
                <?php } ?>


            </div>

        </div>

        <span class="d-block py-3 m-auto">
            <label for="purchasedate" class=" ps-2 pt-1">Email Service Provider</label>
            <input type="text" id="emailcompany" style="font-size: 15px;"
                value="<?php echo $projdata['email_provider']; ?>" name="emailprovider" placeholder="xyz company"
                class="px-2 date form-control w-100"></span>



        <span class="d-block pt-2 m-auto">
            <label for="purchasedate" class=" ps-2 pt-1">Email Purchase Date</label>
            <input type="date" id="emailpur" value="<?php echo $projdata['email_purchase']; ?>" style="font-size: 15px;"
                name="emailpurchase" class="px-2 date form-control w-25"></span>

        <span class="d-block mb-5 py-3">
            <label for="purchaseexpiry" class=" ps-2 pt-1">Email Expiry Date</label>
            <input type="date" id="emailexp" value="<?php echo $projdata['email_expiry']; ?>" style="font-size: 15px;"
                name="emailexpiry" class="px-2 date form-control w-25"></span>
    </div>
    <?php }
        } else {
            echo "<h3>No Project Details</h3>";
        } ?>
    </div>
    <span class="align-items-center d-flex my-3">
        <input type="submit" value="Update" name="submit"
            class="w-50 btn bg-black fw-bolder text-light rounded-pill px-3 m-auto">
    </span>

</form>