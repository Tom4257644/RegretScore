<?php

    $regret_sql = "SELECT regrets.* FROM regrets ORDER BY RAND() LIMIT 1";
    $regret_qry = mysqli_query($dbconnect, $regret_sql);
    $regret_rs = mysqli_fetch_assoc($regret_qry);
    $percentageToBePutIntoDB = ((($regret_rs['regretters'])/(($regret_rs['regretters'])+($regret_rs['antiRegretters'])))*100)%100;
    $regretTitle = $regret_rs['title']; // Make sure this is properly set from your result set
    $updatePercentage_sql = "UPDATE regrets SET regretPercentage='$percentageToBePutIntoDB' WHERE title='$regretTitle'";
    $updatePercentage_qry = mysqli_query($dbconnect, $updatePercentage_sql);
?>

<div class="col-md-6 offset-md-3 py-5">
    <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
        <div class="card-body text-center">
            <h5 class="card-title">Regret #<?php echo $regret_rs['regret_ID']; ?></h5>
            <p class="card-text"><?php echo $regret_rs['title']; ?></p>
            <canvas id="donutChart" width="200" height="200" class="my-3"></canvas>
            <h1><?php echo $percentageToBePutIntoDB ?>% Regret it.</h1>

            <span id="regretCount" ><?php echo $regret_rs['regretters']; ?> people regret doing this</span> <br>
            <span id="gladCount"><?php echo $regret_rs['antiRegretters']; ?> people are happy they did</span>
            
            <div class="mt-3">
                <!-- <button id="regretButton" style="background-color: rgba(255, 99, 132, 0.5)" class="btn" onclick="regret()">I regret this</button>
                <button id="gladButton" style="background-color: rgba(75, 192, 192, 0.5)" class="btn" onclick="glad()">I am happy I did this</button> -->
                <button id="regretButton" class="btn btn-danger" onclick="regret()">I regret this</button>
                <button id="gladButton" class="btn btn-success" onclick="glad()">I am happy I did this</button>
            </div>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="index.php?page=random" class="btn btn-secondary">Show me a random regret</a>
    </div>
</div>
