<!-- data save using savepromotion.php  -->
<?php
include('db.php');
include('auth.php');
include('header.php');
$date = date('Y-m-d');

$current_session_querry = 'SELECT session FROM newadmissions
where session is not null AND session !=0  limit 1';
$result = mysqli_query($conn, $current_session_querry);
$fetch_row = mysqli_fetch_assoc($result);
$current_session = $fetch_row['session'];
?>
<style>
    .container {
        border: 2px solid blue;
        width: 50%;
        margin: auto;
        padding: 20px;
        background-color: white;
    }



    body {
        background-color: burlywood;
    }

    .row {
        font-size: 20px;
        color: red;

    }

    .row1 {
        font-size: 20px;
        color: green;
    }
</style>

<form action="savepromotion.php" method="post">
    <div class="container">
        <h1>Student promotion page</h1>
        <div class="row">
            <label>Current Academic Session :</label>
            <input id="curs" 
                type="text" readonly name="oldsession" 
                value="<?= $current_session ?>">
        </div>
        <div class="row1">
            <label for="session">Enter New Academic session</label>
            <select id="news"
                name="newsession" required>
                <option value="">--SELECT--</option>
                <option value="2027-28">2027-28</option>
                <option value="2028-29">2028-29</option>
            </select>

        </div>
        <div class="row1">
            <label>enter faculty name</label>
            <input type="text" name="teacher_name" placeholder="faculty/teacher" required>
        </div>

        <div class="row1">
            <label>Date of promotion </label>
            <input type="date" name="date"  readonly required value="<?= $date ?>">
        </div>
        <div class="checkbox-group">
            <input type="checkbox" class="cb2" required> Attention: It is declared that you are changing the session by yourself.<br>
            <input type="checkbox" class="cb2" required> Data cannot be changed or modified once you promote the students.<br>
            <input type="checkbox" class="cb2" required> Are you sure you want to continue?<br>
            <input type="checkbox" class="cb2" required> Promote to the next session you entered.<br>
        </div>
        <button class="btn">PROMOTE</button>
    </div>


</form>
<script>
    let check = document.querySelectorAll(".cb2");
    let btn = document.querySelector(".btn");
    let cs = document.querySelector('#curs');
    let ns = document.querySelector("#news");

    ns.addEventListener('input', () => {
        let csval = String(cs.value);
        let nsval = String(ns.value);
        if (csval == nsval) {
            alert('new seesion and current session are same ');
            ns.value = "";
        }
    })
</script>