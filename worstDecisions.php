<?php

if (!isset($_GET['key'])) {
    $regret_sql = "SELECT regrets.* FROM regrets ORDER BY regretPercentage DESC LIMIT 1";
    $regret_qry = mysqli_query($dbconnect, $regret_sql);
    $regret_rs = mysqli_fetch_assoc($regret_qry);
    $a = 1;
    $percentageToBePutIntoDB = (($regret_rs['regretters'])/(($regret_rs['regretters'])+($regret_rs['antiRegretters'])))*100;
    $regretTitle = $regret_rs['title']; // Make sure this is properly set from your result set
    $updatePercentage_sql = "UPDATE regrets SET regretPercentage='$percentageToBePutIntoDB' WHERE title='$regretTitle'";
    $updatePercentage_qry = mysqli_query($dbconnect, $updatePercentage_sql);
} else {
$a = ($_GET['key']) + 1;

$regret_sql = "SELECT regrets.* FROM regrets ORDER BY regretPercentage DESC LIMIT $a";
$regret_qry = mysqli_query($dbconnect, $regret_sql);
for ($i = 0; $i < ($a-1); $i++) {
    mysqli_fetch_assoc($regret_qry);
}
$regret_rs = mysqli_fetch_assoc($regret_qry);
}

?>

<div class="col-md-6 offset-md-3 py-2">
    <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
        <div class="card-body text-center">
            <h5 class="card-title">Regret #<?php echo $regret_rs['regret_ID']; ?></h5>
            <p class="card-text"><?php echo $regret_rs['title']; ?></p>
            <canvas id="donutChart" width="200" height="200" class="my-3"></canvas>    
            <h1><?php echo $regret_rs['regretPercentage']; ?>% Regret it.</h1>
            <p><?php echo $regret_rs['regretters']; ?> people regret doing this</p>
            <p><?php echo $regret_rs['antiRegretters']; ?> people are happy they did</p>
        </div>
    </div>
    <div class="text-center mt-4">
        <a href="index.php?page=worstDecisions&key=<?php echo $a ?>" class="btn btn-secondary">Next</a>
    </div>
</div>