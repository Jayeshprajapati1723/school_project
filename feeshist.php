<!-- is file m me fees records ki history or regenration k banane vala hu  -->
<?php
include('auth.php');
include('db.php');

if (isset($_GET['scholar_no'])) {
    $scholar_no = mysqli_real_escape_string($conn, $_GET['scholar_no']);
    $query = "SELECT * FROM fees_payments WHERE scholar_no = '$scholar_no'";
    $res = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($res);
    if (!$data) {
        die("<h2 style='text-align:center; padding-top:50px;'>Student Not Found!</h2>");
    }
} else {
    header("Location:dash.php");
    exit();
}

?>
<link rel="stylesheet" href="feeshist.css">

<div class="maincoont">
    <h2>FESS HISTORY OF STUDENT </h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Name</th>
                    <th>Reciept No</th>
                    <th>Regenerate</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $data['scholar_no'] ?></td>
                
                    <td><?= $data['student_name'] ?></td>
                
                    <td><?= $data['receipt_no'] ?></td>
                    <td> <a href="print_receipt.php ?scholar_no=<?= $data['scholar_no'] ?>" >
                    regenerate</a> 
                </td>
                </tr>
            </tbody>

        </table>
    </div>


</div>