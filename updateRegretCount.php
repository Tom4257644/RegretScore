
<?php
session_start();
$dbconnect = mysqli_connect("localhost", "root", "", "regretScore");

if(!$dbconnect) {
    die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['regret_id']) && isset($_POST['action'])) {
    $regret_id = intval($_POST['regret_id']);
    $action = $_POST['action'];

    if($action == 'regret') {
        $sql = "UPDATE regrets SET regretters = regretters + 1 WHERE regret_ID = $regret_id";
    } elseif($action == 'glad') {
        $sql = "UPDATE regrets SET antiRegretters = antiRegretters + 1 WHERE regret_ID = $regret_id";
    } else {
        echo json_encode(array("status" => "error", "message" => "Invalid action"));
        exit;
    }

    if(mysqli_query($dbconnect, $sql)) {
        echo json_encode(array("status" => "success"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Failed to update: " . mysqli_error($dbconnect)));
    }
} else {
    echo json_encode(array("status" => "error", "message" => "Invalid input"));
}
?>
