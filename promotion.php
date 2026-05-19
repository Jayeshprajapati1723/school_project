<!-- data save using savepromotion.php  -->
<?php
include('db.php');
include('auth.php');
include('header.php');
$date = date('Y-m-d');











?>
<style>
    .container {
        border: 2px solid blue;
        width: 50%;
        margin: auto;
        padding: 20px;
        background-color:white  ;
    }



    body {
        background-color: burlywood;
    }
</style>

<form action="promosave.php" method="post">
    <div class="container">
<h1>Student promotion page</h1>
    <label for="session">Enter new session</label>
        <select id="session" name="session">
            <option>2026-27</option>
            <option>2027-28</option>
        </select>
        <div>
            <label>enter faculty name</label>
            <input type="text" name="teacher name" placeholder="faculty/teacher" required>
        </div>

        <div>
            <label>Date of promotion </label>
            <input type="date" readonly required value="<?= $date ?>">
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
</script>