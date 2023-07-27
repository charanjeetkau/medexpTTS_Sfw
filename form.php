<?php
require "saman.php";
$id = 0;
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (isset($_GET['client'])) {
        $sql = "SELECT `project` FROM `project_commercial` WHERE `client` = '$id'";
        $fetdelcli = mysqli_query($db, $sql);
        if ($fetdelcli != false) {
            $project_name = mysqli_fetch_array($fetdelcli)['project'];
            $newsql = "DELETE FROM `client_details` WHERE `name` = '$id'";

            if (mysqli_query($db, $newsql) == True) {
                $id = $project_name;
            } else {
                echo $sql . "/" . $newsql;
            }
        } else {
            echo $sql;
        }

    }

    $sql = "DELETE FROM `project_commercial` WHERE `project` = '$id';";
    if (mysqli_query($db, $sql) == true) {
        $sql = "DELETE FROM `project_details` WHERE `project` = '$id';";
        if (mysqli_query($db, $sql) == true) {
            header("Location:lists.php?msg=$id is deleted");
        }
    } else {
        echo mysqli_error($db);
        echo $sql;
    }
} elseif (isset($_GET['payid'])) {
    if ($_GET['payid'] != 'All') {
        $id = $_GET['payid'];
        $fsql = "SELECT `final_price`,`final_price` from `project_commercial` WHERE `project` = '$id'";
        $ffetch = mysqli_query($db, $fsql);
        $temppr = mysqli_fetch_array($ffetch);
        $fdata = $temppr[0];
        $fdataa = $temppr[1];
        $sql = "SELECT `payment` , `pay_date` FROM `payment_history` WHERE `project` = '$id'";
        $fetch = mysqli_query($db, $sql);

        ?>


        <table class='table fs-3'>
            <tr>
                <th>Amount</th>
                <th>Date</th>
            </tr>
            <?php
            while ($row = mysqli_fetch_array($fetch)) { ?>
                <tr>
                    <?php
                    $fdata -= $row['payment'];
                    echo "<th>" . $row['payment'] . "</th> 
                <th>" . $row['pay_date'] . "</th>" ?>
                </tr>
            <?php } ?>
        </table>
        <p class="text-center">
            <?php echo "Cost = $fdataa | Balance : $fdata"; ?>
        </p>

    <?php }
} elseif (isset($_GET['clientshow'])) {

    $sql = "SELECT * FROM `client_details`";
    $fetch = mysqli_query($db, $sql);
    ?>
    <p class="text-center fs-5 ">Number of client :
    <?php echo mysqli_num_rows($fetch); ?>
    </p>
    <table class="table w-100">
        <tr style="background-color: #139f95;">
            <th>Name</th>
            <th>Location</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    <?php while ($row = mysqli_fetch_array($fetch)) { ?>
        <tr>
            <th>
                <?php echo $row['name']; ?>
            </th>
            <th>
                <?php echo $row['location']; ?>
            </th>
            <th>
                <?php echo $row['phone']; ?>
            </th>
            <th>
                <?php echo $row['email']; ?>
            </th>
            <th>
                <button class="ms-4 btn btnn p-0 px-2 delbtn" value="<?php echo $row['name']; ?>">
                    <i class="fa fa-trash "></i></button>
            </th>
        </tr>
    <?php } ?>
    </table>

<?php } ?>