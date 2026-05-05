<!-- is file m me fees records ki history or regenration k banane vala hu  -->
<?php
include('auth.php');
include('db.php');
include('header.php') ;
if (isset($_GET['scholar_no'])) {
    $scholar_no = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    $query = "SELECT * FROM fees_payments WHERE scholar_no = '$scholar_no'ORDER BY receipt_no DESC";
    $res = mysqli_query($conn, $query);
    if (mysqli_num_rows($res) == 0) {
        die("<h2 style='text-align:center; padding-top:50px;'> Oops! Records Not Found say for fee submission!</h2>");
    }
} else {
    header("Location:dash.php");
    exit();
}

?>
<link rel="stylesheet" href="feeshist.css">

<div class="maincont">
    <h2>FESS HISTORY OF STUDENT </h2>
    <div>
        <table>
            <thead>
                <tr class="row">
                    <th>S.no</th>
                    <th>Date</th>
                    <th>Name</th>
                    <th>Reciept No</th>
                    <th>Regenerate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($data = mysqli_fetch_assoc($res)) {
                ?>
                    <tr class="col">
                        <td><?= $data['scholar_no'] ?></td>
                        <td><?= date(  'd-m-Y',strtotime($data['date']))?></td>
                        <td><?= $data['student_name'] ?></td>

                        <td><?= $data['receipt_no'] ?></td>
                        <td> <a href="print_receipt.php?id=<?= $data['receipt_no'] ?>">
                                regenerate</a>
                        </td>
                    </tr>
                <?php

                } ?>
            </tbody>

        </table>
    </div>


</div>