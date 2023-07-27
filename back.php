<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login');
    exit();
}
require "saman.php";
$id = 0;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} elseif (isset($_GET['upid'])) {
    $id = $_GET['upid'];
}
$sql = "SELECT `client`, `project` FROM `project_commercial` WHERE `project` = '$id'";

$fe = mysqli_query($db, $sql);
$data = mysqli_fetch_row($fe);

$name = $data[0];
$project = $data[1];


$projsql = "SELECT * FROM `project_details` WHERE `project` = '$id'";
$fetch = mysqli_query($db, $projsql);

$clientsql = "SELECT * FROM `client_details` WHERE `name` = '$name'";
$clifetch = mysqli_query($db, $clientsql);

$comsql = "SELECT * FROM `project_commercial` WHERE `project` = '$project'";
$commer = mysqli_query($db, $comsql);

$paysql = "SELECT * FROM `payment_history` WHERE `project` = '$project'";
$payfetch = mysqli_query($db, $paysql);

?>
<style>
    .ainvid {
        display: flex;

    }

    .secdiv {
        display: none;
        width: 100%
    }

    .firstdiv {
        width: 100%
    }

    table {
        overflow: scroll;
    }

    label {
        padding-inline-start: 20px;
    }
</style>
<?php
if (isset($_GET['id'])) { ?>
    <span>

        <div class=" m-auto mt-4">
            <div class="btn-group m-auto" role="group" aria-label="Basic radio toggle button group">
                <input value="customer" type="radio" class="btn-check" name="domain" id="domaincustomer" autocomplete="off"
                    checked onclick="showhide('first_div','second-div')">
                <label class="btn btn-outline-warning fw-bolder" for="domaincustomer"
                    style="font-size: small;">Commercial</label>

                <input type="radio" value="tts" class="btn-check" name="domain" id="domaintts" autocomplete="off"
                    onclick="showhide('second-div','first_div')">
                <label class="btn btn-outline-warning fw-medium" for="domaintts" style="font-size: small;">Sevice
                    details</label>
            </div>
        </div>

    </span>

    <div class=" rounded p-4 ainvid  align-items-center m-auto" style="7">

        <div id="first_div" class="firstdiv">
            <?php
            while ($obj = mysqli_fetch_array($clifetch)) { ?>
                <table class="overflow-scroll mt-4 table ">

                    <tr class="">
                        <th>Name</th>
                        <th>Contact No.</th>
                        <th>Location</th>
                        <th>Email</th>
                    </tr>
                    <tr class="py-3 down">
                        <th>
                            <?php echo $obj['name']; ?>
                        </th>
                        <th>
                            <?php echo $obj['phone']; ?>
                        </th>
                        <th>
                            <?php echo $obj['location']; ?>
                        </th>
                        <th>
                            <?php echo $obj['email']; ?>
                        </th>
                    </tr>
                </table>
            <?php }
            $object = mysqli_fetch_row($commer) ?>
            <table class="overflow-scroll mt-4 table ">

                <tr class="">
                    <th>Project</th>
                    <th>Ask Price</th>
                    <th>Final Price</th>
                    <th>Project Start Date</th>
                    <th>Project Start Date</th>
                </tr>
                <tr class="py-3 down">
                    <th>
                        <?php echo $project ?>
                    </th>
                    <th>
                        <?php echo $object[3]; ?>
                    </th>
                    <th>
                        <?php echo $object[4]; ?>
                    </th>
                    <th>
                        <?php echo $object[5]; ?>
                    </th>
                    <th>
                        <?php echo $object[6]; ?>
                    </th>
                </tr>
            </table>
            <p style="max-height:100px;overflow:auto;">
                <?php echo $object[7]; ?>
            </p>
            <p>Payments</p>
            <table>
                <tr class="">

                    <?php
                    while ($row = mysqli_fetch_array($payfetch)) { ?>
                        <th>
                            <?php echo $row['payment'] . " / " . $row['pay_date']; ?>
                        </th>

                    <?php } ?>



                </tr>
            </table>

        </div>
        <div id="second-div" class="secdiv">
            <?php
            if (mysqli_num_rows($fetch) == 0) {
                echo "<h3>No Project Details Available</h3>";
            }
            while ($obj = mysqli_fetch_array($fetch)) { ?>
                <table class="overflow-scroll my-4 table ">
                    <tr class="">
                        <th>Domain By</th>
                        <th>Domain Name</th>
                        <th>Purchase Date</th>
                        <th>Expiry Date</th>
                    </tr>
                    <tr class="py-3 down">
                        <th>
                            <?php echo $obj['domain']; ?>
                        </th>
                        <th>
                            <a href="//<?php echo $obj['domain_name']; ?>" target="_blank">
                                <?php echo $obj['domain_name']; ?></a>
                        </th>
                        <th>
                            <?php echo $obj['domain_purchase']; ?>
                        </th>
                        <th>
                            <?php echo $obj['domain_expiry']; ?>
                        </th>
                    </tr>
                </table>

                <table class="overflow-scroll my-4 table ">
                    <tr class="">
                        <th>Host by</th>
                        <th>Purchase date</th>
                        <th>Expiry Date</th>
                    </tr>
                    <tr class="py-3 down">
                        <th>
                            <?php echo $obj['hosting']; ?>
                        </th>
                        <th>
                            <?php echo $obj['hosting_purchase']; ?>
                        </th>
                        <th>
                            <?php echo $obj['hosting_expiry']; ?>
                        </th>
                    </tr>
                </table>

                <table class="w-100overflow-scroll my-4 table ">
                    <tr class="">
                        <th>Email</th>
                        <th>Email Provider</th>
                        <th>Email Type</th>
                        <th>Purchase date</th>
                        <th>Expiry Date</th>
                    </tr>
                    <tr class="py-3 down">
                        <th>
                            <?php echo $obj['email']; ?>
                        </th>
                        <th>
                            <?php echo $obj['email_provider']; ?>
                        </th>
                        <th>
                            <?php echo $obj['email_type']; ?>
                        </th>
                        <th>
                            <?php echo $obj['email_purchase']; ?>
                        </th>
                        <th>
                            <?php echo $obj['email_expiry']; ?>
                        </th>
                    </tr>
                </table>

                <p>SEO :
                    <?php echo $obj['SEO']; ?>
                </p>

            </div>
        <?php } ?>
    </div>
<?php } ?>
<script src="jquery-3.6.4.min.js"></script>
<script>
    function showhide(a, b) {
        var show = "#" + a;
        var hide = "#" + b;
        $(show).css('display', 'block');
        $(hide).css('display', 'none');
    }


</script>