
<div class="row justify-content-center">
    <?php
    $regret_sql = "SELECT regrets.* FROM regrets WHERE regrets.title='Career Choice' LIMIT 1";
    $regret_qry = mysqli_query($dbconnect, $regret_sql);
    $regret_rs = mysqli_fetch_assoc($regret_qry);
    ?>
    <div class="col-3 py-5">
        <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
            <div class="card-body text-center">
                <h5 class="card-title">Regret #<?php echo $regret_rs['regret_ID']; ?></h5>
                <h3 class="card-text"><?php echo $regret_rs['title']; ?></h3>
                <canvas id="donutChart" width="200" height="200" class="my-3"></canvas>
                <h1><?php echo $regret_rs['regretPercentage'] ?>% Regret it.</h1>
                <p><?php echo $regret_rs['regretters']; ?> people regret doing this</p>
                <p><?php echo $regret_rs['antiRegretters']; ?> people are happy they did</p>
            </div>
        </div>
    </div>


    <?php
    $regret2_sql = "SELECT regrets.* FROM regrets WHERE regrets.title='Getting a tattoo' LIMIT 1";
    $regret2_qry = mysqli_query($dbconnect, $regret2_sql);
    $regret2_rs = mysqli_fetch_assoc($regret2_qry);
    ?>
    <div class="col-3 py-5">
        <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
            <div class="card-body text-center">
                <h5 class="card-title">Regret #<?php echo $regret2_rs['regret_ID']; ?></h5>
                <h3 class="card-text"><?php echo $regret2_rs['title']; ?></h3>
                <canvas id="donutChart2" width="200" height="200" class="my-3 mx-5"></canvas>
                <h1><?php echo $regret2_rs['regretPercentage'] ?>% Regret it.</h1>
                <p><?php echo $regret2_rs['regretters']; ?> people regret doing this</p>
                <p><?php echo $regret2_rs['antiRegretters']; ?> people are happy they did</p>
            </div>
        </div>
    </div>


    <?php
    $regret3_sql = "SELECT regrets.* FROM regrets WHERE regrets.title='Dropping out of high school' LIMIT 1";
    $regret3_qry = mysqli_query($dbconnect, $regret3_sql);
    $regret3_rs = mysqli_fetch_assoc($regret3_qry);
    ?>
    <div class="col-3 py-5">
        <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
            <div class="card-body text-center">
                <h5 class="card-title">Regret #<?php echo $regret3_rs['regret_ID']; ?></h5>
                <h3 class="card-text"><?php echo $regret3_rs['title']; ?></h3>
                <canvas id="donutChart3" width="200" height="200" class="my-3 mx-5"></canvas>
                <h1><?php echo $regret3_rs['regretPercentage'] ?>% Regret it.</h1>
                <p><?php echo $regret3_rs['regretters']; ?> people regret doing this</p>
                <p><?php echo $regret3_rs['antiRegretters']; ?> people are happy they did</p>
            </div>
        </div>
    </div>
</div>

