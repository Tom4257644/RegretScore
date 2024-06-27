<?php
echo '<h1 class="text-center">About to make a decision? Want to know if you\'ll regret it??</h1>';
echo '<p class="text-center">Maybe you will... You should probably find out first...</p>';
?>
<form class="search-form" method="post" action="index.php?page=search">
    <input class="search-input" type="text" name="query" placeholder="Enter your search query">
    <button class="search-button" type="submit">Search</button>
</form>

<?php

if ((isset($_GET['query'])) || (isset($_POST['query']))) {
    


    if (isset($_POST['query'])) {
        $query = $_POST['query'];
    } else {$query = $_GET['query'];}

    $regret_sql = "SELECT * FROM regrets WHERE title LIKE '%$query%' ORDER BY RAND()";
    $regret_qry = mysqli_query($dbconnect, $regret_sql);
    $regret_rs = mysqli_fetch_assoc($regret_qry);
    $percentageToBePutIntoDB = (($regret_rs['regretters'])/(($regret_rs['regretters'])+($regret_rs['antiRegretters'])))*100;
    $regretTitle = $regret_rs['title']; // Make sure this is properly set from your result set
    $updatePercentage_sql = "UPDATE regrets SET regretPercentage='$percentageToBePutIntoDB' WHERE title='$regretTitle'";
    $updatePercentage_qry = mysqli_query($dbconnect, $updatePercentage_sql);
    
    // Check if there are any results
    if ($regret_qry) {
        $num_results = mysqli_num_rows($regret_qry);
        if ($num_results > 0) {
            echo $num_results . " results found"; ?>

            <div class="col-md-6 offset-md-3 py-5">
                <div class="card" style="background-color: #ded8c8; border-radius: 10px; border: 5px solid #52504d;">
                    <div class="card-body text-center">
                        <h5 class="card-title">Regret #<?php echo $regret_rs['regret_ID']; ?></h5>
                        <p class="card-text"><?php echo $regret_rs['title']; ?></p>
                        <canvas id="donutChart" width="200" height="200" class="my-3"></canvas>
                        <h1><?php echo $regret_rs['regretPercentage']; ?>% Regret it.</h1>
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
                <?php 
                if ($num_results > 1) { ?>
                <div class="text-center mt-4">
                    <a href="index.php?page=search&query=<?php echo $query ?>" class="btn btn-secondary">Next</a>
                    <!-- gotta link whats being searched here -->
                </div>
<?php }
    ?>
</div>


<?php
            



        } else {
            echo "0 results found";
        }
    } 
} 
?>




