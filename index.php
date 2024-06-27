<!DOCTYPE html>
<?php
    session_start();
    if (!isset($_GET['page'])) {
        header("Location: index.php?page=home");
    }
    $dbconnect = mysqli_connect("localhost", "root", "", "regretScore");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regret Score</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
</head>
<body>
    <?php include 'navbar.php' ?>

<div class="body">
    <div class="container mt-4">
        <div class="mainContent">
            <?php
            if ($_GET['page'] == 'home') {
                include 'search.php';
            } elseif ($_GET['page'] == 'worstDecisions') {
                include 'worstDecisions.php';
            } elseif ($_GET['page'] == 'bestDecisions') {
                include 'bestDecisions.php';
            } elseif ($_GET['page'] == 'search') {
                include 'search.php';
            } elseif ($_GET['page'] == 'random') {
                include 'random.php';
            } ?>
        </div>
    </div>
    <?php
        if ($_GET['page'] != 'random') { ?>
    
                <div class="randomButton text-center mt-4">
                    <a href="index.php?page=random" class="btn btn-secondary">Show me a random regret</a>
                </div>

            <?php }
            if ($_GET['page'] == 'home') {
                include 'homeSection.php';
            }
            ?>

    <footer class="bg-light text-center py-3 mt-5">
        <p>&copy; 2024 Regret Score</p>
    </footer>
</div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz4fnFO9gybBogGz6YFf5b7D8ROOcgV2Hj3HJ7l//onJ3UJf2gij2FhDkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-pZfO8B3Cd2qfgz+Z6tJ9L4Bq5yx/sY1A6BWeQwzeyS3B3Vy7JHc5TqRHEyl50z2Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

let regretPercentage = <?php echo $regret_rs['regretPercentage']; ?>; // Assuming you have a variable regretPercentage holding the percentage value
    let regretCount = <?php echo $regret_rs['regretters'] ?>;
    let gladCount = <?php echo $regret_rs['antiRegretters'] ?>;
    let regretButton = document.getElementById('regretButton'); 
    let gladButton = document.getElementById('gladButton');
    let regretId = <?php echo $regret_rs['regret_ID']; ?>; // no point setting this as a variable 

        function regret() {
            regretCount++;
            document.getElementById('regretCount').textContent = regretCount+' people regret doing this';
            document.getElementById('regretButton').outerHTML = '';
            document.getElementById('gladButton').outerHTML = '';
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateRegretCount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Response received:', xhr.responseText);
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                }
            };
            xhr.send('regret_id=' + regretId + '&action=regret');
            }
        

        function glad() {
            gladCount++;
            document.getElementById('gladCount').textContent = gladCount+' people are happy they did';
            document.getElementById('regretButton').outerHTML = '';
            document.getElementById('gladButton').outerHTML = '';
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'updateRegretCount.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Response received:', xhr.responseText);
                } else {
                    console.error('Error:', xhr.status, xhr.statusText);
                }
            };
            xhr.send('regret_id=' + regretId + '&action=glad');
            }
        


    function generateDonutChart(percentage, d) {
        var ctx = document.getElementById(d).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    label: 'Regret Percentage',
                    data: [percentage, 100 - percentage],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)', // Red
                        'rgba(75, 192, 192, 0.5)'  // Green
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                legend: {
                    display: false 
                },
                tooltips: {
                    mode: 'none' 
                }
            }
        });
    }

    generateDonutChart(regretPercentage, 'donutChart');

    <?php
     if ($_GET['page'] == 'home') { ?>
        generateDonutChart(<?php echo $regret2_rs['regretPercentage']; ?>, 'donutChart2');
        generateDonutChart(<?php echo $regret3_rs['regretPercentage']; ?>, 'donutChart3');
        <?php
    }

    ?>

    
</script>
</html>
